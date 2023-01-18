<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;

class CategoryController extends Controller
{
    // Get all categories, ordered by most recently added
    public function AllCategories() {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    // Create category
    public function CreateCategory() {
        return view('backend.category.category_create');
    }

    // Store category
    public function StoreCategory(Request $request) {
        // Create unique image name
        $image = $request->file('category_image');
        $generate_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Use image intervention to resize the image
        Image::make($image)->resize(120, 120)->save('upload/category_images/'.$generate_name);
        // Insert image into the DB
        $image_url = 'upload/category_images/'.$generate_name;
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_image' => $image_url,
        ]);

        $notification = array(
            'message' => 'Category Created Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.categories')->with($notification);
    }

    // Edit category
    public function EditCategory($id) {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    // Update category
    public function UpdateCategory(Request $request) {
        $category_id = $request->id;
        $old_image = $request->old_image;

        if($request->file('category_image')) {
            // Create unique image name
            $image = $request->file('category_image');
            $generate_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            
            // Use image intervention to resize the image
            Image::make($image)->resize(120, 120)->save('upload/category_images/'.$generate_name);
            
            // Insert image into the DB
            $image_url = 'upload/category_images/'.$generate_name;
            
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $image_url,
            ]);

            $notification = array(
                'message' => 'Category Name and Image Updated Successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('all.categories')->with($notification);
        } else {
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);

            $notification = array(
                'message' => 'Category Name Updated Successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('all.categories')->with($notification);
        }
    }

    // Delete category
    public function DeleteCategory($id) {
        $category = Category::findOrFail($id);
        $image = $category->category_image;
        // Delete image from the folder
        unlink($image);
        // Delete from the DB
        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
