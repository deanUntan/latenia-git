<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GeoFeature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeoFeatureController extends Controller
{
    /** GET /api/geotrace — list all features */
    public function index(): JsonResponse
    {
        $features = GeoFeature::orderBy('created_at', 'desc')->get();
        return response()->json(['success' => true, 'data' => $features]);
    }

    /** POST /api/geotrace — create feature */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:polyline,polygon',
            'coordinates' => 'required',
            'description' => 'nullable|string',
            'color'       => 'nullable|string|max:7',
        ]);

        $validated['color']       = $validated['color'] ?? '#4f8ef7';
        $validated['description'] = $validated['description'] ?? '';

        $feature = GeoFeature::create($validated);

        return response()->json(['success' => true, 'data' => $feature, 'message' => 'Feature saved'], 201);
    }

    /** PUT /api/geotrace/{id} — update feature */
    public function update(Request $request, int $id): JsonResponse
    {
        $feature = GeoFeature::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'sometimes|string|max:255',
            'type'        => 'sometimes|in:polyline,polygon',
            'coordinates' => 'sometimes',
            'description' => 'nullable|string',
            'color'       => 'nullable|string|max:7',
        ]);

        $feature->update(array_filter($validated, fn($v) => $v !== null));

        return response()->json(['success' => true, 'message' => 'Feature updated']);
    }

    /** DELETE /api/geotrace/{id} — delete feature */
    public function destroy(int $id): JsonResponse
    {
        GeoFeature::findOrFail($id)->delete();

        return response()->json(['success' => true, 'message' => 'Feature deleted']);
    }
}
