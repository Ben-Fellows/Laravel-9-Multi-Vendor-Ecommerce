<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function AdminDashboard() {
        return view('admin.index');
    }

    // Admin login
    public function AdminLogin() {
        return view('admin.admin_login');
    }

    // Admin logout
    public function AdminDestroy(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    // Access all admin details
    public function AdminProfile() {
        $id = Auth::user()->id;
        
        $adminData = User::find($id);
        
        return view('admin.admin_profile_view', compact('adminData'));
    }

    // Update all admin details
    public function AdminProfileStore(Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        // Handle profile image
        if($request->file('photo')) {
            $file = $request->file('photo');
            // Delete old photo from the folder when a new photo is uploaded
            @unlink(public_path('upload/admin_images/'.$data->photo));
            // Create unique filename
            $filename = date('YmdHi').$file->getClientOriginalName();
            // Move the photo to admin_images under the new file name
            $file->move(public_path('upload/admin_images'), $filename);
            
            $data['photo'] = $filename;
        }
        // Store photo in the DB
        $data->save();
        return redirect()->back();
    }
}
