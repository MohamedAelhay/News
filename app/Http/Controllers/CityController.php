<?php

namespace App\Http\Controllers;

use App\City;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webpatser\Countries\Countries;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\cities\CityStoreRequest;
use App\Http\Requests\cities\CityUpdateRequest;

class CityController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(City::class, 'city');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            return DataTables::eloquent(City::query()->with("country"))
                ->addColumn('actions', function ($city){
                    return view('cities.actions', compact('city'));
                    })
                ->toJson();
        }

        return view('cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view(
            'cities.create', [
            'countries' => Countries::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CityStoreRequest $request
     * @return Response
     */
    public function store(CityStoreRequest $request)
    {
        City::create($request->all());
        return redirect()->route('cities.index')->with(
            [
            'success' => 'City "'.$request->name.'" has been Created.'
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  City $city
     * @return Response
     */
    public function show(City $city)
    {
        return view(
            'cities.show', [
            'city' => $city
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  City $city
     * @return Response
     */
    public function edit(City $city)
    {
        return view(
            'cities.edit', [
            'city' => $city,
            'countries' => Countries::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CityUpdateRequest $request
     * @param  City $city
     * @return Response
     */
    public function update(CityUpdateRequest $request, City $city)
    {
        $city->update($request->all());
        return redirect()->route('cities.index')->with(
            [
            'success' => 'City "'.$request->name.'" has been Updated.'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  City $city
     * @return Response
     * @throws Exception
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')->with(
            [
            'success' => 'City "'.$city->name.'" has been Deleted.'
            ]
        );
    }

    public function getCitiesByCountryId($country_id)
    {
        return Response()->json(City::whereCountryId($country_id)->pluck('id','name'));
    }
}
