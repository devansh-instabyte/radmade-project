<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Session;

class AdminController extends Controller
{
   


    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validate the request data
            $request->validate([
                'username' => 'required',
                'password' => 'required|min:6',
            ]);

            // Create a new admin
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->username = $request->input('username');
            $admin->password = Hash::make($request->input('password'));
            $admin->status = 1; // Active status
            $admin->save();

            // Redirect to login page with success message
            return redirect()->route('admin.login')->with('success', 'Registration successful. Please log in.');
        }

        // If GET request, show the registration form
        return view('auth.register');
    }


    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validate the request data
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            // Attempt to find the admin by username
            $admin = Admin::where('username', $request->input('username'))->first();

            if ($admin && Hash::check($request->input('password'), $admin->password)) {
                 Session::put('admin_id', $admin->id);
                  Session::put('name', $admin->name);
                 Session::put('admin_username', $admin->username);
                 Session::put('is_admin_logged_in', true);
                // Authentication passed, redirect to dashboard
                return redirect()->route('admin.dashboard');
            } else {
                // Authentication failed, redirect back with error
                return redirect()->back()->withErrors(['Invalid username or password.'])->withInput();
            }
        }

        // If GET request, show the login form
        return view('auth.login');
    }


 public function logout(Request $request)
{
    Session::flush(); // clears all admin session

    return redirect()->route('admin.login')
        ->with('success', 'You have been logged out successfully.');
}


    /**
     * Show the form for creating a new resource.
     */
  public function settings(Request $request)
{
    // Fetch the first settings row or create one
    $setting = Settings::first() ?? new Settings();

    if ($request->isMethod('post')) {

          // Handle Logo 
        if ($request->hasFile('logo')) {
            $file1 = $request->file('logo')->store('logos', 'public');
            $setting->logo = $file1;
        }

          // Handle Footer Logo
        if ($request->hasFile('flogo')) {
            $file1 = $request->file('flogo')->store('logos', 'public');
            $setting->flogo = $file1;
        }


        // Handle banner 1
        if ($request->hasFile('banner_1')) {
            $file1 = $request->file('banner_1')->store('banners', 'public');
            $setting->banner1 = $file1;
        }

        // Handle banner 2
        if ($request->hasFile('banner_2')) {
            $file2 = $request->file('banner_2')->store('banners', 'public');
            $setting->banner2 = $file2;
        }

        // Handle banner 3
        if ($request->hasFile('banner_3')) {
            $file3 = $request->file('banner_3')->store('banners', 'public');
            $setting->banner3 = $file3;
        }

        $setting->save();

        return back()->with('success', 'Settings updated successfully!');
    }

    return view('settings.index', compact('setting'));

 }

 public function removeImage($field)
{
    $setting = Settings::first();

    if (!$setting || !in_array($field, ['logo', 'flogo', 'banner1', 'banner2', 'banner3'])) {
        return back()->withErrors('Invalid field');
    }

    // Delete file from storage
    if ($setting->$field && Storage::disk('public')->exists($setting->$field)) {
        Storage::disk('public')->delete($setting->$field);
    }

    // Remove from database
    $setting->$field = null;
    $setting->save();

    return back()->with('success', ucfirst($field).' removed successfully!');
}


}

