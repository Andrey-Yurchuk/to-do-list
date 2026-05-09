<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/health');
});

Route::get('/health', function () {
    return response()->json([
        'message' => 'server running',
    ]);
});

Route::get('/docs', function () {
    return view('swagger');
});

Route::get('/docs/openapi.yml', function () {
    return response()->file(
        base_path('docs/openapi.yml'),
        ['Content-Type' => 'application/yaml; charset=UTF-8'],
    );
});
