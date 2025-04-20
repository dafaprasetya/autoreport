<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserManagement extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $name, $email;

    #[Validate('required|min:8|confirmed')]
    public $password;

    #[Validate('nullable|image|max:6148')]
    public $picture;

    public function editUser()
    {
        $this->validate();
        $userId = Auth::user()->id;
        $user = User::find($userId);
        // dd($validatedData);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();
        $this->reset(['name', 'email', 'picture']);
        session()->flash('message', 'Data berhasil ditambahkan.');
    }
    public function editPassword() {
        $this->validate();
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $user->password = $this->password;
        $user->save();
        return redirect()->route('userprofile')->with('success','Password berhasil diupdate');
    }
    public function render()
    {
        $user = Auth::user();
        $data = [
            'user' => $user,
        ];
        return view('livewire.user.user-management', $data);
    }
}
