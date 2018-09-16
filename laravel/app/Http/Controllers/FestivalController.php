<?php

namespace App\Http\Controllers;

use App\Festival;
use App\Http\Requests\FestivalRequest;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $festivals = Festival::withTrashed()
            ->latest()
            ->get();
        return view('festival.index', compact('festivals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('festival.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FestivalRequest $request)
    {
        $festival = new Festival();
        $festival->name             = $request->name;
        $festival->slug             = str_slug($festival->name);
        $festival->place            = $request->place;
        $festival->description      = $request->description;
        $festival->start_date       = $request->start_date;
        $festival->end_date         = $request->end_date;
        $festival->facebook_url     = $request->facebook_url;
        $festival->twitter_url      = $request->twitter_url;
        $festival->instagram_url    = $request->instagram_url;
        $festival->snapchat_url     = $request->snapchat_url;
        $festival->save();
        return redirect('festivals')->with(['message' => $festival->name, 'datatype' => 'Festival', 'crudtype' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $festival = Festival::withTrashed()->findOrFail($id);
        return view('festival.show', compact('festival'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $festival = Festival::withTrashed()->findOrFail($id);
        return view('festival.edit', compact('festival'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FestivalRequest $request, $id)
    {
        $festival = Festival::withTrashed()->findOrFail($id);
        $festival->name             = request('name');
        $festival->place            = request('place');
        $festival->description      = request('description');
        $festival->start_date       = request('start_date');
        $festival->end_date         = request('end_date');
        $festival->facebook_url     = request('facebook_url');
        $festival->twitter_url      = request('twitter_url');
        $festival->instagram_url    = request('instagram_url');
        $festival->snapchat_url     = request('snapchat_url');
        $festival->update();
        return redirect('festivals')->with(['message' => $festival->name, 'datatype' => 'Festival', 'crudtype' => 'updated']);
    }

    /**
     * Force Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $festival = Festival::withTrashed()->findOrFail($id);
        $festival->forceDelete();

        return redirect('festivals')->with(['message' => $festival->name, 'datatype' => 'Festival', 'crudtype' => 'forcedeleted']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $festival = Festival::withTrashed()->findOrFail($id);
        $festival->delete();

        return redirect('festivals')->with(['message' => $festival->name, 'datatype' => 'Festival', 'crudtype' => 'softdeleted']);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $festival = Festival::withTrashed()->findOrFail($id);
        $festival->restore();

        return redirect('festivals')->with(['message' => $festival->name, 'datatype' => 'Festival', 'crudtype' => 'restored']);
    }
}
