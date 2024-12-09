<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:xem danh sách bình luận', ['only' => ['index']]);
    }
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    public function create()
    {
        return view('admin.comments.create');
    }
    public function store(CommentRequest $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'title' => 'required',
            'comment' => 'required',
            'rating' => 'required|integer|min:1|max:5',

        ]);

        Comment::create($request->all());
        return redirect()->route('admin.comments.index')->with('success', 'Bình luận đã được thêm');
    }

    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'title' => 'required',
            'comment' => 'required',
            'rating' => 'required|integer|min:1|max:5',

        ]);
        $comment->update($request->all());
        return redirect()->route('admin.comments.index')->with('success', 'Bình luận đã được cập nhật');

    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Bình luận đã xóa');
    }

    public function show($id)
    {
        // Tìm comment theo ID
        $comment = Comment::find($id);

        // Kiểm tra xem comment có tồn tại không
        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found');
        }

        // Trả về view để hiển thị comment
        return view('admin.comments.show', compact('comment'));
    }

}
