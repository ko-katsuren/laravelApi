<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::all();
        $profilelist = [];
        foreach ($user as $data) {
            $profilelist[] = $data->profile()->get();
        }
        return response()->json([
            'message' => 'ok',
            'userData' => $user,
            'profileData' => $profilelist,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = json_decode($request['body'], true);

        $user = User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]
        );

        $profile = $user->profile()->create(
            [
                'age' => $data['age'],
                'address' => $data['address'],
                'belong' => $data['belong']
            ]
        );

        $user->save();
        $profile->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $query = User::query();

        if (isset($request->id)) {
            $query->where('id', 'like', "%$request->id%");
        }

        if (isset($request->name)) {
            $query->where('name', 'like', "%$request->name%");
        }

        if (isset($request->belong)) {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('belong', 'like', "%$request->belong%");
            });
        }

        $users = $query->get();

        $profilelist = [];
        foreach ($users as $user) {
            $profilelist[] = $user->profile()->get();
        }
        return response()->json([
            'message' => 'ok',
            'userData' => $users,
            'profileData' => $profilelist,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
