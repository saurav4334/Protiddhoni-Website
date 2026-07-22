/* ============================================================
 * Protiddhoni — analytics & conversion tracking (centralized)
 *
 * Single, reusable helper loaded once on every page.
 *   • Google Analytics 4  (the gtag base tag is in each page <head>)
 *   • Meta Pixel          (loaded here, once, with global params)
 *
 * SCALABILITY: this same Meta Pixel is shared across company products
 * (Notify = Bulk SMS, Protiddhoni = Voice Solution, ...). To add a new
 * product later, only change PD_CONFIG.META below — nothing else.
 * ============================================================ */
window.PD_CONFIG = {
  GA4_ID:  'G-XXXXXXXXXX',            // GA4 base tag lives in each page <head>; keep placeholder here
  GTM_ID:  'GTM-XXXXXXX',             // optional GTM container
  PIXEL_ID:'27426500270311489',      // shared Meta Pixel ID

  // Global event parameters — attached to EVERY Meta event.
  META: { product: 'Protiddhoni', business_unit: 'Voice Solution', website: 'protiddhoni-bd.com' },

  FORM_EMAIL:  'sales@protiddhoni-bd.com',
  DASH_SIGNUP: 'https://dashboard.protiddhoni-bd.com/signup',
  DASH_LOGIN:  'https://dashboard.protiddhoni-bd.com/login'
};

