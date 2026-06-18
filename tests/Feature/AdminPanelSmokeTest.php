<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelSmokeTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): Admin
    {
        return Admin::create([
            'name' => 'Smoke Admin', 'email' => 'smoke@example.com',
            'password' => bcrypt('secret'), 'role' => 'super_admin', 'is_active' => true,
        ]);
    }

    /** Every admin resource page should render for a super admin. */
    public function test_admin_resource_pages_render(): void
    {
        $this->actingAs($this->admin(), 'admin');

        $urls = [
            '/admin',
            '/admin/admins', '/admin/admins/create',
            '/admin/page-seos', '/admin/page-seos/create',
            '/admin/pricing-plans', '/admin/pricing-plans/create',
            '/admin/media-assets', '/admin/media-assets/create',
            '/admin/blog-posts', '/admin/page-blocks',
            '/admin/contact-submissions', '/admin/settings',
        ];

        foreach ($urls as $url) {
            $this->get($url)->assertSuccessful();
        }
    }
}
