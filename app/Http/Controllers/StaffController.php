<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\staff\StaffStoreRequest;
use App\Http\Requests\staff\StaffUpdateRequest;
use App\Jobs\SendNewStaffResetPassword;
use App\Staff;
use App\User;
use App\Work;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Webpatser\Countries\Countries;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Staff::class, 'staff');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view(
            'staff.index', [
                'staff' => Staff::all()
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
        return view('staff.create', [
            'works' => Work::all(),
            'cities'=> City::all(),
            'countries'=> Countries::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(StaffStoreRequest $request)
    {
        $user = User::create($request->all() + ['password' => User::generatePassword()]);

        $staff = Staff::create($request->all() + ['user_id' => $user->id]);

        $this->saveMorphImage($staff, $this->upload($request->file('image')));

        $token = $this->getToken($user);

        dispatch(new SendNewStaffResetPassword($user->email, $token));

        return redirect()->route('staff.index')->with(
            [
                'success' => 'Staff Member: "'.$request->fname.' '.$request->lname.'" has been Created.'
            ]
        );
    }

    private function getToken($user)
    {
        return app('auth.password.broker')->createToken($user);
    }

    private function upload($path)
    {
        return Storage::putFile('public/staff', $path);
    }

    private function saveMorphImage($staff, $path)
    {
        $staff->images()->create(['image' => $path]);
    }

    /**
     * Display the specified resource.
     *
     * @param Staff $staff
     * @return Response
     */
    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Staff $staff
     * @return Response
     */
    public function edit(Staff $staff)
    {
        return view('staff.edit', [
            'staff' => $staff,
            'works' => Work::all(),
            'cities'=> City::all(),
            'countries'=> Countries::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StaffUpdateRequest $request
     * @param Staff $staff
     * @return Response
     */
    public function update(StaffUpdateRequest $request, Staff $staff)
    {
        $staff->update($request->all());

        $staff->user->update($request->all());

        if($request->file('image'))
        {
            $this->saveMorphImage($staff, $this->upload($request->file('image')));
        }

        return redirect()->route('staff.index')->with([
            'success' => 'Staff "'.$request->fname.'" has been Updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staff
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Staff $staff)
    {
        $staff->user->delete();

        return redirect()->route('staff.index')->with(
            [
                'success' => 'Staff Member "'.$staff->user->fname.' '.$staff->user->lname.'" has been Deleted.'
            ]
        );
    }
}
