<?php

namespace Modules\Content\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Entities\PostCategory;
use Modules\Content\Http\Requests\EditPostCategoryRequest;
use Modules\Content\Http\Requests\PostCategoryRequest;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $postCategories = PostCategory::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('content::post-category.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('content::post-category.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PostCategoryRequest $request)
    {
        $inputs = $request->all();
        $name = $inputs['name'];
        $post_category = PostCategory::create($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success'," دسته بندی $name  با موفقیت ثبت شد");
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
    public function edit(PostCategory $postCategory)
    {
        return view('content::post-category.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(EditPostCategoryRequest $request, PostCategory $postCategory)
    {
        $inputs = $request->all();
        $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success'," دسته بندی $postCategory->name  با موفقیت ویرایش شد");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(PostCategory $postCategory)
    {
        $result = $postCategory->delete();
        return redirect()->route('admin.content.category.index')->with('swal-warning','عملیات حذفـ با موفقیت انجام شد');
    }

    public function status(PostCategory $postCategory){

        $postCategory->status = $postCategory->status == 0 ? 1 : 0;
        $result = $postCategory->save();
        if($result){
                if($postCategory->status == 0){
                    return response()->json(['status' => true, 'checked' => false]);
                }
                else{
                    return response()->json(['status' => true, 'checked' => true]);
                }
        }
        else{
            return response()->json(['status' => false]);
        }

    }
}
