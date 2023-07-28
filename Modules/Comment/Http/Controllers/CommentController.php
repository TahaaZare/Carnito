<?php

namespace Modules\Comment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Comment\Entities\Comment;
use Illuminate\Support\Str;
use Modules\Comment\Http\Requests\CommentRequest;
use Modules\Content\Entities\Post;

class CommentController extends Controller
{
    public function addComment(Post $post, Request $request)
    {
        $request->validate([
            'body' => 'required|max:2000'
        ]);

        $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['commentable_id'] = $post->id;
        $inputs['commentable_type'] = Post::class;
        Comment::create($inputs);
        return back()->with('swal-success','نظر شما بعد از تایید نمایش داده میشود .');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function postIndex()
    {
        $unSeenComments = Comment::where('commentable_type','Modules\Content\Entities\Post')->where('seen',0)->get();
        foreach ($unSeenComments as $unSeenComment) {
            $unSeenComment->seen = 1;
            $result = $unSeenComment->save();
        }
        $comments = Comment::orderBy('created_at', 'desc')->where('commentable_type','Modules\Content\Entities\Post')->simplePaginate(10);
        return view('comment::index', compact('comments'));
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function postShow(Comment $comment)
    {
        return view('comment::show', compact('comment'));
    }
    public function postStatus(Comment $comment)
    {

        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            if ($comment->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
    
    public function postApproved(Comment $comment){

        $comment->approved = $comment->approved == 0 ? 1 : 0;
        $result = $comment->save();
        if($result){
            return redirect()->route('admin.content.posts-comments.index')->with('swal-success', '  وضعیت نظر با موفقیت تغییر کرد');
        }
        else{
            return redirect()->route('admin.content.posts-comments.index')->with('swal-error', '  وضعیت نظر با خطا مواجه شد');
        }

    }

    public function postAnswer(CommentRequest $request, Comment $comment)
    {
        if ($comment->parent == null) {
            $inputs = $request->all();
            $inputs['author_id'] = 1;
            $inputs['parent_id'] = $comment->id;
            $inputs['commentable_id'] = $comment->commentable_id;
            $inputs['commentable_type'] = $comment->commentable_type;
            $inputs['approved'] = 1;
            $inputs['status'] = 1;
            $comment = Comment::create($inputs);
            return redirect()->route('admin.content.posts-comments.index')->with('swal-success', '  پاسخ شما با موفقیت ثبت شد');
        }
        else{
            return redirect()->route('admin.content.posts-comments.index')->with('swal-error', 'خطا');

        }
    }
    // 

}
