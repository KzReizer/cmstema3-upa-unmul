  # Task: Fix & Upgrade Search + Translate Features

## Steps
- [x] Analyze current search feature (broken empty-form button in navbar)
- [x] Analyze translate feature (`.lang` AJAX switch broken due to jQuery load timing)
- [x] Edit `application/views/front/home/header.php`:
  - Add inline expanding search box (`cms-nav-search`) in navbar + `cms-search-trigger` button
  - Replace Bootstrap language dropdown with custom animated `cms-lang-dropdown` using `data-url`
  - Remove broken inline language-switch script
- [x] Edit `public/front/css/custom.css`:
  - Add inline expanding search box styles (width 0 -> 220px animation) + `cmsShine` keyframe
  - Add animated language dropdown styles
  - Add dark-mode overrides for search input
- [x] Edit `public/front/js/custom.js`:
  - Rewrite `initSearchOverlay()` for inline expanding box (toggle `.open`, ESC, outside click, focus)
  - Add `initLanguageDropdown()` (animated toggle + robust `.lang` switch via fetch using `data-url`)
  - Register both in `$(document).ready()`
- [x] Test search box expands with animation & submits keyword
- [x] Test language switch to English works on both home & inner pages

