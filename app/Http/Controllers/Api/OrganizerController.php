<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizer\StoreOrganizerRequest;
use App\Http\Requests\Organizer\UpdateOrganizerRequest;
use App\Models\Language;
use App\Models\Organizer;
use Illuminate\Http\Request;


class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizers = Organizer::all();

        return response()->json([
            'status' => 'ok',
            'data' => $organizers
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizerRequest $request)
    {
        
        $language = Language::findOrFail($request->language_id);
        
        $organizer = Organizer::create([
            'portrait' => $request->portrait,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'website' => $request->website,
            'user_id'=> $request->user_id,
            'created_user_id' => $request->created_user_id,
            'modified_user_id'=> $request->modified_user_id
        ]);
        
        $organizer->languages()->attach($language, [
            'name' => $request->name,
            'description' => $request->description,   
        ]);

       return $organizer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organizer = Organizer::findOrFail($id);
        
        return response()->json([
            'status' => 'ok',
            'data' => $organizer
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganizerRequest $request)
    {
        $organizer = Organizer::findOrfail($request->organizer_id);
        
        $organizer->update([
            'portrait' => $request->portrait,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'website' => $request->website
        ]);

        return $organizer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $organizer = Organizer::destroy($id);

        if($organizer){
            return response()->json([
                "status"=> "ok",
                "message" => "The organizer with the id: ${id} has been deleted"
            ],200);
        }
        return response()->json([
            "status"=> "false",
            "message" => "The organizer with the id: ${id} does not exist"
        ],404);
    }
}
