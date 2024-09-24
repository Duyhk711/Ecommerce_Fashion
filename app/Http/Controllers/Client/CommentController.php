<?php

namespace App\Http\Controllers\Client;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->product_id = $request->input('product_id');
        $comment->title = $request->input('comment_title');
        $comment->rating = $request->input('rating');
        $comment->comment = $request->input('main_comment');

        $comment->save();
        
        return redirect()->back();
    }
}
