<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\DeletePlaylistRequest;
use App\Http\Requests\Client\StorePlaylistRequest;
use App\Services\Client\PlaylistService;
use App\Services\Client\SongService;
use App\Services\Client\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    protected $user;
    protected $song;
    protected $playlist;

    public function __construct(UserService $user, SongService $song, PlaylistService $playlist)
    {
        $this->user = $user;
        $this->song = $song;
        $this->playlist = $playlist;
    }

    public function index($id)
    {
        try {
            $playlists = $this->playlist->getPlaylist($id);
            $topTracks = $this->song->getTopTrack(TOP_TRACK_SONG);
            return view('client.playlist', compact('playlists','topTracks'));
        } catch (ModelNotFoundException $e) {
            return view('client.404');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getPlaylist()
    {
        try {
            $playlists = $this->playlist->getPlaylist(Auth::guard('cus')->id());
            return view('client.playlist-table', compact('playlists'));
        } catch (\Exception $e) {
            return  response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StorePlaylistRequest $request)
    {
        try {

            $this->playlist->storePlaylist($request);
            return  response()->json([
                'status' => 'success'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return  response()->json([
                'status' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return  response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(DeletePlaylistRequest $request)
    {
        try {
            $this->playlist->deletePlaylist($request);
            return  response()->json([
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return  response()->json([
                'status' => $e->getMessage()
            ], 404);
        }
    }
}
