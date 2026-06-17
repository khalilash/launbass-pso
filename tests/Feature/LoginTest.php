<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_flow()
    {
        DB::statement('CREATE TABLE IF NOT EXISTS user (IDUser INTEGER PRIMARY KEY AUTOINCREMENT, Nama TEXT, Email TEXT, Password TEXT, Jabatan TEXT)');

        $password = 'secret123';
        DB::table('user')->insert([
            'Nama' => 'Admin',
            'Email' => 'admin@test.com',
            'Password' => bcrypt($password),
            'Jabatan' => 'Admin'
        ]);

        $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => $password
        ])->assertRedirect('/home');
    }
}
