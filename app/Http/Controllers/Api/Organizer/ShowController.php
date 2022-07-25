<?php

namespace App\Http\Controllers\Api\Organizer;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\LangRequest;
use App\Models\Organizer;

class ShowController extends ApiController
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
}