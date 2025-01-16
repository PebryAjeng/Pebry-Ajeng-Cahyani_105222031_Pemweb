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

	// public function getSelectedData(Request $request)
	// {

	// 	// Tuliskan code mengambil 1 data jadwal user dengan id jadwal, simpan di variabel $data
	// 	$data = Event::where('id', $request->id)->where('user_id', Auth::id())->first();
	// 	$data = [];
	// 	return response()->json($data);
	// }

	public function getSelectedData(Request $request)
{
    // Validate that 'id' is passed and exists in the events table
    $validated = $request->validate([
        'id' => 'required|exists:events,id'
    ]);

    // Try to find the event by the provided 'id'
    $event = Event::find($validated['id']);

    // If event found, return the event data as JSON
    if ($event) {
        return response()->json([
            'id' => $event->id,
            'name' => $event->name,
            'start' => $event->start->format('Y-m-d'),  // Format to a date string
            'end' => $event->end->format('Y-m-d')       // Format to a date string
        ]);
    }

    // If event not found, return an error response
    return response()->json(['error' => 'Event not found'], 404);
}


	// public function update (Request $request) {

	// 	$validated = $request->validate([
	//         'id' => 'required|exists:events,id',
	//         'name' => 'required|string|max:255',
	//         'start' => 'required|date',
	//         'end' => 'required|date|after_or_equal:start_date',
	//     ]);

	//     Event::where('id', $validated['id'])->where('user_id', Auth::id())->update([
	//         'name' => $validated['name'],
	//         'start' => $validated['start'],
	//         'end' => $validated['end'],
	//     ]);
	//     return redirect()->route('event.home')->with('success', 'Jadwal berhasil diperbarui.');
	// }

	public function update(Request $request)
	{
		// Validate the incoming request data
		$validated = $request->validate([
			'id' => 'required|exists:events,id',  // Ensure event ID exists in the database
			'name' => 'required|string|max:255',  // Ensure name is a string and not longer than 255 characters
			'start' => 'required|date',  // Ensure start date is a valid date
			'end' => 'required|date|after_or_equal:start',  // Ensure end date is a valid date and is after or equal to the start date
		]);

		// Update the event data
		Event::where('id', $validated['id'])->update([
			'name' => $validated['name'],
			'start' => $validated['start'],
			'end' => $validated['end'],
		]);

		// Return a success response or redirect with a success message
		return redirect()->route('event.home')->with('success', 'Jadwal berhasil diperbarui.');
	}


	public function delete(Request $request)
	{

		// Delete event by ID
		$event = Event::findOrFail($request->id);
		$event->delete();

		return response()->json(['success' => true, 'message' => 'Jadwal berhasil dihapus']);
	}
}
