<?php

namespace App\Http\Controllers\Api\Organizer;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Organizer\UpdateOrganizerRequest;
use App\Models\Organizer;

class UpdateController extends ApiController
{
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
}