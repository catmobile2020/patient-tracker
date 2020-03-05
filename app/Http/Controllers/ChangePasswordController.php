<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function changePassword($token)
    {
        if ($user = User::where('reset_token',$token)->first())
        {
            return view('update-password');
        }
        return abort(404);
    }

    public function updatePassword($token,UpdatePasswordRequest $request)
    {
        if ($user = User::where('reset_token',$token)->first())
        {
            $user->update(['password'=>$request->password,'reset_token'=>null]);
            return json_encode('Updated Successfully',200);
        }
        return abort(404);
    }
}
