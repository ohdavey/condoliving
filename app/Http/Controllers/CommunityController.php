<?php

namespace App\Http\Controllers;

use App\Community;
use App\ImageFile;
use Illuminate\Http\Request;

class CommunityController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $communities = Community::latest()->get();

        return view('communities.index', compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('communities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        request()->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'country' => 'required',
            'description' => 'required',
        ]);
        $community = Community::create([
            'owner_id' => 1,
            'category_id' => 4,
            'name' => request('name'),
            'address' => request('address'),
            'city' => request('city'),
            'state' => request('state'),
            'postcode' => request('postcode'),
            'country' => request('country'),
            'description' => request('description'),
        ]);
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $path = public_path('/images/' . get_class($community));
                $filename = $image->getClientOriginalName();
                $image->move($path, $filename);

                // Store in db
                $file = new ImageFile();
                $file->relation_id = $community->id;
                $slug = new \ReflectionClass($community);
                $file->relation = $slug->getShortName();
                $file->file_path = $filename;

                $file->save();
            }
        }
        return view('community.show', compact('community'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Community $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community) {
        return view('communities.show', compact('community'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Community $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Community $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Community $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community) {
        //
    }
}
