<?php

namespace App\Http\Controllers\Api\Organizer;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Organizer\StoreOrganizerRequest;
use App\Models\Organizer;
use App\Models\User;

class StoreController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizerRequest $request)
    {
        $language = $this->getLanguageModel($request->input('lang_code'));

        $input = $request->only(['portrait', 'email', 'phone', 'website']);
        $input['user_id'] = $request->input('organizer_user_id');

        $user = $this->getUser();
        $input['created_user_id'] = $user->id;
        $input['modified_user_id'] = $user->id;

        if ($user->id !== $input['user_id']) {
            $user = User::find($input['user_id']);
        }

        $organizer = Organizer::create($input);
        $organizer->members()->attach($user, [
            'created_user_id' => $input['created_user_id'],
            'modified_user_id' => $input['modified_user_id']
        ]);
        $organizer->languages()->attach($language, [
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $organizer['name'] = $request->name;
        $organizer['description'] = $request->description;

        return $this->sendResponse($organizer, 'Organizer create successfully.');
    }
}