/* ============================================================
   cmstema3 - Modern University Theme JavaScript
   Premium redesign for Faculty of Agriculture, Unmul
   ============================================================ */

(function($) {
  'use strict';

  /* -------------------------------------------
     1. Navbar Scroll Effect
     ------------------------------------------- */
  function initNavbar() {
    const navbar = document.querySelector('.cms-navbar');
    if (!navbar) return;

    let lastScroll = 0;

    function onScroll() {
      const scrollY = window.scrollY;
      
      if (scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }

      lastScroll = scrollY;
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    // Initial check
    onScroll();
  }

  /* -------------------------------------------
     2. Mobile Menu Toggle
     ------------------------------------------- */
  function initMobileMenu() {
    const toggle = document.querySelector('.cms-navbar-toggle');
    const nav = document.querySelector('.cms-navbar-nav');
    if (!toggle || !nav) return;

    toggle.addEventListener('click', function() {
      this.classList.toggle('active');
      nav.classList.toggle('open');
      document.body.classList.toggle('menu-open');
    });

    // Close menu on link click
    nav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        toggle.classList.remove('active');
        nav.classList.remove('open');
        document.body.classList.remove('menu-open');
      });
    });
  }

  /* -------------------------------------------
     3. Dark Mode Toggle
     ------------------------------------------- */
  function initDarkMode() {
    const toggle = document.querySelector('.cms-dark-toggle');
    if (!toggle) return;

    const html = document.documentElement;
    const thumb = toggle.querySelector('.cms-dark-toggle-thumb');

    // Check saved preference
    const savedTheme = localStorage.getItem('cms-theme');
    if (savedTheme === 'dark') {
      html.setAttribute('data-theme', 'dark');
      if (thumb) thumb.textContent = '🌙';
    } else {
      html.removeAttribute('data-theme');
      if (thumb) thumb.textContent = '☀️';
    }

    toggle.addEventListener('click', function() {
      const isDark = html.getAttribute('data-theme') === 'dark';
      
      if (isDark) {
        html.removeAttribute('data-theme');
        localStorage.setItem('cms-theme', 'light');
        if (thumb) thumb.textContent = '☀️';
      } else {
        html.setAttribute('data-theme', 'dark');
        localStorage.setItem('cms-theme', 'dark');
        if (thumb) thumb.textContent = '🌙';
      }
    });
  }

  /* -------------------------------------------
     4. Back to Top Button
     ------------------------------------------- */
  function initBackToTop() {
    const btn = document.querySelector('.cms-back-to-top');
    if (!btn) return;

    window.addEventListener('scroll', function() {
      if (window.scrollY > 400) {
        btn.classList.add('visible');
      } else {
        btn.classList.remove('visible');
      }
    }, { passive: true });

    btn.addEventListener('click', function() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

  /* -------------------------------------------
     5. Counter Animation
     ------------------------------------------- */
  function initCounters() {
    const counters = document.querySelectorAll('.cms-stat-card strong[data-to]');
    if (!counters.length) return;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const target = entry.target;
          const finalValue = parseInt(target.getAttribute('data-to'));
          animateCounter(target, finalValue);
          observer.unobserve(target);
        }
      });
    }, { threshold: 0.3 });

    counters.forEach(counter => observer.observe(counter));
  }

  function animateCounter(element, target) {
    const duration = 2000;
    const steps = 60;
    const stepDuration = duration / steps;
    const increment = target / steps;
    let current = 0;
    let step = 0;

    function update() {
      step++;
      current = Math.min(Math.round(increment * step), target);
      element.textContent = current.toLocaleString();

      if (current < target) {
        requestAnimationFrame(() => {
          setTimeout(update, stepDuration);
        });
      }
    }

    update();
  }

  /* -------------------------------------------
     6. Hero Stats Floating Animation
     ------------------------------------------- */
  function initHeroStats() {
    const stats = document.querySelectorAll('.cms-hero-stat');
    if (!stats.length) return;

    stats.forEach((stat, index) => {
      stat.style.animationDelay = `${index * 2}s`;
    });
  }

  /* -------------------------------------------
     7. Smooth Scroll for Anchor Links
     ------------------------------------------- */
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href === '#') return;
        
        const target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          const offset = 80;
          const targetPosition = target.getBoundingClientRect().top + window.scrollY - offset;
          
          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
          });
        }
      });
    });
  }

  /* -------------------------------------------
     8. Scroll Reveal (using Intersection Observer)
     ------------------------------------------- */
  function initScrollReveal() {
    const elements = document.querySelectorAll('[data-reveal]');
    if (!elements.length) return;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const delay = el.getAttribute('data-reveal-delay') || 0;
          
          setTimeout(() => {
            el.classList.add('revealed');
          }, delay);
          
          observer.unobserve(el);
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    });

    elements.forEach(el => observer.observe(el));
  }

  /* -------------------------------------------
     9. Loading Skeleton Placeholder
     ------------------------------------------- */
  function initSkeletons() {
    // Skeletons are shown by default via CSS
    // We hide them once content is loaded
    document.querySelectorAll('.cms-skeleton-container').forEach(container => {
      setTimeout(() => {
        container.classList.add('loaded');
      }, 500);
    });
  }

