<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorTiga
{

	public function getData()
	{
		// Tuliskan code mengambil semua data jadwal user, simpan di variabel $data
		$data = Event::where('user_id', Auth::id())->get();
		$data = [];
		return $data;
	}

	public function getSelectedData(Request $request)
{
    $validated = $request->validate([
        'id' => 'required|exists:events,id'
    ]);

    $event = Event::find($validated['id']);

    if ($event) {
        return response()->json([
            'id' => $event->id,
            'name' => $event->name,
            'start' => $event->start->format('Y-m-d'),
            'end' => $event->end->format('Y-m-d')
        ]);
    }

    return response()->json(['error' => 'Event not found'], 404);
}

	public function update(Request $request)
	{
		// Validate the incoming request data
		$validated = $request->validate([
			'id' => 'required|exists:events,id',
			'name' => 'required|string|max:255',
			'start' => 'required|date',
			'end' => 'required|date|after_or_equal:start',
		]);

		Event::where('id', $validated['id'])->update([
			'name' => $validated['name'],
			'start' => $validated['start'],
			'end' => $validated['end'],
		]);

		return redirect()->route('event.home')->with('success', 'Jadwal berhasil diperbarui.');
	}


	public function delete(Request $request)
	{

		$event = Event::findOrFail($request->id);
		$event->delete();

		return response()->json(['success' => true, 'message' => 'Jadwal berhasil dihapus']);
	}
}
