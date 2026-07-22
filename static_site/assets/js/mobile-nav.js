/* ============================================================
 * Protiddhoni — mobile navigation (hamburger + drawer) and
 * mobile bottom CTA bar. Pure vanilla JS, no dependencies.
 * ============================================================ */
(function () {
  'use strict';

  var SIGNUP = 'https://dashboard.protiddhoni-bd.com/signup';
  var LOGIN  = 'https://dashboard.protiddhoni-bd.com/login';
  var LINKS = [
    ['About Us', '/about'], ['Voice OTP', '/voice-otp'], ['Voice Survey', '/voice-survey'],
    ['Voice Broadcast', '/voice-broadcast'], ['Pricing', '/pricing'], ['API Docs', '/api-docs'],
    ['Blog', '/blog'], ['Contact Us', '/contact']
  ];

  function track(ga, fb, label) {
    if (window.pdTrack) window.pdTrack(ga, fb, { label: label });
  }

  function el(tag, cls, html) {
    var e = document.createElement(tag);
    if (cls) e.className = cls;
    if (html != null) e.innerHTML = html;
    return e;
  }

  document.addEventListener('DOMContentLoaded', function () {
    var navHost = document.querySelector('.nav-inner') ||
                  document.querySelector('header nav') ||
                  document.querySelector('nav');

    /* ---- Hamburger ---- */
    if (navHost && !document.querySelector('.pd-burger')) {
      var burger = el('button', 'pd-burger', '<span></span>');
      burger.setAttribute('aria-label', 'Open menu');
      burger.setAttribute('aria-expanded', 'false');
      navHost.appendChild(burger);

      /* ---- Drawer + overlay ---- */
      var overlay = el('div', 'pd-drawer-overlay');
      var drawer = el('aside', 'pd-drawer');
      var head = el('div', 'pd-drawer-head',
        '<strong style="color:#003087;font-weight:800">Menu</strong>');
      var close = el('button', 'pd-drawer-close', '&times;');
      close.setAttribute('aria-label', 'Close menu');
      head.appendChild(close);
      drawer.appendChild(head);

      var nav = el('nav');
      LINKS.forEach(function (l) {
        var a = el('a', null, l[0]); a.href = l[1];
        nav.appendChild(a);
      });
      drawer.appendChild(nav);

      var cta = el('div', 'pd-drawer-cta');
      var su = el('a', 'pd-d-signup', 'Free Signup'); su.href = SIGNUP; su.rel = 'nofollow';
      var li = el('a', 'pd-d-login', 'Dashboard Login'); li.href = LOGIN; li.rel = 'nofollow';
      su.addEventListener('click', function () { track('sign_up_click', 'Lead', 'drawer signup'); });
      li.addEventListener('click', function () { track('login_click', null, 'drawer login'); });
      cta.appendChild(su); cta.appendChild(li);
      drawer.appendChild(cta);

      document.body.appendChild(overlay);
      document.body.appendChild(drawer);

      var open = function () {
        drawer.classList.add('open'); overlay.classList.add('open');
        burger.setAttribute('aria-expanded', 'true'); document.body.style.overflow = 'hidden';
      };
      var shut = function () {
        drawer.classList.remove('open'); overlay.classList.remove('open');
        burger.setAttribute('aria-expanded', 'false'); document.body.style.overflow = '';
      };
      burger.addEventListener('click', open);
      close.addEventListener('click', shut);
      overlay.addEventListener('click', shut);
      nav.addEventListener('click', function (e) { if (e.target.tagName === 'A') shut(); });
      document.addEventListener('keydown', function (e) { if (e.key === 'Escape') shut(); });
    }

    /* ---- Mobile bottom CTA bar ---- */
    if (!document.querySelector('.pd-mobile-bar')) {
      var bar = el('div', 'pd-mobile-bar');
      var bSu = el('a', 'b-signup', '🚀 Free Signup'); bSu.href = SIGNUP; bSu.rel = 'nofollow';
      var bLi = el('a', 'b-login', '🔐 Login'); bLi.href = LOGIN; bLi.rel = 'nofollow';
      bSu.addEventListener('click', function () { track('sign_up_click', 'Lead', 'mobilebar signup'); });
      bLi.addEventListener('click', function () { track('login_click', null, 'mobilebar login'); });
      bar.appendChild(bSu); bar.appendChild(bLi);
      document.body.appendChild(bar);
    }
  });
})();
