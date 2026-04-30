@extends('layouts.frontend')

@section('title', 'Pricing — VoiceReach by Protiddhoni')

@push('styles')
<style>
  :root{
    --navy:#003087; --blue:#0070BA; --sky:#009CDE; --gold:#FFC439; --cream:#FFF9E6;
    --ink:#0a1230; --paper:#fafbff; --line:#eef1f8; --muted:#6b7693; --slate:#3d4a72;
    --green:#22c55e; --amber:#f59e0b; --red:#ef4444;
  }
  .page-hero{background:linear-gradient(180deg,#fff7e6 0%,#fff 35%,#f0f4ff 100%);position:relative;overflow:hidden;padding:80px 0 48px;text-align:center}
  .ph-h1{font-size:60px;font-weight:800;letter-spacing:-2px;line-height:1.05;color:var(--ink);position:relative;z-index:1}
  .ph-h1 .accent{background:linear-gradient(90deg,var(--navy),var(--blue));-webkit-background-clip:text;background-clip:text;color:transparent}
  .ph-sub{font-size:17px;color:#4a5675;line-height:1.65;max-width:620px;margin:18px auto 0;position:relative;z-index:1}
  .billing-toggle{display:inline-flex;align-items:center;gap:6px;background:#fff;border:1px solid var(--line);border-radius:999px;padding:6px;margin-top:36px;position:relative;z-index:1;box-shadow:0 8px 20px -10px rgba(0,48,135,.15)}
  .bt-opt{padding:10px 22px;border-radius:999px;font-size:13px;font-weight:700;color:var(--slate);cursor:pointer;transition:all .2s;background:transparent;display:inline-flex;align-items:center;gap:8px;border:none;}
  .bt-opt.active{background:linear-gradient(135deg,var(--navy),var(--blue));color:#fff;box-shadow:0 6px 16px -6px rgba(0,48,135,.5)}
  .save-badge{background:var(--gold);color:var(--ink);font-size:10px;font-weight:800;padding:2px 7px;border-radius:6px;letter-spacing:.5px}
  .tiers-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;max-width:1180px;margin:0 auto}
  .tier{background:#fff;border:1.5px solid var(--line);border-radius:24px;padding:36px 30px;position:relative;transition:all .3s;display:flex;flex-direction:column}
  .tier.featured{background:linear-gradient(180deg,#0a1230,#1a2350);color:#fff;border-color:var(--gold);transform:scale(1.04);box-shadow:0 30px 60px -20px rgba(10,18,48,.4)}
  .tier.featured .tier-name{color:var(--gold)}
  .tier-currency{font-size:22px;font-weight:800;color:var(--ink);font-family:'JetBrains Mono',monospace}
  .tier.featured .tier-currency{color:#fff}
  .tier-amt{font-family:'JetBrains Mono',monospace;font-size:52px;font-weight:800;letter-spacing:-3px;line-height:1;color:var(--ink)}
  .tier.featured .tier-amt{color:#fff}
  .feat-incl li::before{content:"✓";color:var(--green);font-weight:800;flex-shrink:0;font-size:14px;margin-right:8px;}
  .calc-wrap{max-width:1080px;margin:0 auto;background:#fff;border:1px solid var(--line);border-radius:28px;padding:48px;display:grid;grid-template-columns:1fr 1fr;gap:48px;box-shadow:0 30px 60px -30px rgba(0,48,135,.18)}
  .calc-right{background:linear-gradient(180deg,#0a1230,#1a2350);border-radius:20px;padding:40px;color:#fff;display:flex;flex-direction:column;justify-content:center;position:relative;overflow:hidden}
  .calc-rprice{font-family:'JetBrains Mono',monospace;font-size:64px;font-weight:800;letter-spacing:-3px;line-height:1;background:linear-gradient(180deg,#fff,#FFC439);-webkit-background-clip:text;background-clip:text;color:transparent;margin-bottom:6px}
  .calc-field input[type=range]{width:100%;-webkit-appearance:none;appearance:none;height:6px;border-radius:3px;background:linear-gradient(90deg,var(--blue) var(--p,30%),#eef1f8 var(--p,30%));outline:none}
</style>
@endpush

@section('content')
<section class="page-hero">
  <div class="max-w-7xl mx-auto px-6">
    <span class="ph-eyebrow"><span class="w-2 h-2 rounded-full bg-green-500 inline-block animate-pulse"></span> {{ \App\Models\PageBlock::value('pricing.hero.pill', 'Transparent pricing · No hidden fees') }}</span>
    <h1 class="ph-h1">{!! \App\Models\PageBlock::value('pricing.hero.headline', 'Pay only for the calls<br/>that <span class="accent">actually connect.</span>') !!}</h1>
    <p class="ph-sub">{!! \App\Models\PageBlock::value('pricing.hero.subhead', 'Bangladesh-first pricing in Taka. Plans from solopreneurs to enterprises.') !!}</p>

    <div class="billing-toggle" id="billingToggle">
      <button class="bt-opt active" data-cycle="monthly">Monthly</button>
      <button class="bt-opt" data-cycle="yearly">Yearly <span class="save-badge">Save 20%</span></button>
    </div>
  </div>
</section>

<section class="py-24">
  <div class="max-w-7xl mx-auto px-6">
    <div class="tiers-grid">
      @foreach(\App\Models\PageBlock::value('pricing.tiers', []) as $tier)
      <div class="tier {{ ($tier['featured'] ?? false) ? 'featured' : '' }}">
        @if($tier['badge'] ?? false)
        <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-paypal-gold text-ink-900 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">{{ $tier['badge'] }}</span>
        @endif
        <div class="text-[11px] font-extrabold uppercase tracking-widest mb-2 {{ ($tier['featured'] ?? false) ? 'text-paypal-gold' : 'text-paypal-blue' }}">{{ $tier['name'] }}</div>
        <p class="text-xs mb-6 opacity-80">{{ $tier['desc'] }}</p>
        <div class="flex items-baseline gap-1 mb-1">
          @if(is_numeric($tier['price_monthly']) && $tier['price_monthly'] > 0)
            <span class="tier-currency">৳</span>
            <span class="tier-amt" data-monthly="{{ $tier['price_monthly'] }}" data-yearly="{{ $tier['price_yearly'] }}">{{ number_format($tier['price_monthly']) }}</span>
            <span class="text-sm opacity-60">/month</span>
          @else
            <span class="tier-amt">Custom</span>
          @endif
        </div>
        <p class="text-[11px] font-mono opacity-60 mb-8">+ ৳{{ $tier['rate_per_min'] }} per minute</p>
        <hr class="border-white/10 mb-8"/>
        <ul class="flex-1 space-y-3 mb-8">
          @foreach($tier['features'] as $feature)
          <li class="text-xs flex items-start gap-2">
            <span class="text-green-500 font-bold">✓</span>
            <span>{!! $feature !!}</span>
          </li>
          @endforeach
        </ul>
        <a href="#" class="btn {{ ($tier['featured'] ?? false) ? 'btn-gold' : 'btn-outline' }} justify-center w-full">{{ $tier['cta'] }}</a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="py-24 bg-surface-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <span class="chip">Cost Calculator</span>
      <h2 class="text-4xl font-extrabold text-ink-900 mt-4">Estimate your <span class="text-gradient">monthly bill</span></h2>
    </div>

    <div class="calc-wrap">
      <div class="p-8">
        <h3 class="text-2xl font-extrabold mb-8">Usage settings</h3>
        <div class="space-y-8">
          <div>
            <label class="block text-sm font-bold mb-4">Service Type</label>
            <div class="grid grid-cols-3 gap-2" id="svcGroup">
              <button class="calc-svc-opt active p-3 border-2 rounded-xl text-sm font-bold border-paypal-blue bg-paypal-blue/5" data-rate="0.45">Voice OTP</button>
              <button class="calc-svc-opt p-3 border-2 rounded-xl text-sm font-bold border-surface-200" data-rate="0.55">Survey</button>
              <button class="calc-svc-opt p-3 border-2 rounded-xl text-sm font-bold border-surface-200" data-rate="0.40">Broadcast</button>
            </div>
          </div>
          <div>
            <div class="flex justify-between text-sm font-bold mb-2"><span>Calls per month</span><span id="callsVal">5,000</span></div>
            <input type="range" min="500" max="100000" value="5000" id="callsRange" class="w-full">
          </div>
          <div>
            <div class="flex justify-between text-sm font-bold mb-2"><span>Avg duration</span><span id="durVal">30s</span></div>
            <input type="range" min="10" max="120" value="30" id="durRange" class="w-full">
          </div>
        </div>
      </div>
      <div class="calc-right">
        <div class="text-xs uppercase tracking-widest text-paypal-gold font-bold mb-2">Estimated Monthly</div>
        <div class="calc-rprice">৳<span id="totalCost">2,250</span></div>
        <p class="text-xs opacity-60 mb-8">~ <span id="totalMin">2,500</span> total minutes</p>
        <div class="space-y-3 pt-6 border-t border-white/10">
          <div class="flex justify-between text-sm"><span>Base Plan</span><span id="basePlanCost">৳999</span></div>
          <div class="flex justify-between text-sm"><span>Usage</span><span id="usageCost">৳1,251</span></div>
          <div class="flex justify-between text-sm font-bold text-paypal-gold pt-3 border-t border-white/10"><span>Total</span><span id="totalCost2">৳2,250</span></div>
        </div>
        <div class="mt-8 p-4 rounded-xl bg-white/5 border border-white/10 text-xs">
          <strong>Rec. Plan:</strong> <span id="recPlan" class="text-paypal-gold">Business</span>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
(function(){
  var toggle = document.getElementById('billingToggle');
  var btns = toggle.querySelectorAll('.bt-opt');
  btns.forEach(function(b){
    b.addEventListener('click', function(){
      btns.forEach(function(x){ x.classList.remove('active'); });
      b.classList.add('active');
      var cycle = b.getAttribute('data-cycle');
      document.querySelectorAll('.tier-amt[data-monthly]').forEach(function(el){
        var val = el.getAttribute('data-' + cycle);
        if(val) el.textContent = parseInt(val).toLocaleString('en-BD');
      });
    });
  });

  // Basic Calculator logic
  var callsRange = document.getElementById('callsRange');
  var durRange = document.getElementById('durRange');
  var svcBtns = document.querySelectorAll('.calc-svc-opt');
  var rate = 0.45;

  function update(){
    var calls = parseInt(callsRange.value);
    var dur = parseInt(durRange.value);
    var totalMin = (calls * dur) / 60;
    var usage = totalMin * rate;
    var base = totalMin > 1000 ? 4999 : 999;
    var total = Math.round(base + usage);

    document.getElementById('callsVal').textContent = calls.toLocaleString('en-BD');
    document.getElementById('durVal').textContent = dur + 's';
    document.getElementById('totalCost').textContent = total.toLocaleString('en-BD');
    document.getElementById('totalCost2').textContent = total.toLocaleString('en-BD');
    document.getElementById('totalMin').textContent = Math.round(totalMin).toLocaleString('en-BD');
    document.getElementById('basePlanCost').textContent = '৳' + base.toLocaleString('en-BD');
    document.getElementById('usageCost').textContent = '৳' + Math.round(usage).toLocaleString('en-BD');
    document.getElementById('recPlan').textContent = totalMin > 1000 ? 'Business' : 'Starter';
    
    callsRange.style.setProperty('--p', ((calls - 500) / (100000 - 500) * 100) + '%');
    durRange.style.setProperty('--p', ((dur - 10) / (120 - 10) * 100) + '%');
  }

  callsRange.addEventListener('input', update);
  durRange.addEventListener('input', update);
  svcBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      svcBtns.forEach(b => {
        b.classList.remove('active', 'border-paypal-blue', 'bg-paypal-blue/5');
        b.classList.add('border-surface-200');
      });
      btn.classList.add('active', 'border-paypal-blue', 'bg-paypal-blue/5');
      btn.classList.remove('border-surface-200');
      rate = parseFloat(btn.getAttribute('data-rate'));
      update();
    });
  });
  update();
})();
</script>
@endpush
