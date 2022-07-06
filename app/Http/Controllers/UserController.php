<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Trait\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    use ImageTrait;

    public function index()
    {
        $user = User::first();
        return view('backend.user.user-index',compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::first();
     
        $input = $request->all();
       
        if($request->has('image')){
            //removing file if image exists
            if($user && $user->image_path){
                $this->removeFile($user->image_path);
            }
          $input['image_path'] = $this->uploadImage($request->file('image'));
         
        }
        if($user && File::exists(public_path($user->image_path))){
            //if exists old image
            $input['image_path'] = $user->image_path;
        }
        
        //
        $input['password'] = Hash::make($request->password);
        $user = User::updateOrCreate(['id'=>$user->id],$input);
        if($user){
            session()->flash('success','Successfully Updated!!');
        }
        return redirect()->back();

    }

    public function removeFile($path)
    {
        if(File::exists(public_path($path))){
            unlink(public_path($path));

        }
    }
}
