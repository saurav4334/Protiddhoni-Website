@extends('layouts.frontend')

@section('title', 'Voice Survey & IVR — VoiceReach by Protiddhoni')

@push('styles')
<style>
  :root{
    --navy:#003087; --blue:#0070BA; --sky:#009CDE; --gold:#FFC439; --cream:#FFF9E6;
    --ink:#0a1230; --paper:#fafbff; --line:#eef1f8; --muted:#6b7693; --slate:#3d4a72;
    --green:#22c55e; --amber:#f59e0b; --red:#ef4444; --purple:#7c3aed;
  }
  .hero{background:linear-gradient(180deg,#fff7e6 0%,#fff 25%,#f0f4ff 65%,#e8eef9 100%);position:relative;overflow:hidden;padding:64px 0 56px}
  .hero-grid{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center}
  .ivr-flow{background:#fff;border:1px solid var(--line);border-radius:24px;padding:28px;box-shadow:0 30px 60px -25px rgba(0,48,135,.18);position:relative;overflow:hidden}
  .ivr-bubble{flex:1;border-radius:14px;padding:11px 14px;line-height:1.55}
  .ivr-bubble.bot{background:#f0f4ff;color:var(--ink);border-top-left-radius:4px}
  .ivr-bubble.user{background:linear-gradient(135deg,var(--navy),var(--blue));color:#fff;border-top-right-radius:4px;margin-left:auto}
  .dash-kpi{padding:16px;border-radius:12px;background:#fafbff;border:1px solid var(--line)}
  .nps-bar{display:flex;height:14px;border-radius:7px;overflow:hidden;margin:14px 0 8px}
  .resp-bar{flex:1.5;height:6px;background:var(--line);border-radius:3px;overflow:hidden}
  .builder-canvas{background:#0a1230;border-radius:14px;padding:24px;min-height:380px;position:relative;overflow:hidden;color:#fff}
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="hero pt-32">
  <div class="max-w-7xl mx-auto px-6">
    <div class="hero-grid">
      <div class="reveal">
        <span class="status-pill"><span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse mr-2"></span> {{ \App\Models\PageBlock::value('voice-survey.hero.pill', 'Voice Survey · 4x response rate vs SMS') }}</span>
        <h1 class="hero-h1">
          {!! \App\Models\PageBlock::value('voice-survey.hero.headline', 'What customers actually say,<br/><span class="accent">over the phone.</span>') !!}
        </h1>
        <p class="hero-sub mt-6 text-lg text-ink-500 leading-relaxed">
          {!! \App\Models\PageBlock::value('voice-survey.hero.subhead', 'A voice survey rings the phone directly — the question is asked in Bangla, the customer presses 1–5 to reply.') !!}
        </p>

        <div class="mt-8 flex flex-wrap gap-3">
          <a class="btn-primary" href="{{ url('/admin/register') }}">Build a survey →</a>
          <a class="btn-outline" href="#demo">▶ See live dashboard</a>
        </div>
      </div>

      <div class="reveal">
        <div class="ivr-flow">
          <div class="flex items-center gap-4 pb-4 border-b border-surface-200 mb-6">
            <div class="w-10 h-10 rounded-xl bg-paypal-blue text-white flex items-center justify-center">🎙</div>
            <div>
              <div class="text-xs font-bold">Live Survey · NPS Q4 2026</div>
              <div class="text-[10px] text-ink-300 font-mono">+880 9610-114455</div>
            </div>
          </div>

          <div class="space-y-4">
            <div class="flex gap-3 items-start">
              <div class="w-8 h-8 rounded-lg bg-blue-100 text-paypal-navy flex items-center justify-center text-xs">📞</div>
              <div class="ivr-bubble bot text-xs">Assalamu Alaikum. Calling from <strong>BRAC</strong>. We'd like 30 seconds of your feedback.</div>
            </div>
            <div class="flex gap-3 items-start flex-row-reverse">
              <div class="w-8 h-8 rounded-lg bg-paypal-gold text-ink-900 flex items-center justify-center text-xs">🟡</div>
              <div class="ivr-bubble user text-xs">▸ Press 1 to continue</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DASHBOARD -->
<section class="py-24 bg-surface-50" id="demo">
  <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
    <div class="reveal">
      <span class="chip mb-4">Real-time dashboard</span>
      <h3 class="text-3xl font-extrabold text-ink-900 mb-6">Watch responses pour in across Bangladesh, live.</h3>
      <ul class="space-y-4">
        <li class="flex items-start gap-3 text-sm text-ink-500">
          <span class="text-green-500 font-bold">✓</span>
          <strong>Live NPS / CSAT scores</strong> with promoter breakdown
        </li>
        <li class="flex items-start gap-3 text-sm text-ink-500">
          <span class="text-green-500 font-bold">✓</span>
          <strong>Geo-segmented results</strong> — district-wise filtering
        </li>
      </ul>
    </div>

    <div class="bg-white rounded-3xl border border-surface-200 shadow-xl overflow-hidden reveal">
      <div class="p-6 border-b border-surface-200 flex justify-between items-center bg-surface-50">
        <h5 class="text-sm font-bold">📊 NPS Q4 2026 — Live results</h5>
        <span class="chip chip-sky !text-[10px]"><span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Live</span>
      </div>
      <div class="p-6">
        <div class="grid grid-cols-3 gap-4 mb-8">
          <div class="dash-kpi">
            <div class="text-[9px] font-bold text-ink-300 uppercase">NPS Score</div>
            <div class="text-2xl font-extrabold text-ink-900">+48</div>
          </div>
          <div class="dash-kpi">
            <div class="text-[9px] font-bold text-ink-300 uppercase">Responses</div>
            <div class="text-2xl font-extrabold text-ink-900">12.8k</div>
          </div>
          <div class="dash-kpi">
            <div class="text-[9px] font-bold text-ink-300 uppercase">Completion</div>
            <div class="text-2xl font-extrabold text-ink-900">71%</div>
          </div>
        </div>
        <div class="text-[10px] font-bold text-ink-300 uppercase mb-2">NPS distribution</div>
        <div class="nps-bar">
          <div class="bg-green-500 w-[62%] h-full"></div>
          <div class="bg-paypal-gold w-[24%] h-full"></div>
          <div class="bg-red-500 w-[14%] h-full"></div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
