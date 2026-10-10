<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Lab3Seeder extends Seeder
{
    public function run(): void
    {
        $make = function (string $name, string $email, string $role): User {
            $user = User::firstOrNew(['email' => $email]);
            $user->name = $name;
            $user->password = Hash::make('Password123!');   // fictional test password
            $user->role = $role;                              // assigned here only (trusted setup)
            $user->email_verified_at = now();
            $user->save();
            return $user;
        };

        $make('Admin Staff', 'admin@example.com', 'admin');
        $a = $make('Student A', 'student.a@example.com', 'student');
        $b = $make('Student B', 'student.b@example.com', 'student');

        // Link existing Lab 2 records to students WITHOUT deleting anything.
        $ids = DB::table('requests')->whereNull('user_id')->orderBy('id')->pluck('id')->all();
        foreach ($ids as $i => $id) {
            DB::table('requests')->where('id', $id)
                ->update(['user_id' => $i % 2 === 0 ? $a->id : $b->id]);
        }
    }
}