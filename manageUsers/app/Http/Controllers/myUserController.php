<?php

namespace App\Http\Controllers;
use App\Models\profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\myUsers;
use Illuminate\Http\Request;



class myUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $profiles = profile::all();
        return view('user.index',compact('users','profiles'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $user = new User;

        $user->name = $request ->input('name');
        $user->email = $request ->input('email');
        $user->lastname = $request ->input('lastname');
        $user->password = $request ->input('pass');
        $user->status = $request->input('status');
        $user->save();
        if($request->hasFile('avatar1') && $request->hasFile('avatar2'))
        {

            for($i = 0; $i < 2; $i++)
            {
                $user_profile = new profile;
                $file = $request->file('avatar'.($i+1));
                $extension = $file->getClientOriginalExtension();
                $file_name = time().'_'.$i.'.'.$extension;
                $file->move('uploads/users',$file_name);
                $user_profile->avatar = $file_name;
                $user_profile->user_id = $user->id;
                $user_profile->save();
            }
        }

        return redirect()->back()->with('status','user profile added');
    }
    public function edit($id){
        $user = User::find($id);
        $profiles = DB::table('profile')->where('user_id','=', $id)->get();
        $p1 = $profiles->get(0);
        $p2 = $profiles->get(1);
        return view('user.edit',compact('user','p1','p2'));

    }
    public function update(Request $request , $id){
        $user = User::find($id);
        $profiles = DB::table('profile')->where('user_id','=', $id)->get();

        $user->name = $request ->input('name');
        $user->email = $request ->input('email');
        $user->lastname = $request ->input('lastname');
        $user->password = $request ->input('pass');
        $user->status = $request ->input('status');
        //dd($profiles);
        $p1 = $profiles->get(0);
        $p2 = $profiles->get(1);

        if($request->hasFile('avatar1'))
        {
            $dest = 'uploads/users'.$p1->avatar;
            if(File::exists($dest)){
                File::delete($dest);
            }
            $file = $request->file('avatar1');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'_0.'.$extension;
            $file->move('uploads/users',$file_name);
            profile::where('avatar', $p1->avatar)->delete();
            DB::table('profile')->insert(
                array(
                    'user_id'     =>   $id,
                    'avatar'   =>   $file_name
                )
            );
        }
        if($request->hasFile('avatar2'))
        {
            $dest = 'uploads/users'.$p2->avatar;
            if(File::exists($dest)){
                File::delete($dest);
            }
            $file = $request->file('avatar2');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'_1.'.$extension;
            $file->move('uploads/users',$file_name);

            profile::where('avatar', $p2->avatar)->delete();
            DB::table('profile')->insert(
                array(
                    'user_id'     =>   $id,
                    'avatar'   =>   $file_name
                )
            );
        }
        $user->update();
        return redirect()->back()->with('status','user profile edited');

    }
    public function delete($id){
        $user = User::find($id);
        $profile = DB::table('profile')->where('user_id','=', $id)->get();

        foreach ($profile as $p)
        {
            $dest = 'uploads/users'.$p->avatar;
            if(File::exists($dest)){
                File::delete($dest);
            }
            DB::table('profile')->where('avatar',$p->avatar)->delete();
        }
        $user->delete();

        return redirect()->back()->with('status','user profile deleted');
    }


    public function active($id){
        $user = User::find($id);
        if($user->status==1){
            $user->status=2;
        }else $user->status=1;
        $user->update();
        return redirect()->back()->with('status','user status changed');

    }
}
