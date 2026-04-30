@extends('layouts.frontend')

@section('title', 'Contact — VoiceReach by Protiddhoni')

@push('styles')
<style>
  :root{
    --navy:#003087; --blue:#0070BA; --sky:#009CDE; --gold:#FFC439; --cream:#FFF9E6;
    --ink:#0a1230; --muted:#6b7693; --line:#eef1f8;
  }
  .page-hero{background:linear-gradient(180deg,#fff7e6 0%,#fff 100%);padding:80px 0 56px;text-align:center}
  .ch-card{background:#fff;border:1px solid var(--line);border-radius:18px;padding:24px;transition:all .3s}
  .ch-card:hover{transform:translateY(-3px);border-color:var(--blue);shadow:0 20px 40px -16px rgba(0,48,135,.15)}
  .form-wrap{background:#fff;border:1px solid var(--line);border-radius:24px;padding:40px;box-shadow:0 30px 60px -30px rgba(0,48,135,.18)}
  .field input, .field select, .field textarea{padding:12px 14px;border:1.5px solid var(--line);border-radius:10px;background:#fafbff;outline:none;width:100%}
  .field input:focus, .field select:focus, .field textarea:focus{border-color:var(--blue);background:#fff}
  .interest-opt{padding:10px 8px;border:1.5px solid var(--line);border-radius:10px;text-align:center;font-size:12px;font-weight:700;cursor:pointer;transition:all .2s;background:#fff}
  .interest-opt.active{border-color:var(--blue);background:rgba(0,112,186,.05);color:var(--navy)}
  .office-card{background:#fff;border:1px solid var(--line);border-radius:20px;overflow:hidden}
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="page-hero pt-32">
  <div class="max-w-7xl mx-auto px-6">
    <span class="chip mb-4">Avg response · 4 hours · 09:00–22:00 BDT</span>
    <h1 class="text-6xl font-extrabold text-navy-900 tracking-tight">Got a question?<br/><span class="text-gradient">Ekta call dur.</span></h1>
    <p class="mt-6 text-lg text-ink-500 max-w-2xl mx-auto">Sales, technical support, or partnerships — we\'re always available. Fill out the form or pick a channel below.</p>
  </div>
</section>

<!-- CHANNELS -->
<section class="py-12">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid md:grid-cols-4 gap-4">
      <div class="ch-card">
        <div class="text-2xl mb-2">💼</div>
        <h4 class="font-extrabold text-navy-900">Sales & demos</h4>
        <p class="text-xs text-ink-500 mb-4">Custom pricing, enterprise demos.</p>
        <a href="mailto:sales@voicereach.bd" class="text-paypal-blue font-bold text-xs">sales@voicereach.bd</a>
      </div>
      <div class="ch-card">
        <div class="text-2xl mb-2">🛠</div>
        <h4 class="font-extrabold text-navy-900">Technical support</h4>
        <p class="text-xs text-ink-500 mb-4">API issues, integration help.</p>
        <a href="mailto:support@voicereach.bd" class="text-paypal-blue font-bold text-xs">support@voicereach.bd</a>
      </div>
      <div class="ch-card">
        <div class="text-2xl mb-2">🤝</div>
        <h4 class="font-extrabold text-navy-900">Partnerships</h4>
        <p class="text-xs text-ink-500 mb-4">Reseller, agency partnerships.</p>
        <a href="mailto:partners@voicereach.bd" class="text-paypal-blue font-bold text-xs">partners@voicereach.bd</a>
      </div>
      <div class="ch-card">
        <div class="text-2xl mb-2">📰</div>
        <h4 class="font-extrabold text-navy-900">Media & press</h4>
        <p class="text-xs text-ink-500 mb-4">Press kit, brand assets.</p>
        <a href="mailto:press@voicereach.bd" class="text-paypal-blue font-bold text-xs">press@voicereach.bd</a>
      </div>
    </div>
  </div>
</section>

<!-- FORM -->
<section class="py-24 bg-surface-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-12 items-start">
      <div class="form-wrap reveal">
        <h3 class="text-2xl font-extrabold text-navy-900 mb-2">Send us a message</h3>
        <p class="text-ink-500 text-sm mb-8">We\'ll route it to the right human within 4 business hours.</p>

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
          @csrf
          <div class="grid grid-cols-2 gap-4">
            <div class="field"><label class="text-[10px] font-bold text-ink-300 uppercase">Full Name *</label><input type="text" name="name" required></div>
            <div class="field"><label class="text-[10px] font-bold text-ink-300 uppercase">Work Email *</label><input type="email" name="email" required></div>
          </div>
          <div class="field"><label class="text-[10px] font-bold text-ink-300 uppercase">Message *</label><textarea name="message" rows="4" required></textarea></div>
          <button type="submit" class="w-full btn-primary !py-4">Send message →</button>
        </form>
      </div>

      <div class="space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-surface-200 reveal">
          <h4 class="font-extrabold text-navy-900 mb-4">Quick contact</h4>
          <ul class="space-y-4">
            <li class="flex gap-4">
              <span class="text-xl">📞</span>
              <div><p class="font-bold text-navy-900 text-sm">Sales hotline</p><p class="text-xs text-ink-500">+880 9610-114455</p></div>
            </li>
            <li class="flex gap-4">
              <span class="text-xl">📧</span>
              <div><p class="font-bold text-navy-900 text-sm">Email response</p><p class="text-xs text-ink-500">4 business hours · Mon–Sat</p></div>
            </li>
          </ul>
        </div>

        <div class="bg-navy-900 p-6 rounded-2xl text-white reveal">
          <h4 class="text-paypal-gold text-[10px] font-bold uppercase tracking-widest mb-4">Response SLAs</h4>
          <div class="space-y-3 text-sm">
            <div class="flex justify-between border-b border-white/10 pb-2"><span>Critical bug</span><span class="font-bold">15 min</span></div>
            <div class="flex justify-between border-b border-white/10 pb-2"><span>Enterprise support</span><span class="font-bold">1 hour</span></div>
            <div class="flex justify-between"><span>Sales inquiries</span><span class="font-bold">4 hours</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- OFFICES -->
<section class="py-24">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <span class="text-paypal-blue text-[10px] font-bold uppercase tracking-widest">Our offices</span>
      <h2 class="text-4xl font-extrabold text-navy-900 mt-2">Drop by anytime — <span class="text-gradient">3 cities, 1 platform.</span></h2>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="office-card reveal">
        <div class="h-40 bg-navy-900"></div>
        <div class="p-6">
          <h4 class="font-extrabold text-navy-900">Dhaka — Banani</h4>
          <p class="text-xs text-ink-500 mt-2">House 14, Road 11, Banani, Dhaka 1213</p>
        </div>
      </div>
      <div class="office-card reveal">
        <div class="h-40 bg-paypal-blue"></div>
        <div class="p-6">
          <h4 class="font-extrabold text-navy-900">Chattogram — Agrabad</h4>
          <p class="text-xs text-ink-500 mt-2">Agrabad C/A, Chattogram 4100</p>
        </div>
      </div>
      <div class="office-card reveal">
        <div class="h-40 bg-paypal-gold"></div>
        <div class="p-6">
          <h4 class="font-extrabold text-navy-900">Sylhet — Zindabazar</h4>
          <p class="text-xs text-ink-500 mt-2">Zindabazar, Sylhet 3100</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
