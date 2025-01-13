<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreSingerRequest;
use App\Http\Requests\Admin\UpdateSingerRequest;
use App\Models\Singer;
use App\Http\Controllers\Controller;
use App\Services\Admin\SingerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class SingerController extends Controller
{
    private $singer;

    public function __construct(SingerService $singerService)
    {
        $this->singer = $singerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            return view('admin.singer.indexSinger');
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    public function getSinger()
    {
        try {
            $singers = $this->singer->index(SORT_SINGER,INDEX_SINGER);
            return view('admin.singer.singer-table', compact('singers'));
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
            return view('admin.singer.updateOrCreateSinger');
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreSingerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSingerRequest $request)
    {
        try {
            $this->singer->storeSinger($request);
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
     * @param  \App\Models\Singer  $singer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $singer = $this->singer->find($id);
            return view('admin.singer.updateOrCreatesinger', compact('singer'));
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
     * @param  \App\Http\Requests\Admin\UpdateSingerRequest  $request
     * @param  \App\Models\Singer  $singer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSingerRequest $request, $id)
    {
        try {
            $this->singer->updateSinger($request, $id);
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
     * @param  \App\Models\Singer  $singer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->singer->deleteSinger($id);
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
