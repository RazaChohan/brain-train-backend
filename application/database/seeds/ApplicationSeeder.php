<?php

use Illuminate\Database\Seeder;
use Dal\Entities\User;
use Dal\Entities\Category;
use Dal\Entities\Course;
use Dal\Entities\Exercise;
use Dal\Entities\Session;
use Illuminate\Support\Facades\Hash;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        //Add new user
        $user = new User();
        $user->username = 'newuser';
        $user->password = Hash::make('brain_training_123');
        $user->status = "active";
        $userID = $user->save();

        //Insert new category
        $categoryA = new Category();
        $categoryA->name = 'CategoryA';
        $categoryAID = $categoryA->save();

        //Insert new category
        $categoryB = new Category();
        $categoryB->name = 'CategoryB';
        $categoryBID = $categoryB->save();

        //Insert new course
        $courseA = new Course();
        $courseA->name = 'CourseA';
        $courseA->course_time = $faker->dateTime();
        $courseAID = $courseA->save();

        //Insert new course
        $courseB = new Course();
        $courseB->name = 'CourseB';
        $courseB->course_time = $faker->dateTime();
        $courseBID = $courseB->save();

        //Insert new exercise
        $exerciseA = new Exercise();
        $exerciseA->name = 'Exercise A';
        $exerciseA->course_id = $courseAID;
        $exerciseA->category_id = $categoryAID;
        $exerciseA->points = $faker->randomFloat();
        $exerciseA->save();

        //Insert new exercise
        $exerciseB = new Exercise();
        $exerciseB->name = 'Exercise B';
        $exerciseB->course_id = $courseBID;
        $exerciseB->category_id = $categoryBID;
        $exerciseB->points = $faker->randomFloat(2, 10, 100);
        $exerciseB->save();

        //Insert new session
        $sessionA = new Session();
        $sessionA->user_id = $userID;
        $sessionA->course_id = $courseAID;
        $sessionA->score = $faker->numberBetween(10, 100);
        $sessionA->score_normalized = $faker->numberBetween(10, 100);
        $sessionA->start_difficulty = 'easy';
        $sessionA->end_difficulty = 'hard';
        $sessionA->session_time = $faker->dateTime;
        $sessionA->save();


        //Insert new session
        $sessionB = new Session();
        $sessionB->user_id = $userID;
        $sessionB->course_id = $courseBID;
        $sessionB->score = $faker->numberBetween(10, 100);
        $sessionB->score_normalized = $faker->numberBetween(10, 100);
        $sessionB->start_difficulty = 'hard';
        $sessionB->end_difficulty = 'easy';
        $sessionB->session_time = $faker->dateTime;
        $sessionB->save();
    }
}
