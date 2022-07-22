<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Organizer\StoreOrganizerRequest;
use App\Http\Requests\Organizer\UpdateOrganizerRequest;
use App\Http\Requests\Organizer\StoreTranslationOrganizerRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Organizer;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class OrganizerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lang_code' => 'string|exists:App\Models\Language,iso_code',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $language = $this->getLanguageModel($request->input('lang_code'));

        $organizers = Organizer::all();

        $orga = [];

        foreach ($organizers as $key => $organizer) {
            $organizer_language = Organizer::find($organizer->id)
                ->languages()
                ->where('language_id', $language->id)
                ->get();
           
            if (count($organizer_language) > 0) {
                return $organizer_language;
                $orga['organizers'][] = [
                    'id' => $organizer->id,
                    'portrait' => $organizer->portrait,
                    'name'=> $organizer_language[0]->pivot->name,
                    'description'=> $organizer_language[0]->pivot->description,
                    'email' => $organizer->email,
                    'phone' => $organizer->phone,
                    'website' => $organizer->website
                ];
            } 
        }

        return $this->sendResponse($orga, 'User register successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizerRequest $request)
    {
        // $iso_code = $request->input('iso_code') ?  $request->input('iso_code') : 'ro_MD';

        // $language = Language::where([
        //     'iso_code' => $iso_code
        // ])
        //     ->first();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

        //todo: sustituir por el valor por defecto, dependiendo del enfoque definido, variable de entorno, o idioma preferido de usuario

        $iso_code = $request->input('lang_code') ?  $request->input('lang_code') : 'ro_MD';
        $organizer = Organizer::where([
            'id' => $id
        ])
            ->with(['languages' => function ($query) use ($iso_code) {
                $query->where('iso_code', $iso_code)->first();
            }])
            ->first();

        if (count($organizer->languages) === 0)
            return response()->json([
                'status' => 'error',
                'message' => 'Organizer doesn\'t not have translation in that language.'
            ], 422);

        $organizer_json = [
            'id' => $organizer->id,
            'name' => $organizer->languages[0]->pivot->name,
            'description' => $organizer->languages[0]->pivot->description,
            'portrait' => $organizer->portrait,
            'email' => $organizer->email,
            'phone' => $organizer->phone,
            'website' => $organizer->website
        ];

        return response()->json([
            'status' => 'ok',
            'data' => response()->json([
                'organizer' => $organizer_json,
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