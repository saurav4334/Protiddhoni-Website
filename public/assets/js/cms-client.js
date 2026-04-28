/**
 * Protiddhoni CMS client — shared across all marketing pages
 *
 * Usage in HTML:
 *   <script src="assets/js/cms-client.js"></script>
 *   <script>
 *     CMS.init({ base: 'https://cms.protiddhoni-bd.com/api', page: 'homepage' });
 *   </script>
 *
 * Then anywhere in the page:
 *   <h1 data-cms="homepage.hero.headline">Static fallback...</h1>
 *   <p  data-cms-html="homepage.hero.subhead">Static fallback...</p>
 *
 * The library:
 *   - Fetches all blocks for the current page in ONE request
 *   - Replaces matching elements (text or HTML)
 *   - Falls back gracefully to existing static content if API fails
 *   - Wires <form data-cms-form="contact"> and <form data-cms-form="newsletter">
 *   - Renders <ul data-cms-list="homepage.faq"> from JSON arrays
 */
(function (window) {
  'use strict';

  const CMS = {
    base: '',
    page: null,
    cache: {},

    init(opts = {}) {
      this.base = (opts.base || '').replace(/\/$/, '');
      this.page = opts.page || null;

      if (this.page) this.hydratePage(this.page);
      this.bindForms();
    },

    /** Fetch all blocks for the current page and apply to DOM. */
    async hydratePage(page) {
      try {
        const res = await fetch(`${this.base}/blocks/${encodeURIComponent(page)}`, {
          headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) throw new Error(`CMS responded ${res.status}`);
        const json = await res.json();
        const blocks = json.data || {};

        // Also pull global blocks (footer, contact info, etc.)
        let globals = {};
        try {
          const gr = await fetch(`${this.base}/blocks/global`);
          if (gr.ok) globals = (await gr.json()).data || {};
        } catch (_) {}

        const all = { ...globals, ...blocks };
        this.cache = all;
        this.applyToDom(all);
      } catch (err) {
        console.warn('[CMS] page hydration skipped — using static fallback.', err);
      }
    },

    /** Replace [data-cms="key"] (textContent) and [data-cms-html="key"] (innerHTML). */
    applyToDom(blocks) {
      // Text replacement
      document.querySelectorAll('[data-cms]').forEach(el => {
        const key = el.getAttribute('data-cms');
        if (key in blocks && blocks[key] != null) {
          const v = blocks[key];
          if (typeof v === 'string' || typeof v === 'number') el.textContent = String(v);
        }
      });

      // HTML replacement (for rich_text blocks)
      document.querySelectorAll('[data-cms-html]').forEach(el => {
        const key = el.getAttribute('data-cms-html');
        if (key in blocks && blocks[key] != null) {
          el.innerHTML = String(blocks[key]);
        }
      });

      // List rendering (for json blocks)
      document.querySelectorAll('[data-cms-list]').forEach(el => {
        const key = el.getAttribute('data-cms-list');
        const tpl = el.getAttribute('data-cms-template');
        if (!(key in blocks) || !Array.isArray(blocks[key])) return;
        const items = blocks[key];
        if (!tpl) return;  // need a template id
        const tplEl = document.getElementById(tpl);
        if (!tplEl) return;
        el.innerHTML = items.map(item => this.fillTemplate(tplEl.innerHTML, item)).join('');
      });

      // Anchors with data-cms-href="key"
      document.querySelectorAll('[data-cms-href]').forEach(el => {
        const key = el.getAttribute('data-cms-href');
        if (key in blocks && blocks[key]) el.setAttribute('href', String(blocks[key]));
      });

      // Custom event so pages can do their own hookup
      document.dispatchEvent(new CustomEvent('cms:hydrated', { detail: blocks }));
    },

    /** Tiny `{{key}}` interpolation. Supports `{{nested.key}}`. */
    fillTemplate(tpl, data) {
      return tpl.replace(/\{\{\s*([\w.]+)\s*\}\}/g, (_, path) => {
        const val = path.split('.').reduce((o, k) => (o == null ? null : o[k]), data);
        return val == null ? '' : String(val);
      });
    },

    /* -------------------------------------------------------- */
    /*  Public API: fetch helpers                                */
    /* -------------------------------------------------------- */

    async fetchPosts(params = {}) {
      const qs = new URLSearchParams(params).toString();
      const r = await fetch(`${this.base}/posts${qs ? '?' + qs : ''}`);
      if (!r.ok) throw new Error('Failed to load posts');
      return r.json();
    },

    async fetchPost(slug) {
      const r = await fetch(`${this.base}/posts/${encodeURIComponent(slug)}`);
      if (!r.ok) throw new Error('Failed to load post');
      return r.json();
    },

    async fetchCategories() {
      const r = await fetch(`${this.base}/categories`);
      if (!r.ok) throw new Error('Failed to load categories');
      return r.json();
    },

    /* -------------------------------------------------------- */
    /*  Form bindings                                            */
    /* -------------------------------------------------------- */

    bindForms() {
      document.querySelectorAll('form[data-cms-form]').forEach(form => {
        form.addEventListener('submit', e => this.handleFormSubmit(e, form));
      });
    },

    async handleFormSubmit(e, form) {
      e.preventDefault();
      const type = form.getAttribute('data-cms-form');
      const endpoint = type === 'newsletter' ? '/newsletter' : '/contact';
      const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
      const originalLabel = submitBtn ? submitBtn.textContent : '';

      // Honeypot check (silent reject)
      const honey = form.querySelector('input[name="website"]');
      if (honey && honey.value) return;

      // Collect form data
      const fd = new FormData(form);
      const data = Object.fromEntries(fd.entries());
      // Inject source hint for newsletter
      if (type === 'newsletter' && !data.source) data.source = 'site:' + (CMS.page || 'unknown');

      if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Sending…'; }
      this.setFormState(form, 'loading');

      try {
        const res = await fetch(`${this.base}${endpoint}`, {
          method: 'POST',
          headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
          body: JSON.stringify(data),
        });
        const json = await res.json().catch(() => ({}));

        if (res.ok) {
          this.setFormState(form, 'success', json.message || 'Thanks — we got your message.');
          form.reset();
        } else {
          const msg = json.message || (json.errors ? this.firstError(json.errors) : 'Submission failed.');
          this.setFormState(form, 'error', msg);
        }
      } catch (err) {
        this.setFormState(form, 'error', 'Network error. Please retry.');
        console.error('[CMS] form submit error', err);
      } finally {
        if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = originalLabel; }
      }
    },

    firstError(errors) {
      for (const k in errors) return Array.isArray(errors[k]) ? errors[k][0] : String(errors[k]);
      return 'Validation failed.';
    },

    setFormState(form, state, message) {
      const banner = form.querySelector('.cms-form-banner');
      if (!banner) {
        const b = document.createElement('div');
        b.className = 'cms-form-banner';
        b.style.cssText = 'margin-top:12px;padding:11px 14px;border-radius:10px;font-size:13.5px;font-weight:600;';
        form.appendChild(b);
        return this.setFormState(form, state, message);
      }
      const colors = {
        loading: ['#eef3fb', '#003087', 'Sending…'],
        success: ['#dcfce7', '#15803d', message || 'Submitted!'],
        error:   ['#fee2e2', '#b91c1c', message || 'Submission failed.'],
      };
      const [bg, fg, text] = colors[state] || colors.loading;
      banner.style.background = bg;
      banner.style.color      = fg;
      banner.textContent      = text;
    },
  };

  window.CMS = CMS;
})(window);
