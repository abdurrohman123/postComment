<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{   
    public function storeUpdate(Request $request, $id)
    {
        // return $request->jenis;

        if ($request->jenis == 'post'){
            $inputLike = [
                'user_id' => Auth::user()->id,
                'post_id' => $id,
                'comment_id'=> null,
            ];

            $check = Like::where('post_id', $id)->where('user_id', Auth::user()->id);
            if ($check->count() > 0){
                $check->delete();
              
                return redirect()->back()->with('info', 'Anda Telah Unlike');
            }

        } else {
            $inputLike = [
                'user_id' => Auth::user()->id,
                'post_id' => null,
                'comment_id'=> $id,
            ];   
            
            $check = Like::where('comment_id', $id)->where('user_id', Auth::user()->id);
            if ($check->count() > 0){
                $check->delete();
                return redirect()->back()->with('info', 'Anda Telah Unlike');
            }
        
        }
          
        Like::create($inputLike);
        
        return redirect()->back()->with('success', 'Like Success');
    }
  
    public function unlikeUpdate (Request $request, $id)
    {
        if ( $request->pilih == 'unlike')
        {
            $check = Like::where('post_id', $id)->where('user_id', Auth::user()->id);
            if ($check->count() > 0){
                $check->delete();
                return redirect()->back()->with('info', 'Unlike Berhasil');
            }
        }
    }
}
