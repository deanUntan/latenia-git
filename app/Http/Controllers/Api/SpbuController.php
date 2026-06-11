<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spbu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpbuController extends Controller
{
    /** GET /api/fuelpoint — list all SPBU */
    public function index(): JsonResponse
    {
        $spbuList = Spbu::orderBy('created_at', 'desc')->get();
        return response()->json(['success' => true, 'data' => $spbuList]);
    }

    /** POST /api/fuelpoint — create SPBU */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
            'description' => 'nullable|string',
            'is_24_hours' => 'nullable|boolean',
        ]);

        $validated['description'] = $validated['description'] ?? '';
        $validated['is_24_hours'] = $validated['is_24_hours'] ?? false;

        $spbu = Spbu::create($validated);

        return response()->json(['success' => true, 'data' => $spbu, 'message' => 'SPBU saved'], 201);
    }

    /** PUT /api/fuelpoint/{id} — update SPBU */
    public function update(Request $request, int $id): JsonResponse
    {
        $spbu = Spbu::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'sometimes|string|max:255',
            'latitude'    => 'sometimes|numeric',
            'longitude'   => 'sometimes|numeric',
            'description' => 'nullable|string',
            'is_24_hours' => 'nullable|boolean',
        ]);

        $spbu->update(array_filter($validated, fn($v) => $v !== null));

        return response()->json(['success' => true, 'message' => 'SPBU updated']);
    }

    /** DELETE /api/fuelpoint/{id} — delete SPBU */
    public function destroy(int $id): JsonResponse
    {
        Spbu::findOrFail($id)->delete();

        return response()->json(['success' => true, 'message' => 'SPBU deleted']);
    }
}
