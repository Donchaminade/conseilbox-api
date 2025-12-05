<?php

use App\Http\Controllers\Api\ConseilController;
use App\Http\Controllers\Api\PubliciteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

Route::prefix('conseils')->name('api.conseils.')->group(function (): void {
    Route::get('/', [ConseilController::class, 'index'])->name('index');
    Route::post('/', [ConseilController::class, 'store'])->name('store');
    Route::get('/{conseil}', [ConseilController::class, 'show'])->name('show');
});

Route::get('publicites', [PubliciteController::class, 'index'])->name('api.publicites.index');






// ... vos autres routes existantes ...

Route::get('/publicites/image/{filename}', function ($filename) {

    // Chemin complet vers le fichier dans le disque "public"
    $path = 'publicites/' . $filename;

    // Vérification si le fichier existe
    if (! Storage::disk('public')->exists($path)) {
        return Response::json([
            'error' => 'Image non trouvée.'
        ], 404);
    }

    // Récupération du fichier et de son type MIME
    $file = Storage::disk('public')->get($path);
    $mime = Storage::disk('public')->mimeType($path);

    // Retour de l'image
    return Response::make($file, 200, [
        'Content-Type' => $mime
    ]);

})->name('api.publicites.image');
