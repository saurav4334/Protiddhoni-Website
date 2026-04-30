@extends('layouts.frontend')

@section('title', 'Voice OTP — VoiceReach by Protiddhoni')

@push('styles')
<style>
  :root{
    --navy:#003087; --blue:#0070BA; --sky:#009CDE; --gold:#FFC439; --cream:#FFF9E6;
    --ink:#0a1230; --paper:#fafbff; --line:#eef1f8; --muted:#6b7693; --slate:#3d4a72;
    --green:#22c55e; --amber:#f59e0b; --red:#ef4444;
  }
  .hero{background:linear-gradient(180deg,#fff7e6 0%,#fff 25%,#f0f4ff 65%,#e8eef9 100%);position:relative;overflow:hidden;padding:64px 0 56px}
  .hero-grid{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center}
  .hero-h1{font-size:56px;font-weight:800;letter-spacing:-2px;line-height:1.05;color:var(--ink)}
  .hero-h1 .accent{background:linear-gradient(90deg,var(--navy),var(--blue));-webkit-background-clip:text;background-clip:text;color:transparent}
  .status-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(34,197,94,.1);color:#15803d;padding:8px 14px;border-radius:999px;font-size:11px;font-weight:700;letter-spacing:.5px;border:1px solid rgba(34,197,94,.25);margin-bottom:18px;text-transform:uppercase}
  .phone-mock{position:relative;height:560px;display:flex;align-items:center;justify-content:center}
  .phone{width:300px;height:530px;background:linear-gradient(180deg,#1a2350,#0a1230);border-radius:42px;padding:14px;box-shadow:0 40px 80px -30px rgba(10,18,48,.5);position:relative;z-index:1}
  .phone-screen{width:100%;height:100%;background:linear-gradient(180deg,#fafbff,#fff);border-radius:32px;overflow:hidden;position:relative;display:flex;flex-direction:column}
  .otp-box{width:42px;height:50px;border:2px solid var(--line);border-radius:10px;display:flex;align-items:center;justify-content:center;font-family:'JetBrains Mono',monospace;font-size:24px;font-weight:800;color:var(--ink);background:#fff}
  .otp-box.filled{border-color:var(--blue);background:rgba(0,112,186,.05)}
  .call-notif{position:absolute;top:60px;left:-30px;background:#fff;border-radius:14px;padding:12px 14px;box-shadow:0 20px 40px -10px rgba(0,48,135,.25);width:240px;display:flex;align-items:center;gap:10px;border:1px solid var(--line);z-index:10}
  .ci-pulse{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--green),#16a34a);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;flex-shrink:0;animation:ringPulse 1.4s infinite}
  @keyframes ringPulse{0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,.4)}50%{box-shadow:0 0 0 10px rgba(34,197,94,0)}}
  .vs-card{background:#fff;border:1px solid var(--line);border-radius:20px;overflow:hidden;box-shadow:0 30px 60px -30px rgba(0,48,135,.18)}
  .vs-cell{padding:18px 22px;border-bottom:1px solid var(--line);display:flex;align-items:center;gap:10px}
  .code-block{background:var(--ink);color:#e0f2fe;padding:28px;border-radius:18px;font-family:'JetBrains Mono',monospace;font-size:13px;line-height:1.7;overflow-x:auto;border:1px solid #1a2350;position:relative}
  .lang-tab.active{background:var(--ink);color:var(--gold);border-color:var(--ink)}
  .code-pane{display:none}
  .code-pane.active{display:block}
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="hero pt-32">
  <div class="max-w-7xl mx-auto px-6">
    <div class="hero-grid">
      <div class="reveal">
        <span class="status-pill"><span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse mr-2"></span> {{ \App\Models\PageBlock::value('voice-otp.hero.pill', 'Voice OTP · 99.4% delivery in 2s') }}</span>
        <h1 class="hero-h1">
          {!! \App\Models\PageBlock::value('voice-otp.hero.headline', 'SMS OTP busy?<br/>Network jam?<br/><span class="accent">Voice OTP works.</span>') !!}
        </h1>
        <p class="hero-sub mt-6 text-lg text-ink-500 leading-relaxed">
          {!! \App\Models\PageBlock::value('voice-otp.hero.subhead', 'When SMS gets throttled or filtered, Voice OTP still gets through. 3× more reliable than SMS.') !!}
        </p>

        <div class="mt-8 flex flex-wrap gap-3">
          <a class="btn-primary" href="{{ url('/admin/register') }}">Get free API key →</a>
          <a class="btn-outline" href="#demo">▶ Hear sample</a>
        </div>
      </div>

      <div class="phone-mock reveal">
        <div class="call-notif">
          <div class="ci-pulse">📞</div>
          <div class="flex-1">
            <div class="text-xs font-bold">VoiceReach OTP</div>
            <div class="text-[10px] text-ink-300 font-mono">+880 9610-114455</div>
          </div>
        </div>

        <div class="phone">
          <div class="phone-screen">
            <div class="flex justify-between p-4 pt-8 text-[10px] font-bold"><span>9:41</span><span>● ● ●</span></div>
            <div class="flex-1 flex flex-col justify-center px-6 text-center">
              <div class="text-[10px] uppercase tracking-widest text-ink-300 font-bold mb-4">VoiceReach OTP</div>
              <p class="text-xs text-ink-500 mb-6">Listen to your 6-digit verification code and <strong>type it</strong> below</p>
              <div class="flex gap-2 justify-center mb-8">
                @foreach([8,2,5,9,3,7] as $n)
                <div class="otp-box filled">{{ $n }}</div>
                @endforeach
              </div>
              <div class="bg-paypal-blue text-white py-3 rounded-xl text-xs font-bold shadow-lg shadow-paypal-blue/30">✓ Verified successfully</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- COMPARISON -->
<section class="py-24">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="reveal">
        <span class="chip mb-4">Voice vs SMS OTP</span>
        <h2 class="text-4xl font-extrabold text-ink-900 leading-tight mb-6">Once you understand SMS's problem, <br/>voice's power becomes obvious.</h2>
        <p class="text-ink-500 mb-6">In Bangladesh, the average SMS OTP delivery rate is ~78%. Voice OTP rings the phone directly and reads the OTP in Bangla.</p>
        <ul class="space-y-4">
          @foreach(['3x higher delivery', 'Bangla pronunciation', 'No spam folder', 'Accessible for all'] as $idx => $feat)
          <li class="flex items-center gap-3 text-sm font-bold text-ink-700">
            <span class="w-8 h-8 rounded-lg bg-paypal-sky/10 text-paypal-sky flex items-center justify-center font-mono">0{{ $idx+1 }}</span>
            {{ $feat }}
          </li>
          @endforeach
        </ul>
      </div>

      <div class="vs-card reveal">
        <div class="grid grid-cols-2 text-[10px] font-bold uppercase tracking-widest bg-surface-50 border-b border-surface-200">
          <div class="p-4 border-r border-surface-200">Compare</div>
          <div class="p-4 text-paypal-navy">VoiceReach OTP</div>
        </div>
        @php
          $rows = [
            ['SMS OTP', 'Voice OTP', 'win'],
            ['~78% delivery', '99.4% delivery', 'win'],
            ['3-15s latency', '1.6s avg', 'win'],
            ['Carrier filtered', 'No filtering', 'win'],
            ['৳0.40 / SMS', '৳0.45 / OTP', '']
          ];
        @endphp
        @foreach($rows as $row)
        <div class="grid grid-cols-2 text-sm border-b border-surface-100 last:border-0">
          <div class="p-4 border-r border-surface-200 text-ink-300">{{ $row[0] }}</div>
          <div class="p-4 font-bold {{ $row[2] === 'win' ? 'text-ink-900' : 'text-ink-500' }}">
            {{ $row[1] }}
            @if($row[2] === 'win') <span class="ml-2 text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded">Better</span> @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- CODE -->
<section class="py-24 bg-surface-50" id="integration">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-12">
      <div class="reveal">
        <span class="chip mb-4">Developer-first</span>
        <h2 class="text-3xl font-extrabold text-ink-900 mb-6">5-minute integration. Your favorite stack.</h2>
        <p class="text-ink-500 mb-8">One REST endpoint, official SDKs in Node, Python, PHP, Java, Go, .NET.</p>
        <div class="grid grid-cols-2 gap-4">
          <div class="p-4 bg-white rounded-xl border border-surface-200 shadow-sm">
            <h5 class="text-xs font-bold mb-1">🔁 Idempotent</h5>
            <p class="text-[10px] text-ink-300">Safe to retry requests.</p>
          </div>
          <div class="p-4 bg-white rounded-xl border border-surface-200 shadow-sm">
            <h5 class="text-xs font-bold mb-1">🪝 Webhooks</h5>
            <p class="text-[10px] text-ink-300">Real-time status.</p>
          </div>
        </div>
      </div>

      <div class="reveal">
        <div class="flex gap-2 mb-4" id="langTabs">
          <button class="lang-tab active px-4 py-2 rounded-lg text-xs font-bold border border-surface-200 bg-white" data-lang="node">Node.js</button>
          <button class="lang-tab px-4 py-2 rounded-lg text-xs font-bold border border-surface-200 bg-white" data-lang="py">Python</button>
        </div>
        <div class="code-pane active" id="pane-node">
          <div class="code-block">
            <pre><span class="k">const</span> voice = <span class="k">require</span>(<span class="s">'@protiddhoni/voicereach'</span>);
<span class="k">const</span> client = <span class="k">new</span> voice.<span class="n">Client</span>(<span class="s">'sk_live_xxx'</span>);

<span class="k">const</span> otp = <span class="k">await</span> client.<span class="n">otp</span>.<span class="n">send</span>({
  to: <span class="s">'+8801712345678'</span>,
  language: <span class="s">'bn'</span>
});</pre>
          </div>
        </div>
        <div class="code-pane" id="pane-py">
          <div class="code-block">
            <pre><span class="k">from</span> voicereach <span class="k">import</span> Client
client = Client(<span class="s">'sk_live_xxx'</span>)

otp = client.otp.send(
    to=<span class="s">'+8801712345678'</span>,
    language=<span class="s">'bn'</span>
)</pre>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
(function(){
  var tabs = document.querySelectorAll('.lang-tab');
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active', 'bg-ink-900', 'text-white'));
      tab.classList.add('active', 'bg-ink-900', 'text-white');
      document.querySelectorAll('.code-pane').forEach(p => p.classList.remove('active'));
      document.getElementById('pane-' + tab.dataset.lang).classList.add('active');
    });
  });
})();
</script>
@endpush
