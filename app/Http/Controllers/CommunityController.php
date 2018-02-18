<?php

namespace App\Http\Controllers;

use App\Community;
use App\ImageFile;
use Illuminate\Http\Request;

class CommunityController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

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
            $slug = new \ReflectionClass($community);
            $app = $slug->getShortName();
            foreach ($request->file('images') as $image) {
                $path = public_path('/images/' . $app);
                $filename = $image->getClientOriginalName();
                $image->move($path, $filename);
                // Store in db
                $file = new ImageFile();
                $file->app_id = $community->id;
                $file->app = $app;
                $file->file_path = $filename;

                $file->save();
            }
        }
        return redirect('/community/' . $community->id);
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
        $this->authorize('update', $community);

        $community->update(request()->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'country' => 'required',
            'description' => 'required',
        ]));

        return $community;
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
