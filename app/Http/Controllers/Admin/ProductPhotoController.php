<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\ProductPhoto;

class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request){
        //deleta do diretorio

        $photoName = $request->get('photoName');
        if (Storage::disk('public')->exists($photoName)) {
            Storage::disk('public')->delete($photoName);
        }
        //deleta do banco
        $removePhoto = ProductPhoto::where('image', $photoName);
        $productId = $removePhoto->first()->product_id;
        $removePhoto->delete();
       

        flash('Imagem Removida com Sucesso!')->success();
        return redirect()->route('admin.products.edit', ['product' =>$productId]);
    }
}
