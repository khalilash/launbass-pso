<?php

namespace Tests\Feature;

use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * Menguji rute publik dapat diakses
     */
    public function test_rute_publik_dapat_diakses()
    {
        $this->get('/splash')->assertStatus(200);
        $this->get('/login')->assertStatus(200);
        $this->get('/register')->assertStatus(200);
    }

    /**
     * Menguji rute proteksi (harus login)
     */
    public function test_rute_proteksi_memerlukan_login()
    {
        // Daftar rute yang harus redirect ke login jika belum ada session user_id
        $protectedRoutes = [
            '/home',
            '/riwayat-pesanan',
            '/keuangan',
            '/datapelanggan',
            '/tambahpesanan'
        ];

        foreach ($protectedRoutes as $route) {
            $this->get($route)->assertRedirect('/login');
        }
    }

    /**
     * Menguji rute forgot password
     */
    public function test_rute_forgot_password()
    {
        $this->get('/forgot-password')->assertStatus(200);
        $this->get('/forgot-password/verify')->assertStatus(200);
        $this->get('/forgot-password/reset')->assertStatus(200);
    }
}
