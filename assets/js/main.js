// Mobile menu toggle with accessibility
const mobileToggle = document.getElementById('mobileToggle');
const navMenu = document.getElementById('navMenu');

mobileToggle.addEventListener('click', function () {
    const isExpanded = this.getAttribute('aria-expanded') === 'true';

    this.setAttribute('aria-expanded', !isExpanded);
    this.classList.toggle('active');
    navMenu.classList.toggle('active');

    // Prevent body scroll when menu is open
    document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
});

// Close mobile menu when clicking outside
document.addEventListener('click', function (e) {
    if (!e.target.closest('.navbar') && navMenu.classList.contains('active')) {
        mobileToggle.click();
    }
});

// ACTIVE PAGE HIGHLIGHTING FUNCTION
function setActiveNavLink() {
    // Get current page URL
    const currentUrl = window.location.pathname;
    const currentPage = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);
    
    // Remove all active classes first
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    
    // Special handling for index.php or root
    if (currentPage === 'index.php' || currentPage === '' || currentUrl.endsWith('/')) {
        const homeLink = document.querySelector('.nav-link[href*="index.php"]');
        if (homeLink) {
            homeLink.classList.add('active');
        }
        return;
    }
    
    // Check each nav item and add active class if URL matches
    document.querySelectorAll('.nav-link').forEach(link => {
        const href = link.getAttribute('href');
        
        // Skip if href is not a proper URL (like #products)
        if (href.includes('#') || href === '#') return;
        
        // Extract filename from href
        const linkPage = href.substring(href.lastIndexOf('/') + 1);
        
        // Check if current page matches the nav link
        if (currentPage === linkPage) {
            link.classList.add('active');
        }
    });
    
    // Also check for dropdown items (sub-pages)
    document.querySelectorAll('.dropdown-item').forEach(link => {
        const href = link.getAttribute('href');
        if (href) {
            const linkPage = href.substring(href.lastIndexOf('/') + 1);
            if (currentPage === linkPage) {
                // Also highlight the parent dropdown
                const parentDropdown = link.closest('.dropdown').querySelector('.nav-link');
                if (parentDropdown) {
                    parentDropdown.classList.add('active');
                }
            }
        }
    });
}

// Call the function on page load
document.addEventListener('DOMContentLoaded', setActiveNavLink);

// Enhanced search functionality
const searchInput = document.getElementById('searchInput');
const searchBtn = document.querySelector('.search-btn');
const voiceBtn = document.querySelector('.voice-search');

let searchTimeout;

// Search suggestions data
const searchSuggestions = [
    'Organic Tomatoes', 'Fresh Spinach', 'Red Onions', 'Bell Peppers',
    'Organic Carrots', 'Fresh Lettuce', 'Cucumber', 'Broccoli',
    'Cauliflower', 'Organic Potatoes', 'Fresh Herbs', 'Ginger',
    'Garlic', 'Green Chilies', 'Organic Apples', 'Fresh Berries'
];

// Debounced search with suggestions
searchInput.addEventListener('input', function () {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        const value = this.value.trim();
        if (value.length > 2) {
            showSearchSuggestions(value);
        } else {
            hideSearchSuggestions();
        }
    }, 200);
});

// Search execution
function performSearch() {
    const searchTerm = searchInput.value.trim();
    if (!searchTerm) return;

    console.log('Searching for:', searchTerm);

    // Add loading state
    searchBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Searching...</span>';
    searchInput.classList.add('loading');

    // Simulate search API call
    setTimeout(() => {
        searchBtn.innerHTML = '<i class="fas fa-search"></i> <span>Search</span>';
        searchInput.classList.remove('loading');
        hideSearchSuggestions();

        // Show search results notification
        showNotification(`Found results for "${searchTerm}"`, 'success');
    }, 1000);
}

searchInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        performSearch();
    }
});

searchBtn.addEventListener('click', performSearch);

// Voice search functionality
voiceBtn.addEventListener('click', function () {
    if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
        showNotification('Voice search not supported in your browser', 'error');
        return;
    }

    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const recognition = new SpeechRecognition();

    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.lang = 'en-US';

    recognition.onstart = () => {
        this.innerHTML = '<i class="fas fa-stop" style="color: var(--danger);"></i>';
        this.setAttribute('aria-label', 'Stop voice search');
    };

    recognition.onresult = (event) => {
        const transcript = event.results[0][0].transcript;
        searchInput.value = transcript;
        searchInput.focus();

        if (event.results[0][0].confidence > 0.7) {
            setTimeout(performSearch, 500);
        }
    };

    recognition.onend = () => {
        this.innerHTML = '<i class="fas fa-microphone"></i>';
        this.setAttribute('aria-label', 'Start voice search');
    };

    recognition.onerror = () => {
        showNotification('Voice search error. Please try again.', 'error');
        this.innerHTML = '<i class="fas fa-microphone"></i>';
        this.setAttribute('aria-label', 'Start voice search');
    };

    recognition.start();
});

