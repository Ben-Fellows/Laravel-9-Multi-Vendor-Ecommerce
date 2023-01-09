<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function VendorDashboard() {
        return view('vendor.index');
    }

    public function VendorLogin() {
        return view('vendor.vendor_login');
    }

    public function VendorDestroy(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }

    // Access all admin details
    public function VendorProfile() {
        $id = Auth::user()->id;
        
        $vendorData = User::find($id);
        
        return view('vendor.vendor_profile_view', compact('vendorData'));
    }

     // Update all admin details
     public function VendorProfileStore(Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_bio = $request->vendor_bio;

        // Handle profile image
        if($request->file('photo')) {
            $file = $request->file('photo');
            // Delete old photo from the folder when a new photo is uploaded
            @unlink(public_path('upload/vendor_images/'.$data->photo));
            // Create unique filename
            $filename = date('YmdHi').$file->getClientOriginalName();
            // Move the photo to admin_images under the new file name
            $file->move(public_path('upload/vendor_images'), $filename);
            
            $data['photo'] = $filename;
        }
        // Store photo in the DB
        $data->save();

        $notification = array(
            'message' => 'Vendor Profile Details Updated Successully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
