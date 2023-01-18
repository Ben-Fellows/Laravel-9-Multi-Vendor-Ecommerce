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
            'message' => 'Brand Created Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brands')->with($notification);
    }

    // Edit brand
    public function EditBrand($id) {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    // Update brand
    public function UpdateBrand(Request $request) {
        $brand_id = $request->id;
        $old_image = $request->old_image;

        if($request->file('brand_image')) {
            // Create unique image name
            $image = $request->file('brand_image');
            $generate_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            
            // Use image intervention to resize the image
            Image::make($image)->resize(300, 300)->save('upload/brand_images/'.$generate_name);
            
            // Insert image into the DB
            $image_url = 'upload/brand_images/'.$generate_name;
            
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $image_url,
            ]);

            $notification = array(
                'message' => 'Brand Name and Image Updated Successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('all.brands')->with($notification);
        } else {
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);

            $notification = array(
                'message' => 'Brand Name Updated Successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('all.brands')->with($notification);
        }
    }
    
    // Delete brand
    public function DeleteBrand($id) {
        $brand = Brand::findOrFail($id);
        $image = $brand->brand_image;
        // Delete image from the folder
        unlink($image);
        // Delete from the DB
        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
