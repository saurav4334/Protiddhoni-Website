<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Illuminate\Database\Seeder;

/**
 * Default pricing tiers (mirrors the original `pricing.tiers` page block) so the pricing
 * page renders structured plans editable in the admin under "Pricing plans".
 */
class PricingPlanSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->plans() as $plan) {
            PricingPlan::updateOrCreate(['slug' => $plan['slug']], $plan);
        }
    }

    /** @return array<int,array<string,mixed>> */
    private function plans(): array
    {
        return [
            [
                'slug' => 'starter', 'name' => 'Starter', 'sort_order' => 1,
                'description' => 'For solopreneurs, students, and small projects testing voice OTP or surveys.',
                'price_monthly' => 999, 'price_yearly' => 799,
                'rate_per_min' => '0.50', 'rate_note' => '+ ৳0.50 per minute · Pay as you go',
                'cta_label' => 'Start free trial', 'cta_url' => null, 'badge' => null,
                'is_featured' => false, 'is_active' => true,
                'features' => [
                    '<strong>1,000 minutes</strong> included monthly',
                    'Voice OTP — <strong>up to 5,000/mo</strong>',
                    '1 sender ID, 1 outbound number',
                    'Bangla + English text-to-speech',
                    'All 4 BD carriers covered',
                    'REST API + webhooks',
                    'Email support · 24h response',
                    '30-day call logs retention',
                ],
            ],
            [
                'slug' => 'business', 'name' => 'Business', 'sort_order' => 2,
                'description' => 'For e-commerce, NGOs, and growth teams running regular broadcasts and OTP at scale.',
                'price_monthly' => 4999, 'price_yearly' => 3999,
                'rate_per_min' => '0.45', 'rate_note' => '+ ৳0.45 per minute · Volume discounts apply',
                'cta_label' => 'Get started', 'cta_url' => null, 'badge' => 'Most Popular',
                'is_featured' => true, 'is_active' => true,
                'features' => [
                    '<strong>10,000 minutes</strong> included monthly',
                    'Voice OTP — <strong>up to 100,000/mo</strong>',
                    'Voice Survey + IVR builder',
                    'Scheduled broadcasts up to <strong>50,000 contacts</strong>',
                    '5 sender IDs, 3 outbound numbers',
                    'Custom voice cloning (Bangla/English)',
                    'Real-time delivery dashboard',
                    'Priority chat + email · 4h response',
                    '90-day call logs + recording',
                    'Zapier, HubSpot, Shopify integrations',
                ],
            ],
            [
                'slug' => 'enterprise', 'name' => 'Enterprise', 'sort_order' => 3,
                'description' => 'For banks, MFS, and govt-scale operations needing dedicated infra and SLAs.',
                'price_monthly' => null, 'price_yearly' => null,
                'rate_per_min' => 'Custom', 'rate_note' => 'From ৳0.38/min · Volume tier negotiation',
                'cta_label' => 'Talk to sales', 'cta_url' => '/contact', 'badge' => null,
                'is_featured' => false, 'is_active' => true,
                'features' => [
                    '<strong>Unlimited minutes</strong> with negotiated rate',
                    'Voice OTP — <strong>unlimited volume</strong>',
                    'Dedicated SIP trunks + carrier routes',
                    'White-label dashboard with your branding',
                    'Unlimited sender IDs & numbers',
                    'Custom AI voice + multi-language stack',
                    'BTRC compliance + data residency',
                    'SOC 2 + ISO 27001 reports',
                    '99.95% SLA + dedicated CSM',
                    '24/7 phone support · 15min response',
                    'Unlimited log retention + audit trail',
                ],
            ],
        ];
    }
}
