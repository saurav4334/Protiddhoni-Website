<?php

namespace Database\Seeders;

use App\Models\PageBlock;
use Illuminate\Database\Seeder;

/**
 * One source of truth for every editable string/JSON across the marketing site.
 * Run once with `php artisan db:seed --class=PageBlocksSeeder`.
 *
 * Naming convention: {page}.{section}.{element}
 *   homepage.hero.headline
 *   pricing.faq.items
 *   global.footer.address
 *
 * Types:
 *   text      → plain string
 *   rich_text → HTML allowed
 *   json      → structured (lists of FAQ items, testimonials, pricing tiers)
 *   image     → image URL / path
 */
class PageBlocksSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->blocks() as $block) {
            PageBlock::updateOrCreate(['key' => $block['key']], $block);
        }
    }

    /** @return array<int,array<string,mixed>> */
    private function blocks(): array
    {
        return array_merge(
            $this->global(),
            $this->homepage(),
            $this->voiceOtp(),
            $this->voiceSurvey(),
            $this->voiceBroadcast(),
            $this->pricing(),
            $this->about(),
            $this->contact(),
            $this->apiDocs(),
            $this->blog(),
            $this->userGuide(),
        );
    }

    /* ============================================================ */
    /*  GLOBAL — nav, footer, contact info                           */
    /* ============================================================ */
    private function global(): array
    {
        return [
            ['key' => 'global.brand.name',       'label' => 'Brand name',          'page' => 'global', 'type' => 'text', 'value' => 'VoiceReach'],
            ['key' => 'global.brand.tagline',    'label' => 'Brand tagline',       'page' => 'global', 'type' => 'text', 'value' => 'Voice broadcasting for Bangladesh'],

            ['key' => 'global.contact.phone',    'label' => 'Support phone',       'page' => 'global', 'type' => 'text', 'value' => '+880 1313-484823'],
            ['key' => 'global.contact.email',    'label' => 'Support email',       'page' => 'global', 'type' => 'text', 'value' => 'hello@protiddhoni.bd'],
            ['key' => 'global.contact.address',  'label' => 'Office address',      'page' => 'global', 'type' => 'text', 'value' => 'Banani, Dhaka 1213'],

            ['key' => 'global.footer.about',     'label' => 'Footer about line',   'page' => 'global', 'type' => 'rich_text',
             'value' => 'Voice OTP, surveys, and broadcast for the Bangladesh market. Built in Banani, deployed across 64 districts.'],

            ['key' => 'global.footer.badges',    'label' => 'Footer badge pills',  'page' => 'global', 'type' => 'json',
             'value' => json_encode(['🇧🇩 Made in BD', 'BTRC compliant', 'SOC 2 Type II'])],

            ['key' => 'global.cta.signin_url',   'label' => 'Sign-in button URL',  'page' => 'global', 'type' => 'text', 'value' => 'https://app.protiddhoni.com/login'],
            ['key' => 'global.cta.signup_url',   'label' => 'Start-free button URL','page' => 'global','type' => 'text', 'value' => 'https://app.protiddhoni.com/register'],

            ['key' => 'contact.notify_emails',   'label' => 'Contact form notification recipients', 'page' => 'global', 'type' => 'json',
             'value' => json_encode(['hello@protiddhoni.bd']),
             'description' => 'Array of emails that receive new contact form submissions.'],
        ];
    }

    /* ============================================================ */
    /*  HOMEPAGE                                                     */
    /* ============================================================ */
    private function homepage(): array
    {
        return [
            ['key' => 'homepage.hero.pill',      'label' => 'Hero status pill',    'page' => 'homepage', 'type' => 'text', 'value' => 'All Bangladesh · Live now'],
            ['key' => 'homepage.hero.headline',  'label' => 'Hero headline',       'page' => 'homepage', 'type' => 'rich_text',
             'value' => 'Every district.<br/><span class="accent">Every call.</span><br/>Real-time.'],
            ['key' => 'homepage.hero.subhead',   'label' => 'Hero subtext',        'page' => 'homepage', 'type' => 'rich_text',
             'value' => 'From Tetulia to Teknaf, Bandarban to Panchagarh — we deliver voice OTP, surveys, and broadcasts to every corner of the country. <strong>64 districts · 487 upazilas · 4 carriers · 1 network.</strong>'],
            ['key' => 'homepage.hero.cta_primary',  'label' => 'Hero primary CTA label',   'page' => 'homepage', 'type' => 'text', 'value' => 'Start broadcasting →'],
            ['key' => 'homepage.hero.cta_secondary','label' => 'Hero secondary CTA label', 'page' => 'homepage', 'type' => 'text', 'value' => '▶ Hear sample'],
            ['key' => 'homepage.hero.trust_strip',  'label' => 'Hero trust strip',         'page' => 'homepage', 'type' => 'text', 'value' => '4.9 · 280+ BD businesses · No card required'],

            ['key' => 'homepage.stats.calls_per_min', 'label' => 'Calls/min stat',         'page' => 'homepage', 'type' => 'integer', 'value' => '3284'],
            ['key' => 'homepage.stats.avg_latency_s', 'label' => 'Avg latency (seconds)',   'page' => 'homepage', 'type' => 'text',    'value' => '1.8'],
            ['key' => 'homepage.stats.coverage',      'label' => 'Coverage districts/total','page' => 'homepage', 'type' => 'text',    'value' => '64/64'],
            ['key' => 'homepage.stats.upazilas',      'label' => 'Upazila zones',           'page' => 'homepage', 'type' => 'integer', 'value' => '487'],

            ['key' => 'homepage.stats_banner', 'label' => 'Stats banner numbers', 'page' => 'homepage', 'type' => 'json',
             'value' => json_encode([
                 ['num' => '2.4M+',  'lbl' => 'Calls / 24 hrs'],
                 ['num' => '99.4%',  'lbl' => 'Avg delivery rate'],
                 ['num' => '280+',   'lbl' => 'BD businesses'],
                 ['num' => '64/64',  'lbl' => 'Districts covered'],
             ])],

            ['key' => 'homepage.testimonials',  'label' => 'Homepage testimonials', 'page' => 'homepage', 'type' => 'json',
             'value' => json_encode([
                 ['name' => 'Sajid Rahman', 'role' => 'CTO, bKash', 'quote' => 'SMS used to fail in rural areas — that was our biggest pain. After switching to VoiceReach, our delivery rate climbed from 78% to 99%.'],
                 ['name' => 'Fatima Khan',  'role' => 'Head of Growth, Daraz', 'quote' => 'COD verification calls dropped our return rate from 31% to 12%. The Bangla TTS quality is exceptional.'],
                 ['name' => 'Dr. Hasan',    'role' => 'Programs Director, BRAC', 'quote' => "We needed to reach 4 lakh households for a health awareness campaign. VoiceReach's coverage and reporting saved our compliance team."],
             ])],

            ['key' => 'homepage.faq', 'label' => 'Homepage FAQ items', 'page' => 'homepage', 'type' => 'json',
             'value' => json_encode([
                 ['q' => "What's the difference between Voice OTP and SMS OTP?",
                  'a' => "SMS often fails in rural areas due to network congestion and low priority queues. A voice call rings directly on the user's phone — even with poor data. Voice OTP delivery rate is 99.4%, while SMS only achieves 78–85%."],
                 ['q' => 'How is the Bangla voice quality? Will it sound robotic?',
                  'a' => 'Our Bangla TTS engine is trained with local linguists, with natural prosody and regional accent support (Dhaka, Sylhet, Chittagong). Both female and male voices are available.'],
                 ['q' => 'Which carriers do you support?',
                  'a' => 'All 4 BD carriers: Grameenphone, Robi, Banglalink, Airtel. Plus international roaming numbers (+880 prefix outside BD).'],
                 ['q' => 'How does pricing work?',
                  'a' => 'Pay-as-you-go from ৳0.85/call connected, or monthly subscription with included volume. See the pricing page for full details.'],
                 ['q' => 'Compliance and regulations? Do you have BTRC permission?',
                  'a' => 'Yes — fully BTRC compliant. DND registry integration, opt-in consent verification, and complete audit logs.'],
                 ['q' => 'Are failed calls charged?',
                  'a' => "No — only successful connected calls count. Calls that hit busy, switched-off, or unreachable numbers are free."],
             ])],
        ];
    }

    /* ============================================================ */
    /*  VOICE OTP                                                    */
    /* ============================================================ */
    private function voiceOtp(): array
    {
        return [
            ['key' => 'voice-otp.hero.pill',     'label' => 'Hero pill',     'page' => 'voice-otp', 'type' => 'text', 'value' => 'VOICE OTP · 99.4% DELIVERY IN 2S'],
            ['key' => 'voice-otp.hero.headline', 'label' => 'Hero headline', 'page' => 'voice-otp', 'type' => 'rich_text',
             'value' => 'SMS OTP busy?<br/>Network jam?<br/><span class="accent">Voice OTP works.</span>'],
            ['key' => 'voice-otp.hero.subhead',  'label' => 'Hero subtext',  'page' => 'voice-otp', 'type' => 'rich_text',
             'value' => "When SMS gets throttled or filtered by carriers, Voice OTP still gets through. The call rings directly on the customer's phone and reads out the OTP in Bangla — <strong>3× more reliable than SMS, delivered in 2 seconds.</strong>"],

            ['key' => 'voice-otp.faq', 'label' => 'Voice OTP FAQ', 'page' => 'voice-otp', 'type' => 'json',
             'value' => json_encode([
                 ['q' => "What's the difference between Voice OTP and SMS OTP?",
                  'a' => "Voice OTP places a call to the customer and reads out the OTP in Bangla or English. Unlike SMS, it doesn't go to an inbox, so it can't get lost in filters or spam folders. Carrier-level delivery rate is 99.4% vs ~78% for SMS."],
                 ['q' => 'Is the Bangla voice natural?',
                  'a' => 'Yes — we use neural TTS so that Bangla pronunciation, intonation, and number reading sound natural. You can choose from 4 voice options (2 female, 2 male) or commission a custom voice clone.'],
                 ['q' => 'Which carriers are supported?',
                  'a' => 'All four — Grameenphone, Robi/Airtel, Banglalink. Automatic routing picks the route with the highest delivery rate per carrier.'],
                 ['q' => 'Can I customise the message template?',
                  'a' => 'Definitely — full message-template control. You can customise the intro, OTP digits, outro, and expiry mention. A/B testing tools are built in.'],
             ])],
        ];
    }

    /* ============================================================ */
    /*  VOICE SURVEY                                                 */
    /* ============================================================ */
    private function voiceSurvey(): array
    {
        return [
            ['key' => 'voice-survey.hero.pill',     'label' => 'Hero pill',     'page' => 'voice-survey', 'type' => 'text', 'value' => 'VOICE SURVEY · 60-70% COMPLETION'],
            ['key' => 'voice-survey.hero.headline', 'label' => 'Hero headline', 'page' => 'voice-survey', 'type' => 'rich_text',
             'value' => 'What customers actually say,<br/><span class="accent">over the phone.</span>'],
            ['key' => 'voice-survey.hero.subhead',  'label' => 'Hero subtext',  'page' => 'voice-survey', 'type' => 'rich_text',
             'value' => "Emails go unopened, SMS goes unanswered, online survey links go unclicked. <strong>A voice survey rings the phone directly</strong> — the question is asked in Bangla, the customer presses 1–5 to reply. Auto-analysed, real-time dashboard."],

            ['key' => 'voice-survey.faq', 'label' => 'Voice Survey FAQ', 'page' => 'voice-survey', 'type' => 'json',
             'value' => json_encode([
                 ['q' => 'What completion rate can I expect?',
                  'a' => 'SMS reply rate is ~12%, online-survey link click rate is ~3%. A voice call rings directly, the customer picks up, and a 1–5 button press takes 30 seconds. Result: 60–70% completion rate.'],
                 ['q' => 'Can I capture open-ended responses?',
                  'a' => 'Yes — every question can capture either DTMF (button press) or a voice recording (10–60 seconds). Open-ended Bangla recordings are auto-transcribed and sentiment-tagged.'],
                 ['q' => 'Can I segment my audience?',
                  'a' => 'Definitely — you can filter your uploaded list by district, division, age range, or gender. Or set quotas: "stop after 200 responses from each district".'],
             ])],
        ];
    }

    /* ============================================================ */
    /*  VOICE BROADCAST                                              */
    /* ============================================================ */
    private function voiceBroadcast(): array
    {
        return [
            ['key' => 'voice-broadcast.hero.pill',     'label' => 'Hero pill',     'page' => 'voice-broadcast', 'type' => 'text', 'value' => 'Live now · 12,400 broadcasts running across BD'],
            ['key' => 'voice-broadcast.hero.headline', 'label' => 'Hero headline', 'page' => 'voice-broadcast', 'type' => 'rich_text',
             'value' => 'Reach lakhs of customers <span class="text-gradient">in one announcement.</span>'],
            ['key' => 'voice-broadcast.hero.subhead',  'label' => 'Hero subtext',  'page' => 'voice-broadcast', 'type' => 'rich_text',
             'value' => 'Voice broadcasts that ring on every BD carrier — Bangla or English — with smart pacing, BTRC-compliant scheduling, and live delivery analytics by district. Unlike SMS, people actually hear it and remember.'],
            ['key' => 'voice-broadcast.composer.headline', 'label' => 'Composer headline', 'page' => 'voice-broadcast', 'type' => 'text', 'value' => 'A composer that writes like you talk — in Bangla.'],
            ['key' => 'voice-broadcast.composer.subhead',  'label' => 'Composer subhead',  'page' => 'voice-broadcast', 'type' => 'text', 'value' => 'Drag a placeholder, hear the TTS, set the carrier mix. The composer is in Bangla and English side by side.'],
        ];
    }

    /* ============================================================ */
    /*  PRICING                                                      */
    /* ============================================================ */
    private function pricing(): array
    {
        return [
            ['key' => 'pricing.hero.pill',     'label' => 'Hero pill',     'page' => 'pricing', 'type' => 'text', 'value' => 'TRANSPARENT PRICING · NO HIDDEN FEES'],
            ['key' => 'pricing.hero.headline', 'label' => 'Hero headline', 'page' => 'pricing', 'type' => 'rich_text',
             'value' => 'Pay only for the calls<br/>that <span class="accent">actually connect.</span>'],
            ['key' => 'pricing.hero.subhead',  'label' => 'Hero subtext',  'page' => 'pricing', 'type' => 'rich_text',
             'value' => 'Bangladesh-first pricing in Taka. Plans from solopreneurs to enterprises — pay-as-you-go through to unlimited monthly. <strong>৳0 setup. ৳0 monthly minimum on Starter.</strong>'],

            ['key' => 'pricing.tiers', 'label' => 'Pricing plan tiers', 'page' => 'pricing', 'type' => 'json',
             'value' => json_encode([
                 ['name' => 'Starter',    'price_monthly' => 999,  'price_yearly' => 799,  'desc' => 'For solopreneurs, students, and small projects testing voice OTP or surveys.', 'rate_per_min' => 0.85, 'cta' => 'Get Started', 'features' => ['1,000 calls/month included', 'All 4 BD carriers', 'Bangla + English TTS', 'Email support']],
                 ['name' => 'Business',   'price_monthly' => 4999, 'price_yearly' => 3999, 'desc' => 'For e-commerce, NGOs, and growth teams running regular broadcasts and OTP at scale.', 'rate_per_min' => 0.65, 'cta' => 'Start Trial', 'features' => ['10,000 calls/month included', 'Custom voices', 'Priority support', 'API access', 'Webhooks', 'BTRC reporting'], 'featured' => true, 'badge' => 'Most Popular'],
                 ['name' => 'Enterprise', 'price_monthly' => 0,      'price_yearly' => 0,      'desc' => 'For banks, MFS, and govt-scale operations needing dedicated infra and SLAs.', 'rate_per_min' => 'Custom', 'cta' => 'Contact Sales', 'features' => ['Unlimited calls', 'Dedicated infra', '99.95% SLA', '24/7 support', 'Custom contracts', 'On-prem option']],
             ])],

            ['key' => 'pricing.faq', 'label' => 'Pricing FAQ', 'page' => 'pricing', 'type' => 'json',
             'value' => json_encode([
                 ['q' => 'Are failed calls charged?',
                  'a' => 'No — if a call hits a busy network, rings without an answer, or is rejected, you\'re not charged. You only pay for the paid duration of connected and answered calls. For Voice OTP, calls of 12 seconds or less count as a "completed OTP."'],
                 ['q' => 'Can I switch plans anytime?',
                  'a' => 'Yes — upgrade or downgrade any time. Unused balance carries over for 90 days.'],
                 ['q' => 'What payment methods do you accept?',
                  'a' => 'bKash, Nagad, SSLCommerz (cards), bank transfer for Business and Enterprise. Monthly invoicing for Enterprise.'],
             ])],
        ];
    }

    /* ============================================================ */
    /*  ABOUT                                                        */
    /* ============================================================ */
    private function about(): array
    {
        return [
            ['key' => 'about.hero.pill',     'label' => 'Hero pill',     'page' => 'about', 'type' => 'text', 'value' => 'ABOUT PROTIDDHONI'],
            ['key' => 'about.hero.headline', 'label' => 'Hero headline', 'page' => 'about', 'type' => 'rich_text',
             'value' => "Building voice infrastructure<br/>for <span class=\"accent\">Bangladesh's next decade.</span>"],
            ['key' => 'about.hero.subhead',  'label' => 'Hero subtext',  'page' => 'about', 'type' => 'rich_text',
             'value' => 'Started in Dhaka, 2018. Today: 280+ businesses, 2.4M calls a day, 64 of 64 districts. We hold one simple promise: <strong>your voice will reach every corner of Bangladesh.</strong>'],

            ['key' => 'about.team', 'label' => 'Team members', 'page' => 'about', 'type' => 'json',
             'value' => json_encode([
                 ['name' => 'Tareq Hossain',     'role' => 'Co-founder & CEO',           'initials' => 'TH'],
                 ['name' => 'Rashedul Amin',     'role' => 'Co-founder & CTO',           'initials' => 'RA'],
                 ['name' => 'Sumaiya Khan',      'role' => 'VP Product',                 'initials' => 'SK'],
                 ['name' => 'Arif Hassan',       'role' => 'VP Engineering',             'initials' => 'AH'],
                 ['name' => 'Farhana Akter',     'role' => 'VP Sales',                   'initials' => 'FA'],
                 ['name' => 'Mahmudul Hasan',    'role' => 'Carrier Operations',         'initials' => 'MH'],
                 ['name' => 'Nabila Jahan',      'role' => 'Head of Customer Success',   'initials' => 'NJ'],
                 ['name' => 'Saif Chowdhury',    'role' => 'Voice AI Lead',              'initials' => 'SC'],
             ])],

            ['key' => 'about.values', 'label' => 'Company values', 'page' => 'about', 'type' => 'json',
             'value' => json_encode([
                 ['title' => 'Reliability above all',          'desc' => "If we can't deliver, we say so. No fake percentages, no padded numbers."],
                 ['title' => 'Bangladesh first',               'desc' => 'Every product decision starts with: does this work for Tetulia? For Bandarban?'],
                 ['title' => 'Talk straight',                  'desc' => 'Plain English (and Bangla). No engineer-speak in customer-facing docs.'],
                 ['title' => 'Build for the next district',    'desc' => 'Coverage matters more than scale. We grow when one more upazila gets reliable voice.'],
             ])],
        ];
    }

    /* ============================================================ */
    /*  CONTACT                                                      */
    /* ============================================================ */
    private function contact(): array
    {
        return [
            ['key' => 'contact.hero.pill',     'label' => 'Hero pill',     'page' => 'contact', 'type' => 'text', 'value' => 'TYPICAL REPLY · UNDER 4 HOURS'],
            ['key' => 'contact.hero.headline', 'label' => 'Hero headline', 'page' => 'contact', 'type' => 'rich_text',
             'value' => 'Got a question?<br/><span class="accent">Let\'s talk.</span>'],
            ['key' => 'contact.hero.subhead',  'label' => 'Hero subtext',  'page' => 'contact', 'type' => 'rich_text',
             'value' => "Sales, technical support, partnerships, or just a quick question — we're always available. Pick a channel below or fill out the form. Most replies come within 4 hours."],

            ['key' => 'contact.channels', 'label' => 'Contact channels', 'page' => 'contact', 'type' => 'json',
             'value' => json_encode([
                 ['icon' => '💼', 'title' => 'Sales',             'desc' => 'New customers, demos, custom pricing.', 'email' => 'sales@protiddhoni.bd', 'sla' => '4 h'],
                 ['icon' => '🛠', 'title' => 'Technical support', 'desc' => 'API issues, incidents, debugging.',     'email' => 'support@protiddhoni.bd', 'sla' => '1 h critical'],
                 ['icon' => '🤝', 'title' => 'Partnerships',      'desc' => 'Carriers, integrators, resellers.',     'email' => 'partners@protiddhoni.bd', 'sla' => '24 h'],
                 ['icon' => '🎤', 'title' => 'Media & press',     'desc' => 'Interviews, quotes, brand assets.',     'email' => 'press@protiddhoni.bd', 'sla' => '24 h'],
             ])],

            ['key' => 'contact.offices', 'label' => 'Office locations', 'page' => 'contact', 'type' => 'json',
             'value' => json_encode([
                 ['city' => 'Dhaka HQ',  'address' => 'Banani Road 11, Block C, Dhaka 1213',  'phone' => '+880 1313-484823'],
                 ['city' => 'Chattogram','address' => 'Agrabad Commercial Area, Chattogram',  'phone' => '+880 1313-484824'],
                 ['city' => 'Sylhet',    'address' => 'Zindabazar, Sylhet 3100',              'phone' => '+880 1313-484825'],
             ])],
        ];
    }

    /* ============================================================ */
    /*  API DOCS                                                     */
    /* ============================================================ */
    private function apiDocs(): array
    {
        return [
            ['key' => 'api-docs.hero.pill',     'label' => 'Hero pill',     'page' => 'api-docs', 'type' => 'text', 'value' => 'Protiddhoni API · v1.0 · Stable'],
            ['key' => 'api-docs.hero.headline', 'label' => 'Hero headline', 'page' => 'api-docs', 'type' => 'rich_text',
             'value' => 'Voice broadcasting API <span class="text-gradient">for Bangladesh.</span>'],
            ['key' => 'api-docs.hero.subhead',  'label' => 'Hero subtext',  'page' => 'api-docs', 'type' => 'rich_text',
             'value' => "Send Voice OTPs, run multi-number broadcasts, launch surveys, and pull results — all over a clean REST API. Built for BD carriers, secured by Bearer tokens, ready for production. The docs don't lecture you — the code speaks for itself."],

            ['key' => 'api-docs.base_url',      'label' => 'API base URL',  'page' => 'api-docs', 'type' => 'text', 'value' => 'api.protiddhoni.com/api'],
            ['key' => 'api-docs.version',       'label' => 'API version',   'page' => 'api-docs', 'type' => 'text', 'value' => 'v1.0 · Stable'],
        ];
    }

    private function blog(): array
    {
        return [
            ['key' => 'blog.hero.pill',     'label' => 'Hero pill',     'page' => 'blog', 'type' => 'text', 'value' => 'Updated weekly · 4 carriers tracked live'],
            ['key' => 'blog.hero.headline', 'label' => 'Hero headline', 'page' => 'blog', 'type' => 'rich_text',
             'value' => 'Voice marketing playbooks <span class="text-gradient">for Bangladesh</span> — written by people who run them.'],
            ['key' => 'blog.hero.subhead',  'label' => 'Hero subtext',  'page' => 'blog', 'type' => 'rich_text',
             'value' => 'Carrier deliverability data, OTP conversion benchmarks, regulatory updates from BTRC, and Banglish UX patterns.'],
        ];
    }

    private function userGuide(): array
    {
        return [
            ['key' => 'user-guide.hero.pill',     'label' => 'Hero pill',     'page' => 'user-guide', 'type' => 'text', 'value' => '📘 Onboarding Guide'],
            ['key' => 'user-guide.hero.headline', 'label' => 'Hero headline', 'page' => 'user-guide', 'type' => 'rich_text',
             'value' => 'How to manage your website with <span class="text-gradient">Protiddhoni CMS</span>'],
            ['key' => 'user-guide.hero.subhead',  'label' => 'Hero subtext',  'page' => 'user-guide', 'type' => 'rich_text',
             'value' => 'Step-by-step guide to publishing blog posts, managing media, and tracking analytics. No coding required.'],
        ];
    }
}
