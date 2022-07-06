<?php

namespace App\Trait;

trait ImageTrait
{
    public function uploadImage($image,$dir='uploads')
    {
        $path = time().'.'.$image->getClientOriginalExtension();
        //quickest method
       $image = $image->move(public_path($dir),$path);

       return $dir.'/'.$path;
    }

    //alternatively we can store in storage disk if we want 
    //helps in storing in different object storage 
    public function storeImageStorage()
    {
    //    $path = $image->storeAs($dir, time(),'s3');
    }
}
