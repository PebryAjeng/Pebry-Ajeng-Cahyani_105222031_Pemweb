<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NomorSatu {


	public function auth (Request $request) {


$credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        return redirect()->route('event.home')->with('success', 'Login berhasil!');
    } else {

        return redirect()->back()->with('error', 'Email atau password salah!');
    }

		return redirect()->route('event.home');
	}

	public function logout (Request $request) {

		Auth::logout();
        return redirect()->route('event.home')->with('success', 'Logout berhasil!');

        return redirect()->route('event.home');
	}
}

?>
