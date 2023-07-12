<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
  public function updateAvatar(Request $request)
  {
    $request->validate([
        'avatar' => 'required|image|max:2048', // Max file size of 2MB
    ]);

    $user = auth()->user();

    // Delete old avatar if exists
    if ($user->avatar) {
        Storage::disk('public')->delete($user->avatar);
    }

    $avatarPath = $request->file('avatar')->store('avatars', 'public');

    // Update the user's avatar
    $user->avatar = $avatarPath;
    $user->save();

    return redirect()->back()->with('success', 'Avatar uploaded successfully!');
  }
}
