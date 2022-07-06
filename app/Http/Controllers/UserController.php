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
        //if user does not exists
        
        if(is_null($user)){
            $this->createUser($request);
        }else{
            $this->updateUser($request,$user);   
        }
        

        return redirect()->back();

    }

    public function createUser($request)
    {   
        $input = $request->all();
        $request->validate([
        'name'=>'required',
        'email'=>'required|unique:users',
        'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],['image.required'=>'Image is required']);
        
        if($request->has('image')){
           
   
          $input['image_path'] = $this->uploadImage($request->file('image'));
         
        }
  
        
        //
        $input['password'] = Hash::make($request->password);
        
      
        $user = User::create($input);
        if($user){
            session()->flash('success','Successfully Created!!');
        }
    }

    public function updateUser($request,$user)
    {
        $input = $request->all();
        
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
    }

    public function removeFile($path)
    {
        if(File::exists(public_path($path))){
            unlink(public_path($path));

        }
    }
}
