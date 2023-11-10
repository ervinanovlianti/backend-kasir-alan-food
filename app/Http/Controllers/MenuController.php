<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $menus->each(function ($menu) {
            $menu->image_url = asset("public/images/{$menu->image}");
        });
        return response()->json([
            'message' => 'success',
            'data' => $menus
        ], 200);
    }
    public function show($id)
    {
        $menu = Menu::find($id);
        return response()->json([
            'message' => 'success',
            'data' => $menu
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => '', // Batasi jenis file dan ukuran gambar
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/images');
            $imageName = basename($imagePath);
        } else {
            $imageName = 'default.jpg'; // Jika tidak ada gambar yang diunggah
        }

        $menu = Menu::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imageName, // Simpan nama gambar ke dalam database
        ]);

        return response()->json(['message' => 'Menu berhasil ditambahkan', 'data' => $menu], 201);
    }

    // public function update(Request $request, $id)
    // {
    //     $menu = Menu::findOrFail($id);

    //     $request->validate([
    //         'name' => 'string',
    //         'price' => 'numeric',
    //         'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Batasi jenis file dan ukuran gambar
    //     ]);

    //     if ($request->hasFile('image')) {
    //         // Unggah gambar baru dan perbarui nama file yang tersimpan di storage/app/public/images
    //         $image = $request->file('image');
    //         $imagePath = $image->store('public/images');
    //         $imageName = basename($imagePath);

    //         // Hapus gambar lama jika tidak lagi digunakan
    //         if ($menu->image !== 'default.jpg') {
    //             $oldImagePath = 'public/images/' . $menu->image;
    //             Storage::delete($oldImagePath);
    //         }

    //         $menu->image = $imageName;
    //     }

    //     if ($request->has('name')) {
    //         $menu->name = $request->name;
    //     }

    //     if ($request->has('price')) {
    //         $menu->price = $request->price;
    //     }

    //     $menu->save();

    //     return response()->json(['message' => 'Menu berhasil diperbarui', 'data' => $menu]);
    // }
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'string',
            'price' => 'numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Batasi jenis file dan ukuran gambar
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/images');
            $imageName = basename($imagePath);

            // Hapus gambar lama jika tidak lagi digunakan
            if ($menu->image !== 'default.jpg') {
                $oldImagePath = 'public/images/' . $menu->image;
                Storage::delete($oldImagePath);
            }

            $menu->update([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $imageName,

            ]);

            // $menu->image = $imageName;
        }else{
            $menu->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);
        }

        // if ($request->has('name')) {
        //     $menu->name = $request->name;
        // }

        // if ($request->has('price')) {
        //     $menu->price = $request->price;
        // }

        // $menu->save();

        return response()->json(['message' => 'Menu berhasil diperbarui', 'data' => $menu]);
    }


    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Hapus gambar yang terkait
        if ($menu->image !== 'default.jpg') {
            $imagePath = 'public/images/' . $menu->image;
            Storage::delete($imagePath);
        }

        $menu->delete();

        return response()->json(['message' => 'Menu berhasil dihapus']);
    }
    public function edit(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->update($request->all());
        return response()->json(['message' => 'Menu berhasil di ubah', 'menu' => $menu]);
    }
    public function delete($id){
        $menu = Menu::find($id);
        $menu->delete();
        return response()->json(['message' => 'Menu berhasil di hapus', 'menu' => $menu]);
    }
}
