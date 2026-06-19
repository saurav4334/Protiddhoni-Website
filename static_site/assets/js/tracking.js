/* ============================================================
 * Protiddhoni — analytics & conversion tracking (centralized)
 *
 * >>> EDIT YOUR IDs HERE (one place for the whole site) <<<
 * Replace the placeholders below with your real IDs. Anything
 * left as a placeholder is simply skipped (no errors).
 * ============================================================ */
window.PD_CONFIG = {
  GA4_ID:  'G-XXXXXXXXXX',          // Google Analytics 4 measurement ID
  GTM_ID:  'GTM-XXXXXXX',           // Google Tag Manager container ID
  PIXEL_ID:'000000000000000',       // Meta (Facebook) Pixel ID
  FORM_EMAIL: 'info@protiddhoni-bd.com',
  DASH_SIGNUP: 'https://dashboard.protiddhoni-bd.com/signup',
  DASH_LOGIN:  'https://dashboard.protiddhoni-bd.com/login'
};

(function () {
  'use strict';
  var C = window.PD_CONFIG;
  var isSet = function (v) { return v && !/^G-XX|^GTM-XX|^0+$/.test(v); };

  /* ---- Google Analytics 4 (gtag) ---- */
  if (isSet(C.GA4_ID)) {
    var s = document.createElement('script'); s.async = true;
    s.src = 'https://www.googletagmanager.com/gtag/js?id=' + C.GA4_ID;
    document.head.appendChild(s);
    window.dataLayer = window.dataLayer || [];
    window.gtag = function () { window.dataLayer.push(arguments); };
    gtag('js', new Date());
    gtag('config', C.GA4_ID);
  } else {
    window.dataLayer = window.dataLayer || [];
    window.gtag = window.gtag || function () { window.dataLayer.push(arguments); };
  }

  /* ---- Google Tag Manager ---- */
  if (isSet(C.GTM_ID)) {
    (function (w, d, s, l, i) {
      w[l] = w[l] || []; w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
      var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true; j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', C.GTM_ID);
  }

  /* ---- Meta Pixel ---- */
  if (isSet(C.PIXEL_ID)) {
    !function (f, b, e, v, n, t, s) {
      if (f.fbq) return; n = f.fbq = function () { n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments); };
      if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = [];
      t = b.createElement(e); t.async = !0; t.src = v; s = b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t, s);
    }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', C.PIXEL_ID); fbq('track', 'PageView');
  } else {
    window.fbq = window.fbq || function () {};
  }

  /* ---- Unified conversion tracker ---- */
  window.pdTrack = function (ga4Event, fbEvent, params) {
    params = params || {};
    try { if (window.gtag) gtag('event', ga4Event, params); } catch (e) {}
    try { if (window.fbq && fbEvent) fbq('track', fbEvent, params); } catch (e) {}
    try { if (window.dataLayer) window.dataLayer.push(Object.assign({ event: ga4Event }, params)); } catch (e) {}
  };

  /* map a [data-track] value to GA4 + Meta events */
  var MAP = {
    signup:      ['sign_up_click',      'Lead'],
    login:       ['login_click',        null],
    pricing_cta: ['pricing_cta_click',  'Lead'],
    contact:     ['contact_click',      'Contact'],
    api_docs:    ['api_docs_view',      null]
  };

  document.addEventListener('DOMContentLoaded', function () {
    // Bind clicks
    document.querySelectorAll('[data-track]').forEach(function (el) {
      el.addEventListener('click', function () {
        var key = el.getAttribute('data-track');
        var m = MAP[key] || [key, null];
        window.pdTrack(m[0], m[1], { label: el.textContent.trim().slice(0, 60) });
      });
    });

    // API docs page-view conversion
    if (/\/api-docs/.test(location.pathname) || /api-docs\.html$/.test(location.pathname)) {
      window.pdTrack('api_docs_view', null);
    }

    bindContactForm();
  });

  /* ---- Contact form (FormSubmit AJAX — no backend) ---- */
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
      // validation
      var name = (form.querySelector('[name="name"]') || {}).value || '';
      var email = (form.querySelector('[name="email"]') || {}).value || '';
      var phone = (form.querySelector('[name="phone"]') || {}).value || '';
      var msg = (form.querySelector('[name="message"]') || {}).value || '';
      if (!name.trim() || !email.trim() || !msg.trim()) { show(false, 'Please fill in your name, email, and message.'); return; }
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) { show(false, 'Please enter a valid email address.'); return; }
      // honeypot
      var honey = form.querySelector('[name="_honey"]');
      if (honey && honey.value) return;

      var btn = form.querySelector('button[type="submit"], input[type="submit"]');
      var label = btn ? btn.textContent : '';
      if (btn) { btn.disabled = true; btn.textContent = 'Sending…'; }

      fetch('https://formsubmit.co/ajax/' + encodeURIComponent(C.FORM_EMAIL), {
        method: 'POST',
        headers: { 'Accept': 'application/json' },
        body: new FormData(form)
      }).then(function (r) { return r.json(); }).then(function (json) {
        if (json && (json.success === 'true' || json.success === true)) {
          show(true, 'Thank you! We received your message and will reply within 4 hours.');
          form.reset();
          window.pdTrack('generate_lead', 'Lead', { form: 'contact' });
          window.pdTrack('contact_submit', 'Contact', { form: 'contact' });
        } else {
          show(false, 'Sorry, something went wrong. Please email ' + C.FORM_EMAIL + ' directly.');
        }
      }).catch(function () {
        show(false, 'Network error. Please email ' + C.FORM_EMAIL + ' directly.');
      }).finally(function () {
        if (btn) { btn.disabled = false; btn.textContent = label; }
      });
    });
  }
})();
