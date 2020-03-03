<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadImage;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use UploadImage;

    public function index()
    {
        $rows = User::where('type',2)->paginate(20);
        return view('admin.pages.user.index',compact('rows'));
    }


    public function create()
    {
        $user = new User;
        return view('admin.pages.user.form',compact('user'));
    }


    public function store(UserRequest $request)
    {
        $inputs = $request->all();
        $inputs['type'] =2;
        $user = User::create($inputs);
        if ($request->photo)
            $this->upload($request->photo,$user);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function show($id)
    {

    }


    public function edit(User $user)
    {
        return view('admin.pages.user.form',compact('user'));
    }


    public function update(UserRequest $request, User $user)
    {
        $inputs = $request->all();
        if (!$request->password)
        {
            unset($inputs['password']);
        }
        $user->update($inputs);
        if ($request->photo)
            $this->upload($request->photo,$user,null,true);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message','Done Successfully');
    }

    public function allUsers(Request $request)
    {
        if ($request->ajax())
        {
            $user = User::find($request->id);
            $user->update(['type'=>$request->type]);
            return ['status'=>true];
        }
        $rows = User::paginate(20);
        return view('admin.pages.user.all-user',compact('rows'));
    }
}
