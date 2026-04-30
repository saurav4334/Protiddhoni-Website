@extends('layouts.frontend')

@section('title', 'About — VoiceReach by Protiddhoni')

@push('styles')
<style>
  :root{
    --navy:#003087; --blue:#0070BA; --sky:#009CDE; --gold:#FFC439; --cream:#FFF9E6;
    --ink:#0a1230; --paper:#fafbff; --line:#eef1f8; --muted:#6b7693; --slate:#3d4a72;
    --green:#22c55e; --amber:#f59e0b;
  }
  .page-hero{background:linear-gradient(180deg,#fff7e6 0%,#fff 35%,#f0f4ff 100%);position:relative;overflow:hidden;padding:96px 0 80px;text-align:center}
  .ph-eyebrow{display:inline-flex;align-items:center;gap:8px;background:rgba(0,112,186,.08);color:var(--navy);padding:8px 16px;border-radius:999px;font-size:11px;font-weight:800;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:18px;position:relative;z-index:1}
  .ph-h1{font-size:64px;font-weight:800;letter-spacing:-2.5px;line-height:1.02;color:var(--ink);position:relative;z-index:1;max-width:920px;margin:0 auto}
  .ph-h1 .accent{background:linear-gradient(90deg,var(--navy),var(--blue));-webkit-background-clip:text;background-clip:text;color:transparent}
  .ph-sub{font-size:18px;color:#4a5675;line-height:1.65;max-width:680px;margin:22px auto 0;position:relative;z-index:1}
  .stats-banner{padding:48px 0;background:linear-gradient(135deg,var(--navy),var(--blue));color:#fff;position:relative;overflow:hidden}
  .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:32px;position:relative;z-index:1}
  .stat-item{text-align:center;border-right:1px solid rgba(255,255,255,.1);padding:0 20px}
  .stat-item:last-child{border-right:none}
  .stat-num-big{font-family:'JetBrains Mono',monospace;font-size:48px;font-weight:800;letter-spacing:-2px;line-height:1;background:linear-gradient(180deg,#fff,#FFC439);-webkit-background-clip:text;background-clip:text;color:transparent}
  .stat-lbl{font-size:12px;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.6);margin-top:10px;font-weight:700}
  .story-grid{display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;max-width:1180px;margin:0 auto}
  .story-visual{position:relative;height:480px;background:linear-gradient(180deg,#fff7e6 0%,#fff 35%,#f0f4ff 100%);border-radius:28px;overflow:hidden;border:1px solid var(--line)}
  .sv-card{position:absolute;background:rgba(255,255,255,.95);backdrop-filter:blur(20px);border:1px solid var(--line);border-radius:14px;padding:14px 16px;box-shadow:0 16px 32px -10px rgba(0,48,135,.18);max-width:240px;animation:floatY 5s ease-in-out infinite}
  @keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
  .sv-card.c1{top:30px;left:24px;animation-delay:0s}
  .sv-card.c2{top:160px;right:24px;animation-delay:1.6s}
  .sv-card.c3{bottom:40px;left:40px;animation-delay:3.2s}
  .tl-item{position:relative;padding-bottom:48px;padding-left: 60px;}
  .tl-dot{position:absolute;left:0;top:0;width:48px;height:48px;border-radius:50%;background:#fff;border:3px solid var(--blue);display:flex;align-items:center;justify-content:center;font-family:'JetBrains Mono',monospace;font-size:13px;font-weight:800;color:var(--blue);box-shadow:0 8px 20px -8px rgba(0,112,186,.4)}
  .timeline-grid{max-width:920px;margin:0 auto;position:relative;}
  .timeline-grid::before{content:"";position:absolute;top:0;bottom:0;left:24px;width:2px;background:linear-gradient(180deg,var(--blue),var(--sky))}
  .reveal{opacity:0;transform:translateY(20px);transition:opacity .8s ease-out,transform .8s ease-out}
  .reveal.in{opacity:1;transform:translateY(0)}
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="page-hero">
  <div class="max-w-7xl mx-auto px-6">
    <span class="ph-eyebrow">{{ \App\Models\PageBlock::value('about.hero.pill', 'About Protiddhoni') }}</span>
    <h1 class="ph-h1">{!! \App\Models\PageBlock::value('about.hero.headline', 'Building voice infrastructure<br/>for <span class="accent">Bangladesh\'s next decade.</span>') !!}</h1>
    <p class="ph-sub">{!! \App\Models\PageBlock::value('about.hero.subhead', 'Started in Dhaka, 2018. Today: 280+ businesses, 2.4M calls a day, 64 of 64 districts.') !!}</p>
  </div>
</section>

<!-- STATS -->
<section class="stats-banner">
  <div class="max-w-7xl mx-auto px-6">
    <div class="stats-grid">
      <div class="stat-item"><div class="stat-num-big">8</div><div class="stat-lbl">Years building</div></div>
      <div class="stat-item"><div class="stat-num-big">280+</div><div class="stat-lbl">BD businesses</div></div>
      <div class="stat-item"><div class="stat-num-big">2.4M</div><div class="stat-lbl">Calls / day</div></div>
      <div class="stat-item"><div class="stat-num-big">38</div><div class="stat-lbl">Team members</div></div>
    </div>
  </div>
</section>

<!-- STORY -->
<section class="py-24">
  <div class="max-w-7xl mx-auto px-6">
    <div class="story-grid">
      <div class="story-text reveal">
        <span class="chip mb-4">Our story</span>
        <h2 class="text-4xl font-extrabold mb-6">It all started because of one failed OTP.</h2>
        <p class="text-ink-500 mb-4">In 2017, our founder <strong>Tareq Hossain</strong> was building a small fintech app. One day an important transaction OTP never reached the customer — the SMS gateway had blocked it. He lost the customer that day, and went home with one question: <em>"Why don't Bangladesh's businesses have access to carrier-grade voice infrastructure?"</em></p>
        <p class="text-ink-500 mb-4">Protiddhoni launched in 2018 — initial team of 4 engineers, one small office in Banani. The mission was singular: every business in our country should be able to <strong>reach any customer at any time, reliably</strong> — whether it's voice OTP, surveys, or broadcasts.</p>
        <p class="text-ink-500">Today we're a team of 38, with offices in Dhaka, Chattogram, and Sylhet, handling 2.4M+ calls a day. But the philosophy hasn't changed — <strong>when SMS fails, voice succeeds.</strong></p>
      </div>

      <div class="story-visual reveal">
        <div class="sv-card c1">
          <p class="text-[9px] font-bold text-paypal-navy uppercase tracking-widest mb-1">2018 · Day 1</p>
          <h5 class="font-bold">4 founders, 1 server</h5>
          <p class="text-[11px] text-ink-500">A one-room office in Banani, routing through AWS Mumbai.</p>
        </div>
        <div class="sv-card c2">
          <p class="text-[9px] font-bold text-paypal-navy uppercase tracking-widest mb-1">2026 · Today</p>
          <div class="text-2xl font-extrabold text-paypal-blue">2.4M</div>
          <p class="text-[11px] text-ink-500">Calls processed every 24 hours, all 4 BD carriers.</p>
        </div>
        <div class="sv-card c3">
          <p class="text-[9px] font-bold text-paypal-navy uppercase tracking-widest mb-1">Vision · 2030</p>
          <h5 class="font-bold">Voice for South Asia</h5>
          <p class="text-[11px] text-ink-500">Regional expansion from our BD foundation.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- VALUES -->
<section class="py-24 bg-ink-900 text-white relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 relative z-10">
    <div class="text-center mb-16">
      <span class="chip !bg-paypal-gold/20 !text-paypal-gold">Our values</span>
      <h2 class="mt-4 text-4xl font-extrabold">Four principles, <span class="text-paypal-gold">repeated daily.</span></h2>
    </div>

    <div class="grid md:grid-cols-4 gap-6">
      @foreach(\App\Models\PageBlock::value('about.values', []) as $index => $value)
      <div class="card !bg-white/5 !border-white/10 p-8 hover:!border-paypal-gold/50 transition-all">
        <div class="text-3xl font-mono font-extrabold text-paypal-gold mb-4">0{{ $index + 1 }}</div>
        <h4 class="text-lg font-bold mb-2">{{ $value['title'] }}</h4>
        <p class="text-sm text-ink-300 leading-relaxed">{{ $value['desc'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- TEAM -->
<section class="py-24 bg-surface-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <span class="chip">Leadership</span>
      <h2 class="mt-4 text-4xl font-extrabold text-ink-900">The folks behind <span class="text-gradient">every connected call</span></h2>
    </div>

    <div class="grid md:grid-cols-4 gap-6">
      @foreach(\App\Models\PageBlock::value('about.team', []) as $member)
      <div class="card p-6 text-center hover:!border-paypal-blue transition-all">
        <div class="w-20 h-20 rounded-full mx-auto mb-4 flex items-center justify-center font-mono text-2xl font-extrabold text-white bg-gradient-to-br from-paypal-navy to-paypal-blue">
          {{ $member['initials'] }}
        </div>
        <h4 class="font-extrabold text-ink-900">{{ $member['name'] }}</h4>
        <p class="text-[10px] font-bold text-paypal-blue uppercase tracking-widest mb-2">{{ $member['role'] }}</p>
        <p class="text-xs text-ink-500 leading-relaxed">{{ $member['desc'] ?? '10y telecom & fintech expert.' }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
(function(){
  var els = document.querySelectorAll('.reveal');
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if (e.isIntersecting) {
        e.target.classList.add('in');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0, rootMargin: "0px 0px -10% 0px" });
  els.forEach(function(el){ io.observe(el); });
})();
</script>
@endpush
