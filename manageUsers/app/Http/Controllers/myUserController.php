<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\myUsers;
use Illuminate\Http\Request;


class myUserController extends Controller
{
    public function index()
    {
        $users = myUsers::all();
        return view('user.index',compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $user = new myUsers;
        $user->name = $request ->input('name');
        $user->email = $request ->input('email');
        $user->lastname = $request ->input('lastname');
        $user->pass = $request ->input('pass');
        $user->status = $request->input('status');
        if($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $file->move('uploads/users',$file_name);
            $user->avatar = $file_name;
        }
        $user->save();
        return redirect()->back()->with('status','user profile added');
    }
    public function edit($id){
        $user = myUsers::find($id);
        return view('user.edit',compact('user'));

    }
    public function update(Request $request , $id){
        $user = myUsers::find($id);
        $user->name = $request ->input('name');
        $user->email = $request ->input('email');
        $user->lastname = $request ->input('lastname');
        $user->pass = $request ->input('pass');
        $user->status = $user->status;
        if($request->hasFile('avatar'))
        {
            $dest = 'uploads/users'.$user->avatar;
            if(File::exists($dest)){
                File::delete($dest);
            }
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $file->move('uploads/users',$file_name);
            $user->avatar = $file_name;
        }
        $user->update();
        return redirect()->back()->with('status','user profile edited');

    }
    public function delete($id){
        $user = myUsers::find($id);
        $dest = 'uploads/users'.$user->avatar;
        if(File::exists($dest)){
            File::delete($dest);
        }
        $user->delete();
        return redirect()->back()->with('status','user profile deleted');
    }


    public function active($id){
        $user = myUsers::find($id);
        if($user->status==1){
            $user->status=2;
        }else $user->status=1;
        $user->update();
        return redirect()->back()->with('status','user status changed');

    }
}
