@extends('layouts.frontend')

@section('title', 'Blog & Insights — VoiceReach by Protiddhoni')

@push('styles')
<style>
  :root{
    --navy:#003087;--blue:#0070BA;--sky:#009CDE;--gold:#FFC439;--cream:#FFF9E6;
    --ink:#0a1230;--ink2:#3a4566;--mute:#6b7593;--line:#e5e9f2;--bg:#f7f9fc;--white:#fff;
  }
  .hero{padding:64px 0 32px;background:linear-gradient(180deg,#fff 0%,var(--bg) 100%)}
  .search-wrap{margin:32px 0 12px;display:flex;gap:12px;flex-wrap:wrap;align-items:center;background:#fff;padding:8px;border-radius:999px;box-shadow:0 8px 24px rgba(0,48,135,.10);border:1px solid var(--line);max-width:820px}
  .search-wrap input{flex:1;min-width:200px;border:0;outline:0;padding:14px 18px;font-size:15px;background:transparent}
  .featured-card{display:grid;grid-template-columns:1.15fr 1fr;background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 24px 64px rgba(0,48,135,.18);border:1px solid var(--line)}
  .featured-img{background:linear-gradient(135deg,var(--navy) 0%,var(--blue) 60%);min-height:440px;padding:36px;display:flex;flex-direction:column;justify-content:space-between;color:#fff}
  .post-card{background:#fff;border-radius:18px;overflow:hidden;border:1px solid var(--line);display:flex;flex-direction:column}
  .post-thumb{height:200px;background:var(--navy)}
  .with-side{display:grid;grid-template-columns:1fr 320px;gap:36px}
  .newsletter{background:linear-gradient(135deg,var(--navy),var(--blue));color:#fff;border-radius:18px;padding:28px}
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="hero pt-32">
  <div class="max-w-7xl mx-auto px-6">
    <span class="chip mb-4">{{ \App\Models\PageBlock::value('blog.hero.pill', 'Updated weekly · 4 carriers tracked live') }}</span>
    <h1 class="text-5xl font-extrabold text-navy-900 leading-tight">
      {!! \App\Models\PageBlock::value('blog.hero.headline', 'Voice marketing playbooks <span class="text-gradient">for Bangladesh</span> — written by people who run them.') !!}
    </h1>
    <p class="mt-6 text-lg text-ink-500 max-w-3xl leading-relaxed">
      {!! \App\Models\PageBlock::value('blog.hero.subhead', 'Carrier deliverability data, OTP conversion benchmarks, regulatory updates from BTRC, and Banglish UX patterns.') !!}
    </p>

    <div class="search-wrap mt-10">
      <input type="text" placeholder="Search 142 articles..." />
      <button class="btn-primary !rounded-full">Search</button>
    </div>
  </div>
</section>

<!-- FEATURED -->
<section class="py-12">
  <div class="max-w-7xl mx-auto px-6">
    <div class="featured-card reveal">
      <div class="featured-img">
        <span class="bg-paypal-gold text-ink-900 px-3 py-1 rounded-full text-[10px] font-bold self-start uppercase tracking-widest">⭐ Featured</span>
        <h3 class="text-3xl font-extrabold mt-auto">How Brac Bank cut OTP failure from 11% to 0.4% in six weeks.</h3>
        <div class="flex items-center gap-3 mt-6">
          <div class="w-10 h-10 rounded-full bg-paypal-gold text-navy-900 flex items-center justify-center font-bold">RA</div>
          <div class="text-sm">Rashedul Amin · CTO</div>
        </div>
      </div>
      <div class="p-10 flex flex-col justify-center">
        <p class="text-ink-500 mb-8 leading-relaxed">Brac Bank\'s mobile app logins were failing 1 in every 9 OTP attempts. SMS routes were clogged, customers were rage-quitting. Here is how we fixed it.</p>
        <div class="grid grid-cols-3 gap-4 border-t border-surface-200 pt-6 mb-8">
          <div><div class="text-xl font-bold text-navy-900">99.6%</div><div class="text-[10px] text-ink-300 uppercase">Delivery</div></div>
          <div><div class="text-xl font-bold text-navy-900">8.4s</div><div class="text-[10px] text-ink-300 uppercase">Avg time</div></div>
        </div>
        <a class="btn-primary self-start" href="#">Read the playbook →</a>
      </div>
    </div>
  </div>
</section>

<!-- LATEST -->
<section class="py-24">
  <div class="max-w-7xl mx-auto px-6">
    <div class="with-side">
      <div class="grid md:grid-cols-2 gap-8">
        @php
          $posts = [
            ['Voice OTP', 'Why your OTP retry window should be 47 seconds', 'Saif Chowdhury'],
            ['Surveys', 'Bangla NPS surveys outperform English by 38%', 'Nabila Jahan'],
            ['Compliance', 'BTRC\'s new voice broadcast guidelines (Mar 2026)', 'Farhana Akter'],
            ['Engineering', 'Webhooks that survive: idempotency and retries', 'Arif Hassan']
          ];
        @endphp
        @foreach($posts as $post)
        <article class="post-card reveal">
          <div class="post-thumb"></div>
          <div class="p-6">
            <span class="text-[10px] font-bold text-paypal-blue uppercase tracking-widest">{{ $post[0] }}</span>
            <h3 class="text-lg font-extrabold text-navy-900 mt-2 mb-4 leading-snug">{{ $post[1] }}</h3>
            <div class="flex items-center gap-2 mt-auto border-t border-surface-100 pt-4">
              <div class="w-8 h-8 rounded-full bg-paypal-blue text-white flex items-center justify-center text-xs font-bold">{{ substr($post[2], 0, 1) }}</div>
              <div class="text-xs font-bold text-ink-700">{{ $post[2] }}</div>
            </div>
          </div>
        </article>
        @endforeach
      </div>

      <aside class="space-y-8">
        <div class="newsletter">
          <h4 class="text-xl font-extrabold mb-4">Daak diye rekho</h4>
          <p class="text-sm opacity-90 mb-6">One email every Tuesday. BD voice market data and regulation updates.</p>
          <form class="space-y-3">
            <input type="email" placeholder="your@email.com" class="w-full p-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder:text-white/60 outline-none">
            <button class="w-full btn-gold !py-3">Subscribe</button>
          </form>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-surface-200">
          <h4 class="text-sm font-bold mb-4 uppercase tracking-widest text-ink-300">🔥 Most read</h4>
          <div class="space-y-4">
            @foreach(['Study: 47s OTP window', 'Brac Bank case study', 'BTRC 2026 guidelines'] as $idx => $pop)
            <div class="flex gap-4">
              <span class="text-xl font-bold text-paypal-gold opacity-50">0{{ $idx+1 }}</span>
              <div class="text-sm font-bold text-navy-900 leading-snug">{{ $pop }}</div>
            </div>
            @endforeach
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>
@endsection
