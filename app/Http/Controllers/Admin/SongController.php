<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreSongRequest;
use App\Http\Requests\Admin\UpdateSongRequest;
use App\Http\Controllers\Controller;
use App\Services\Admin\AlbumService;
use App\Services\Admin\GenreService;
use App\Services\Admin\SingerService;
use App\Services\Admin\SongService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SongController extends Controller
{
    private $song;
    private $singer;
    private $album;
    private $genre;

    public function __construct(
        SongService $songService,
        SingerService $singerService,
        AlbumService $albumService,
        GenreService $genreService)
    {
        $this->song = $songService;
        $this->singer = $singerService;
        $this->album = $albumService;
        $this->genre = $genreService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        try {
            return view('admin.song.indexSong');
        } catch (Exception $e) {
            return view('admin.404');
        }
    }

    public function getSong()
    {
        try {
            $songs = $this->song->index(SORT_SONG,INDEX_SONG);
            return view('admin.song.song-table', compact('songs'));
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        try {
            $singers = $this->singer->getAll();
            $albums = $this->album->getAll();
            $genres = $this->genre->getAll();
            return view('admin.song.updateOrCreateSong', compact('singers', 'albums', 'genres'));
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreSongRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSongRequest $request)
    {
        try {
            $this->song->storeSong($request);
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
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        try {
            $song = $this->song->find($id);
            $singers = $this->singer->getAll();
            $albums = $this->album->getAll();
            $genres = $this->genre->getAll();
            return view('admin.song.updateOrCreateSong', compact('song', 'singers', 'albums', 'genres'));
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
     * @param  \App\Http\Requests\Admin\UpdateSongRequest  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSongRequest $request, $id)
    {
        try {
            $this->song->updateSong($request, $id);
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
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->song->deleteSong($id);
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
