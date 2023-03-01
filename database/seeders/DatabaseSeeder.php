<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Group;
use App\Models\QuestionAswerService;
use App\Models\Role;
use App\Models\TypeOfService;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //user admin
        User::truncate();
        $userAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 123456,
            // 'is_active' => true,
            // 'is_admin'  => true,
        ]);

        //roles
        // Role::truncate();
        // $roleStaff = Role::create([
        //     'permission' => ["questions.listStaff", "questions.edit", "questions.create", "faq.listStaff", "faq.edit", "faq.sendmail"],
        //     'name' => 'Nhân viên',
        // ]);

        // $roleStaff1 = Role::create([
        //     'permission' => ["questions.listBoss", "questions.approved", "faq.listBoss", "faq.assignUser", "faq.edit"],
        //     'name' => 'Lãnh đạo phòng',
        // ]);

        // $roleStaff2 = Role::create([
        //     'permission' => ["questions.list", "faq.list"],
        //     'name' => 'Lãnh đạo chi nhánh',
        // ]);

        //groups
        Group::truncate();
        // $groupStaff = Group::create([
        //     'name' => 'Nhân viên',
        //     'group_role_json' => '[["questions.listStaff", "questions.edit", "questions.create", "faq.listStaff", "faq.edit", "faq.sendmail"]]',
        //     'status' => 1
        // ]);

        // $groupStaff1 = Group::create([
        //     'name' => 'Lãnh đạo phòng',
        //     'group_role_json' => '[["questions.listBoss", "questions.approved", "faq.listBoss", "faq.assignUser", "faq.edit"]]',
        //     'status' => 1
        // ]);

        // $groupStaff2 = Group::create([
        //     'name' => 'Lãnh đạo chi nhánh',
        //     'group_role_json' => '[["questions.list","faq.list"]]',
        //     'status' => 1
        // ]);

        //users
        // $user = User::create([
        //     'name' => 'User1',
        //     'email' => 'user1@gmail.com',
        //     'password' => 123456,
        //     'is_active' => true,
        //     'is_admin'  => false,
        // ]);

        // $user1 = User::create([
        //     'name' => 'User2',
        //     'email' => 'user2@gmail.com',
        //     'password' => 123456,
        //     'is_active' => true,
        //     'is_admin'  => false,
        // ]);

        // $userBoss = User::create([
        //     'name' => 'Boss1',
        //     'email' => 'boss1@gmail.com',
        //     'password' => 123456,
        //     'is_active' => true,
        //     'is_admin'  => false,
        // ]);

        // $userBoss1 = User::create([
        //     'name' => 'Boss2',
        //     'email' => 'boss2@gmail.com',
        //     'password' => 123456,
        //     'is_active' => true,
        //     'is_admin'  => false,
        // ]);

        // $userBigBoss = User::create([
        //     'name' => 'BigBoss1',
        //     'email' => 'bigboss1@gmail.com',
        //     'password' => 123456,
        //     'is_active' => true,
        //     'is_admin'  => false,
        // ]);

        // $userBigBoss1 = User::create([
        //     'name' => 'BigBoss2',
        //     'email' => 'bigboss2@gmail.com',
        //     'password' => 123456,
        //     'is_active' => true,
        //     'is_admin'  => false,
        // ]);
    }
}
