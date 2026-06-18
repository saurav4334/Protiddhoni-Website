<?php

namespace Database\Seeders;

use App\Models\PageSeo;
use Illuminate\Database\Seeder;

/**
 * Default per-page SEO metadata, taken from the original static HTML <title>/<meta> tags.
 * Editable afterwards in the admin under "Page SEO".
 */
class PageSeoSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->rows() as $row) {
            PageSeo::updateOrCreate(['page' => $row['page']], $row);
        }
    }

    /** @return array<int,array<string,string>> */
    private function rows(): array
    {
        return [
            [
                'page' => 'homepage', 'label' => 'Homepage',
                'title' => 'VoiceReach — Voice OTP, Survey & Broadcast for Bangladesh',
                'meta_description' => 'Reach every district in Bangladesh with carrier-grade voice OTP, surveys, and broadcasts. 99.4% delivery across all 64 districts. Trusted by 280+ businesses.',
            ],
            [
                'page' => 'about', 'label' => 'About',
                'title' => 'About — VoiceReach by Protiddhoni',
                'meta_description' => "Building Bangladesh's most reliable voice infrastructure. The story, team, and mission behind VoiceReach by Protiddhoni.",
            ],
            [
                'page' => 'pricing', 'label' => 'Pricing',
                'title' => 'Pricing — VoiceReach by Protiddhoni',
                'meta_description' => 'Transparent voice broadcasting pricing for Bangladesh. Pay-as-you-go from ৳0.45/min. Plans for startups to enterprises. No hidden fees, no setup cost.',
            ],
            [
                'page' => 'voice-otp', 'label' => 'Voice OTP',
                'title' => 'Voice OTP — VoiceReach by Protiddhoni',
                'meta_description' => 'Bangla voice OTP that actually delivers. 99.4% delivery across all 4 BD carriers in under 2 seconds. Trusted by banks, MFS, and e-commerce.',
            ],
            [
                'page' => 'voice-survey', 'label' => 'Voice Survey',
                'title' => 'Voice Survey & IVR — VoiceReach by Protiddhoni',
                'meta_description' => 'Collect responses from millions across Bangladesh through automated voice surveys. NPS, CSAT, market research — all in Bangla, all auto-analyzed.',
            ],
            [
                'page' => 'voice-broadcast', 'label' => 'Voice Broadcast',
                'title' => 'Voice Broadcast — Reach lakhs across Bangladesh in minutes | VoiceReach',
                'meta_description' => 'Send personalized voice broadcasts to lakhs of customers across Bangladesh — Bangla TTS, smart carrier routing, BTRC-compliant scheduling, and live delivery analytics.',
            ],
            [
                'page' => 'api-docs', 'label' => 'API Docs',
                'title' => 'API Documentation — Protiddhoni Voice Broadcasting',
                'meta_description' => 'Protiddhoni REST API v1.0 reference — Voice OTP, multi-number broadcasts, surveys, webhooks, and sender management for Bangladesh. Base URL: api.protiddhoni.com/api',
            ],
            [
                'page' => 'blog', 'label' => 'Blog',
                'title' => 'Blog & Insights — VoiceReach by Protiddhoni',
                'meta_description' => 'Voice marketing, OTP, and survey insights for Bangladesh. Carrier playbooks, conversion data, regulation updates, and Banglish UX learnings — all in one place.',
            ],
            [
                'page' => 'contact', 'label' => 'Contact',
                'title' => 'Contact — VoiceReach by Protiddhoni',
                'meta_description' => 'Talk to sales, get technical support, or visit our offices in Dhaka, Chattogram, and Sylhet. We respond within 4 hours, every business day.',
            ],
            [
                'page' => 'user-guide', 'label' => 'User Guide',
                'title' => 'How to Manage Your Content — Protiddhoni CMS Guide',
                'meta_description' => 'Step-by-step guide to publishing blog posts, managing media, and editing site content with the Protiddhoni CMS. No coding required.',
            ],
        ];
    }
}