// Search suggestions UI
function showSearchSuggestions(query) {
    const suggestions = searchSuggestions.filter(item =>
        item.toLowerCase().includes(query.toLowerCase())
    ).slice(0, 6);

    if (suggestions.length === 0) return;

    let dropdown = document.querySelector('.search-suggestions');
    if (!dropdown) {
        dropdown = document.createElement('div');
        dropdown.className = 'search-suggestions';
        dropdown.setAttribute('role', 'listbox');
        document.querySelector('.search-bar').appendChild(dropdown);
    }

    dropdown.innerHTML = suggestions.map((suggestion, index) => `
                <div class="suggestion-item" 
                     role="option" 
                     data-value="${suggestion}"
                     aria-selected="false"
                     tabindex="-1">
                    <i class="fas fa-search"></i>
                    ${suggestion}
                </div>
            `).join('');

    // Add click handlers
    dropdown.querySelectorAll('.suggestion-item').forEach(item => {
        item.addEventListener('click', () => {
            searchInput.value = item.dataset.value;
            hideSearchSuggestions();
            performSearch();
        });
    });
}

function hideSearchSuggestions() {
    const dropdown = document.querySelector('.search-suggestions');
    if (dropdown) {
        dropdown.remove();
    }
}

// Close suggestions when clicking outside
document.addEventListener('click', function (e) {
    if (!e.target.closest('.search-bar')) {
        hideSearchSuggestions();
    }
});

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : 'var(--info)'};
                color: var(--white);
                padding: var(--space-4) var(--space-6);
                border-radius: var(--border-radius-md);
                box-shadow: var(--shadow-lg);
                z-index: 10000;
                transform: translateX(100%);
                transition: var(--transition-fast);
                max-width: 300px;
                font-size: 0.875rem;
                font-weight: 500;
            `;

    notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: var(--space-2);">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
                    <span>${message}</span>
                </div>
            `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 10);

    // Auto remove
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}

// Scroll behavior for navbar
let lastScrollY = window.scrollY;

window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    const currentScrollY = window.scrollY;

    if (currentScrollY > 100) {
        navbar.style.boxShadow = 'var(--shadow-md)';
    } else {
        navbar.style.boxShadow = 'var(--shadow-sm)';
    }

    lastScrollY = currentScrollY;
}, { passive: true });

// Cart interaction enhancement
document.querySelectorAll('.action-btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
        const count = this.querySelector('.cart-count, .wishlist-count');
        if (count && this.getAttribute('href').includes('cart') || this.getAttribute('href').includes('wishlist')) {
            e.preventDefault();

            // Animate count badge
            count.style.animation = 'none';
            setTimeout(() => {
                count.style.animation = 'pulse 0.6s ease-in-out';
            }, 10);

            const itemType = this.getAttribute('href').includes('cart') ? 'cart' : 'wishlist';
            showNotification(`Opening your ${itemType}...`, 'info');
        }
    });
});

// Keyboard shortcuts
document.addEventListener('keydown', function (e) {
    // Ctrl/Cmd + K for search focus
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        searchInput.focus();
        searchInput.select();
    }

    // Escape key handling
    if (e.key === 'Escape') {
        hideSearchSuggestions();
        searchInput.blur();

        if (navMenu.classList.contains('active')) {
            mobileToggle.click();
        }
    }
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function () {
    console.log('🌿 GreenAgro navbar initialized successfully!');
    setActiveNavLink(); // Call active link function on load
});

// Handle window resize
let resizeTimeout;
window.addEventListener('resize', function () {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        // Reset mobile menu state on larger screens
        if (window.innerWidth > 767 && navMenu.classList.contains('active')) {
            mobileToggle.click();
        }

        // Hide search suggestions on resize
        hideSearchSuggestions();
    }, 250);
});

// Performance monitoring (optional)
if ('performance' in window) {
    window.addEventListener('load', function () {
        setTimeout(() => {
            const perfData = performance.getEntriesByType('navigation')[0];
            if (perfData) {
                console.log('Navigation Performance:', {
                    'DOM Content Loaded': Math.round(perfData.domContentLoadedEventEnd - perfData.domContentLoadedEventStart),
                    'Load Complete': Math.round(perfData.loadEventEnd - perfData.loadEventStart)
                });
            }
        }, 0);
    });
}



// Support modal functions
function openSupportModal(event) {
  event.preventDefault();
  const modal = document.getElementById("supportModal");
  modal.classList.add("active");
  document.body.style.overflow = "hidden";
}

function closeSupportModal() {
  const modal = document.getElementById("supportModal");
  modal.classList.remove("active");
  document.body.style.overflow = "";
}

function contactSupport(type) {
  switch (type) {
    case "phone":
      window.location.href = "tel:+918511916407";
      break;
    case "whatsapp":
      window.open("https://wa.me/918511916407", "_blank");
      break;
    case "email":
      window.location.href = "mailto:hello@greenagro.com";
      break;
    case "chat":
      showNotification("Live chat will open shortly...", "info");
      break;
  }
  closeSupportModal();
}

function toggleLanguage(event) {
  event.preventDefault();
  showNotification("Language selection coming soon!", "info");
}

function showNotification(message, type = "success") {
  // Create a simple notification
  const notification = document.createElement("div");
  notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${
                  type === "success"
                    ? "#10b981"
                    : type === "error"
                    ? "#ef4444"
                    : "#3b82f6"
                };
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                z-index: 10001;
                font-size: 0.875rem;
                font-weight: 500;
            `;
  notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-${
                      type === "success"
                        ? "check-circle"
                        : type === "error"
                        ? "exclamation-triangle"
                        : "info-circle"
                    }"></i>
                    <span>${message}</span>
                </div>
            `;
  document.body.appendChild(notification);

  // Remove after 3 seconds
  setTimeout(() => {
    notification.remove();
  }, 3000);
}