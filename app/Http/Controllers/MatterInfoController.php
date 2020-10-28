<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matter;


class MatterInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $matter = Matter::all();
        return response()->json([
            'message' => 'ok',
            'matterData' => $matter,
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

        $matter = Matter::create(
            [
                'name' => $data['name'],
                'price' => $data['price']
            ]
        );

        $matter->save();
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
        $query = Matter::query();

        if (isset($request->id)) {
            $query->where('id', 'like', "%$request->id%");
        }

        if (isset($request->name)) {
            $query->where('name', 'like', "%$request->name%");
        }

        if (isset($request->price)) {
            $query->where('price',  $request->price);
        }

        $matters = $query->get();

        return response()->json([
            'message' => 'ok',
            'matterData' => $matters,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
