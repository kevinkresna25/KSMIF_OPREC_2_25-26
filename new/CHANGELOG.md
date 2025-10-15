# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [3.0.0] - 2025-10-14

### 🎮 MAJOR REDESIGN: RetroTerm Theme

Complete visual overhaul with retro hacker aesthetic inspired by 90s terminal interfaces and CTF themes. 
This is a **BREAKING CHANGE** - completely new UI/UX across the entire application.

### Added

#### RetroTerm Theme System
- ✨ **CRT Screen Effects**: Scanline overlay and flicker animation
- ✨ **Custom Color Palette**: 
  - Primary Dark: #343a40
  - Accent: #5b7290
  - Success: #a3d39c
  - Danger: #d46767
  - Retro BG: #0a0e27
  - Retro Border/Glow: #00ff41 (Terminal green)
- ✨ **Custom Fonts**:
  - Press Start 2P (pixel font for headings)
  - Raleway (subheadings)
  - Lato (body text)
- ✨ **Animations**:
  - CRT flicker effect
  - Scanline animation
  - Text glow (pulsing green)
  - Menu hover transitions

#### New Layout System
- ✨ `layouts/retro.blade.php` - Base layout with CRT effects
- ✨ Glassmorphism backdrop effects
- ✨ Sharp corners (no rounded elements)
- ✨ Terminal-style input fields
- ✨ Retro button styles (solid & outlined)

### Changed

#### Complete Visual Redesign
- ♻️ **Welcome Page**: Hero section with pixel font, retro cards, and stats
- ♻️ **Login Page**: Terminal-style authentication form
- ♻️ **Register Page**: Retro account creation interface
- ♻️ **Operator Dashboard**: Complete sidebar redesign with terminal aesthetics
- ♻️ **All Forms**: Input fields with focus glow effects
- ♻️ **Navigation**: Retro-styled menu items with hover effects
- ♻️ **Typography**: Pixel fonts for headers, modern fonts for content

#### Tailwind Configuration
- ♻️ Extended color palette with custom retro colors
- ♻️ Added custom font families (pixel, raleway, lato)
- ♻️ Custom animations (flicker, scanline, glow)
- ♻️ Custom keyframes for CRT effects

#### Component Styling
- ♻️ Buttons: Sharp corners with accent colors
- ♻️ Cards: Dark background with border glow
- ♻️ Inputs: Transparent with success ring on focus
- ♻️ Alerts: Retro-styled notifications
- ♻️ Badges: Terminal-style status indicators

### Technical Improvements
- ⚡ CSS optimizations with new Tailwind build
- ⚡ Better animation performance with GPU acceleration
- ⚡ Cleaner component structure
- ⚡ Responsive design maintained

