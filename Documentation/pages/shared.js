/**
 * shared.js — Livriko Documentation
 *
 * Dynamically generates the sidebar, mobile header, overlay, and
 * interactive scripts for every documentation page.
 *
 * Usage: include <script src="shared.js"></script> before </body>
 * Each page should have a <div id="livriko-sidebar"></div> placeholder
 * (or the script will inject before <main>, or append to <body>).
 */
(function () {
  'use strict';

  /* ================================================================
     1. PAGE DETECTION
     ================================================================ */

  /**
   * Extracts the current page filename from the URL.
   * Returns "index.html" when the URL points to a directory.
   */
  function getCurrentPage() {
    var path = window.location.pathname; // e.g. "/Documentation%20web/management-zones.html"
    var parts = path.split('/');
    var filename = parts[parts.length - 1];
    // If empty (directory listing), default to index.html
    return filename || 'index.html';
  }

  var currentPage = getCurrentPage();

  /* ================================================================
     2. PAGE → LABEL / SECTION MAPPING
     ================================================================ */

  /**
   * Each entry: { file: "filename.html", label: "Display Label" }
   * The section id (data-toggle target) is derived from the file prefix.
   * Special case: index.html has no section id (top-level link).
   */
  var navItems = [
    // --- Introduction (no collapsible section) ---
    { file: '../index.html',               label: 'Introduction',            section: null },

    // --- Laravel Configuration ---
    { file: 'laravel-prerequisites.html',  label: 'Prerequisites',           section: 'laravel' },
    { file: 'laravel-localhost.html',      label: 'Localhost Configuration', section: 'laravel' },
    { file: 'laravel-installation.html',   label: 'Installation Overview',   section: 'laravel' },
    { file: 'laravel-installation-gui.html', label: 'Installation GUI',      section: 'laravel' },
    { file: 'laravel-installation-cli.html', label: 'Installation CLI',      section: 'laravel' },

    // --- Deployment ---
    { file: 'deployment-overview.html',    label: 'Overview',                section: 'deployment' },
    { file: 'deployment-cpanel-gui.html',  label: 'cPanel GUI',             section: 'deployment' },
    { file: 'deployment-cpanel-cli.html',  label: 'cPanel CLI',             section: 'deployment' },
    { file: 'deployment-vps-apache.html',  label: 'VPS Apache',             section: 'deployment' },
    { file: 'deployment-vps-nginx.html',   label: 'VPS Nginx',              section: 'deployment' },

    // --- App Configuration ---
    { file: 'app-prerequisites.html',      label: 'Prerequisites',           section: 'app' },
    { file: 'app-installation.html',       label: 'Installation',            section: 'app' },
    { file: 'app-features.html',           label: 'Features',                section: 'app' },
    { file: 'app-android.html',            label: 'Android Setup',           section: 'app' },
    { file: 'app-ios.html',                label: 'iOS Setup',               section: 'app' },
    { file: 'app-create-user.html',        label: 'Create User App',         section: 'app' },
    { file: 'app-create-driver.html',      label: 'Create Driver App',       section: 'app' },
    { file: 'app-change-name.html',        label: 'Change App Name',         section: 'app' },
    { file: 'app-change-color.html',       label: 'Change App Color',        section: 'app' },
    { file: 'app-change-icon.html',        label: 'Change App Icon',         section: 'app' },
    { file: 'app-environment.html',        label: 'Environment URL',         section: 'app' },
    { file: 'app-folder-structure.html',   label: 'Folder Structure',        section: 'app' },
    { file: 'app-basic-setup.html',        label: 'Basic Setup',             section: 'app' },
    { file: 'app-build.html',              label: 'Build APK / AAB',         section: 'app' },
    { file: 'app-google-maps.html',        label: 'Google Maps',             section: 'app' },
    { file: 'app-services.html',           label: 'Service List',            section: 'app' },
    { file: 'app-vehicle-types.html',      label: 'Vehicle Types',           section: 'app' },
    { file: 'app-coupons.html',            label: 'Coupons',                 section: 'app' },
    { file: 'app-addons.html',             label: 'Add-Ons',                 section: 'app' },
    { file: 'app-ios-setup.html',          label: 'iOS Setup Detail',        section: 'app' },
    { file: 'app-ios-build.html',          label: 'iOS Build',               section: 'app' },

    // --- Payment Gateways ---
    { file: 'payment-overview.html',       label: 'Overview',                section: 'payment' },

    // --- Platform Settings ---
    { file: 'settings-languages.html',     label: 'Languages',               section: 'settings' },
    { file: 'settings-currencies.html',    label: 'Currencies',              section: 'settings' },
    { file: 'settings-taxes.html',         label: 'Taxes',                   section: 'settings' },
    { file: 'settings-sms.html',           label: 'SMS Gateways',            section: 'settings' },
    { file: 'settings-landing.html',       label: 'Landing Page',            section: 'settings' },
    { file: 'settings-system.html',        label: 'System Tools',            section: 'settings' },
    { file: 'settings-general.html',       label: 'Settings',                section: 'settings' },

    // --- Livriko Management ---
    { file: 'management-zones.html',       label: 'Zones',                   section: 'management' },
    { file: 'management-vehicle-types.html', label: 'Vehicle Types',         section: 'management' },
    { file: 'management-rental.html',      label: 'Rental Vehicles',         section: 'management' },
    { file: 'management-hourly.html',      label: 'Hourly Packages',         section: 'management' },
    { file: 'management-airports.html',    label: 'Airports',                section: 'management' },
    { file: 'management-surge.html',       label: 'Surge Pricing',           section: 'management' },
    { file: 'management-vehicle-zone.html', label: 'Vehicle Zone Pricing',   section: 'management' },
    { file: 'management-coupons.html',     label: 'Coupons',                 section: 'management' },
    { file: 'management-sos.html',         label: 'SOS',                     section: 'management' },
    { file: 'management-plans.html',       label: 'Plans',                   section: 'management' },
    { file: 'management-drivers.html',     label: 'Drivers',                 section: 'management' },
    { file: 'management-location.html',    label: 'Driver Location',         section: 'management' },
    { file: 'management-wallet.html',      label: 'Wallet',                  section: 'management' },
    { file: 'management-fleet.html',       label: 'Fleet Manager',           section: 'management' },
    { file: 'management-push.html',        label: 'Push Notifications',      section: 'management' },
    { file: 'management-templates.html',   label: 'Notification Templates',  section: 'management' },
    { file: 'management-settings.html',    label: 'App Settings',            section: 'management' },

    // --- Firebase ---
    { file: 'firebase-overview.html',      label: 'Overview',                section: 'firebase' },
    { file: 'firebase-create.html',        label: 'Create Project',          section: 'firebase' },
    { file: 'firebase-rules.html',         label: 'Rules',                   section: 'firebase' },
    { file: 'firebase-sha.html',           label: 'SHA Key',                 section: 'firebase' },
    { file: 'firebase-admin.html',         label: 'Connect Admin',           section: 'firebase' },
    { file: 'firebase-messaging.html',     label: 'Messaging',               section: 'firebase' },
    { file: 'firebase-social.html',        label: 'Social Login',            section: 'firebase' },
    { file: 'firebase-billing.html',       label: 'Billing',                 section: 'firebase' },
    { file: 'firebase-functions.html',     label: 'Cloud Functions',         section: 'firebase' },
    { file: 'firebase-collections.html',   label: 'Firestore Collections',   section: 'firebase' },

    // --- Troubleshooting ---
    { file: 'troubleshooting-app.html',    label: 'App Errors',              section: 'troubleshooting' },
    { file: 'troubleshooting-admin.html',  label: 'Admin Errors',            section: 'troubleshooting' },
    { file: 'troubleshooting-database.html', label: 'Database Upgrade',      section: 'troubleshooting' },
    { file: 'troubleshooting-update.html', label: 'Version Update',          section: 'troubleshooting' }
  ];

  /* ================================================================
     3. SECTION DEFINITIONS (order, icons, labels)
     ================================================================ */

  var sections = [
    { id: 'laravel',        label: 'Laravel Configuration',  icon: 'fab fa-laravel',          style: 'margin-right:6px;' },
    { id: 'deployment',     label: 'Deployment',             icon: 'fas fa-cloud-arrow-up',   style: 'margin-right:6px;' },
    { id: 'app',            label: 'App Configuration',      icon: 'fas fa-mobile-screen-button', style: 'margin-right:6px;' },
    { id: 'payment',        label: 'Payment Gateways',       icon: 'fas fa-credit-card',       style: 'margin-right:6px;' },
    { id: 'settings',       label: 'Platform Settings',      icon: 'fas fa-gear',              style: 'margin-right:6px;' },
    { id: 'management',     label: 'Livriko Management',     icon: 'fas fa-sliders',           style: 'margin-right:6px;' },
    { id: 'firebase',       label: 'Firebase',               icon: 'fas fa-fire',              style: 'margin-right:6px;' },
    { id: 'troubleshooting', label: 'Troubleshooting',       icon: 'fas fa-bug',               style: 'margin-right:6px;' }
  ];

  /* ================================================================
     4. LOGO PATH
     ================================================================ */

  var LOGO_PATH = '../livriko png 0.5x/Forme texte monochrome blanc@0.5x.png';

  /* ================================================================
     5. HTML GENERATION
     ================================================================ */

  /**
   * Returns the <a> tag for a single nav link.
   * Adds class "active" if this link matches the current page.
   */
  function buildNavLink(item) {
    // Compare just the filename, ignoring path prefix like ../
    var itemFile = item.file.replace('../', '');
    var isActive = itemFile === currentPage;
    var cls = 'nav-link' + (isActive ? ' active' : '');
    return '<a href="' + item.file + '" class="' + cls + '">' +
             '<i class="fas fa-circle"></i> ' + item.label +
           '</a>';
  }

  /**
   * Builds the full sidebar HTML, including:
   * - mobile-header
   * - sidebar-overlay
   * - aside.sidebar (header + nav + footer)
   */
  function buildSidebarHTML() {
    var html = '';

    /* ---------- Mobile header ---------- */
    html += '<div class="mobile-header">\n';
    html += '  <button class="hamburger" id="hamburgerBtn" aria-label="Toggle navigation">\n';
    html += '    <span></span>\n';
    html += '    <span></span>\n';
    html += '    <span></span>\n';
    html += '  </button>\n';
    html += '  <img src="' + LOGO_PATH + '" alt="Livriko" class="mobile-logo">\n';
    html += '</div>\n\n';

    /* ---------- Sidebar overlay ---------- */
    html += '<div class="sidebar-overlay" id="sidebarOverlay"></div>\n\n';

    /* ---------- Sidebar ---------- */
    html += '<aside class="sidebar" id="sidebar">\n';

    // -- Sidebar header (logo + search) --
    html += '  <div class="sidebar-header">\n';
    html += '    <div class="sidebar-logo">\n';
    html += '      <img src="' + LOGO_PATH + '" alt="Livriko">\n';
    html += '      <span>Docs</span>\n';
    html += '    </div>\n';
    html += '    <div class="sidebar-search">\n';
    html += '      <i class="fas fa-search"></i>\n';
    html += '      <input type="text" placeholder="Search documentation\u2026" aria-label="Search documentation">\n';
    html += '    </div>\n';
    html += '  </div>\n\n';

    // -- Navigation --
    html += '  <nav class="sidebar-nav" id="sidebarNav">\n\n';

    // --- Introduction (standalone link, no collapsible) ---
    var introItem = navItems[0]; // ../index.html
    var introActive = introItem.file.replace('../', '') === currentPage;
    html += '    <!-- Introduction -->\n';
    html += '    <div class="nav-section">\n';
    html += '      <a href="' + introItem.file + '" class="nav-link' + (introActive ? ' active' : '') + '">\n';
    html += '        <i class="fas fa-home"></i> Introduction\n';
    html += '      </a>\n';
    html += '    </div>\n\n';

    // --- Collapsible sections ---
    sections.forEach(function (sec) {
      // Collect nav items for this section
      var items = navItems.filter(function (n) { return n.section === sec.id; });

      // Determine if this section contains the active page
      var isActiveSection = items.some(function (n) { return n.file.replace('../', '') === currentPage; });

      // Build section links
      var linksHTML = '';
      items.forEach(function (item) {
        linksHTML += '          ' + buildNavLink(item) + '\n';
      });

      html += '    <!-- ' + sec.label + ' -->\n';
      html += '    <div class="nav-section">\n';
      html += '      <div class="nav-section-header" data-toggle="' + sec.id + '">\n';
      html += '        <span><i class="' + sec.icon + '" style="' + sec.style + '"></i> ' + sec.label + '</span>\n';
      html += '        <i class="fas fa-chevron-down chevron"></i>\n';
      html += '      </div>\n';
      html += '      <div class="nav-section-links" id="' + sec.id + '">\n';
      html += linksHTML;
      html += '      </div>\n';
      html += '    </div>\n\n';
    });

    html += '  </nav>\n\n';

    // -- Sidebar footer --
    html += '  <div class="sidebar-footer">\n';
    html += '    <p>Livriko v1.0 &middot; Based on <a href="#">Taxido</a></p>\n';
    html += '  </div>\n';
    html += '</aside>\n';

    return html;
  }

  /* ================================================================
     6. INJECT INTO THE DOM
     ================================================================ */

  function injectSidebar() {
    var placeholder = document.getElementById('livriko-sidebar');
    var mainTag = document.querySelector('main');
    var html = buildSidebarHTML();

    if (placeholder) {
      // Replace the placeholder div entirely with the generated HTML
      placeholder.outerHTML = html;
    } else if (mainTag) {
      // Insert before the first <main> element
      mainTag.insertAdjacentHTML('beforebegin', html);
    } else {
      // Last resort: append to body (before any existing children)
      document.body.insertAdjacentHTML('afterbegin', html);
    }
  }

  /**
   * Prepends the Livriko logo to every <footer class="footer"> on the page.
   */
  function injectFooterLogo() {
    var LOGO_FOOTER = '../livriko png 0.5x/Forme monochrome noir@0.5x.png';
    var footerHTML = '<img src="' + LOGO_FOOTER + '" alt="Livriko" class="footer-logo">';

    document.querySelectorAll('footer.footer').forEach(function (footer) {
      // Only inject once per footer
      if (!footer.querySelector('.footer-logo')) {
        footer.insertAdjacentHTML('afterbegin', footerHTML);
      }
    });
  }

  /* ================================================================
     7. INTERACTIVE SCRIPTS
     ================================================================ */

  function initScripts() {
    /* ---- Sidebar toggle (mobile hamburger) ---- */
    var hamburger = document.getElementById('hamburgerBtn');
    var sidebar   = document.getElementById('sidebar');
    var overlay   = document.getElementById('sidebarOverlay');

    if (hamburger && sidebar && overlay) {
      function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('active', 'visible');
        hamburger.classList.add('active');
      }
      function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('visible');
        hamburger.classList.remove('active');
        setTimeout(function () { overlay.classList.remove('active'); }, 300);
      }

      hamburger.addEventListener('click', function () {
        if (sidebar.classList.contains('open')) {
          closeSidebar();
        } else {
          openSidebar();
        }
      });
      overlay.addEventListener('click', closeSidebar);
    }

    /* ---- Collapsible nav sections ---- */
    document.querySelectorAll('.nav-section-header[data-toggle]').forEach(function (header) {
      header.addEventListener('click', function () {
        var section = header.closest('.nav-section');
        if (section) {
          section.classList.toggle('collapsed');
        }
      });
    });

    /* ---- Open the active section, collapse all others ---- */
    // After DOM is ready, expand the section that contains the active link
    // and collapse all other collapsible sections.
    (function () {
      var activeSectionId = null;

      // Find which section contains the active link
      var activeLink = document.querySelector('.nav-link.active');
      if (activeLink) {
        var parentLinks = activeLink.closest('.nav-section-links');
        if (parentLinks) {
          activeSectionId = parentLinks.id;
        }
      }

      // Collapse all sections, then expand the active one
      document.querySelectorAll('.nav-section').forEach(function (sec) {
        // Only operate on sections that have a collapsible header
        var header = sec.querySelector('.nav-section-header[data-toggle]');
        if (!header) return; // skip Introduction (no collapsible header)

        var linksContainer = sec.querySelector('.nav-section-links');
        if (!linksContainer) return;

        if (linksContainer.id === activeSectionId) {
          // This section should be expanded (remove collapsed class)
          sec.classList.remove('collapsed');
        } else {
          // This section should be collapsed
          sec.classList.add('collapsed');
        }
      });
    })();

    /* ---- Mark active link (in case it wasn't set at build time) ---- */
    document.querySelectorAll('.nav-link').forEach(function (link) {
      if (link.href === window.location.href) {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  }

  /* ================================================================
     8. INITIALIZATION
     ================================================================ */

  // Run as soon as DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      injectSidebar();
      injectFooterLogo();
      initScripts();
    });
  } else {
    // DOM already loaded (script in <head> with defer, or at end of body)
    injectSidebar();
    injectFooterLogo();
    initScripts();
  }

})();
