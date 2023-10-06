<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return response()->json([
            'message' => 'success',
            'data' => $menus
        ], 200);
    }

    public function store(Request $request)
    {

        // Simpan data menu ke tabel 'menus'
        $menu = Menu::create([
            'name' => $request->name,
            'price' => $request->price,
            // Tambahkan kolom lainnya sesuai kebutuhan

            // Simpan nama gambar ke database
            'image' => $request->file('image')->store('public/images'), // Mengunggah gambar dan menyimpan nama file
        ]);

        return response()->json(['message' => 'Menu berhasil ditambahkan', 'menu' => $menu]);
    }
}
