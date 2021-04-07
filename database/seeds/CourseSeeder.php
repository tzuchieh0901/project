<?php

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $fixture = $this->getTestFixture();
        foreach ($fixture as $courseName) {
            Course::create([
                'name' => $courseName,
                'description' => $faker->text,
                'outline' => $faker->text,
            ]);

        }
    }

    private function getTestFixture()
    {
        return [
            'PHP 基礎課程',
            'Laravel 程式設計',
            '良好的程式撰寫基礎',
            '設計模式基礎',
        ];
    }
}