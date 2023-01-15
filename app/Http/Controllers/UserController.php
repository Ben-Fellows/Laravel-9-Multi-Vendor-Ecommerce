<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function UserDashboard() {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('index', compact('userData'));
    }

    // Update all user details
    public function UserProfileStore(Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->name = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        // Handle profile image
        if($request->file('photo')) {
            $file = $request->file('photo');
            // Delete old photo from the folder when a new photo is uploaded
            @unlink(public_path('upload/user_images/'.$data->photo));
            // Create unique filename
            $filename = date('YmdHi').$file->getClientOriginalName();
            // Move the photo to admin_images under the new file name
            $file->move(public_path('upload/user_images'), $filename);
            
            $data['photo'] = $filename;
        }
        // Store photo in the DB
        $data->save();

        $notification = array(
            'message' => 'User Profile Details Updated Successully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
