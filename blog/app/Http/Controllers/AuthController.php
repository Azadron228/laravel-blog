<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{ 
  public function create(): View
  {
    return view('login');
  }

  public function store(Request $request): RedirectResponse
  {
  $email = $request->input('email');
  $password = $request->input('password');
  $remember = $request->has('remember');

  if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
    $request->session()->regenerate();
    return redirect()->intended('/');
  }

  // Handle authentication failure
  return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
  }


  public function logout(Request $request): RedirectResponse
  {
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
  }
}

