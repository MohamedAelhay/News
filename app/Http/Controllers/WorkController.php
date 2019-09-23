<?php

namespace App\Http\Controllers;

use App\Http\Requests\works\WorkStoreRequest;
use App\Http\Requests\works\WorkUpdateRequest;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view(
            'works.index', [
                'works' => Work::paginate(5)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WorkStoreRequest $request
     * @return void
     */
    public function store(WorkStoreRequest $request)
    {
        Work::create($request->all());
        return redirect()->route('works.index')->with(
            [
                'success' => 'Job: "'.$request->name.'" has been Created.'
            ]
        );
    }

    /**all
     * Display the specified resource.
     *
     * @param Work $work
     * @return Response
     */
    public function show(Work $work)
    {
        return view('works.show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Work $work
     * @return Response
     */
    public function edit(Work $work)
    {
        return view('works.edit', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WorkUpdateRequest $request
     * @param Work $work
     * @return void
     */
    public function update(WorkUpdateRequest $request, Work $work)
    {
        $work->update($request->all());
        return redirect()->route('works.index')->with(
            [
                'success' => 'Job "'.$request->name.'" has been Updated.'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Work $work
     * @return Response
     * @throws \Exception
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return redirect()->route('works.index')->with(
            [
                'success' => 'City "'.$work->name.'" has been Deleted.'
            ]
        );
    }
}
