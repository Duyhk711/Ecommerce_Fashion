<?php

namespace App\Http\Controllers\Client;

use App\Models\Comment;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:300',
            'rating' => 'nullable|integer|between:1,5',
        ]);

        if (empty($request->comment) && empty($request->rating)) {
            return redirect()->back()->with('error' , 'Vui lòng nhập bình luận hoặc chọn đánh giá.');
        }

        if (!empty($request->comment) && strlen($request->comment) > 300) {
            return redirect()->back()->with(['error', 'Bình luận chỉ được tối đa 300 kí tự.']);
        }
        
        $user = Auth::user();
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->product_id = $request->input('product_id');
        $comment->order_id = $request->input('order_id');
        $comment->title = $request->input('title');
        $comment->rating = $request->input('rating');
        $comment->comment = $request->input('comment');
        $comment->save();

        // Redirect back với thông báo thành công
        return redirect()->back()->with('success', 'Bình luận sản phẩm thành công!');
    }


    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:300',
            'rating' => 'nullable|integer|between:1,5',
        ]);

        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        if (empty($request->comment) && empty($request->rating)) {
            return redirect()->back()->with('error' , 'Vui lòng nhập bình luận hoặc chọn đánh giá.');
        }

        if (!empty($request->comment) && strlen($request->comment) > 300) {
            return redirect()->back()->with('error', 'Bình luận chỉ được tối đa 300 kí tự.');
        }

        // Cập nhật dữ liệu
        $comment->title = $request->input('title');
        $comment->comment = $request->input('comment');
        $comment->rating = $request->input('rating');
        $comment->save();

        return redirect()->back()->with('success', 'Đã sửa bình luận sản phẩm này');
    }

    public function show($id)
    {
        $comment = Comment::with('user') // Giả sử bạn đã tạo mối quan hệ giữa Comment và User
            ->where('id', $id)
            ->first();
        $image = $comment->user->avatar;
        $avatarUrl = Storage::url($image);
        if ($comment) {
            return response()->json([
                'status' => 'success',
                'user_name' => $comment->user->name,
                'comment' => $comment->comment,
                'rating' => $comment->rating,
                'avatar' => $avatarUrl ?? 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg',
                'updated_at' => $comment->updated_at->format('d/m/Y H:i'), // Định dạng thời gian cập nhật
            ]);
        }

        return response()->json(['status' => 'error']);
    }



}
