<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Haversine;
use App\Http\Controllers\Controller;
use App\Models\PoorHousehold;
use App\Models\WorshipPlace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PoorHouseholdController extends Controller
{
    /** GET /api/household — list all households */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => PoorHousehold::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /** POST /api/household — create household */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $validated['description'] = $validated['description'] ?? '';

        $household = PoorHousehold::create($validated);
        $this->recalculate($household);

        return response()->json(['success' => true, 'data' => $household->fresh(), 'message' => 'Household saved'], 201);
    }

    /** PUT /api/household/{id} — update household */
    public function update(Request $request, int $id): JsonResponse
    {
        $household = PoorHousehold::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'sometimes|string|max:255',
            'latitude'    => 'sometimes|numeric',
            'longitude'   => 'sometimes|numeric',
            'description' => 'nullable|string',
        ]);

        $household->update(array_filter($validated, fn($v) => $v !== null));
        $this->recalculate($household->fresh());

        return response()->json(['success' => true, 'message' => 'Household updated']);
    }

    /** DELETE /api/household/{id} — delete household */
    public function destroy(int $id): JsonResponse
    {
        PoorHousehold::findOrFail($id)->delete();

        return response()->json(['success' => true, 'message' => 'Household deleted']);
    }

    /** Recalculate is_covered for a single household */
    private function recalculate(PoorHousehold $household): void
    {
        $worships = WorshipPlace::all();
        $covered  = false;

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
