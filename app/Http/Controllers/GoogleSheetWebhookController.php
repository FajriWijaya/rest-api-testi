<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class GoogleSheetWebhookController extends Controller
{
     public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|string',
        ]);

        $testimoni = Testimoni::updateOrCreate(
            ['name' => $validated['name']],
            [
                'rating' => $validated['rating'],
                'description' => $validated['description'],
            ]
        );

        return response()->json([
            'success' => true,
            'data'    => $request->all(),
        ]);
    }   
}
