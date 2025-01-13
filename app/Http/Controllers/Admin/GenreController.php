<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreGenreRequest;
use App\Http\Requests\Admin\UpdateGenreRequest;
use App\Models\Genre;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Services\Admin\GenreService;

class GenreController extends Controller
{
    private $genre;

    public function __construct(GenreService $genreService)
    {
        $this->genre = $genreService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $genres = $this->genre->index(SORT_GENRE, INDEX_GENRE);
            return view('admin.genre.indexgenre', compact('genres'));
        } catch (Exception $e) {
            return view('admin.404');
        }
    }

    public function getGenre()
    {
        try {
            $genres = $this->genre->index(SORT_GENRE, INDEX_GENRE);
            return view('admin.genre.genre-table', compact('genres'));
        } catch (Exception $e) {
            return view('admin.404');
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
            return view('admin.genre.updateOrCreateGenre');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreGenreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenreRequest $request)
    {
        try {
            $this->genre->storeGenre($request);
            return response()->json([
                'status' => 'success'
            ], 200);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $genre = $this->genre->find($id);
           return view('admin.genre.updateOrCreateGenre', compact('genre'));
        } catch (ModelNotFoundException $e) {
            return view('admin.404');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateGenreRequest  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenreRequest $request, $id)
    {
        try {
            $this->genre->updategenre($request, $id);
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
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->genre->deleteGenre($id);
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
