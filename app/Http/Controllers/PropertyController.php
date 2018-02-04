<?php

namespace App\Http\Controllers;


use App\Community;
use App\Property;
use App\ImageFile;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::latest()->get();

        return view('property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     * @param \App\Community $community
     * @return \Illuminate\Http\Response
     */
    public function create(Community $community)
    {
        return view('property.create', compact('community'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Community $community, Request $request)
    {
        request()->validate([
            'address' => 'required',
            'unit' => 'required',
            'type' => 'required',
            'beds' => 'required',
            'baths' => 'required',
            'sqft' => 'required',
            'parking' => 'required',
            'price' => 'required',
            'year_built' => 'required',
            'body' => 'required',
        ]);
        $property = Property::create([
            'owner_id' => 1,
            'community_id' => $community->id,
            'address' => request('address'),
            'unit' => request('unit'),
            'type' => request('type'),
            'beds' => request('beds'),
            'baths' => request('baths'),
            'sqft' => request('sqft'),
            'parking' => request('parking'),
            'price' => request('price'),
            'year_built' => request('year_built'),
            'body' => request('body'),
            'status' => 0,
        ]);
        if ($request->hasFile('images')) {
            $slug = new \ReflectionClass($property);
            $app = $slug->getShortName();
            foreach ($request->file('images') as $image) {
                $path = public_path('/images/' . $app);
                $filename = $image->getClientOriginalName();
                $image->move($path, $filename);
                // Store in db
                $file = new ImageFile();
                $file->app_id = $property->id;
                $file->app = $app;
                $file->file_path = $filename;

                $file->save();
            }
        }
        return redirect('/community/' . $community->id . '/property/' . $property->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property $property
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community, Property $property){
        return view('property.show', compact('property', 'community'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Property $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
