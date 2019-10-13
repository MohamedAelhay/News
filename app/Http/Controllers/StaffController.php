<?php

namespace App\Http\Controllers;

use App\City;
use App\Work;
use App\User;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webpatser\Countries\Countries;
use Illuminate\Http\RedirectResponse;
use App\Jobs\SendNewStaffResetPassword;
use App\Http\Requests\staff\StaffStoreRequest;
use App\Http\Requests\staff\StaffUpdateRequest;
use Yajra\DataTables\Facades\DataTables;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Staff::class, 'staff');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            return DataTables::eloquent(Staff::query()->with("user", "job"))
                ->addColumn('actions', function ($staff){
                    return view('staff.actions', compact('staff'));
                })
                ->editColumn('is_active', function ($staff){
                    return view('staff.active', compact('staff'));
                })
                ->toJson();
        }

        return view(
            'staff.index');
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
     * @param StaffStoreRequest $request
     * @return Response
     */
    public function store(StaffStoreRequest $request)
    {
        $user = User::create($request->all() + ['password' => User::generatePassword()]);

        $user->staff()->create($request->all());

        $user->staff
            ->imageUpload($request->file('image'))
            ->images()
            ->create(['image' => $user->staff->imagePath]);

        dispatch(new SendNewStaffResetPassword($user->email, $user->getToken()));

        return redirect()->route('staff.index')->with(
            [
                'success' => 'Staff Member: "'.$request->fname.' '.$request->lname.'" has been Created.'
            ]
        );
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

        $staff->imageUpload($request->file('image'))
              ->images()
              ->create(['image' => $staff->imagePath]);

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
        $staff->delete();

        return redirect()->route('staff.index')->with(
            [
                'success' => 'Staff Member "'.$staff->user->fname.' '.$staff->user->lname.'" has been Deleted.'
            ]
        );
    }

    public function getStaffByJob($work_id)
    {
//        $tt = DataTables::eloquent(User::query()->select("id", "fname")->with(["staff" => function($query){
//            return $query->with(["job" => function($query){
//                return $query->where("name", "Writer");
//            }]);
//        }]))->toJson();
//
//        $t2 = DataTables::eloquent(User::query()
//                ->select("id", "fname")
//                ->whereHas("staff", function ($query){
//                    return $query->whereHas("job", function ($query){
//                       return $query->where("name", "Writer");
//                    });
//                })
//            )
//            ->toJson();
        $users = Staff::where("work_id", $work_id)
            ->with("user")
            ->get()
            ->pluck("user.fname", "user.id");
        return Response()->json($users);
    }
}
