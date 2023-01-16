<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

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
}
