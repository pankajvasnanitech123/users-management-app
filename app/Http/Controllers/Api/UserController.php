<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Models\UserInformation;
use App\Models\User;

class UserController extends Controller
{
    public function create(UserCreateRequest $request) {
        // Save user
        $user = User::factory()->create();

        // Save user information
        $userInfoObj = new UserInformation();
        $userInfoObj->user_id = $user->id;
        $userInfoObj->position = $request->position;
        $userInfoObj->status = $request->status;

        $userInfoObj->save();

        $data['user'] = $user;
        $data['user_information'] = $userInfoObj;

        return response()->json(['success' => true, 'data' => $data, 'message' => ''], 201);
    }

    public function show($id) {
        // Show user details
        $data = User::with('user_information')->where('id', $id)->first();

        if(empty($data)) {
            return response()->json(['success' => false, 'data' => '', 'message' => 'Record Not Found'], 404);
        }

        return response()->json(['success' => true, 'data' => $data, 'message' => ''], 200);
    }

    public function update($id) {
        // Get user information
        $data = UserInformation::where('id', $id)->first();
        
        if(empty($data)) {
            return response()->json(['success' => false, 'data' => '', 'message' => 'Record Not Found'], 404);
        }

        $data->position = request()->position;
        $data->status = request()->status;

        $data->save();

        return response()->json(['success' => true, 'data' => $data, 'message' => ''], 200);
    }

    public function delete($id) {
        // Get user information
        $data = UserInformation::where('id', $id)->first();
        
        if(empty($data)) {
            return response()->json(['success' => false, 'data' => '', 'message' => 'Record Not Found'], 404);
        }

        // Delete User Information
        $data->delete();

        // Delete data from main users table
        User::where('id', $data->user_id)->delete();

        return response()->json(['success' => true, 'data' => '', 'message' => ''], 204);
    }
}
