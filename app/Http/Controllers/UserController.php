<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Trait\ImageTrait;
use Illuminate\Http\Request;

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
        $user = User::firstOrNew(['id'=>1]);
        $input = $request->all();
       
        if($request->has('image')){
            // $image_path
          $input['image_path'] = $this->uploadImage($request->file('image'));
        }
        $user = User::create($input);
        
        return redirect()->back();

    }
}
