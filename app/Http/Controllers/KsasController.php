<?php

namespace App\Http\Controllers;

use App\Models\Ksas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KsasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ksass = ksas::all();
        return view('admin.ksas.index', compact('ksass'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ksas.create');
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

        $ksas = new ksas;
        $ksas->name = $request->name;
        $ksas->description = $request->description;
        $ksas->open_hours = $request->open_hours;
        $ksas->important_details = $request->important_details;
        $ksas->longitude = $request->longitude;
        $ksas->latitude = $request->latitude;

        // Handle image upload with custom folder and filename
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('img')->put('images/ksas/' . $filename, $image->get());
            $ksas->image = 'ksas/' . $filename;
        }

        $ksas->save();

        return redirect()->route('ksas.index')
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
        $ksas = ksas::find($id);
        return view('admin.ksas.show', compact('ksas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ksas = ksas::find($id);
        return view('admin.ksas.edit', compact('ksas'));
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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',        
    ]);

    $ksas = ksas::find($id);
    $ksas->name = $request->name;
    $ksas->description = $request->description;
    $ksas->open_hours = $request->open_hours;
    $ksas->important_details = $request->important_details;
    $ksas->longitude = $request->longitude;
    $ksas->latitude = $request->latitude;

    // Handle image update (optional)
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();

        // Delete existing image (optional)
        if ($ksas->image) {
            $old_image_path = public_path('/images/' . $ksas->image);
            if (file_exists($old_image_path)) {
                unlink($old_image_path); 
            }
        }

        Storage::disk('img')->put('images/ksas/' . $filename, $image->get());
        $ksas->image = 'ksas/' . $filename;
    }

    $ksas->save();

    return redirect()->route('ksas.index')
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
        $ksas = ksas::find($id);

        // Optional: Check if location exists before deletion
        if ($ksas) {
            // Handle image deletion (optional)
            if ($ksas->image) {
                $image_path = public_path('/images/' . $ksas->image);
                if (file_exists($image_path)) {
                    unlink($image_path); // Delete image file
                }
            }

            $ksas->delete();
            return redirect()->route('ksas.index')
                            ->with('success', 'Location deleted successfully!');
        }

        return redirect()->route('ksas.index')
                        ->with('error', 'Location not found!');
    }
}

