<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\cities\CityStoreRequest;
use App\Http\Requests\cities\CityUpdateRequest;
use Illuminate\Http\Request;
use Webpatser\Countries\Countries;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(City::class, 'city');
    }

    public function index()
    {
        return view('cities.index', [
            'cities' => City::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create', [
            'countries' => Countries::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityStoreRequest $request)
    {
        City::create($request->all());
        return redirect()->route('cities.index')->with([
            'success' => 'City "'.$request->name.'" has been Created.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('cities.show', [
            'city' => $city
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('cities.edit', [
            'city' => $city,
            'countries' => Countries::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\cities\CityUpdateRequest  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityUpdateRequest $request, City $city)
    {
        $city->update($request->all());
        return redirect()->route('cities.index')->with([
            'success' => 'City "'.$request->name.'" has been Updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')->with([
            'success' => 'City "'.$city->name.'" has been Deleted.'
        ]);
    }
}
