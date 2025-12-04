<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PubliciteResource;
use App\Models\Publicite;
use Illuminate\Http\Request;

class PubliciteController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'limit' => ['nullable', 'integer', 'min:1', 'max:50'],
            'only_active' => ['nullable', 'boolean'],
        ]);

        $query = Publicite::query();

        // Récupérer la valeur de 'only_active' de manière sécurisée
        // S'assurer que 'only_active' est traité comme un booléen et qu'il n'est pas un tableau.
        $onlyActive = filter_var($request->input('only_active', true), FILTER_VALIDATE_BOOLEAN);


        if ($onlyActive) {
            $query->active();
        }

        $query->orderByDesc('created_at');

        if (! empty($validated['limit'])) {
            return PubliciteResource::collection(
                $query->limit((int) $validated['limit'])->get()
            );
        }

        return PubliciteResource::collection(
            $query->paginate(15)->withQueryString()
        );
    }
}

