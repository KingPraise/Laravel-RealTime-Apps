<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'data' => $users,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        // Return a JSON response with the created user and a success message
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201); // 201 is the HTTP status code for resource creation
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $user->fill($data);
        $user->save();

        // Return a JSON response with the updated user and a success message
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200); // 200 is the HTTP status code for a successful request
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        // Return a JSON response indicating success
        return response()->json([
            'message' => 'User deleted successfully',
            'user' => $user,
        ], 200); // 200 is the HTTP status code for a successful request
    }

}