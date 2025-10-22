<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use App\Http\Requests\StoreCompteRequest;
use App\Http\Requests\UpdateCompteRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Compte::with('client');

        // Filtres
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        if ($request->has('statut') && $request->statut) {
            $query->where('statut', $request->statut);
        }

        if ($request->has('search') && $request->search) {
            $query->where('numero_compte', 'like', '%' . $request->search . '%')
                  ->orWhereHas('client', function ($q) use ($request) {
                      $q->where('nom', 'like', '%' . $request->search . '%');
                  });
        }

        // Tri
        $sortBy = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $query->orderBy($sortBy, $order);

        // Pagination
        $perPage = $request->get('per_page', 15);
        $comptes = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $comptes,
            'message' => 'Liste des comptes récupérée avec succès'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompteRequest $request): JsonResponse
    {
        $compte = Compte::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $compte->load('client'),
            'message' => 'Compte créé avec succès'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Compte $compte): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $compte->load('client'),
            'message' => 'Détails du compte récupérés avec succès'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompteRequest $request, Compte $compte): JsonResponse
    {
        $compte->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $compte->load('client'),
            'message' => 'Compte mis à jour avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compte $compte): JsonResponse
    {
        $compte->delete();

        return response()->json([
            'success' => true,
            'message' => 'Compte supprimé avec succès'
        ]);
    }
}