/* -------------------------------------------
     10. Inline Expanding Search Box (Navbar)
     ------------------------------------------- */
  function initSearchOverlay() {
    const searchBox = document.getElementById('cmsNavSearch');
    const trigger = document.querySelector('.cms-search-trigger');
    const input = document.getElementById('cmsSearchInput');
    if (!searchBox || !trigger) return;

    function openSearch() {
      searchBox.classList.add('open');
      trigger.style.display = 'none';
      setTimeout(() => {
        if (input) input.focus();
      }, 300);
    }

    function closeSearch() {
      searchBox.classList.remove('open');
      trigger.style.display = 'flex';
      setTimeout(() => trigger.focus(), 400);
    }

    trigger.addEventListener('click', function(e) {
      e.stopPropagation();
      openSearch();
    });

    // Close on ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && searchBox.classList.contains('open')) {
        closeSearch();
      }
    });

    // Close when clicking outside the search box
    document.addEventListener('click', function(e) {
      if (searchBox.classList.contains('open') && !searchBox.contains(e.target) && !trigger.contains(e.target)) {
        closeSearch();
      }
    });

    // Prevent the form submit from toggling/close issues
    const form = document.getElementById('cmsSearchForm');
    if (form) {
      form.addEventListener('submit', function() {
        // Let the form submit naturally; nothing special needed
      });
    }
  }

  /* -------------------------------------------
     11. Animated Language Dropdown + Switch
     ------------------------------------------- */
  function initLanguageDropdown() {
    const dropdown = document.getElementById('cmsLangDropdown');
    const btn = dropdown ? dropdown.querySelector('.cms-lang-btn') : null;
    if (!dropdown || !btn) return;

    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      dropdown.classList.toggle('open');
      const expanded = dropdown.classList.contains('open');
      btn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    });

    // Close when clicking outside
    document.addEventListener('click', function(e) {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
      }
    });

    // Robust language switching (event delegation so it works even if markup changes)
    const langUrl = dropdown.getAttribute('data-lang-url');
    document.addEventListener('click', function(e) {
      const item = e.target.closest('.lang');
      if (!item) return;
      e.preventDefault();
      const lang = item.getAttribute('lang-value');
      if (!lang) return;

      // Optimistically update active state
      dropdown.querySelectorAll('.cms-lang-item').forEach(i => {
        i.classList.toggle('active', i.getAttribute('lang-value') === lang);
      });
      const code = dropdown.querySelector('.cms-lang-code');
      if (code) code.textContent = lang;

      if (langUrl) {
        fetch(langUrl, {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
          body: 'lang=' + encodeURIComponent(lang)
        }).then(() => {
          location.reload();
        }).catch(() => {
          location.reload();
        });
      }
    });
  }

  /* -------------------------------------------
     12. Overflow / Responsive Menu
     ------------------------------------------- */
  function initOverflowMenu() {
    const nav = document.querySelector('.cms-navbar-nav');
    if (!nav) return;

    const MAX_VISIBLE = 6;

    // Restore any existing items moved into More (if present)
    const existingMore = nav.querySelector('.cms-nav-more');
    if (existingMore) {
      const movedList = existingMore.querySelector('.more-dropdown ul');
      if (movedList) {
        // move each li back before the More button
        Array.from(movedList.children).forEach(li => {
          nav.insertBefore(li, existingMore);
        });
      } else {
        // fallback for older format: anchors with data-moved
        const moved = Array.from(existingMore.querySelectorAll('a[data-moved]'));
        moved.forEach(a => {
          const li = document.createElement('li');
          li.appendChild(a.cloneNode(true));
          nav.insertBefore(li, existingMore);
        });
      }
      existingMore.remove();
    }

    // Collect top-level menu items
    const items = Array.from(nav.querySelectorAll(':scope > li'));
    if (items.length <= MAX_VISIBLE) return;

    // Move extras into More dropdown
    const visible = items.slice(0, MAX_VISIBLE);
    const extras = items.slice(MAX_VISIBLE);

    const moreLi = document.createElement('li');
    moreLi.className = 'cms-nav-more dropdown';

    const moreToggle = document.createElement('a');
    moreToggle.href = 'javascript:void(0)';
    moreToggle.className = 'dropdown-item dropdown-toggle';
    moreToggle.setAttribute('aria-haspopup', 'true');
    moreToggle.setAttribute('aria-expanded', 'false');
    moreToggle.textContent = 'More ▾';

    const moreMenu = document.createElement('div');
    moreMenu.className = 'cms-dropdown-menu more-dropdown';

    // create a list container to hold moved <li> nodes (preserve submenus & events)
    const movedUl = document.createElement('ul');
    movedUl.style.listStyle = 'none';
    movedUl.style.margin = '0';
    movedUl.style.padding = '8px 0';

    extras.forEach(exLi => {
      // move the whole <li> into the movedUl so submenus remain intact
      movedUl.appendChild(exLi);
    });

    moreMenu.appendChild(movedUl);
    moreLi.appendChild(moreToggle);
    moreLi.appendChild(moreMenu);
    nav.appendChild(moreLi);

    // Toggle and hover behavior
    function openMore() {
      moreLi.classList.add('open');
      moreToggle.setAttribute('aria-expanded', 'true');
      moreMenu.style.pointerEvents = 'auto';
    }
    function closeMore() {
      moreLi.classList.remove('open');
      moreToggle.setAttribute('aria-expanded', 'false');
      moreMenu.style.pointerEvents = 'none';
    }

    // click still toggles (for touch support)
    moreToggle.addEventListener('click', function(e) {
      e.stopPropagation();
      if (moreLi.classList.contains('open')) closeMore(); else openMore();
    });

    // Hover (open on hover, small delay to avoid flicker)
    let hoverTimer = null;
    moreLi.addEventListener('mouseenter', function() {
      clearTimeout(hoverTimer);
      openMore();
    });
    moreLi.addEventListener('mouseleave', function() {
      hoverTimer = setTimeout(closeMore, 200);
    });

    // Keyboard accessibility
    moreToggle.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeMore();
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        if (moreLi.classList.contains('open')) closeMore(); else openMore();
      }
    });

    // Close when clicking outside
    document.addEventListener('click', function(e) {
      if (!moreLi.contains(e.target)) {
        closeMore();
      }
    });
  }

  /* -------------------------------------------
     12. Initialize Everything
     ------------------------------------------- */
  $(document).ready(function() {
    initNavbar();
    initMobileMenu();
    initDarkMode();
    initBackToTop();
    initCounters();
    initHeroStats();
    initSmoothScroll();
    initOverflowMenu();
    initNavIndicator();
    initScrollReveal();
    initSkeletons();
    initSearchOverlay();
    initLanguageDropdown();

    // Recompute overflow when fonts/layout settle
    setTimeout(initOverflowMenu, 300);
  });

  // Re-initialize on AJAX page loads
  $(document).on('ajaxComplete', function() {
    initCounters();
    initOverflowMenu();
    initNavIndicator();
    initScrollReveal();
  });

})(jQuery);

