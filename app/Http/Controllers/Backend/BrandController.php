<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    // Get all brands, ordered by most recently added
    public function AllBrands() {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }

    // Create brand
    public function CreateBrand() {
        return view('backend.brand.brand_create');
    }

    // Store brand
    public function StoreBrand(Request $request) {
        // Create unique image name
        $image = $request->file('brand_image');
        $generate_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Use image intervention to resize the image
        Image::make($image)->resize(300, 300)->save('upload/brand_images/'.$generate_name);
        // Insert image into the DB
        $image_url = 'upload/brand_images/'.$generate_name;
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $image_url,
        ]);

        $notification = array(
            'message' => 'Branded Created Successully.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brands')->with($notification);
    }
}
