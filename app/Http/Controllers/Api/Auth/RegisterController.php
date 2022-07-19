<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Interface\RolePermission\RolesEntity;
use Interface\RolePermission\PermissionsEntity;
use App\Models\User;

class RegisterController extends ApiController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'lastname' => 'required|string|max:150',
            'birth_date' => 'required|date',
            'email' => 'required|unique:users|max:255',
            'username' => 'required|unique:users|max:100',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $user->assignRole(RolesEntity::USER);
        $user->givePermissionTo(PermissionsEntity::USER_READ);
        $user->givePermissionTo(PermissionsEntity::USER_WRITE);

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['lastname'] =  $user->lastname;
        $success['email'] =  $user->email;
        $success['username'] =  $user->username;
        $success['email_verified_at'] =  $user->email_verified_at;

        return $this->sendResponse($success, 'User register successfully.');
    }
}