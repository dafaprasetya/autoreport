<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function editUser($id, Request $request)
    {
        $userId = decrypt($id);
        $user = User::find($userId);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'picture' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2148',
        ]);
        // dd($validatedData);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $pp = $request->file('picture');
        if($pp){
            if($user->picture != 'default/user.png'){
                Storage::delete('public/profile_picture/' . $user->picture);
            }
            $nama_file = str_replace(" ", "_", $validatedData['name']).time().'.'.$pp->extension();
            $pp->storeAs('public/profile_picture/',$nama_file);
            $user->picture = $nama_file;
        }
        $user->save();
        return redirect()->back()->with('success','Profile berhasil diupdate');
    }
    public function editPassword($id, Request $request) {
        $userId = decrypt($id);
        $user = User::find($userId);
        $validatedData = $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        $user->password = Hash::make($validatedData['password']);
        $user->save();
        return redirect()->back()->with('success','Password berhasil diupdate');
    }
    public function userProfile() {
        $data = [
            'title' => 'Admin Profile',
        ];
        return view('admin.user.index', $data);
    }
}