### Visual Features
- 🎨 CRT scanline overlay (non-interactive)
- 🎨 Screen flicker animation
- 🎨 Green phosphor glow on active elements
- 🎨 Terminal green (#00ff41) as primary accent
- 🎨 Dark theme optimized for long sessions
- 🎨 Retro gaming aesthetic throughout

### Files Changed
- 📝 `tailwind.config.js` - Complete theme overhaul
- 📝 `resources/views/layouts/retro.blade.php` - New base layout
- 📝 `resources/views/welcome.blade.php` - Redesigned landing page
- 📝 `resources/views/auth/login.blade.php` - Retro login form
- 📝 `resources/views/auth/register.blade.php` - Retro register form
- 📝 `resources/views/components/operator-layout.blade.php` - Terminal-style dashboard
- 📝 `routes/web.php` - Added stats to welcome page

### Breaking Changes
⚠️ **Visual breaking changes** - All pages have completely new appearance
⚠️ **Font changes** - New font stack requires Google Fonts
⚠️ **Color scheme** - Complete palette change from modern to retro
⚠️ **Layout structure** - New layout system with CRT effects

### Migration Notes
- All existing functionality preserved
- No database changes
- No API changes
- Only visual/frontend changes
- Users may need to hard refresh (Ctrl+Shift+R) to see new theme

## [2.2.1] - 2025-10-14

### 🧹 Cleanup & UX Refinement

Cleaned up unnecessary documentation files and improved sidebar toggle UX.

### Changed
- ♻️ **Logo as Toggle**: Logo puzzle icon sekarang berfungsi sebagai toggle button (no separate button)
- ♻️ Logo icon rotates 180° when minimizing/expanding
- ♻️ Hover effect on logo untuk indicate clickable
- ♻️ Simpler, cleaner toggle experience

### Removed
- 🗑️ Deleted unnecessary MD documentation files
- 🗑️ Kept only README.md and CHANGELOG.md (essential docs)
- 🗑️ Removed: SIDEBAR_TOGGLE_GUIDE.md, SUBMISSIONS_MANAGEMENT.md, MODERN_SIDEBAR_GUIDE.md, LATEST_UPDATE_SUMMARY.md, QUICK_START_V2.2.md, FEATURES_SHOWCASE.md, UI_UX_IMPROVEMENTS.md, QUICK_START.md, WORKFLOW_DOCUMENTATION.md, REFACTORING_SUMMARY.md

## [2.2.0] - 2025-10-14

### 🎯 Submissions Management & Modern Sidebar

Major UI/UX improvements with new submissions management feature and completely redesigned sidebar.

### Added

#### Submissions Management (Delete-Only)
- ✨ **New feature**: Kelola Inputan (Submissions Management) page
- ✨ Delete-only functionality for fairness (no editing allowed)
- ✨ Advanced filtering: by team, status (confirmed/pending), search
- ✨ Bulk delete operations with select all functionality
- ✨ Statistics dashboard: Total, Confirmed, Pending counts
- ✨ Search by content or team name
- ✨ Pagination with configurable per-page (10-50)
- ✨ Empty state with helpful message
- ✨ Confirmation dialogs for delete operations

#### Modern Sidebar Design
- ✨ **Redesigned sidebar** with modern gradient background (indigo to purple)
- ✨ **Glassmorphism toggle button** with smooth animations
- ✨ **Minimizable sidebar** with persistent state (localStorage)
- ✨ Menu items with left border animation on hover
- ✨ Smooth slide effect on hover (pl-4 → pl-5)
- ✨ Custom scrollbar styling (thin, semi-transparent)
- ✨ Responsive mobile overlay with backdrop blur
- ✨ User info card at bottom with gradient avatar
- ✨ Section dividers with styled headings
- ✨ Active state indicators with background & shadow

#### Controllers
- ✨ `AdminSubmissionController` with methods:
  - `index()`: List submissions with filters & pagination
  - `destroy()`: Delete single submission
  - `bulkDestroy()`: Delete multiple submissions at once

#### Routes
- ✨ `operator.manage.submissions.index` - Submissions list
- ✨ `operator.manage.submissions.destroy` - Delete submission
- ✨ `operator.manage.submissions.bulk-destroy` - Bulk delete

#### Views
- ✨ `resources/views/operator/submissions/index.blade.php`
  - Statistics cards with icons
  - Advanced filter form
  - Submissions table with checkboxes
  - Bulk actions bar
  - Empty state
- ✨ Updated `operator-layout.blade.php`:
  - Modern gradient sidebar
  - Toggle functionality (desktop & mobile)
  - Improved navigation structure
  - "Kelola Inputan" menu item

#### Documentation
- ✨ `SUBMISSIONS_MANAGEMENT.md` - Complete guide for submissions management
- ✨ `MODERN_SIDEBAR_GUIDE.md` - Comprehensive sidebar documentation

### Changed

#### UI/UX Improvements
- ♻️ Sidebar width: 256px (expanded) / 80px (minimized)
- ♻️ Toggle button now floats with glassmorphism effect
- ♻️ Menu items use rounded-xl instead of rounded-lg
- ♻️ Better color gradients throughout sidebar
- ♻️ Improved hover states with scale & shadow effects
- ♻️ Content area adjusts margin based on sidebar state

#### JavaScript Enhancements
- ♻️ Sidebar state persistence with localStorage
- ♻️ Smooth transitions with cubic-bezier easing
- ♻️ Toggle icon rotation (180° flip)
- ♻️ Resize handler for responsive behavior
- ♻️ Bulk operations with checkbox management

#### Model Enhancements
- ♻️ `TeamSubmission::scopeSearch()` for content/team search (already existed)
- ♻️ Better eager loading in submissions index

### Fixed
- 🐛 Mobile sidebar now properly slides in/out
- 🐛 Toggle button position updates smoothly
- 🐛 Text elements hide properly when minimized
- 🐛 Overlay closes sidebar on mobile
- 🐛 Responsive breakpoints work correctly

### Security
- 🔒 Only operators can access submissions management
- 🔒 CSRF protection on all delete operations
- 🔒 Confirmation dialogs prevent accidental deletes
- 🔒 Input validation on filters and bulk operations

### Performance
- ⚡ Efficient DOM manipulation for bulk operations
- ⚡ Debounced resize handler
- ⚡ CSS transitions use GPU-accelerated properties
- ⚡ Minimal JavaScript for sidebar functionality

### Documentation
- 📚 Added complete submissions management guide
- 📚 Added modern sidebar design documentation
- 📚 Updated README with new features
- 📚 Code comments for JavaScript functions

## [2.0.0] - 2025-10-14

### 🎉 Major Refactoring Release

Complete code refactoring with clean code principles and Laravel best practices.

### Added

#### Architecture
- ✨ Service layer for business logic (`SubmissionService`, `PuzzleValidationService`)
- ✨ Form Request classes for validation
- ✨ Policy classes for authorization (`TeamPolicy`, `SnippetPolicy`)
- ✨ API Resource classes for JSON responses
- ✨ Reusable Blade components (`alert`, `badge`, `button`, `card`, `layout`)

#### Database
- ✨ `is_operator` field to users table
- ✨ `content_hash` field with index for duplicate detection
- ✨ Database indexes for performance optimization
- ✨ Comprehensive seeders (TeamSeeder, SnippetSeeder)

#### Models
- ✨ Model scopes (`confirmed`, `pending`, `search`, `ordered`, `forTeam`)
- ✨ Model accessors (`getTotalSubmissionsAttribute`, `getConfirmedSubmissionsCountAttribute`)
- ✨ Enhanced relationships (`confirmedSubmissions`)
- ✨ Static utility methods (`getCorrectOrder`, `getCombinedHtml`)

#### Configuration
- ✨ `config/puzzle.php` for app constants
- ✨ Middleware alias registration in `bootstrap/app.php`
- ✨ Enhanced AppServiceProvider with model safeguards

#### Documentation
- ✨ Comprehensive README.md
- ✨ REFACTORING_SUMMARY.md with detailed changes
- ✨ CHANGELOG.md (this file)
- ✨ Code documentation with PHPDoc blocks

### Changed

#### Controllers
- ♻️ Refactored all controllers to use Dependency Injection
- ♻️ Moved business logic to Service classes
- ♻️ Replaced inline validation with Form Request classes
- ♻️ Reduced method complexity (from 30-50 lines to 10-20 lines)
- ♻️ Added proper type hints and return types

#### Routes
- ♻️ Reorganized routes with better grouping
- ♻️ Cleaner middleware assignment
- ♻️ Consistent naming conventions
- ♻️ Controller grouping for related endpoints

#### Code Quality
- ♻️ Applied SOLID principles
- ♻️ Applied DRY principle with reusable components
- ♻️ Added type safety throughout the codebase
- ♻️ Improved error handling
- ♻️ Better separation of concerns

### Improved

#### Performance
- ⚡ Added database indexes (content_hash, is_confirmed, team_id)
- ⚡ Query optimization with Eloquent scopes
- ⚡ Eager loading prevention in development
- ⚡ Efficient pagination

#### Security
- 🔒 Structured validation with Form Requests
- 🔒 Authorization with Policies
- 🔒 XSS prevention (maintained DOMPurify)
- 🔒 CSRF protection (maintained)
- 🔒 Content hashing for duplicate detection

#### Developer Experience
- 👨‍💻 IDE autocomplete support with type hints
- 👨‍💻 Clear code structure
- 👨‍💻 Comprehensive documentation
- 👨‍💻 Reusable components
- 👨‍💻 Easy to test architecture

### Fixed
- 🐛 Missing `is_operator` field in User model
- 🐛 Missing `content_hash` field in TeamSubmission
- 🐛 Inconsistent validation messages
- 🐛 Code duplication in controllers

---

## [1.0.0] - 2025-10-14

### Initial Release

#### Added
- ✨ Basic puzzle game functionality
- ✨ AES decryption page
- ✨ Submission system
- ✨ Operator dashboard
- ✨ Team & Snippet CRUD
- ✨ Drag & drop arrangement
- ✨ Order validation
- ✨ Laravel Breeze authentication
- ✨ Tailwind CSS styling

#### Features
- 🎮 AES client-side decryption with CryptoJS
- 🎮 Team submission with duplicate prevention
- 🎮 Operator confirmation workflow
- 🎮 Drag & drop puzzle arrangement
- 🎮 HTML sanitization with DOMPurify
- 🎮 Responsive design

---

## Migration Guide (v1 to v2)

### Required Steps:

1. **Run Migrations**
   ```bash
   php artisan migrate
   ```

2. **Run Seeders**
   ```bash
   php artisan db:seed
   ```

3. **Clear Cache**
   ```bash
   php artisan optimize:clear
   ```

4. **Update Dependencies** (if needed)
   ```bash
   composer install
   npm install
   ```

### Breaking Changes:
- None (backward compatible)

### Deprecations:
- None

---

## [2.1.0] - 2025-10-14

### 🎯 Workflow Enhancement Release

Complete workflow redesign: **1 Tim = 1 Inputan Terkonfirmasi**

### Added

#### New Workflow Features
- ✨ Single submission confirmation per team (radio button selection)
- ✨ Progress tracking dashboard with visual indicators
- ✨ Smart navigation (auto-redirect to next team)
- ✨ Arrangement page for ALL confirmed submissions (1 per team)
- ✨ Validation before accessing arrangement page
- ✨ Observer pattern for tracking changes (`TeamSubmissionObserver`)
- ✨ Form Request for arrangement validation (`CheckArrangementRequest`)

#### Enhanced Services
- ✨ `SubmissionService::confirmSingleSubmission()` - Enforces 1 per team
- ✨ `SubmissionService::getAllConfirmedSubmissions()` - Get all confirmed (1 per team)
- ✨ `SubmissionService::allTeamsHaveConfirmedSubmission()` - Validation check
- ✨ `SubmissionService::getConfirmationProgress()` - Progress tracking
- ✨ `SubmissionService::getTeamsWithoutConfirmedSubmission()` - Get remaining teams

#### UI/UX Improvements
- ✨ Progress bar with percentage on dashboard
- ✨ Visual highlights for selected submission
- ✨ Team-specific badges and indicators
- ✨ "Lihat selengkapnya" for long content
- ✨ Enhanced arrangement page with drag indicators

#### Documentation
- ✨ `WORKFLOW_DOCUMENTATION.md` - Complete workflow guide
- ✨ Architecture diagrams and data flow
- ✨ Troubleshooting guide

### Changed

#### Routes
- ♻️ Removed `{team}` parameter from arrangement routes
- ♻️ `/operator/arrange` now handles ALL teams (not single team)

#### Controllers
- ♻️ `OperatorController::showConfirm()` - Shows current confirmed
- ♻️ `OperatorController::processConfirm()` - Single selection logic
- ♻️ `OperatorController::showArrange()` - No team parameter
- ♻️ Enhanced dashboard with progress & alerts

#### Views
- ♻️ `confirm.blade.php` - Radio buttons instead of checkboxes
- ♻️ `arrange.blade.php` - Shows all confirmed (1 per team)
- ♻️ `dashboard.blade.php` - Progress tracking & smart navigation

#### Logic
- ♻️ Confirmation now **unsets all previous** before confirming new one
- ♻️ Arrangement requires **all teams** to have confirmed submission

### Improved

#### Business Rules
- 🎯 Strictly enforced: 1 team = 1 confirmed submission
- 🎯 Cannot proceed to arrangement until all teams confirmed
- 🎯 Operator can change selection anytime

#### User Experience
- 💫 Progress visibility (percentage, remaining teams)
- 💫 Clear visual feedback (highlights, badges)
- 💫 Smart workflow (auto-navigate to next team)
- 💫 Better content preview (expandable)

#### Performance
- ⚡ Observer pattern for cache management
- ⚡ Optimized queries with proper scopes
- ⚡ Reduced N+1 queries

#### Code Quality
- 📝 Better separation of concerns
- 📝 More reusable service methods
- 📝 Enhanced form validation
- 📝 Comprehensive documentation

### Fixed
- 🐛 Multiple confirmations per team (now prevented)
- 🐛 Arrangement showing all submissions (now 1 per team)
- 🐛 No validation before arrangement (now enforced)

---

## Roadmap

### [2.2.0] - Planned
- [ ] Unit tests for Services
- [ ] Feature tests for Controllers
- [ ] API documentation with Swagger/OpenAPI
- [ ] Query caching

### [2.2.0] - Planned
- [ ] RESTful API endpoints
- [ ] API authentication with Sanctum
- [ ] Real-time updates with WebSockets
- [ ] Leaderboard feature

### [3.0.0] - Planned
- [ ] Multi-language support
- [ ] Advanced analytics
- [ ] Admin panel
- [ ] Docker containerization

---

**Contributors:** AI Assistant & KSMIF Team
**License:** MIT

