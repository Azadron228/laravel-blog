<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  public function updateAvatar(Request $request)
  {
    // $path = Storage::putFile('avatars', $request->file('avatar'));
    $path = $request->file('avatar')->store('avatars', 'public');
    return $path;
  }
  
  public function showUpdateAvatarForm()
  {
    return view('update-avatar');
  }

  public function profile(Request $request)
    {
        $user = Auth::user();

        $data = [
            'avatar' => $user->avatar,
            'name' => $user->name,
            'email' => $user->email,
        ];

        return response()->json($data);
    }

}
