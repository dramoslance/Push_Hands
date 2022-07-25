<?php

namespace App\Http\Controllers\Api\Organizer;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Organizer\StoreTranslationOrganizerRequest;
use App\Models\Organizer;

class TranslationController extends ApiController
{
    /**
     * Store a newly traduction created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTranslationOrganizerRequest $request)
    {
        $language = $this->getLanguageModel($request->input('lang_code'));
        $organizer = Organizer::find($request->input('organizer_id'));
        $organizer->languages()->attach($language, [
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return $this->sendResponse($organizer, 'Translation of organization created successfully');
    }

    public function update()
    {
    }
}