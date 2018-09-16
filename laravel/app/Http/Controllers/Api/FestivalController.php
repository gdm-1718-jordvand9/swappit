<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Festival as FestivalResource;
use App\Festival;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FestivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get festivals

        $festivals = Festival::with('ticket_types')->get();

        // Return collection of festivals as a resource
        return FestivalResource::collection($festivals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $festival = Festival::whereSlug($slug)
            ->with(['ticket_types' => function ($q) { $q->OnSale()->withCount(['tickets as tickets_available_count' => function ($q) { $q->Available(); },'tickets as tickets_sold_count' => function ($q) { $q->Sold();}, 'users as tickets_wanted_count' ]); } ])
            ->firstOrFail();

        return new FestivalResource($festival);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
