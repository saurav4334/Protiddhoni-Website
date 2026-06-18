<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\PageBlock;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---------- 1. Default super admin ----------
        Admin::firstOrCreate(
            ['email' => 'admin@protiddhoni-bd.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('change-me-now'),
                'role'     => 'super_admin',
                'is_active'=> true,
            ]
        );

        $author = Admin::first();

        // ---------- 2. Blog categories ----------
        $categories = [
            ['name' => 'Voice OTP',         'color' => '#003087', 'icon' => '📞', 'sort_order' => 1],
            ['name' => 'Surveys & IVR',     'color' => '#0070BA', 'icon' => '📊', 'sort_order' => 2],
            ['name' => 'Broadcast',         'color' => '#009CDE', 'icon' => '📢', 'sort_order' => 3],
            ['name' => 'BTRC compliance',   'color' => '#FFC439', 'icon' => '🛡️', 'sort_order' => 4],
            ['name' => 'Engineering',       'color' => '#3a76b8', 'icon' => '⚙️', 'sort_order' => 5],
            ['name' => 'BD market data',    'color' => '#5089bf', 'icon' => '🇧🇩', 'sort_order' => 6],
            ['name' => 'Customer stories',  'color' => '#06112d', 'icon' => '💬', 'sort_order' => 7],
        ];
        foreach ($categories as $cat) {
            BlogCategory::firstOrCreate(['name' => $cat['name']], $cat);
        }

        // ---------- 3. Page blocks — comprehensive site-wide content ----------
        $this->call(PageBlocksSeeder::class);
        $this->call(PageSeoSeeder::class);
        $this->call(PricingPlanSeeder::class);

        // ---------- 4. Settings ----------
        Setting::set('site.name',          'Protiddhoni',                   'string', 'general');
        Setting::set('site.tagline',       'Voice broadcasting for Bangladesh', 'string', 'general');
        Setting::set('site.contact_email', 'hello@protiddhoni-bd.com',      'string', 'contact');
        Setting::set('site.support_phone', '+880 1313-484823',              'string', 'contact');
        Setting::set('contact.notify_emails', ['hello@protiddhoni-bd.com'], 'json',   'contact');

        // ---------- 5. Sample blog post (so the API has something to return on day 1) ----------
        BlogPost::firstOrCreate(
            ['slug' => 'welcome-to-protiddhoni-blog'],
            [
                'author_id'   => $author->id,
                'category_id' => BlogCategory::where('name', 'Voice OTP')->first()?->id,
                'title'       => 'Welcome to the Protiddhoni Blog',
                'excerpt'     => 'Carrier playbooks, OTP conversion data, BTRC updates — written by our team. Theory, but mostly practice.',
                'body'        => '<p>This is the first post on the Protiddhoni blog. Replace it with your real content from the admin panel.</p>',
                'status'      => 'published',
                'published_at'=> now(),
                'is_featured' => true,
            ]
        );
    }
}
