<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public static function createCalendarEvents( $events) {
        $cevents = [];

        foreach($events as $evet) {
            // masa
            $st = explode(' ', $evet->start_date);
            $et =explode(' ', $evet->end_date);
            //date
            $cevents[] = [
                "title" => $evet->name,
                "start" => $st[0],
                'end' => $et[0]
            ];

            //masa
            $cevents[] = [
                // 'title' =>  date_format(date_create($et[1]), 'h.ia'),
                'title' => 'Start' . $evet->name,
                'start' => $evet->start_date,
                // 'end' => $evet->end_date
            ];
            $ett = $st[0] != $et[0] ?date('Y-m-d',strtotime('-1 day', strtotime($evet->end_date))) : $et[0];
            $cevents[] = [
                // 'title' =>  date_format(date_create($et[1]), 'h.ia'),
                'title' => 'End' . $evet->name,
                'start' => "{$ett   } {$et[1]}",
                // 'end' => $evet->end_date
            ];
            
        }

        return $cevents;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = events::all();

        // kena ikut format dia
       $cevents = $this->createCalendarEvents($events);

        return view('admin.events.index', compact('events', 'cevents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // bruh kau tak pass $cevents kat sini
        $events = Events::all();
        $cevents = $this->createCalendarEvents($events);
        // tgk u view apa
        return view('admin.events.create', compact('events', 'cevents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        $event = new events;
        $event->name = $request->name;
        $event->description = $request->description;
        $event->longitude = $request->longitude;
        $event->latitude = $request->latitude;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;

      
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('img')->put('images/events/' . $filename, $image->get());
            $event->image = 'events/' . $filename;
        }

        $event->save();

        return redirect()->route('events.index')
                        ->with('success', 'Location created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = events::find($id);
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = events::find($id);
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  * $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'description' => 'required',
        'longitude' => 'required|numeric',
        'latitude' => 'required|numeric',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image update
    ]);

    $event = events::find($id);
    $event->name = $request->name;
    $event->description = $request->description;
    $event->longitude = $request->longitude;
    $event->latitude = $request->latitude;
    $event->start_date = $request->start_date;
    $event->end_date = $request->end_date;

    // Handle image update (optional)
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();

        // Delete existing image (optional)
        if ($event->image) {
            $old_image_path = public_path('/images/' . $event->image);
            if (file_exists($old_image_path)) {
                unlink($old_image_path); // Delete old image file
            }
        }

        Storage::disk('img')->put('images/events/' . $filename, $image->get());
        $event->image = 'events/' . $filename;
    }

    $event->save();

    return redirect()->route('events.index')
                        ->with('success', 'Location updated successfully!');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = events::find($id);

        // Optional: Check if location exists before deletion
        if ($event) {
            // Handle image deletion (optional)
            if ($event->image) {
                $image_path = public_path('/images/' . $event->image);
                if (file_exists($image_path)) {
                    unlink($image_path); // Delete image file
                }
            }

            $event->delete();
            return redirect()->route('events.index')
                            ->with('success', 'Location deleted successfully!');
        }

        return redirect()->route('events.index')
                        ->with('error', 'Location not found!');
    }
}

