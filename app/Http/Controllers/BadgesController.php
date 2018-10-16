<?php

namespace App\Http\Controllers;

use App\Badge;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BadgesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badges = Badge::all();

        return view('badges.index', compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('create-badges')){

            return view('badges.create');
        }
        return abort(403, 'You are not allowed to create a badge.');
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
            'name' => 'required|min:2',
            'description' => 'required|min:10',
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $photo = (new Photo)->makePhotoFromFile($request->file('photo'));


        Badge::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo_path' =>$photo->path,
        ]);

        return redirect(url('/badges'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Badge $badge)
    {
        return view('badges.show', compact('badge'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $badge = Badge::find($id);
        return view('badges.edit', compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'description' => 'required|min:10',
            'photo' => 'mimes:jpg,jpeg,png,bmp'
        ]);

        $badge = Badge::find($id);
        $badge->name = $request->name;
        $badge->description = $request->description;
        if($request->file('photo')){
            $photo = (new Photo)->makePhotoFromFile($request->file('photo'));
            $badge->photo_path = $photo->path;
        }
        $badge->save();

        return redirect()->route('showBadge', ['badge' => $badge->id]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $badge = Badge::find($id);
        $badge->delete();
        return redirect()->route('allBadges');
    }
}
