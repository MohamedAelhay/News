<?php

namespace App\Http\Controllers;

use App\Upload;
use Illuminate\Http\Request;

class FolderUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($folder)
    {
        return view('uploads.create', compact('folder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $folder)
    {
        $path = $request->file('path')->store('folders/'.$request->input('type'), 'public');

        Upload::create(array_merge($request->input(), ['path' => $path, 'folder_id'=>$folder]));

        return redirect()->route('folders.show', $folder)->with(
            [
                'success' => 'Upload: "'.$request->name.'" has been Uploaded.'
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function edit($folder, Upload $upload)
    {
        return view('uploads.edit', [
            'upload' => $upload,
            'folder' => $folder
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $folder, Upload $upload)
    {
        if($request->file('path'))
        {
            $path = $request->file('path')->store('folders/'.$request->input('type'), 'public');
            $upload->update(array_merge($request->input(), ['path' => $path]));
        } else {
            $upload->update($request->input());
        }

        return redirect()->route('folders.show', $folder)->with(
            [
                'success' => 'Upload: "'.$request->name.'" has been Updated.'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $folder
     * @param \App\Upload $upload
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($folder, Upload $upload)
    {
        $upload->delete();

        return redirect()->route('folders.show', $folder)->with(
            [
                'success' => 'File has been Deleted.'
            ]
        );
    }
}
