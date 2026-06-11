<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Haversine;
use App\Http\Controllers\Controller;
use App\Models\PoorHousehold;
use App\Models\WorshipPlace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorshipPlaceController extends Controller
{
    /** GET /api/worship — list all worship places */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => WorshipPlace::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /** POST /api/worship — create worship place */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
            'type'        => 'nullable|in:Masjid,Gereja,Pura,Vihara,Kelenteng,Lainnya',
            'description' => 'nullable|string',
            'radius'      => 'nullable|numeric|min:0',
        ]);

        $validated['type']        = $validated['type']        ?? 'Masjid';
        $validated['description'] = $validated['description'] ?? '';
        $validated['radius']      = $validated['radius']      ?? 500;

        $worship = WorshipPlace::create($validated);
        $this->recalculate();

        return response()->json(['success' => true, 'data' => $worship, 'message' => 'Worship place saved'], 201);
    }

    /** PUT /api/worship/{id} — update worship place */
    public function update(Request $request, int $id): JsonResponse
    {
        $worship = WorshipPlace::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'sometimes|string|max:255',
            'latitude'    => 'sometimes|numeric',
            'longitude'   => 'sometimes|numeric',
            'type'        => 'nullable|in:Masjid,Gereja,Pura,Vihara,Kelenteng,Lainnya',
            'description' => 'nullable|string',
            'radius'      => 'nullable|numeric|min:0',
        ]);

        $worship->update(array_filter($validated, fn($v) => $v !== null));
        $this->recalculate();

        return response()->json(['success' => true, 'message' => 'Worship place updated']);
    }

    /** DELETE /api/worship/{id} — delete worship place */
    public function destroy(int $id): JsonResponse
    {
        WorshipPlace::findOrFail($id)->delete();
        $this->recalculate();

        return response()->json(['success' => true, 'message' => 'Worship place deleted']);
    }

    /** POST /api/worship/recalculate — recalculate coverage for all households */
    public function recalculateAction(): JsonResponse
    {
        $this->recalculate();
        $households = PoorHousehold::orderBy('created_at', 'desc')->get();

        return response()->json(['success' => true, 'data' => $households, 'message' => 'Coverage recalculated']);
    }

    /** Internal: recalculate is_covered for every household */
    private function recalculate(): void
    {
        $worships    = WorshipPlace::all();
        $households  = PoorHousehold::all();

        foreach ($households as $household) {
            $covered = false;
            foreach ($worships as $worship) {
                $dist = Haversine::distance(
                    $household->latitude, $household->longitude,
                    $worship->latitude,   $worship->longitude
                );
                if ($dist <= $worship->radius) {
                    $covered = true;
                    break;
                }
            }
            $household->update(['is_covered' => $covered]);
        }
    }
}
