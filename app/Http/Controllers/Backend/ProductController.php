<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\MultiImage;
use App\Models\Brand;
use Image;

class ProductController extends Controller
{
    // All products
    public function AllProducts() {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }

    // Create products
    public function CreateProducts() {
        return view('backend.product.product_create');
    }
}