(function () {
  'use strict';
  var C = window.PD_CONFIG;
  var isSet = function (v) { return v && !/^G-XX|^GTM-XX|^0+$/.test(v); };

  /* ---- Google Analytics 4 ---- (base gtag added per page <head>; shim if absent) */
  if (isSet(C.GA4_ID)) {
    var s = document.createElement('script'); s.async = true;
    s.src = 'https://www.googletagmanager.com/gtag/js?id=' + C.GA4_ID;
    document.head.appendChild(s);
    window.dataLayer = window.dataLayer || [];
    window.gtag = function () { window.dataLayer.push(arguments); };
    gtag('js', new Date()); gtag('config', C.GA4_ID);
  } else {
    window.dataLayer = window.dataLayer || [];
    window.gtag = window.gtag || function () { window.dataLayer.push(arguments); };
  }

  /* ---- Google Tag Manager (optional) ---- */
  if (isSet(C.GTM_ID)) {
    (function (w, d, s, l, i) { w[l] = w[l] || []; w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
      var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true; j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', C.GTM_ID);
  }

  /* ============================================================
   *  META PIXEL — load once, PageView with global params
   * ============================================================ */
  if (isSet(C.PIXEL_ID)) {
    !function (f, b, e, v, n, t, s) {
      if (f.fbq) return; n = f.fbq = function () { n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments); };
      if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = [];
      t = b.createElement(e); t.async = !0; t.src = v; s = b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t, s);
    }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', C.PIXEL_ID);
    fbq('track', 'PageView', C.META);
  } else {
    window.fbq = window.fbq || function () {};
  }

  /* ---- reusable Meta helper: always merges the global params ---- */
  window.pdMeta = function (type, name, extra) {
    try { if (window.fbq) fbq(type || 'track', name, Object.assign({}, C.META, extra || {})); } catch (e) {}
  };
  /* ---- GA4 helper (kept for existing [data-track] + mobile-nav.js calls) ---- */
  window.pdTrack = function (ga4Event, _fb, params) {
    try { if (window.gtag) gtag('event', ga4Event, params || {}); } catch (e) {}
    try { if (window.dataLayer) window.dataLayer.push(Object.assign({ event: ga4Event }, params || {})); } catch (e) {}
  };

  var path = (location.pathname || '').toLowerCase();
  var has = function (t) { return path.indexOf(t) > -1; };

  document.addEventListener('DOMContentLoaded', function () {

    /* ---- ViewContent on product / pricing / solution pages ---- */
    var vcPages = ['/pricing', '/voice-otp', '/voice-survey', '/voice-broadcast', '/api-docs'];
    if (vcPages.some(has)) {
      window.pdMeta('track', 'ViewContent', { content_name: document.title, content_category: 'Voice Solution' });
    }
    /* ---- PricingView custom event ---- */
    if (has('/pricing')) window.pdMeta('trackCustom', 'PricingView', {});
    /* ---- GA4: api-docs view (existing) ---- */
    if (has('/api-docs')) window.pdTrack('api_docs_view');

    /* ---- GA4 bindings for [data-track] (Meta handled by the delegated handler below) ---- */
    var GA = { signup: 'sign_up_click', login: 'login_click', pricing_cta: 'pricing_cta_click', contact: 'contact_click' };
    document.querySelectorAll('[data-track]').forEach(function (el) {
      el.addEventListener('click', function () {
        var k = el.getAttribute('data-track');
        window.pdTrack(GA[k] || k, null, { label: (el.textContent || '').trim().slice(0, 60) });
      });
    });

    bindContactForm();
    bindScroll();
  });

  /* ============================================================
   *  Delegated click handler — all Meta interaction events
   * ============================================================ */
  document.addEventListener('click', function (e) {
    var el = e.target.closest && e.target.closest('a, button');
    if (!el) return;
    var href = (el.getAttribute('href') || '').toLowerCase();
    var text = (el.textContent || '').replace(/\s+/g, ' ').trim();
    var tl = text.toLowerCase();
    var dt = el.getAttribute('data-track') || '';

    /* Contact — phone / call / whatsapp / messenger / email */
    if (href.indexOf('tel:') === 0) window.pdMeta('track', 'Contact', { method: 'phone' });
    else if (/wa\.link|wa\.me|api\.whatsapp|whatsapp/.test(href)) window.pdMeta('track', 'Contact', { method: 'whatsapp' });
    else if (href.indexOf('mailto:') === 0) window.pdMeta('track', 'Contact', { method: 'email' });
    else if (/m\.me|messenger/.test(href)) window.pdMeta('track', 'Contact', { method: 'messenger' });
    else if (/call now/.test(tl)) window.pdMeta('track', 'Contact', { method: 'phone' });

    /* Download — brochure / company profile / proposal / pricing pdf */
    if (/\.pdf(\?|$)/.test(href) || el.hasAttribute('download')) {
      var k = href + ' ' + tl;
      var kind = /brochure/.test(k) ? 'Brochure' : /company.?profile|profile/.test(k) ? 'Company Profile'
        : /proposal/.test(k) ? 'Proposal' : /pricing/.test(k) ? 'Pricing PDF' : 'File';
      window.pdMeta('track', 'Download', { content_name: kind });
    }

    /* CTA_Click — Get Started / Book Demo / Contact Sales / Free Trial (+ our signup/login CTAs) */
    var isSignup = dt === 'signup' || dt === 'pricing_cta' || /\/signup/.test(href);
    var isLogin = dt === 'login' || /\/login/.test(href);
    var ctaText = /get started|book demo|contact sales|free trial|start free|start broadcasting|upgrade to business|enable ai/.test(tl);
    if (isSignup || isLogin || dt === 'contact' || ctaText) {
      window.pdMeta('trackCustom', 'CTA_Click', { button_text: text.slice(0, 64) });
    }

    /* ScheduleDemo — only when a demo is actually booked/requested */
    if (dt === 'demo' || /book demo|book a demo|schedule demo|request demo|book a live demo/.test(tl)) {
      window.pdMeta('trackCustom', 'ScheduleDemo', {});
    }
  }, true);

  /* ---- DeepScroll — fire once at 75% ---- */
  function bindScroll() {
    var fired = false;
    var onScroll = function () {
      if (fired) return;
      var d = document.documentElement, b = document.body;
      var scrolled = (d.scrollTop || b.scrollTop) + window.innerHeight;
      var height = Math.max(b.scrollHeight, d.scrollHeight);
      if (height > 0 && scrolled / height >= 0.75) {
        fired = true;
        window.pdMeta('trackCustom', 'DeepScroll', { percent: 75 });
        window.removeEventListener('scroll', onScroll);
      }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ---- Contact form (FormSubmit AJAX) — Lead on success only ---- */
  function bindContactForm() {
    var form = document.getElementById('contactForm');
    if (!form) return;
    var banner = document.createElement('div');
    banner.style.cssText = 'margin-top:14px;padding:12px 16px;border-radius:10px;font-size:14px;font-weight:600;display:none';
    form.appendChild(banner);
    var show = function (ok, msg) {
      banner.style.display = 'block';
      banner.style.background = ok ? '#dcfce7' : '#fee2e2';
      banner.style.color = ok ? '#15803d' : '#b91c1c';
      banner.textContent = msg;
    };
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var val = function (n) { var x = form.querySelector('[name="' + n + '"]'); return x ? x.value : ''; };
      var name = val('name'), email = val('email'), msg = val('message');
      if (!name.trim() || !email.trim() || !msg.trim()) { show(false, 'Please fill in your name, email, and message.'); return; }
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) { show(false, 'Please enter a valid email address.'); return; }
      var phone = val('phone');
      if (phone && !/^(\+?880|0)?1[3-9]\d{8}$/.test(phone.replace(/[\s-]/g, ''))) { show(false, 'Please enter a valid Bangladesh phone number.'); return; }
      var honey = form.querySelector('[name="_honey"]'); if (honey && honey.value) return;
      var btn = form.querySelector('button[type="submit"], input[type="submit"]'); var label = btn ? btn.textContent : '';
      if (btn) { btn.disabled = true; btn.textContent = 'Sending…'; }
      fetch('https://formsubmit.co/ajax/' + encodeURIComponent(C.FORM_EMAIL), {
        method: 'POST', headers: { 'Accept': 'application/json' }, body: new FormData(form)
      }).then(function (r) { return r.json(); }).then(function (json) {
        if (json && (json.success === 'true' || json.success === true)) {
          show(true, 'Thank you for contacting Protiddhoni. Our sales team will get back to you shortly.');
          form.reset();
          window.pdTrack('generate_lead', null, { form: 'contact' });        // GA4
          window.pdMeta('track', 'Lead', { source: 'contact_page' });        // Meta
        } else { show(false, 'We could not submit your message. Please call us or contact us on WhatsApp.'); }
      }).catch(function () { show(false, 'We could not submit your message. Please call us or contact us on WhatsApp.'); })
        .finally(function () { if (btn) { btn.disabled = false; btn.textContent = label; } });
    });
  }
})();
