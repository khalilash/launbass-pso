<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Setup tabel User dan Password_Reset_Codes sesuai controller kamu
        DB::statement('CREATE TABLE IF NOT EXISTS user (IDUser INTEGER PRIMARY KEY AUTOINCREMENT, Nama TEXT, Email TEXT UNIQUE, Password TEXT, Jabatan TEXT)');
        DB::statement('CREATE TABLE IF NOT EXISTS Password_Reset_Codes (Email TEXT, Code TEXT, Used INTEGER, Expires_At DATETIME, Created_At DATETIME)');
    }

    // --- TEST REGISTER ---
    public function test_user_bisa_register()
    {
        $response = $this->post('/register', [
            'name' => 'Budi User',
            'email' => 'budi@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/home');
        $this->assertDatabaseHas('user', ['Email' => 'budi@example.com']);
    }

    // --- TEST FORGOT PASSWORD FLOW ---
    public function test_forgot_password_full_flow()
    {
        // 1. Register user dummy
        DB::table('user')->insert([
            'Nama' => 'User Test',
            'Email' => 'test@example.com',
            'Password' => bcrypt('oldpassword')
        ]);

        // 2. Step 1: Send Code
        $this->post('/forgot-password', ['email' => 'test@example.com'])->assertStatus(302);
        $code = session('reset_code_for_testing');

        // 3. Step 2: Verify Code
        $this->post('/forgot-password/verify', ['code' => $code])->assertRedirect(route('password.reset'));

        // 4. Step 3: Reset Password
        $this->post('/forgot-password/reset', [
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123'
        ])->assertRedirect(route('password.reset'));

        $this->assertTrue(session('password_changed'));
    }
}
