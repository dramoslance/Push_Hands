<?php

namespace App\Http\Controllers\Api\Organizer;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Organizer\StoreMemberOrganizerRequest;
use App\Models\Organizer;
use App\Models\User;

class MemberController extends ApiController
{
    /**
     * Store a newly traduction created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberOrganizerRequest $request)
    {
        $organizer = Organizer::find($request->input('organizer_id'));

        $user = $this->getUser();
        if ($user->id !== $request->input('organizer_user_id')) {
            $user = User::find($request->input('organizer_user_id'));
        }

        $organizer->members()->attach($user, [
            'created_user_id' => $user->id,
            'modified_user_id' => $user->id
        ]);

        return $this->sendResponse($organizer, 'Member of organizer successfully');
    }

    public function destroy(int $id)
    {
    }
}