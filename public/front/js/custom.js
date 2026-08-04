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
    const drawer = document.querySelector('[data-drawer]');
    const backdrop = document.querySelector('[data-drawer-backdrop]');
    if (!toggle || !drawer || !backdrop) return;

    // Open drawer
    const openDrawer = () => {
      drawer.hidden = false;
      backdrop.hidden = false;
      // allow CSS to paint
      setTimeout(() => {
        drawer.classList.add('open');
        backdrop.classList.add('visible');
        document.body.classList.add('cms-drawer-open');
        drawer.setAttribute('aria-hidden', 'false');
        // focus first element inside drawer for accessibility
        const focusable = drawer.querySelectorAll('a,button,input,textarea,select,[tabindex]:not([tabindex="-1"])');
        if (focusable.length) focusable[0].focus();
      }, 20);
    };

    // Close drawer
    const closeDrawer = () => {
      drawer.classList.remove('open');
      backdrop.classList.remove('visible');
      document.body.classList.remove('cms-drawer-open');
      drawer.setAttribute('aria-hidden', 'true');
      // delay hiding to allow transition
      setTimeout(() => {
        drawer.hidden = true;
        backdrop.hidden = true;
        toggle.focus();
      }, 320);
    };

    // Toggle button
    toggle.addEventListener('click', () => {
      if (drawer.classList.contains('open')) closeDrawer();
      else openDrawer();
    });

    // Backdrop click closes
    backdrop.addEventListener('click', closeDrawer);

    // Close buttons inside drawer
    drawer.querySelectorAll('[data-drawer-close], .cms-drawer-close').forEach(btn => btn.addEventListener('click', closeDrawer));

    // Close when link clicked (mobile navigation behaviour)
    drawer.querySelectorAll('.cms-drawer-nav a').forEach(a => a.addEventListener('click', () => {
      closeDrawer();
    }));

    // Close on Escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && drawer.classList.contains('open')) {
        closeDrawer();
      }
    });

    // Accordion toggles inside drawer
    drawer.querySelectorAll('.drawer-accordion-toggle').forEach(btn => {
      btn.setAttribute('aria-expanded', 'false');
      btn.addEventListener('click', () => {
        const submenu = btn.nextElementSibling;
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
        if (submenu) submenu.hidden = expanded;
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
    // Use plain label; caret is provided via CSS ::after. Avoid adding extra glyphs here.
    moreToggle.textContent = 'More';

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
    initDropdownBehavior();
    initScrollReveal();
    initSkeletons();
    initSearchOverlay();
    initLanguageDropdown();

    // Initialize gallery lightbox if Magnific Popup is available
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.magnificPopup !== 'undefined') {
      jQuery('.cms-gallery-grid').magnificPopup({
        delegate: 'a.cms-gallery-link',
        type: 'image',
        gallery: { enabled: true },
        removalDelay: 300,
        mainClass: 'mfp-fade'
      });
    }

    // Recompute overflow & dropdowns when fonts/layout settle
    setTimeout(function(){ initOverflowMenu(); initDropdownBehavior(); }, 300);
  });

  // Re-initialize on AJAX page loads
  $(document).on('ajaxComplete', function() {
    initCounters();
    initOverflowMenu();
    initNavIndicator();
    initDropdownBehavior();
    initScrollReveal();
  });

/* -------------------------------------------
     Navbar active indicator (pill underline)
     ------------------------------------------- */
  function initNavIndicator() {
    const nav = document.querySelector('.cms-navbar-nav');
    if (!nav) return;

    // Remove any stale indicator element
    const existing = nav.querySelector('.cms-nav-indicator');
    if (existing) existing.remove();

    // Find the active top-level item
    const items = Array.from(nav.querySelectorAll(':scope > li'));
    const active = items.find(li => {
      const a = li.querySelector(':scope > a');
      return a && (a.classList.contains('active') || (a.getAttribute('href') && a.getAttribute('href') === window.location.pathname));
    });

    if (!active) return;

    // Create a small indicator that follows the active item
    const indicator = document.createElement('span');
    indicator.className = 'cms-nav-indicator';
    nav.appendChild(indicator);

    const position = () => {
      const a = active.querySelector(':scope > a');
      if (!a) return;
      const navRect = nav.getBoundingClientRect();
      const aRect = a.getBoundingClientRect();
      indicator.style.left = (aRect.left - navRect.left) + 'px';
      indicator.style.width = aRect.width + 'px';
      indicator.style.top = (aRect.top - navRect.top) + 'px';
    };

    position();
    window.addEventListener('resize', position);
    window.addEventListener('load', position);

    // Only show on desktop
    if (window.innerWidth <= 991) {
      indicator.style.display = 'none';
    }
  }

  /* -------------------------------------------
     Dropdown behavior (recursive, hover/click)
     ------------------------------------------- */
  function initDropdownBehavior() {
    const nav = document.querySelector('.cms-navbar-nav');
    if (!nav) return;

    const isTouch = ('ontouchstart' in window) || navigator.maxTouchPoints > 0;
    const isMobile = () => window.innerWidth <= 991;

    // Open helper
    function openMenu(li, menuEl) {
      if (!menuEl) return;
      clearTimeout(li._closeTimer);
      clearTimeout(li._openTimer);
      menuEl.classList.remove('open-left');
      menuEl.classList.add('is-open');
      li.classList.add('open');
      const trigger = li.querySelector(':scope > a');
      if (trigger) trigger.setAttribute('aria-expanded', 'true');

      // Auto-flip to left if the submenu would overflow right edge
      requestAnimationFrame(() => {
        try {
          const rect = menuEl.getBoundingClientRect();
          const rightOverflow = rect.right > (window.innerWidth - 8);
          const leftOverflow = rect.left < 8;
          if (rightOverflow && !leftOverflow) {
            menuEl.classList.add('open-left');
          }
        } catch (e) {}
      });
    }

    // Close helper
    function closeMenu(li, menuEl) {
      if (!li) return;
      clearTimeout(li._openTimer);
      clearTimeout(li._closeTimer);
      if (menuEl) {
        menuEl.classList.remove('is-open');
      }
      li.classList.remove('open');
      const trigger = li.querySelector(':scope > a');
      if (trigger) trigger.setAttribute('aria-expanded', 'false');
    }

    // Initialize a single li (recursive-safe). Called for all li incl. nested.
    function initItems() {
      const items = Array.from(nav.querySelectorAll('li'));
      items.forEach(li => {
        if (li.dataset.dropdownInitialized) return;

        const submenu = li.querySelector(':scope > .cms-dropdown-menu, :scope > ul');
        if (!submenu) return; // no children

        li.dataset.dropdownInitialized = '1';
        li.classList.add('has-children');
        li.setAttribute('aria-haspopup', 'true');

        // Ensure the submenu is a .cms-dropdown-menu (wrap plain UL)
        let menuEl = submenu;
        if (!submenu.classList.contains('cms-dropdown-menu')) {
          const wrapper = document.createElement('div');
          wrapper.className = 'cms-dropdown-menu';
          wrapper.appendChild(submenu);
          li.appendChild(wrapper);
          menuEl = wrapper;
        }

        const trigger = li.querySelector(':scope > a');
        if (trigger) {
          trigger.setAttribute('aria-expanded', 'false');
          trigger.setAttribute('aria-haspopup', 'true');
        }

        // Click handling: toggle submenu on click (desktop + touch). Use preventDefault for submenu parents.
        if (trigger) {
          trigger.addEventListener('click', function(e) {
            // Prevent the default anchor behavior for items that have submenus
            e.preventDefault();

            if (menuEl.classList.contains('is-open')) {
              closeMenu(li, menuEl);
            } else {
              // close sibling open menus (accordion-like behavior)
              const parentUl = li.parentElement;
              if (parentUl) {
                Array.from(parentUl.querySelectorAll(':scope > li.open')).forEach(sib => {
                  if (sib !== li) {
                    const sm = sib.querySelector(':scope > .cms-dropdown-menu');
                    closeMenu(sib, sm);
                  }
                });
              }
              openMenu(li, menuEl);
            }

          });

          // Keyboard support
          trigger.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
              e.preventDefault();
              if (menuEl.classList.contains('is-open')) closeMenu(li, menuEl);
              else openMenu(li, menuEl);
            } else if (e.key === 'Escape') {
              closeMenu(li, menuEl);
            }
          });
        }
      });
    }

    // Ensure init runs for newly added items; avoid attaching duplicate delegated handlers
    if (nav.dataset.dropdownInitializedOnce) {
      // still (re)initialize any newly moved items (e.g. More overflow)
      initItems();
      return;
    }
    nav.dataset.dropdownInitializedOnce = '1';

    // Initialize items (this also ensures newly moved items are initialized)
    initItems();

    // Attach per-item hover listeners for non-touch devices (more reliable than delegated mouseover/mouseout)
    Array.from(nav.querySelectorAll('li')).forEach(li => {
      // skip the overflow 'More' wrapper - it has its own handlers in initOverflowMenu
      if (li.classList && li.classList.contains('cms-nav-more')) return;
      if (li._hoverHandlersAttached) return;
      li._hoverHandlersAttached = true;
      if (!isTouch && !isMobile()) {
        li.addEventListener('mouseenter', function() {
          const submenu = li.querySelector(':scope > .cms-dropdown-menu');
          if (!submenu) return;
          clearTimeout(li._closeTimer);
          li._openTimer = setTimeout(() => openMenu(li, submenu), 160);
        });
        li.addEventListener('mouseleave', function() {
          const submenu = li.querySelector(':scope > .cms-dropdown-menu');
          if (!submenu) return;
          clearTimeout(li._openTimer);
          li._closeTimer = setTimeout(() => closeMenu(li, submenu), 200);
        });
      }
    });

    // Close all when clicking outside the nav (attach once)
    if (!nav.dataset.dropdownDocClickAttached) {
      nav.dataset.dropdownDocClickAttached = '1';
      document.addEventListener('click', function(e) {
        if (!nav.contains(e.target)) {
          nav.querySelectorAll('li.open').forEach(li => {
            const sm = li.querySelector(':scope > .cms-dropdown-menu');
            closeMenu(li, sm);
          });
        }
      });
    }
  }

})(jQuery);

