<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = Event::first();

        $faculties = Faculty::factory(5)->create([
            'department' => 'CCSIT'
        ])->toArray();

        $toBeInsertedFaculty = collect($faculties)->map(function ($value) use ($event) {
            $faculty['event_id'] = $event->id;
            $faculty['user_id'] = $value['id'];
            $faculty['user_type'] = 3;
            return $faculty;
        })->all();

        $students = Student::factory(5)->create([
            'department' => 'CCSIT'
        ])->toArray();

        $toBeInsertedStudent = collect($students)->map(function ($value) use ($event) {
            $student['event_id'] = $event->id;
            $student['user_id'] = $value['id'];
            $student['user_type'] = 2;
            return $student;
        })->all();

        EventParticipant::insert($toBeInsertedFaculty);
        EventParticipant::insert($toBeInsertedStudent);
    }
}
