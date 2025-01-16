<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorDua {

    public function submit(Request $request) {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Event::create([
            'name' => $validated['name'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'user_id' => Auth::id(), // Ambil user ID dari session
        ]);

        return redirect()->route('event.home')->with('success', 'Jadwal berhasil ditambahkan!');
    }
}
?>
