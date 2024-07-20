<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Services\Admin\UserService;
use Exception;

class UserController extends Controller
{
    private $user;

    public function __construct(UserService $userService)
    {
        $this->user = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        try {
            return view('admin.user.indexUser');
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    public function getUser()
    {
        try {
            $users = $this->user->index(SORT_USER, INDEX_USER);
            return view('admin.user.user-table', compact('users'));
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
            return view('admin.user.updateOrCreateUser');
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $this->user->storeUser($request);
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
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        try {
            $user = $this->user->find($id);
            return view('admin.user.updateOrCreateUser', compact('user'));
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $this->user->updateUser($request, $id);
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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->user->deleteUser($id);
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
