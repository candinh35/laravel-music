<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreAlbumRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Admin\UpdateAlbumRequest;
use App\Http\Controllers\Controller;
use Exception;
use App\Services\Admin\AlbumService;

class AlbumController extends Controller
{
    private $album;

    public function __construct(AlbumService $albumService)
    {
        $this->album = $albumService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('admin.album.indexalbum');
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    public function getAlbum()
    {
        try {
            $albums = $this->album->index(SORT_ALBUM,INDEX_ALBUM);
            return view('admin.album.album-table', compact('albums'));
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('admin.album.updateOrCreateAlbum');
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreAlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request)
    {
        try {
            $this->album->storealbum($request);
            return response()->json([
                'status' => 'success'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $album = $this->album->find($id);
            return view('admin.album.updateOrCreateAlbum', compact('album'));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateAlbumRequest  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbumRequest $request, $id)
    {
        try {
            $this->album->updatealbum($request, $id);
            return response()->json([
                'status' => 'success'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->album->deletealbum($id);
            return response()->json([
                'status' => 'success'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }
}
