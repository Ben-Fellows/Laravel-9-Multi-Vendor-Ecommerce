<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    // Get all subcategories, ordered by most recently added
    public function AllSubCategories() {
        $subcategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all', compact('subcategories'));
    }

    // Create subcategory
    public function CreateSubCategory() {
        // Get info from the category table to link with subcategory
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.subcategory.subcategory_create', compact('categories'));
    }

    // Store subcategory
    public function StoreSubCategory(Request $request){ 

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)), 
        ]);

       $notification = array(
            'message' => 'Sub Category Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategories')->with($notification); 
    }

    // Edit subCategory 
    public function EditSubCategory($id) {
        // Get info from the category table to link with subcategory
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $sub_category = SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit', compact('categories', 'sub_category'));
    }

    // Update subcategory
    public function UpdateSubCategory(Request $request) {
        $subcategory_id = $request->id;

        SubCategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)), 
        ]);

       $notification = array(
            'message' => 'Sub Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategories')->with($notification);
    }

    // Delete subcategory
    public function DeleteSubCategory($id) {
        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
