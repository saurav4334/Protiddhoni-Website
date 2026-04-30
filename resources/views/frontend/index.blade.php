@extends('layouts.frontend')

@section('title', 'VoiceReach — Voice Broadcasting Platform for Bangladesh')

@section('content')
  <!-- HERO -->
  <section class="hero-gradient pt-32 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 dot-grid opacity-30"></div>
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center relative">
      <div>
        <span class="chip"><span class="w-2 h-2 rounded-full bg-paypal-sky animate-pulse"></span>
          {{ \App\Models\PageBlock::value('homepage.hero.pill', 'All Bangladesh · Live now') }}</span>
        <h1 class="mt-5 text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-ink-900 leading-[1.05]">
          {!! \App\Models\PageBlock::value('homepage.hero.headline', 'Reach every customer in <span class="text-gradient">Bangladesh</span> with voice.') !!}
        </h1>
        <p class="mt-6 text-lg text-ink-500 max-w-xl leading-relaxed">
          {!! \App\Models\PageBlock::value('homepage.hero.subhead', 'The most intuitive voice broadcasting platform — best-in-class delivery across Grameenphone, Robi, Banglalink & Airtel with real-time analytics.') !!}
        </p>
        <div class="mt-8 flex flex-wrap gap-3">
          <a href="#"
            class="btn-primary">{{ \App\Models\PageBlock::value('homepage.hero.cta_primary', 'Start Broadcasting Free →') }}</a>
          <a href="#"
            class="btn-outline">{{ \App\Models\PageBlock::value('homepage.hero.cta_secondary', '▶ Watch 2-min demo') }}</a>
        </div>
        <div class="mt-10 flex items-center gap-8">
          <div>
            <p class="text-2xl font-extrabold text-paypal-navy">99.9%</p>
            <p class="text-xs text-ink-500 font-semibold">Uptime SLA</p>
          </div>
          <div class="w-px h-10 bg-surface-200"></div>
          <div>
            <p class="text-2xl font-extrabold text-paypal-navy">All</p>
            <p class="text-xs text-ink-500 font-semibold">Major Carriers</p>
          </div>
          <div class="w-px h-10 bg-surface-200"></div>
          <div>
            <p class="text-2xl font-extrabold text-paypal-navy">10M+</p>
            <p class="text-xs text-ink-500 font-semibold">Minutes Sent</p>
          </div>
        </div>
      </div>

      <!-- Dashboard mock -->
      <div class="relative">
        <div class="absolute -top-6 -left-6 w-72 h-72 bg-paypal-gold/30 rounded-full blur-3xl float-1"></div>
        <div class="absolute -bottom-6 -right-6 w-72 h-72 bg-paypal-sky/30 rounded-full blur-3xl float-2"></div>
        <div class="relative card p-6 shadow-2xl">
          <div class="flex items-center justify-between pb-4 border-b border-surface-200">
            <div class="flex items-center gap-2">
              <span class="w-3 h-3 rounded-full bg-red-400"></span>
              <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
              <span class="w-3 h-3 rounded-full bg-green-400"></span>
              <span class="ml-3 text-xs text-ink-500 font-mono">dashboard.protiddhoni-bd.com</span>
            </div>
            <span class="chip-sky chip">Live</span>
          </div>
          <div class="mt-5">
            <p class="text-sm text-ink-500">Welcome back, Fahim 👋</p>
            <p class="text-2xl font-extrabold text-paypal-navy">Ready to broadcast?</p>
          </div>
          <div class="mt-5 grid grid-cols-3 gap-3">
            <div class="p-3 rounded-xl bg-surface-50">
              <p class="text-[10px] font-bold text-ink-500 uppercase">Balance</p>
              <p class="text-lg font-extrabold text-paypal-navy">
                ৳{{ \App\Models\PageBlock::value('homepage.stats.calls_per_min', '12,450') }}</p>
            </div>
            <div class="p-3 rounded-xl bg-gradient-to-br from-paypal-blue to-paypal-sky text-white">
              <p class="text-[10px] font-bold uppercase opacity-80">Broadcasts</p>
              <p class="text-lg font-extrabold">1,247</p>
            </div>
            <div class="p-3 rounded-xl bg-paypal-cream">
              <p class="text-[10px] font-bold text-[#8b6b00] uppercase">Reach</p>
              <p class="text-lg font-extrabold text-paypal-navy">52K</p>
            </div>
          </div>
          <div class="mt-4 space-y-2">
            <div class="flex items-center justify-between p-3 rounded-xl border border-surface-200">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-green-100 flex items-center justify-center">✓</div>
                <div>
                  <p class="text-sm font-semibold text-ink-700">Eid Product Launch</p>
                  <p class="text-[11px] text-ink-500">2,450 reached · 98% delivered</p>
                </div>
              </div>
              <span class="text-[10px] font-bold text-green-600 bg-green-50 px-2 py-1 rounded">Completed</span>
            </div>
            <div class="flex items-center justify-between p-3 rounded-xl border border-surface-200">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-paypal-cream flex items-center justify-center">⏱</div>
                <div>
                  <p class="text-sm font-semibold text-ink-700">Payment Reminder</p>
                  <p class="text-[11px] text-ink-500">Tomorrow · 9:00 AM</p>
                </div>
              </div>
              <span class="text-[10px] font-bold text-[#8b6b00] bg-paypal-cream px-2 py-1 rounded">Scheduled</span>
            </div>
          </div>
          <button class="mt-4 w-full btn-gold !py-2.5 justify-center">+ Create New Broadcast</button>
        </div>
        <div class="absolute -right-4 -bottom-6 card px-4 py-3 shadow-xl flex items-center gap-3 float-2">
          <div class="flex -space-x-2">
            <div
              class="w-7 h-7 rounded-full bg-paypal-navy text-white text-xs font-bold flex items-center justify-center ring-2 ring-white">
              GP</div>
            <div
              class="w-7 h-7 rounded-full bg-paypal-blue text-white text-xs font-bold flex items-center justify-center ring-2 ring-white">
              RB</div>
            <div
              class="w-7 h-7 rounded-full bg-paypal-sky text-white text-xs font-bold flex items-center justify-center ring-2 ring-white">
              AT</div>
          </div>
          <div>
            <p class="text-xs font-bold text-paypal-navy">All carriers</p>
            <p class="text-[10px] text-ink-500">supported</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CARRIER MARQUEE -->
  <section class="py-10 border-y border-surface-200 bg-surface-50 overflow-hidden">
    <p class="text-center text-xs font-bold text-ink-500 uppercase tracking-widest mb-6">Trusted across Bangladesh</p>
    <div class="marquee whitespace-nowrap text-lg font-bold text-ink-500">
      <span>Grameenphone</span><span>•</span><span>BRAC Bank</span><span>•</span><span>Square
        Group</span><span>•</span><span>Banglalink</span><span>•</span><span>Robi</span><span>•</span><span>Airtel</span><span>•</span><span>Transcom</span><span>•</span><span>Bashundhara</span><span>•</span><span>Daraz</span><span>•</span><span>bKash</span><span>•</span>
      <span>Grameenphone</span><span>•</span><span>BRAC Bank</span><span>•</span><span>Square
        Group</span><span>•</span><span>Banglalink</span><span>•</span><span>Robi</span><span>•</span><span>Airtel</span><span>•</span><span>Transcom</span><span>•</span><span>Bashundhara</span><span>•</span><span>Daraz</span><span>•</span><span>bKash</span><span>•</span>
    </div>
  </section>

  <!-- PROBLEM / SOLUTION -->
  <section class="py-24 max-w-7xl mx-auto px-6">
    <div class="grid md:grid-cols-2 gap-6">
      <div class="card p-10 bg-surface-50">
        <span class="chip !bg-red-50 !text-red-600">The Problem</span>
        <h2 class="mt-4 text-3xl font-extrabold text-ink-900">Your messages are getting ignored</h2>
        <ul class="mt-6 space-y-4 text-ink-500">
          <li class="flex gap-3"><span class="text-red-500">✕</span> SMS and emails get buried in crowded inboxes</li>
          <li class="flex gap-3"><span class="text-red-500">✕</span> Customers miss critical updates — payments,
            deliveries, OTPs</li>
          <li class="flex gap-3"><span class="text-red-500">✕</span> Your message gets lost in the noise of 200+ daily
            notifications</li>
          <li class="flex gap-3"><span class="text-red-500">✕</span> Average SMS open rate in Bangladesh has fallen below
            15%</li>
        </ul>
      </div>
      <div class="card p-10 mesh-blue text-black relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-paypal-gold/30 rounded-full blur-3xl"></div>
        <span class="chip !bg-white/20 !text-white">The Solution</span>
        <h2 class="mt-4 text-3xl font-extrabold">Voice cuts through the noise</h2>
        <ul class="mt-6 space-y-4 opacity-95">
          <li class="flex gap-3"><span class="text-paypal-gold">✓</span> Direct to customer's phone — impossible to ignore
          </li>
          <li class="flex gap-3"><span class="text-paypal-gold">✓</span> Personal, immediate, with guaranteed delivery
            tracking</li>
          <li class="flex gap-3"><span class="text-paypal-gold">✓</span> Reach thousands in seconds with full real-time
            analytics</li>
          <li class="flex gap-3"><span class="text-paypal-gold">✓</span> 98% average answer rate in the first hour after
            broadcast</li>
        </ul>
        <div class="mt-8 relative inline-flex items-center gap-4 p-4 rounded-2xl bg-white/10 backdrop-blur">
          <div
            class="w-14 h-14 rounded-full bg-paypal-gold text-paypal-navy font-extrabold flex items-center justify-center text-xl glow-ring">
            98%</div>
          <div>
            <p class="font-bold">Average answer rate</p>
            <p class="text-sm opacity-80">in the first hour</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="py-24 bg-surface-50">
    <div class="max-w-7xl mx-auto px-6">
      <div class="max-w-3xl">
        <span class="chip">Features</span>
        <h2 class="mt-4 text-4xl sm:text-5xl font-extrabold text-ink-900 tracking-tight">Everything you need to <span
            class="text-gradient">broadcast at scale</span></h2>
        <p class="mt-4 text-ink-500">Powerful features designed for seamless voice broadcasting. From upload to delivery
          analytics, we've got you covered.</p>
      </div>

      <div class="mt-10 card p-8 grid lg:grid-cols-2 gap-8 items-center">
        <div>
          <div class="feature-icon !bg-paypal-navy !text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor"
              stroke-width="2" viewBox="0 0 24 24">
              <path d="M3 3v18h18M7 14l3-3 4 4 5-6" />
            </svg></div>
          <h3 class="mt-4 text-2xl font-extrabold text-ink-900">Real-time Dashboard</h3>
          <p class="mt-2 text-ink-500">Track broadcasts, delivery rates, and customer engagement in real-time. Monitor
            live campaign performance with detailed analytics across every carrier.</p>
          <div class="mt-6 grid grid-cols-4 gap-3 text-center">
            <div class="p-3 rounded-xl bg-surface-50">
              <p class="text-xl font-extrabold text-paypal-navy">99.8%</p>
              <p class="text-[10px] text-ink-500">Delivery</p>
            </div>
            <div class="p-3 rounded-xl bg-surface-50">
              <p class="text-xl font-extrabold text-paypal-navy">2.5s</p>
              <p class="text-[10px] text-ink-500">Avg. time</p>
            </div>
            <div class="p-3 rounded-xl bg-surface-50">
              <p class="text-xl font-extrabold text-paypal-navy">98%</p>
              <p class="text-[10px] text-ink-500">Answered</p>
            </div>
            <div class="p-3 rounded-xl bg-surface-50">
              <p class="text-xl font-extrabold text-paypal-navy">52K</p>
              <p class="text-[10px] text-ink-500">Reach</p>
            </div>
          </div>
        </div>
        <div class="relative bg-surface-50 rounded-2xl p-6">
          <div class="flex items-center justify-between mb-3">
            <p class="font-bold text-ink-900">Live Broadcast Activity</p><span class="chip-sky chip"><span
                class="w-1.5 h-1.5 rounded-full bg-paypal-sky animate-pulse"></span> Live</span>
          </div>
          <canvas id="heroChart" height="160"></canvas>
        </div>
      </div>

      <div class="mt-6 grid md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="card p-6">
          <div class="feature-icon">📞</div>
          <h3 class="mt-4 font-extrabold text-ink-900">Live Agent Transfer</h3>
          <p class="mt-2 text-sm text-ink-500">Press 2 to connect customers to your live support team instantly during a
            broadcast.</p>
        </div>
        <div class="card p-6">
          <div class="feature-icon">📥</div>
          <h3 class="mt-4 font-extrabold text-ink-900">Bulk Upload</h3>
          <p class="mt-2 text-sm text-ink-500">Import thousands of contacts via CSV or Excel. Auto-dedupe & validate
            numbers.</p>
        </div>
        <div class="card p-6">
          <div class="feature-icon">🗓</div>
          <h3 class="mt-4 font-extrabold text-ink-900">Smart Scheduling</h3>
          <p class="mt-2 text-sm text-ink-500">Schedule in your timezone. Avoid DND hours automatically (Mon–Fri
            10am–8pm).</p>
        </div>
        <div class="card p-6">
          <div class="feature-icon">🎵</div>
          <h3 class="mt-4 font-extrabold text-ink-900">Multiple Audio</h3>
          <p class="mt-2 text-sm text-ink-500">MP3, WAV, OGG, M4A. Record in-browser or upload up to 60s of audio.</p>
        </div>
        <div class="card p-6">
          <div class="feature-icon !bg-paypal-cream !text-[#8b6b00]">🤖</div>
          <h3 class="mt-4 font-extrabold text-ink-900">Text to Speech <span
              class="chip-gold chip !px-1.5 !py-0.5 !text-[9px]">Soon</span></h3>
          <p class="mt-2 text-sm text-ink-500">Natural Bengali & English voices powered by neural TTS.</p>
        </div>
        <div class="card p-6">
          <div class="feature-icon">📊</div>
          <h3 class="mt-4 font-extrabold text-ink-900">Export Reports</h3>
          <p class="mt-2 text-sm text-ink-500">Download CSV/Excel reports per campaign with delivery, answer & DTMF data.
          </p>
        </div>
        <div class="card p-6">
          <div class="feature-icon">🔁</div>
          <h3 class="mt-4 font-extrabold text-ink-900">Auto Retry</h3>
          <p class="mt-2 text-sm text-ink-500">Missed calls are retried up to 3 times at optimal intervals — free.</p>
        </div>
        <div class="card p-6">
          <div class="feature-icon">🛡</div>
          <h3 class="mt-4 font-extrabold text-ink-900">DND Compliance</h3>
          <p class="mt-2 text-sm text-ink-500">Built-in BTRC DND list checking on every contact you upload.</p>
        </div>
      </div>

      <div class="mt-10 grid md:grid-cols-2 gap-5">
        <a href="{{ url('/voice-otp') }}" class="card p-8 group">
          <span class="chip-sky chip">Secure</span>
          <h3 class="mt-4 text-2xl font-extrabold text-ink-900">Voice OTP API</h3>
          <p class="mt-3 text-ink-500">Send secure OTPs via voice calls. More secure than SMS — prevents SIM swap, SS7
            interception, and phishing leaks.</p>
          <p class="mt-5 text-paypal-blue font-bold inline-flex items-center gap-1 group-hover:gap-2 transition-all">Learn
            more →</p>
        </a>
        <a href="{{ url('/voice-survey') }}" class="card p-8 group">
          <span class="chip-gold chip">New</span>
          <h3 class="mt-4 text-2xl font-extrabold text-ink-900">Voice Survey</h3>
          <p class="mt-3 text-ink-500">Create interactive voice surveys with keypad responses. Collect real-time feedback
            via phone with 78% response rate.</p>
          <p class="mt-5 text-paypal-blue font-bold inline-flex items-center gap-1 group-hover:gap-2 transition-all">Learn
            more →</p>
        </a>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  @php
    $testimonials = \App\Models\PageBlock::value('homepage.testimonials', []);
  @endphp
  <section class="py-24 max-w-7xl mx-auto px-6">
    <div class="text-center max-w-2xl mx-auto">
      <span class="chip">Testimonials</span>
      <h2 class="mt-4 text-4xl sm:text-5xl font-extrabold text-ink-900 tracking-tight">Loved by <span
          class="text-gradient">5,000+ businesses</span></h2>
    </div>
    <div class="mt-12 grid md:grid-cols-3 gap-5">
      @foreach($testimonials as $index => $t)
        <div class="card p-7 {{ $index === 1 ? 'mesh-blue text-white' : '' }}">
          <div class="flex gap-1 {{ $index === 1 ? 'text-paypal-gold' : 'text-paypal-gold' }}">★★★★★</div>
          <p class="mt-4 {{ $index === 1 ? '' : 'text-ink-700' }} leading-relaxed">"{{ $t['quote'] }}"</p>
          <div class="mt-5 flex items-center gap-3">
            <div
              class="w-10 h-10 rounded-full {{ $index === 1 ? 'bg-paypal-gold text-paypal-navy' : 'bg-paypal-navy text-white' }} font-bold flex items-center justify-center">
              {{ $t['name'][0] }}{{ explode(' ', $t['name'])[1][0] ?? '' }}
            </div>
            <div>
              <p class="font-bold {{ $index === 1 ? '' : 'text-ink-900' }} text-sm">{{ $t['name'] }}</p>
              <p class="text-xs {{ $index === 1 ? 'opacity-80' : 'text-ink-500' }}">{{ $t['role'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  <!-- FAQ -->
  @php
    $faq = \App\Models\PageBlock::value('homepage.faq', []);
  @endphp
  <section class="py-24 bg-surface-50">
    <div class="max-w-4xl mx-auto px-6">
      <div class="text-center mb-10"><span class="chip">FAQ</span>
        <h2 class="mt-3 text-4xl font-extrabold text-ink-900">Questions, answered</h2>
      </div>
      <div class="space-y-3">
        @foreach($faq as $index => $item)
          <details class="card p-5 group" {{ $index === 0 ? 'open' : '' }}>
            <summary class="flex items-center justify-between font-bold text-ink-900">
              <span>{{ $item['q'] }}</span>
              <span class="text-paypal-blue group-open:rotate-45 transition">+</span>
            </summary>
            <p class="mt-3 text-ink-500 text-sm">{{ $item['a'] }}</p>
          </details>
        @endforeach
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-24">
    <div class="max-w-5xl mx-auto px-6">
      <div class="mesh-blue rounded-3xl p-12 text-center text-white relative overflow-hidden">
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-paypal-gold/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-paypal-sky/30 rounded-full blur-3xl"></div>
        <h2 class="relative text-4xl sm:text-5xl font-extrabold tracking-tight">Ready to amplify your<br>customer
          communication?</h2>
        <p class="relative mt-4 opacity-90">Join 5,000+ Bangladeshi businesses using VoiceReach. Start free today.</p>
        <div class="relative mt-8 flex flex-wrap justify-center gap-3">
          <a href="#" class="btn-gold">Start Broadcasting Free →</a>
          <a href="#"
            class="btn-outline !border-white/40 !text-white !bg-transparent hover:!bg-white hover:!text-paypal-navy">▶
            Watch Demo</a>
        </div>
        <p class="relative mt-6 text-xs opacity-80">15 free voice credits · No credit card · Cancel anytime</p>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    const ctx = document.getElementById('heroChart');
    if (ctx) {
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
          datasets: [{
            label: 'Calls',
            data: [4200, 5800, 7100, 6400, 9200, 11500, 8800],
            backgroundColor: ctx => {
              const c = ctx.chart.ctx.createLinearGradient(0, 0, 0, 200);
              c.addColorStop(0, '#009CDE'); c.addColorStop(1, '#0070BA');
              return c;
            },
            borderRadius: 8, borderSkipped: false
          }]
        },
        options: {
          plugins: { legend: { display: false } },
          scales: { x: { grid: { display: false } }, y: { grid: { color: '#eef3f9' }, ticks: { color: '#687173' } } }
        }
      });
    }
  </script>
@endpush