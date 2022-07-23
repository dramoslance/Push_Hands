<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Organizer\StoreTranslationOrganizerRequest;
use App\Http\Requests\Organizer\StoreOrganizerRequest;
use App\Http\Requests\Organizer\UpdateOrganizerRequest;
use App\Http\Requests\LangRequest;
use App\Models\Organizer;

class OrganizerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LangRequest $request)
    {
        $organizers = Organizer::multiLanguages();

        return $this->sendResponse($organizers, 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, LangRequest $request)
    {
        if (empty($request->lang_code)) {
            $organizer = Organizer::multiLanguages($id);
        } else {
            $organizer = Organizer::language($id);
        }

        return $this->sendResponse($organizer, 'ok');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizerRequest $request)
    {
        $language = $this->getLanguageModel($request->input('lang_code'));

        $organizer = Organizer::create([
            'portrait' => $request->portrait,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'user_id' => $request->user_id,
            'created_user_id' =>  $request->created_user_id,
            'modified_user_id' => $request->modified_user_id
        ]);

        $organizer->languages()->attach($language, [
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $this->sendResponse($organizer, 'User register successfully.');
    }
    /**
     * Store a newly traduction created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrganizerTranslation(StoreTranslationOrganizerRequest $request)
    {
        $language = $this->getLanguageModel($request->input('lang_code'));

        $organizer = Organizer::find($request->input('organizer_id'));

        $organizer->languages()->attach($language, [
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $this->sendResponse($organizer, 'Translation of organization created successfully');
    }

    /**Asi 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganizerRequest $request)
    {
        $iso_code = $request->input('iso_code') ?  $request->input('iso_code') : 'ro_MD';

        $organizer = Organizer::where([
            'id' => $request->input('organizer_id')
        ])
            ->with(['languages' => function ($query) use ($iso_code) {
                $query->where('iso_code', $iso_code)->first();
            }])
            ->first();

        $organizer->update([
            'portrait' => $request->input('portrait'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
        ]);

        $organizer->languages()->updateExistingPivot($organizer->languages[0]->id, [
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $organizer_updated = $organizer->languages[0]->pivot->name;

        return response()->json([
            'status' => 'ok',
            'message' => "Organizer ${organizer_updated} updated succesfully"
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