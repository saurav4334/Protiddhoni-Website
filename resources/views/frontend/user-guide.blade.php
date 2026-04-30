@extends('layouts.frontend')

@section('title', 'How to Manage Your Content — Protiddhoni CMS Guide')

@push('styles')
  <style>
    :root {
      --navy: #003087;
      --blue: #0070BA;
      --sky: #009CDE;
      --gold: #FFC439;
      --cream: #FFF9E6;
      --ink: #0a1230;
      --ink2: #3a4566;
      --mute: #6b7593;
      --line: #e5e9f2;
      --bg: #f7f9fc;
      --white: #fff;
    }

    .hero {
      padding: 60px 0 32px;
      background: linear-gradient(180deg, #fff 0%, var(--bg) 100%)
    }

    .toc-link {
      display: flex;
      gap: .6rem;
      padding: .5rem .8rem;
      border-radius: 10px;
      font-size: .85rem;
      font-weight: 600;
      color: var(--mute)
    }

    .toc-link:hover {
      background: #eef3f9;
      color: var(--navy)
    }

    .toc-link.active {
      background: var(--cream);
      color: #8b6b00
    }

    .step-num {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      color: #fff;
      font-size: 1.2rem;
      flex-shrink: 0;
      background: linear-gradient(135deg, var(--navy), var(--blue))
    }

    .mock {
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 14px;
      box-shadow: 0 30px 60px -30px rgba(0, 48, 135, .25);
      overflow: hidden
    }

    .mock-bar {
      background: var(--ink);
      color: #fff;
      padding: .55rem .9rem;
      font-size: .7rem;
      font-weight: 600;
      display: flex;
      gap: .5rem;
      align-items: center
    }
  </style>
@endpush

@section('content')
  <!-- HERO -->
  <section class="hero pt-32">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-3 gap-12 items-end">
      <div class="lg:col-span-2 reveal">
        <span class="chip mb-4">{{ \App\Models\PageBlock::value('user-guide.hero.pill', '📘 Onboarding Guide') }}</span>
        <h1 class="text-5xl font-extrabold text-navy-900 leading-tight">
          {!! \App\Models\PageBlock::value('user-guide.hero.headline', 'How to manage your website with <span class="text-gradient">Protiddhoni CMS</span>') !!}
        </h1>
        <p class="mt-6 text-lg text-ink-500 leading-relaxed">
          {!! \App\Models\PageBlock::value('user-guide.hero.subhead', 'Step-by-step guide to publishing blog posts, managing media, and tracking analytics. No coding required.') !!}
        </p>
      </div>
      <div class="bg-white p-6 rounded-2xl border border-surface-200 shadow-xl reveal">
        <p class="text-[10px] font-bold text-ink-300 uppercase tracking-widest mb-4">In this guide</p>
        <div class="space-y-1">
          <a href="#login" class="toc-link"><span>1️⃣</span> Login & dashboard tour</a>
          <a href="#post" class="toc-link active"><span>2️⃣</span> Publish a blog post</a>
          <a href="#media" class="toc-link"><span>3️⃣</span> Upload media</a>
          <a href="#analytics" class="toc-link"><span>6️⃣</span> Track analytics</a>
        </div>
      </div>
    </div>
  </section>

  <!-- STEP 1 -->
  <section id="login" class="py-24">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center gap-4 mb-10">
        <div class="step-num">1</div>
        <div>
          <p class="text-[10px] font-bold text-paypal-blue uppercase tracking-widest">Step 1</p>
          <h2 class="text-3xl font-extrabold text-navy-900">Login & dashboard tour</h2>
        </div>
      </div>

      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-4 reveal">
          <p class="text-ink-500 leading-relaxed">Login using your admin URL (e.g., <code>/admin</code>). You will land on
            the Dashboard where you can see your site\'s health at a glance.</p>
          <div class="bg-paypal-cream p-4 border-l-4 border-paypal-gold rounded-r-xl text-sm">
            <p class="font-bold text-navy-900">💡 Pro tip</p>
            <p class="text-ink-500 mt-1">Use <code>⌘K</code> to open quick search from anywhere.</p>
          </div>
        </div>
        <div class="mock reveal">
          <div class="mock-bar">
            <div class="flex gap-1.5"><i class="w-2 h-2 rounded-full bg-red-400"></i><i
                class="w-2 h-2 rounded-full bg-yellow-400"></i><i class="w-2 h-2 rounded-full bg-green-400"></i></div>
            <span class="opacity-70 ml-2">protiddhoni-bd.com/admin</span>
          </div>
          <div class="p-6 bg-surface-50 h-64">
            <div class="flex gap-4">
              <div class="w-12 h-48 bg-navy-900 rounded-xl"></div>
              <div class="flex-1 bg-white rounded-xl p-4 shadow-sm">
                <div class="h-4 w-32 bg-surface-200 rounded mb-4"></div>
                <div class="grid grid-cols-2 gap-2">
                  <div class="h-12 bg-surface-50 rounded"></div>
                  <div class="h-12 bg-surface-50 rounded"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- STEP 2 -->
  <section id="post" class="py-24 bg-white border-y border-surface-100">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center gap-4 mb-10">
        <div class="step-num">2</div>
        <div>
          <p class="text-[10px] font-bold text-paypal-blue uppercase tracking-widest">Step 2</p>
          <h2 class="text-3xl font-extrabold text-navy-900">Publish a blog post</h2>
        </div>
      </div>
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="mock reveal">
          <div class="mock-bar bg-surface-100 !text-navy-900">
            <span class="text-[10px] font-bold">Rich Text Editor</span>
          </div>
          <div class="p-6 h-64">
            <div class="h-6 w-full bg-surface-50 rounded mb-4"></div>
            <div class="h-32 w-full bg-surface-50 rounded"></div>
          </div>
        </div>
        <div class="space-y-4 reveal">
          <p class="text-ink-500 leading-relaxed">The editor is fully WYSIWYG. You can format text, add images, and set
            SEO parameters in the sidebar.</p>
          <ul class="space-y-2 text-sm font-bold text-navy-900">
            <li>✓ Auto-save every 30 seconds</li>
            <li>✓ Real-time SEO scoring</li>
            <li>✓ Social media cross-posting</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
@endsection