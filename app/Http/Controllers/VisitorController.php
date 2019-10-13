<?php

namespace App\Http\Controllers;

use App\User;
use App\Visitor;
use Illuminate\Http\Request;
use Webpatser\Countries\Countries;
use App\Jobs\SendNewStaffResetPassword;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\visitors\VisitorRequest;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Illuminate\Http\Request
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return DataTables::eloquent(Visitor::query()->with("user"))
                ->addColumn('actions', function ($visitor){
                    return view('visitors.actions', compact('visitor'));
                })
                ->editColumn('is_active', function ($visitor){
                    return view('visitors.active', compact('visitor'));
                })
                ->toJson();
        }
        return view(
            'visitors.index', [
                'visitors' => Visitor::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visitors.create', [
           'countries' => Countries::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitorRequest $request)
    {
        $user = User::create($request->all() + ['password' => User::generatePassword()]);

        $user->visitor()->create($request->all());

        $user->visitor
             ->upload($request->file('image'))
             ->images()
             ->create(['image'=>$user->visitor->imagePath]);

        dispatch(new SendNewStaffResetPassword($user->email, $user->getToken()));

        return redirect()->route('visitors.index')->with(
            [
                'success' => 'Visitor: "'.$request->fname.' '.$request->lname.'" has been Created.'
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        return view('visitors.show', compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        return view('visitors.edit', [
           'visitor' => $visitor,
           'countries' => Countries::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(VisitorRequest $request, Visitor $visitor)
    {
        $visitor->update($request->all());

        $visitor->user->update($request->all());

        if($request->file('image'))
        {
            $visitor->imageUpload($request->file('image'))
                    ->images()
                    ->create(['image'=>$visitor->imagePath]);
        }
        return redirect()->route('visitors.index')->with([
            'success' => 'Visitor "'.$request->fname.'" has been Updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        $visitor->user->delete();
        $visitor->delete();

        return redirect()->route('visitors.index')->with(
            [
                'success' => 'Visitor Member "'.$visitor->user->fname.' '.$visitor->user->lname.'" has been Deleted.'
            ]
        );
    }
}
