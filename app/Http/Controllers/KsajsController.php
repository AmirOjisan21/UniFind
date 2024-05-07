<?php

namespace App\Http\Controllers;

use App\Models\Ksajs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KsajsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ksajss = ksajs::all();
        return view('admin.ksajs.index', compact('ksajss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ksajs.create');
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
            'open_hours' => 'required',
            'important_details' => 'required',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        $ksajs = new ksajs;
        $ksajs->name = $request->name;
        $ksajs->description = $request->description;
        $ksajs->open_hours = $request->open_hours;
        $ksajs->important_details = $request->important_details;
        $ksajs->longitude = $request->longitude;
        $ksajs->latitude = $request->latitude;

      
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('img')->put('images/ksajs/' . $filename, $image->get());
            $ksajs->image = 'ksajs/' . $filename;
        }

        $ksajs->save();

        return redirect()->route('ksajs.index')
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
        $ksajs = ksajs::find($id);
        return view('admin.ksajs.show', compact('ksajs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ksajs = ksajs::find($id);
        return view('admin.ksajs.edit', compact('ksajs'));
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
        'open_hours' => 'required',
        'important_details' => 'required',
        'longitude' => 'required|numeric',
        'latitude' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image update
    ]);

    $ksajs = ksajs::find($id);
    $ksajs->name = $request->name;
    $ksajs->description = $request->description;
    $ksajs->open_hours = $request->open_hours;
    $ksajs->important_details = $request->important_details;
    $ksajs->longitude = $request->longitude;
    $ksajs->latitude = $request->latitude;

    // Handle image update (optional)
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();

        // Delete existing image (optional)
        if ($ksajs->image) {
            $old_image_path = public_path('/images/' . $ksajs->image);
            if (file_exists($old_image_path)) {
                unlink($old_image_path); // Delete old image file
            }
        }

        Storage::disk('img')->put('images/ksajs/' . $filename, $image->get());
        $ksajs->image = 'ksajs/' . $filename;
    }

    $ksajs->save();

    return redirect()->route('ksajs.index')
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
        $ksajs = ksajs::find($id);

        // Optional: Check if location exists before deletion
        if ($ksajs) {
            // Handle image deletion (optional)
            if ($ksajs->image) {
                $image_path = public_path('/images/' . $ksajs->image);
                if (file_exists($image_path)) {
                    unlink($image_path); // Delete image file
                }
            }

            $ksajs->delete();
            return redirect()->route('ksajs.index')
                            ->with('success', 'Location deleted successfully!');
        }

        return redirect()->route('ksajs.index')
                        ->with('error', 'Location not found!');
    }
}

