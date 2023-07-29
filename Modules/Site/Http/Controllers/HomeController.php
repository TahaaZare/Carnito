<?php

namespace Modules\Site\Http\Controllers;

use App\Models\User;
use Database\Seeders\UserTableSeeder;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Comment\Entities\Comment;
use Modules\Content\Entities\Faq;
use Modules\Content\Entities\Post;
use Modules\Content\Entities\Service;
use Modules\Counseling\Database\Seeders\DaysInWeekTableSeeder;
use Modules\Counseling\Entities\Days;
use Modules\Permission\Database\Seeders\PermissionDatabaseSeeder;
use Modules\Permission\Entities\Permission;
use Modules\Role\Database\Seeders\RoleDatabaseSeeder;
use Modules\Role\Entities\Role;
use Modules\Site\Database\Seeders\UserDatabaseSeederTableSeeder;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        #region user

        $user = User::first();
        if ($user === null) {
            $default  = new UserDatabaseSeederTableSeeder();
            $default->run();
        }

        #endregion
        #region role

        $role = Role::first();
        if ($role === null) {
            $default  = new RoleDatabaseSeeder();
            $default->run();
        }


        #endregion
        #region permissions

        $permission = Permission::first();
        if ($permission === null) {
            $default  = new PermissionDatabaseSeeder();
            $default->run();
        }

        #endregion

        $faqs = Faq::where('status', 1)->take(4)->get();
        $services = Service::where('status', 1)->get();
        $posts = Post::where('status', 1)->orderBy('created_at', 'desc')->get();
        // dd(explode('/', jalaliShamsiDate(now('Asia/Tehran'))));
        foreach ($posts as  $post) {
            $date = explode('/', $post->published_at);
            $nowDate = explode('/', jalaliShamsiDate(now('Asia/Tehran')));
            if ($date[0] == $nowDate[0] && $date[1] == $nowDate[1] && $date[2] == $nowDate[2]) {
                $post->status = 1;
                $post->update([$post->status = 1]);
            }elseif($date[0] >= $nowDate[0] && $date[1] >= $nowDate[1] && $date[2] >= $nowDate[2]){
                $post->status = 1;
                $post->update([$post->status = 1]);
            }elseif($date[0] >= $nowDate[0] || $date[1] >= $nowDate[1] || $date[2] >= $nowDate[2]){
                $post->status = 1;
                $post->update([$post->status = 1]);
            }
        }
        return view('site::index', compact('services', 'posts', 'faqs'));
    }

    public function footerSerivceLink()
    {
        $services = Service::where('status', 1)->get();
        return view('site.layouts.footer', compact('services'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('site::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('site::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('site::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
