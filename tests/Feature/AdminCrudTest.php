<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_requires_authentication(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_create_profile_prm(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/profil-prm', [
            'nama_organisasi' => 'PRM Ngentakrejo',
            'visi' => 'Menjadi organisasi yang bermanfaat',
            'misi' => 'Menyebarkan dakwah',
            'latar_belakang' => 'Berawal dari komunitas',
            'alamat' => 'Ngentakrejo',
            'email' => 'prm@example.com',
            'telepon' => '08123456789',
        ]);

        $response->assertRedirect('/admin/profil-prm');
        $this->assertDatabaseHas('profil_prm', [
            'nama_organisasi' => 'PRM Ngentakrejo',
            'email' => 'prm@example.com',
        ]);
    }
}
