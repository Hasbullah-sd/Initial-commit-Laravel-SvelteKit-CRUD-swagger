<?php

// app/Http/Controllers/DesaController.php
namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        return response()->json(Desa::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'kepala_desa' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $desa = Desa::create($validated);
        return response()->json($desa, 201);
    }

    public function show($id)
    {
        $desa = Desa::findOrFail($id);
        return response()->json($desa);
    }

    public function update(Request $request, $id)
    {
        $desa = Desa::findOrFail($id);
        $desa->update($request->all());
        return response()->json($desa);
    }

    public function destroy($id)
    {
        $desa = Desa::findOrFail($id);
        $desa->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
