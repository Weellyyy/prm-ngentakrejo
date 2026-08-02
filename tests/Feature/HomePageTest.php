<?php

namespace Tests\Feature;

use App\Models\ProfilPrm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_prm_profile_information(): void
    {
        ProfilPrm::create([
            'nama_organisasi' => 'PRM Ngentakrejo',
            'visi' => 'Menjadi organisasi yang bermanfaat bagi masyarakat.',
            'misi' => 'Menyebarkan nilai-nilai kebaikan.',
            'deskripsi' => 'Profil organisasi PRM.',
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('PRM Ngentakrejo');
        $response->assertSee('Profil PRM');
        $response->assertSee('Menjadi organisasi yang bermanfaat bagi masyarakat.');
    }
}
