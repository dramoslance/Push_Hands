<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Interface\RolePermission\RolesEntity;

class RoleController extends ApiController
{
    private $rulesValidate = [
        'role_name' => 'required|string|max:50',
        // 'user_id' => 'required',
    ];

    private function validator_fails($validator)
    {
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
    }

    public function index()
    {
        $user = $this->getUser();
        return $this->sendResponse(
            ['permissions' => $user->getRoleNames()],
            'User roles.'
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rulesValidate);
        $this->validator_fails($validator);
        $rolName = $request->role_name;

        if (!RolesEntity::role_find($rolName)) {
            return $this->sendError('Error: role not found.');
        }

        if (RolesEntity::SUPER_ADMIN === $rolName) {
            return $this->sendError('Error: unable to assign super admin role.');
        }

        // $userAssignRole = User::find($request->user_id);

        // if (empty($userAssignRole)) {
        //     return $this->sendError('Error: user not found.');
        // }

        $user = $this->getUser();
        $user->assignRole($rolName);
        return $this->sendResponse(
            ['permissions' => $user->getRoleNames()],
            'User roles.'
        );
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rulesValidate);
        $this->validator_fails($validator);
        $rolName = $request->role_name;

        if (!RolesEntity::role_find($rolName)) {
            return $this->sendError('Error: role not found.');
        }

        if ((RolesEntity::ADMIN === $rolName) ||
            (RolesEntity::SUPER_ADMIN === $rolName)
        ) {
            return $this->sendError('Error: Can`t delete admin role.');
        }

        $user = $this->getUser();
        $user->removeRole($rolName);
        return $this->sendResponse(
            ['permissions' => $user->getRoleNames()],
            'User roles.'
        );
    }
}