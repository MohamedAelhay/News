<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Services\FolderService;
use App\Staff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;

class FolderController extends Controller
{
    protected $folderService;

    public function __construct(FolderService $service)
    {
        $this->authorizeResource(Folder::class, 'folder');
        $this->folderService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('folders.index', [
            'folders' => $this->folderService->getAllFolders()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('folders.create', [
            'staff' => Staff::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->folderService->createNewFolder($request->input());

        $permission = Permission::create(['name'=>$request->input('name')]);
        $users = User::whereIn('id', $request->input('staff'))->get();
        $users->push(auth()->user());
        $users->map(function ($user) use ($permission) {$user->givePermissionTo($permission);});

        return redirect()->route('folders.index')->with(
            [
                'success' => 'Folder: "'.$request->name.'" has been Created.'
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Folder $folder
     * @return Response
     */
    public function show(Folder $folder)
    {
        return view('folders.show', [
            'folder' => $this->folderService->getFolder($folder)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Folder $folder
     * @return Response
     */
    public function edit(Folder $folder)
    {
        return view('folders.edit', [
           'folder' => $folder,
            'staff' => Staff::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Folder $folder
     * @return Response
     */
    public function update(Request $request, Folder $folder)
    {
        $this->folderService->updateFolder($request->input(), $folder);

        $permission = Permission::where('name', $folder->name)->first();
        ($permission->users)->map(function ($user) use ($permission){$user->revokePermissionTo($permission->id);});
        $users = User::whereIn('id', $request->input('staff'))->get();
        $users->push(auth()->user());
        $users->map(function ($user) use ($permission) {$user->givePermissionTo($permission);});

        return redirect()->route('folders.index')->with(
            [
                'success' => 'Folder: "'.$request->name.'" has been Updated.'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Folder $folder
     * @return Response
     */
    public function destroy($folder)
    {
        $this->folderService->destroyFolder($folder);

        return redirect()->route('folders.index')->with(
            [
                'success' => 'Folder has been Deleted.'
            ]
        );
    }
}
