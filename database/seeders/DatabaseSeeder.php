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
            'is_active' => true,
            'is_admin'  => true,
        ]);

        //department
        Department::truncate();
        $department = Department::create([
            'name' => 'Phòng ban 1',
            'status' => 1
        ]);

        $department1 = Department::create([
            'name' => 'Phòng ban 2',
            'status' => 1
        ]);

        //roles
        Role::truncate();
        $roleStaff = Role::create([
            'permission' => ["questions.list","questions.edit","questions.create","faq.edit","faq.sendmail"],
            'name' => 'Nhân viên',
        ]);

        $roleStaff1 = Role::create([
            'permission' => ["questions.list","questions.approved","faq.approved","faq.list"],
            'name' => 'Lãnh đạo phòng',
        ]);

        $roleStaff2 = Role::create([
            'permission' => ["questions.list","faq.list"],
            'name' => 'Lãnh đạo chi nhánh',
        ]);

        //groups
        Group::truncate();
        $groupStaff = Group::create([
            'name' => 'Nhân viên test',
            'group_role_json' => '[["questions.list","questions.edit","questions.create","faq.edit","faq.sendmail"]]',
            'status' => 1
        ]);

        $groupStaff1 = Group::create([
            'name' => 'Lãnh đạo phòng',
            'group_role_json' => '[["questions.list","questions.approved","faq.approved","faq.list"]]',
            'status' => 1
        ]);

        $groupStaff2 = Group::create([
            'name' => 'Lãnh đạo chi nhánh',
            'group_role_json' => '[["questions.list","faq.list"]]',
            'status' => 1
        ]);

        //users
        $user = User::create([
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'password' => 123456,
            'is_active' => true,
            'is_admin'  => false,
        ]);

        $user1 = User::create([
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'password' => 123456,
            'is_active' => true,
            'is_admin'  => false,
        ]);

        $userBoss = User::create([
            'name' => 'Boss1',
            'email' => 'boss1@gmail.com',
            'password' => 123456,
            'is_active' => true,
            'is_admin'  => false,
        ]);

        $userBoss1 = User::create([
            'name' => 'Boss2',
            'email' => 'boss2@gmail.com',
            'password' => 123456,
            'is_active' => true,
            'is_admin'  => false,
        ]);

        $userBigBoss = User::create([
            'name' => 'Big Boss1',
            'email' => 'bigboss1@gmail.com',
            'password' => 123456,
            'is_active' => true,
            'is_admin'  => false,
        ]);

        $userBigBoss1 = User::create([
            'name' => 'Big Boss2',
            'email' => 'bigboss2@gmail.com',
            'password' => 123456,
            'is_active' => true,
            'is_admin'  => false,
        ]);

        //type of service
        $service = TypeOfService::create([
            'id' => Str::random(3),
            'name' => 'Liên kết tài khoản',
            'status' => 1,
            'user_id' => $userAdmin->id
        ]);

        $service1 = TypeOfService::create([
            'id' => Str::random(3),
            'name' => 'Mở tài khoản',
            'status' => 1,
            'user_id' => $userAdmin->id
        ]);

        //questions
        QuestionAswerService::create([
            'id' => Str::random(5),
            'question_content' => 'Mở tài khoản là gì?',
            'consulting_content' => 'Mở tài khoản tại ngân hàng BIDV gần nhất',
            'type_of_service_id' => $service1->id,
            'user_id' => $user->id
        ]);

        QuestionAswerService::create([
            'id' => Str::random(5),
            'question_content' => 'Mở tài khoản cần gì?',
            'consulting_content' => 'Mở tài khoản tại ngân hàng BIDV gần nhất',
            'type_of_service_id' => $service1->id,
            'user_id' => $user->id
        ]);

        QuestionAswerService::create([
            'id' => Str::random(5),
            'question_content' => 'Liên kết tài khoản là gì?',
            'consulting_content' => 'liên kết tài khoản là một hình thức',
            'type_of_service_id' => $service->id,
            'user_id' => $user1->id
        ]);

        QuestionAswerService::create([
            'id' => Str::random(5),
            'question_content' => 'Liên kết tài khoản cần gì gì?',
            'consulting_content' => 'liên kết tài khoản miễn phí',
            'type_of_service_id' => $service->id,
            'user_id' => $user1->id
        ]);

        //role linked to group
        $roleStaff->groups()->attach($groupStaff->id);
        $roleStaff1->groups()->attach($groupStaff1->id);
        $roleStaff2->groups()->attach($groupStaff2->id);

        //group linked to user
        $groupStaff->users()->attach($user->id);
        $groupStaff->users()->attach($user1->id);
        $groupStaff1->users()->attach($userBoss->id);
        $groupStaff1->users()->attach($userBoss1->id);
        $groupStaff2->users()->attach($userBigBoss->id);
        $groupStaff2->users()->attach($userBigBoss1->id);

        //user linked to department
        $user->department()->associate($department);
        $user->save();
        $userBoss->department()->associate($department);
        $userBoss->save();
        $userBigBoss->department()->associate($department);
        $userBigBoss->save();
        $user1->department()->associate($department1);
        $user1->save();
        $userBoss1->department()->associate($department1);
        $userBoss1->save();
        $userBigBoss1->department()->associate($department1);
        $userBigBoss1->save();
    }
}
