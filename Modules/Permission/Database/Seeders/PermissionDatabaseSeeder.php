<?php

namespace Modules\Permission\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermissionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */  public function run()
    {

        DB::table('permissions')->insert([
            'name' => 'developer',
            'description' => 'توسعه دهنده',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('permissions')->insert([
            'name' => 'admin-panel',
            'description' => 'پنل  ادمین ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        #region admin user

        DB::table('permissions')->insert([
            'name' => 'manage-admin-users',
            'description' => 'مدیریت کاربران ادمین ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'create-user',
            'description' => 'افزودن کاربر ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-user',
            'description' => 'ویرایش کاربر ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete-user',
            'description' => 'حذف کاربر ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        #endregion
        #region roles

        DB::table('permissions')->insert([
            'name' => 'manage-roles',
            'description' => 'مدیریت نقش ها',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'create-role',
            'description' => 'افزودن نقش ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-role',
            'description' => 'ویرایش نقش ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-role-permission',
            'description' => 'ویرایش دسترسی نقش ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete-role',
            'description' => 'حذف نقش ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        #endregion
        #region content

        DB::table('permissions')->insert([
            'name' => 'manage-faqs',
            'description' => 'مدیریت سوالات متداول',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'create-faq',
            'description' => 'افزودن سوالات متداول',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-faq',
            'description' => 'ویرایش سوالات متداول',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete-faq',
            'description' => 'حذف سوالات متداول',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('permissions')->insert([
            'name' => 'manage-blogs',
            'description' => 'مدیریت  بلاگ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'manage-blogs-comments',
            'description' => 'مدیریت  نظرات بلاگ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'create-blog',
            'description' => 'افزودن بلاگ ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-blog',
            'description' => 'ویرایش بلاگ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete-blog',
            'description' => 'حذف بلاگ',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);


        DB::table('permissions')->insert([
            'name' => 'manage-messages',
            'description' => 'مدیریت  پیام ها',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'show-messages',
            'description' => ' نمایش پیام',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);


        #endregion

        #region service

        DB::table('permissions')->insert([
            'name' => 'manage-services',
            'description' => 'مدیریت سرویس ها',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('permissions')->insert([
            'name' => 'create-service',
            'description' => 'افزودن سرویس',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-service',
            'description' => 'ویرایش سرویس',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete-service',
            'description' => 'حذفـ سرویس',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        #endregion
        #region teams

        DB::table('permissions')->insert([
            'name' => 'manage-teams',
            'description' => 'مدیریت تیم',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'create-team',
            'description' => 'افزودن عضو تیم',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-team',
            'description' => 'ویرایش عضو تیم',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        #endregion

        #region tickets

        DB::table('permissions')->insert([
            'name' => 'admin-tickets',
            'description' => 'ادمین تیکت',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('permissions')->insert([
            'name' => 'ticket-section',
            'description' => 'تیکت ها',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        #endregion

        #region permission role


        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 3,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 4,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 5,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 6,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 7,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 8,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 9,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 10,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 11,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 12,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 13,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 14,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 15,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 16,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 17,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 18,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 19,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 20,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 21,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 22,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 23,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 24,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 25,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 26,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 27,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 28,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 29,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 30,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 31,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        #endregion

    }
}
