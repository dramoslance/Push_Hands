<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Interface\RolePermission\PermissionsEntity;

class PermissionController extends ApiController
{
    private $rulesValidate = [
        'permission_name' => 'required|string|max:50',
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
            ['permissions' => $user->getDirectPermissions()],
            'User permissions.'
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rulesValidate);
        $this->validator_fails($validator);
        $pemissionName = $request->permission_name;

        if (!PermissionsEntity::permission_find($pemissionName)) {
            return $this->sendError('Error: pemission not found.');
        }

        $user = $this->getUser();
        $user->givePermissionTo($pemissionName);
        return $this->sendResponse(
            ['permissions' => $user->getDirectPermissions()],
            'User permissions.'
        );
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rulesValidate);
        $this->validator_fails($validator);
        $pemissionName = $request->permission_name;

        if (!PermissionsEntity::permission_find($pemissionName)) {
            return $this->sendError('Error: pemission not found.');
        }

        $user = $this->getUser();
        $user->revokePermissionTo($pemissionName);
        return $this->sendResponse(
            ['permissions' => $user->getDirectPermissions()],
            'User permissions.'
        );
    }
}