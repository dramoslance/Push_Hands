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
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'user_id' => $request->user_id,
            'created_user_id' => $request->created_user_id,
            'modified_user_id' => $request->modified_user_id
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
    public function show($language_id, $id)
    {
        $organizer = Organizer::findOrFail($id);

        $organizer_language = Organizer::find($id)
            ->languages()
            ->where('language_id', $language_id)
            ->get();

        return response()->json([
            'status' => 'ok',
            'data' => response()->json([
                'organizer' => $organizer,
                'organizer_language' =>$organizer_language[0]->pivot
            ])
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

        $language = Language::findOrFail($request->language_id);

        $organizer->update([
            'portrait' => $request->portrait,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website
        ]);

        $languageUpadated =  $organizer->languages()->updateExistingPivot($language, [
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'ok',
            'data' => json_encode(
                [
                    'organizer' => $organizer,
                    'organizer_language' => $languageUpadated
                ]),
            'message'=> 'Organizer updated succesfully'
        ], 200);
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
        
        if ($organizer) {
            return response()->json([
                "status" => "ok",
                "message" => "The organizer with the id: ${id} has been deleted"
            ], 200);
        }
        return response()->json([
            "status" => "false",
            "message" => "The organizer with the id: ${id} does not exist"
        ], 404);
    }
}
