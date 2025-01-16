<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorTiga {

	public function getData () {
		// Tuliskan code mengambil semua data jadwal user, simpan di variabel $data
        $data = Event::where('user_id', Auth::id())->get();
		$data = [];
		return $data;
	}

	public function getSelectedData (Request $request) {

		// Tuliskan code mengambil 1 data jadwal user dengan id jadwal, simpan di variabel $data
        $data = Event::where('id', $request->id)->where('user_id', Auth::id())->first();
		$data = [];
		return response()->json($data);
	}

	public function update (Request $request) {

		$validated = $request->validate([
            'id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Event::where('id', $validated['id'])->where('user_id', Auth::id())->update([
            'name' => $validated['name'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);
        return redirect()->route('event.home')->with('success', 'Jadwal berhasil diperbarui.');
	}

	public function delete (Request $request) {

		Event::where('id', $request->id)->where('user_id', Auth::id())->delete();
        return redirect()->route('event.home')->with('success', 'Jadwal berhasil dihapus.');
	}
}

?>
