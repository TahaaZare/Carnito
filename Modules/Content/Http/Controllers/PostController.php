<?php

namespace Modules\Content\Http\Controllers;

use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Comment\Entities\Comment;
use Modules\Content\Entities\Post;
use Modules\Content\Entities\PostCategory;
use Modules\Content\Http\Requests\EditPostRequest;
use Modules\Content\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function blogs()
    {
        $posts = Post::where('status',1)->paginate(6);
        $categories = PostCategory::all();
        return view('site.layouts.blogs.blogs', compact('posts','categories'));
    }
    public function singleBlog(Post $post)
    {
        $categories = PostCategory::all();
        $comments = Comment::where('approved', 1)->where('approved', 1)->get();
        $tags = explode(',', $post->tags);
        return view('site.layouts.blogs.single-blog', compact('post', 'categories', 'comments','tags'));
    }
    public function nav_blog(){
        $posts = Post::where('status',1)->paginate(6);
        return view('site.layouts.blogs.layouts.trending', compact('posts'));
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(15);

        return view('content::post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $post_categories = PostCategory::where('deleted_at', null)->where('status', 1)->get();
        $author = User::where('is_author', 1)->get();
        return view('content::post.create', compact('post_categories', 'author'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PostRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        $post = Post::create($inputs);
        return redirect()->route('admin.content.post.index')->with('swal-success', 'پست  جدید شما با موفقیت ثبت شد');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('content::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Post $post)
    {
        $post_categories = PostCategory::where('deleted_at', null)->where('status', 1)->get();
        $author = User::where('deleted_at', null)->where('status', 1)->get();
        return view('content::post.edit', compact('post', 'post_categories', 'author'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(EditPostRequest $request, Post $post, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            if (!empty($post->image)) {
                $imageService->deleteImage($post->image);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

        $u_post = $post->update($inputs);
        return redirect()->route('admin.content.post.index')->with('swal-success', 'پست   شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Post $post)
    {
        $result = $post->delete();
        return redirect()->route('admin.content.post.index')->with('swal-warning', 'عملیات حذفـ با موفقیت انجام شد');
    }
}
