<?php

namespace App\Http\Controllers;

use Image;
use App\Photo;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotosController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

     /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store($slug, Request $request)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $this->validate($request, [
            'photos' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $file = $request->file('photos');
        $name = time() . $file->getClientOriginalName();
        $path = 'meals/photos/' . $name;
        $file = Image::make($file->getRealPath())->resize(800, 500)->save($path);

        $photo = new Photo();
        $photo->product_id = $product->id;
        $photo->photos = $path;
        $photo->save();
    }
}
