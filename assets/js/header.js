// // Assets/js/header.js
// // Enhanced announcement bar close functionality
// function closeAnnouncement() {
//   const announcement = document.getElementById("announcement");
//   announcement.style.transform = "translateY(-100%)";
//   announcement.style.opacity = "0";
//   setTimeout(() => {
//     announcement.style.display = "none";
//   }, 300);
// }

// // Mobile menu toggle with accessibility
// const mobileToggle = document.getElementById("mobileToggle");
// const navMenu = document.getElementById("navMenu");

// mobileToggle.addEventListener("click", function () {
//   const isExpanded = this.getAttribute("aria-expanded") === "true";

//   this.setAttribute("aria-expanded", !isExpanded);
//   this.classList.toggle("active");
//   navMenu.classList.toggle("active");

//   // Prevent body scroll when menu is open
//   document.body.style.overflow = navMenu.classList.contains("active")
//     ? "hidden"
//     : "";
// });

// // Close mobile menu when clicking outside
// document.addEventListener("click", function (e) {
//   if (!e.target.closest(".navbar") && navMenu.classList.contains("active")) {
//     mobileToggle.click();
//   }
// });

// // Enhanced search functionality
// const searchInput = document.getElementById("searchInput");
// const searchBtn = document.querySelector(".search-btn");
// const voiceBtn = document.querySelector(".voice-search");

// let searchTimeout;

// // Search suggestions data
// const searchSuggestions = [
//   "Tomato Seeds",
//   "Organic Fertilizer",
//   "Drip Irrigation Kit",
//   "Wheat Seeds",
//   "Pesticide Spray",
//   "GreenAgro Tools",
//   "Crop Planning Software",
//   "Soil Testing Kit",
// ];

// // Debounced search with suggestions
// searchInput.addEventListener("input", function () {
//   clearTimeout(searchTimeout);
//   searchTimeout = setTimeout(() => {
//     const value = this.value.trim();
//     if (value.length > 2) {
//       showSearchSuggestions(value);
//     } else {
//       hideSearchSuggestions();
//     }
//   }, 200);
// });

// // Search execution
// function performSearch() {
//   const searchTerm = searchInput.value.trim();
//   if (!searchTerm) return;

//   console.log("Searching for:", searchTerm);

//   // Add loading state
//   searchBtn.innerHTML =
//     '<i class="fas fa-spinner fa-spin"></i> <span>Searching...</span>';
//   searchInput.classList.add("loading");

//   // Simulate search API call
//   setTimeout(() => {
//     searchBtn.innerHTML = '<i class="fas fa-search"></i> <span>Search</span>';
//     searchInput.classList.remove("loading");
//     hideSearchSuggestions();

//     // Show search results notification
//     showNotification(`Found results for "${searchTerm}"`, "success");
//   }, 1000);
// }

// searchInput.addEventListener("keypress", function (e) {
//   if (e.key === "Enter") {
//     e.preventDefault();
//     performSearch();
//   }
// });

// searchBtn.addEventListener("click", performSearch);

// // Voice search functionality
// voiceBtn.addEventListener("click", function () {
//   if (
//     !("webkitSpeechRecognition" in window) &&
//     !("SpeechRecognition" in window)
//   ) {
//     showNotification("Voice search not supported in your browser", "error");
//     return;
//   }

//   const SpeechRecognition =
//     window.SpeechRecognition || window.webkitSpeechRecognition;
//   const recognition = new SpeechRecognition();

//   recognition.continuous = false;
//   recognition.interimResults = false;
//   recognition.lang = "en-US";

//   recognition.onstart = () => {
//     this.innerHTML =
//       '<i class="fas fa-stop" style="color: var(--danger);"></i>';
//     this.setAttribute("aria-label", "Stop voice search");
//   };

//   recognition.onresult = (event) => {
//     const transcript = event.results[0][0].transcript;
//     searchInput.value = transcript;
//     searchInput.focus();

//     if (event.results[0][0].confidence > 0.7) {
//       setTimeout(performSearch, 500);
//     }
//   };

//   recognition.onend = () => {
//     this.innerHTML = '<i class="fas fa-microphone"></i>';
//     this.setAttribute("aria-label", "Start voice search");
//   };

//   recognition.onerror = () => {
//     showNotification("Voice search error. Please try again.", "error");
//     this.innerHTML = '<i class="fas fa-microphone"></i>';
//     this.setAttribute("aria-label", "Start voice search");
//   };

//   recognition.start();
// });

// // Search suggestions UI
// function showSearchSuggestions(query) {
//   const suggestions = searchSuggestions
//     .filter((item) => item.toLowerCase().includes(query.toLowerCase()))
//     .slice(0, 6);

//   if (suggestions.length === 0) return;

//   let dropdown = document.querySelector(".search-suggestions");
//   if (!dropdown) {
//     dropdown = document.createElement("div");
//     dropdown.className = "search-suggestions";
//     dropdown.setAttribute("role", "listbox");
//     document.querySelector(".search-bar").appendChild(dropdown);
//   }

//   dropdown.innerHTML = suggestions
//     .map(
//       (suggestion, index) => `
//                 <div class="suggestion-item" 
//                      role="option" 
//                      data-value="${suggestion}"
//                      aria-selected="false"
//                      tabindex="-1">
//                     <i class="fas fa-search"></i>
//                     ${suggestion}
//                 </div>
//             `
//     )
//     .join("");

//   // Add click handlers
//   dropdown.querySelectorAll(".suggestion-item").forEach((item) => {
//     item.addEventListener("click", () => {
//       searchInput.value = item.dataset.value;
//       hideSearchSuggestions();
//       performSearch();
//     });
//   });
// }

// function hideSearchSuggestions() {
//   const dropdown = document.querySelector(".search-suggestions");
//   if (dropdown) {
//     dropdown.remove();
//   }
// }

// // Close suggestions when clicking outside
// document.addEventListener("click", function (e) {
//   if (!e.target.closest(".search-bar")) {
//     hideSearchSuggestions();
//   }
// });

// // Notification system
// function showNotification(message, type = "info") {
//   const notification = document.createElement("div");
//   notification.style.cssText = `
//                 position: fixed;
//                 top: 20px;
//                 right: 20px;
//                 background: ${
//                   type === "success"
//                     ? "var(--success)"
//                     : type === "error"
//                     ? "var(--danger)"
//                     : "var(--info)"
//                 };
//                 color: var(--white);
//                 padding: var(--space-4) var(--space-6);
//                 border-radius: var(--border-radius-md);
//                 box-shadow: var(--shadow-lg);
//                 z-index: 10000;
//                 transform: translateX(100%);
//                 transition: var(--transition-fast);
//                 max-width: 300px;
//                 font-size: 0.875rem;
//                 font-weight: 500;
//             `;

//   notification.innerHTML = `
//                 <div style="display: flex; align-items: center; gap: var(--space-2);">
//                     <i class="fas fa-${
//                       type === "success"
//                         ? "check-circle"
//                         : type === "error"
//                         ? "exclamation-triangle"
//                         : "info-circle"
//                     }"></i>
//                     <span>${message}</span>
//                 </div>
//             `;

//   document.body.appendChild(notification);

//   // Animate in
//   setTimeout(() => {
//     notification.style.transform = "translateX(0)";
//   }, 10);

//   // Auto remove
//   setTimeout(() => {
//     notification.style.transform = "translateX(100%)";
//     setTimeout(() => notification.remove(), 300);
//   }, 4000);
// }

// // Scroll behavior for navbar
// let lastScrollY = window.scrollY;

// window.addEventListener(
//   "scroll",
//   () => {
//     const navbar = document.getElementById("navbar");
//     const currentScrollY = window.scrollY;

//     if (currentScrollY > 100) {
//       navbar.style.boxShadow = "var(--shadow-md)";
//     } else {
//       navbar.style.boxShadow = "var(--shadow-sm)";
//     }

//     lastScrollY = currentScrollY;
//   },
//   {
//     passive: true,
//   }
// );

// // Cart interaction enhancement
// document.querySelectorAll(".action-btn").forEach((btn) => {
//   btn.addEventListener("click", function (e) {
//     const count = this.querySelector(".cart-count, .wishlist-count");
//     if (
//       (count && this.getAttribute("href").includes("cart")) ||
//       this.getAttribute("href").includes("wishlist")
//     ) {
//       e.preventDefault();

//       // Animate count badge
//       count.style.animation = "none";
//       setTimeout(() => {
//         count.style.animation = "pulse 0.6s ease-in-out";
//       }, 10);

//       const itemType = this.getAttribute("href").includes("cart")
//         ? "cart"
//         : "wishlist";
//       showNotification(`Opening your ${itemType}...`, "info");
//     }
//   });
// });

// // Initialize on page load
// document.addEventListener("DOMContentLoaded", function () {
//   console.log("🌿 GreenAgro header initialized successfully!");

//   // Auto-hide announcement after 15 seconds
//   setTimeout(() => {
//     const announcement = document.getElementById("announcement");
//     if (announcement && announcement.style.display !== "none") {
//       announcement.style.opacity = "0.8";
//     }
//   }, 15000);
// });

// // Handle window resize
// let resizeTimeout;
// window.addEventListener("resize", function () {
//   clearTimeout(resizeTimeout);
//   resizeTimeout = setTimeout(() => {
//     // Reset mobile menu state on larger screens
//     if (window.innerWidth > 1023 && navMenu.classList.contains("active")) {
//       mobileToggle.click();
//     }

//     // Hide search suggestions on resize
//     hideSearchSuggestions();
//   }, 250);
// });

// // Your complete JSON data
// const productData = {
//   categories: [
//     {
//       id: 1,
//       name: "All",
//       subcategories: [],
//     },
//     {
//       id: 2,
//       name: "Seeds",
//       subcategories: [
//         {
//           id: 201,
//           name: "Vegetable Seeds",
//           products: [
//             {
//               id: 20101,
//               name: "Tomato Seeds",
//               images: [
//                 "./Assets/imagess/tomato1.jpg",
//                 "./Assets/imagess/tomato2.jpg",
//               ],
//               MRP: 120,
//               OFFER_PRICE: 95,
//               choose_weight: ["50g", "100g", "250g", "500g", "1kg"],
//               product_description:
//                 "High-yield tomato seeds with excellent disease resistance. Perfect for home gardens and commercial GreenAgroing.",
//               key_points: [
//                 "High germination rate",
//                 "Disease resistant",
//                 "Suitable for all seasons",
//                 "Fast growing",
//               ],
//             },
//             {
//               id: 20102,
//               name: "Brinjal (Eggplant) Seeds",
//               images: [
//                 "./Assets/imagess/brinjal1.jpg",
//                 "./Assets/imagess/brinjal2.jpg",
//               ],
//               MRP: 110,
//               OFFER_PRICE: 85,
//               choose_weight: ["50g", "100g", "250g", "500g"],
//               product_description:
//                 "Premium brinjal seeds that produce high-quality, shiny purple eggplants.",
//               key_points: [
//                 "Long fruiting season",
//                 "High yield potential",
//                 "Drought tolerant",
//                 "Rich in nutrients",
//               ],
//             },
//             {
//               id: 20103,
//               name: "Chilli Seeds",
//               images: ["chilli1.jpg", "chilli2.jpg"],
//               MRP: 90,
//               OFFER_PRICE: 70,
//               choose_weight: ["25g", "50g", "100g", "250g"],
//               product_description:
//                 "Spicy chilli seeds perfect for Indian cooking and commercial cultivation.",
//               key_points: [
//                 "High pungency level",
//                 "Early maturing",
//                 "Disease resistant",
//                 "Suitable for drying",
//               ],
//             },
//             {
//               id: 20104,
//               name: "Capsicum (Bell Pepper) Seeds",
//               images: ["capsicum1.jpg", "capsicum2.jpg"],
//               MRP: 130,
//               OFFER_PRICE: 105,
//               choose_weight: ["25g", "50g", "100g", "250g"],
//               product_description:
//                 "Colorful bell pepper seeds for sweet and crunchy peppers.",
//               key_points: [
//                 "Multiple colors",
//                 "Sweet flavor",
//                 "High yield",
//                 "Disease resistant",
//               ],
//             },
//             {
//               id: 20105,
//               name: "Cabbage Seeds",
//               images: ["cabbage1.jpg", "cabbage2.jpg"],
//               MRP: 80,
//               OFFER_PRICE: 65,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Compact cabbage seeds for dense and firm heads.",
//               key_points: [
//                 "Compact heads",
//                 "Good storage life",
//                 "High yield",
//                 "Winter season",
//               ],
//             },
//             {
//               id: 20106,
//               name: "Cauliflower Seeds",
//               images: ["cauliflower1.jpg", "cauliflower2.jpg"],
//               MRP: 85,
//               OFFER_PRICE: 68,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Premium cauliflower seeds for white and compact curds.",
//               key_points: [
//                 "White curds",
//                 "Compact size",
//                 "Winter crop",
//                 "High quality",
//               ],
//             },
//             {
//               id: 20107,
//               name: "Carrot Seeds",
//               images: ["carrot1.jpg", "carrot2.jpg"],
//               MRP: 75,
//               OFFER_PRICE: 60,
//               choose_weight: ["25g", "50g", "100g", "250g"],
//               product_description:
//                 "Sweet and crunchy carrot seeds with excellent root formation.",
//               key_points: [
//                 "Sweet flavor",
//                 "Deep orange color",
//                 "Uniform roots",
//                 "Rich in vitamins",
//               ],
//             },
//             {
//               id: 20108,
//               name: "Beetroot Seeds",
//               images: ["beetroot1.jpg", "beetroot2.jpg"],
//               MRP: 70,
//               OFFER_PRICE: 55,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Deep red beetroot seeds with high nutritional value.",
//               key_points: [
//                 "Deep red color",
//                 "High iron content",
//                 "Easy to grow",
//                 "Dual purpose",
//               ],
//             },
//             {
//               id: 20109,
//               name: "Onion Seeds",
//               images: ["onion1.jpg", "onion2.jpg"],
//               MRP: 95,
//               OFFER_PRICE: 75,
//               choose_weight: ["25g", "50g", "100g", "250g"],
//               product_description: "High-yielding onion seeds for large bulbs.",
//               key_points: [
//                 "Large bulbs",
//                 "Good storage",
//                 "High yield",
//                 "All season",
//               ],
//             },
//             {
//               id: 20110,
//               name: "Spinach Seeds",
//               images: ["spinach1.jpg", "spinach2.jpg"],
//               MRP: 65,
//               OFFER_PRICE: 50,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Nutrient-rich spinach seeds for leafy greens.",
//               key_points: [
//                 "High iron content",
//                 "Fast growing",
//                 "Multiple cuttings",
//                 "Winter crop",
//               ],
//             },
//             {
//               id: 20111,
//               name: "Coriander Seeds",
//               images: ["coriander1.jpg", "coriander2.jpg"],
//               MRP: 60,
//               OFFER_PRICE: 45,
//               choose_weight: ["25g", "50g", "100g", "250g"],
//               product_description:
//                 "Aromatic coriander seeds for fresh herbs and spices.",
//               key_points: [
//                 "Strong aroma",
//                 "Dual purpose",
//                 "Fast growing",
//                 "Cool season",
//               ],
//             },
//             {
//               id: 20112,
//               name: "Okra (Lady Finger) Seeds",
//               images: ["okra1.jpg", "okra2.jpg"],
//               MRP: 85,
//               OFFER_PRICE: 65,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "High-yield okra seeds for continuous harvesting.",
//               key_points: [
//                 "Continuous yield",
//                 "Heat tolerant",
//                 "Long pods",
//                 "Summer crop",
//               ],
//             },
//             {
//               id: 20113,
//               name: "Bottle Gourd Seeds",
//               images: ["bottle_gourd1.jpg", "bottle_gourd2.jpg"],
//               MRP: 80,
//               OFFER_PRICE: 62,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Long and straight bottle gourd seeds for summer vegetables.",
//               key_points: [
//                 "Long fruits",
//                 "High yield",
//                 "Summer vegetable",
//                 "Climbing habit",
//               ],
//             },
//             {
//               id: 20114,
//               name: "Bitter Gourd Seeds",
//               images: ["bitter_gourd1.jpg", "bitter_gourd2.jpg"],
//               MRP: 90,
//               OFFER_PRICE: 70,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Medicinal bitter gourd seeds with high nutritional value.",
//               key_points: [
//                 "Medicinal properties",
//                 "High yield",
//                 "Summer crop",
//                 "Diabetes friendly",
//               ],
//             },
//             {
//               id: 20115,
//               name: "Ridge Gourd Seeds",
//               images: ["ridge_gourd1.jpg", "ridge_gourd2.jpg"],
//               MRP: 75,
//               OFFER_PRICE: 58,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Ridged gourd seeds for unique textured vegetables.",
//               key_points: [
//                 "Unique texture",
//                 "High yield",
//                 "Summer vegetable",
//                 "Climbing habit",
//               ],
//             },
//             {
//               id: 20116,
//               name: "Cucumber Seeds",
//               images: ["cucumber1.jpg", "cucumber2.jpg"],
//               MRP: 95,
//               OFFER_PRICE: 75,
//               choose_weight: ["25g", "50g", "100g", "250g"],
//               product_description:
//                 "Crisp cucumber seeds for salads and pickles.",
//               key_points: [
//                 "Crisp texture",
//                 "High yield",
//                 "Summer crop",
//                 "Multiple uses",
//               ],
//             },
//             {
//               id: 20117,
//               name: "Pumpkin Seeds",
//               images: ["pumpkin1.jpg", "pumpkin2.jpg"],
//               MRP: 110,
//               OFFER_PRICE: 85,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Large pumpkin seeds for big fruits and edible seeds.",
//               key_points: [
//                 "Large fruits",
//                 "Edible seeds",
//                 "Long storage",
//                 "Winter vegetable",
//               ],
//             },
//             {
//               id: 20118,
//               name: "Peas Seeds",
//               images: ["peas1.jpg", "peas2.jpg"],
//               MRP: 100,
//               OFFER_PRICE: 80,
//               choose_weight: ["100g", "250g", "500g", "1kg"],
//               product_description: "Sweet pea seeds for fresh peas and pods.",
//               key_points: [
//                 "Sweet flavor",
//                 "Winter crop",
//                 "High yield",
//                 "Climbing habit",
//               ],
//             },
//             {
//               id: 20119,
//               name: "Beans Seeds",
//               images: ["beans1.jpg", "beans2.jpg"],
//               MRP: 85,
//               OFFER_PRICE: 65,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Green bean seeds for tender pods and beans.",
//               key_points: [
//                 "Tender pods",
//                 "High yield",
//                 "All season",
//                 "Bush type",
//               ],
//             },
//             {
//               id: 20120,
//               name: "Radish Seeds",
//               images: ["radish1.jpg", "radish2.jpg"],
//               MRP: 70,
//               OFFER_PRICE: 55,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Fast-growing radish seeds for quick harvest.",
//               key_points: [
//                 "Fast growing",
//                 "Cool season",
//                 "Crisp texture",
//                 "High yield",
//               ],
//             },
//           ],
//         },
//         {
//           id: 202,
//           name: "Fruit Seeds",
//           products: [
//             {
//               id: 20201,
//               name: "Watermelon Seeds",
//               images: ["watermelon1.jpg", "watermelon2.jpg"],
//               MRP: 180,
//               OFFER_PRICE: 150,
//               choose_weight: ["100g", "250g", "500g", "1kg"],
//               product_description:
//                 "Sweet and juicy watermelon seeds for large, delicious fruits.",
//               key_points: [
//                 "Sweet and juicy",
//                 "Large fruit size",
//                 "High yield",
//                 "Summer season crop",
//               ],
//             },
//             {
//               id: 20202,
//               name: "Muskmelon Seeds",
//               images: ["muskmelon1.jpg", "muskmelon2.jpg"],
//               MRP: 160,
//               OFFER_PRICE: 130,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Aromatic muskmelon seeds with excellent flavor and texture.",
//               key_points: [
//                 "Sweet aroma",
//                 "High sugar content",
//                 "Early maturing",
//                 "Good shelf life",
//               ],
//             },
//             {
//               id: 20203,
//               name: "Papaya Seeds",
//               images: ["papaya1.jpg", "papaya2.jpg"],
//               MRP: 140,
//               OFFER_PRICE: 115,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Tropical papaya seeds for sweet and nutritious fruits.",
//               key_points: [
//                 "Tropical fruit",
//                 "High vitamin C",
//                 "Fast growing",
//                 "Year-round fruiting",
//               ],
//             },
//             {
//               id: 20204,
//               name: "Strawberry Seeds",
//               images: ["strawberry1.jpg", "strawberry2.jpg"],
//               MRP: 200,
//               OFFER_PRICE: 165,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Sweet strawberry seeds for delicious red berries.",
//               key_points: [
//                 "Sweet flavor",
//                 "Rich in antioxidants",
//                 "Cool climate",
//                 "Container friendly",
//               ],
//             },
//             {
//               id: 20205,
//               name: "Guava Seeds",
//               images: ["guava1.jpg", "guava2.jpg"],
//               MRP: 120,
//               OFFER_PRICE: 95,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Tropical guava seeds for vitamin C rich fruits.",
//               key_points: [
//                 "High vitamin C",
//                 "Tropical fruit",
//                 "Year-round",
//                 "Disease resistant",
//               ],
//             },
//             {
//               id: 20206,
//               name: "Pomegranate Seeds",
//               images: ["pomegranate1.jpg", "pomegranate2.jpg"],
//               MRP: 150,
//               OFFER_PRICE: 120,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Ruby red pomegranate seeds for antioxidant-rich fruits.",
//               key_points: [
//                 "Antioxidant rich",
//                 "Ruby red arils",
//                 "Medicinal value",
//                 "Drought tolerant",
//               ],
//             },
//             {
//               id: 20207,
//               name: "Lemon Seeds",
//               images: ["lemon1.jpg", "lemon2.jpg"],
//               MRP: 110,
//               OFFER_PRICE: 85,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Citrus lemon seeds for tangy and vitamin C rich fruits.",
//               key_points: [
//                 "High vitamin C",
//                 "Tangy flavor",
//                 "Year-round",
//                 "Medicinal uses",
//               ],
//             },
//             {
//               id: 20208,
//               name: "Mango Seeds",
//               images: ["mango1.jpg", "mango2.jpg"],
//               MRP: 130,
//               OFFER_PRICE: 105,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "King of fruits mango seeds for sweet and juicy fruits.",
//               key_points: [
//                 "Sweet flavor",
//                 "Summer fruit",
//                 "Variety available",
//                 "High yield",
//               ],
//             },
//             {
//               id: 20209,
//               name: "Apple Seeds",
//               images: ["apple1.jpg", "apple2.jpg"],
//               MRP: 170,
//               OFFER_PRICE: 140,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Temperate apple seeds for crisp and sweet fruits.",
//               key_points: [
//                 "Crisp texture",
//                 "Cool climate",
//                 "Long storage",
//                 "High demand",
//               ],
//             },
//             {
//               id: 20210,
//               name: "Dragon Fruit Seeds",
//               images: ["dragon_fruit1.jpg", "dragon_fruit2.jpg"],
//               MRP: 250,
//               OFFER_PRICE: 200,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Exotic dragon fruit seeds for unique tropical fruits.",
//               key_points: [
//                 "Exotic fruit",
//                 "High antioxidant",
//                 "Climbing cactus",
//                 "Tropical climate",
//               ],
//             },
//           ],
//         },
//         {
//           id: 203,
//           name: "Flower Seeds",
//           products: [
//             {
//               id: 20301,
//               name: "Marigold Seeds",
//               images: ["marigold1.jpg", "marigold2.jpg"],
//               MRP: 60,
//               OFFER_PRICE: 45,
//               choose_weight: ["25g", "50g", "100g", "250g"],
//               product_description:
//                 "Bright and vibrant marigold seeds for beautiful garden flowers.",
//               key_points: [
//                 "Bright colors",
//                 "Long flowering season",
//                 "Easy to grow",
//                 "Pest repellent properties",
//               ],
//             },
//             {
//               id: 20302,
//               name: "Sunflower Seeds",
//               images: ["sunflower1.jpg", "sunflower2.jpg"],
//               MRP: 80,
//               OFFER_PRICE: 65,
//               choose_weight: ["50g", "100g", "250g", "500g"],
//               product_description:
//                 "Tall sunflower seeds for large yellow blooms and edible seeds.",
//               key_points: [
//                 "Large blooms",
//                 "Edible seeds",
//                 "Fast growing",
//                 "Bird attractant",
//               ],
//             },
//             {
//               id: 20303,
//               name: "Rose Seeds",
//               images: ["rose1.jpg", "rose2.jpg"],
//               MRP: 120,
//               OFFER_PRICE: 95,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Fragrant rose seeds for beautiful and aromatic flowers.",
//               key_points: [
//                 "Fragrant flowers",
//                 "Multiple colors",
//                 "Perennial",
//                 "Cut flowers",
//               ],
//             },
//             {
//               id: 20304,
//               name: "Zinnia Seeds",
//               images: ["zinnia1.jpg", "zinnia2.jpg"],
//               MRP: 70,
//               OFFER_PRICE: 55,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Colorful zinnia seeds for long-lasting cut flowers.",
//               key_points: [
//                 "Vibrant colors",
//                 "Long lasting",
//                 "Butterfly attractant",
//                 "Summer bloomer",
//               ],
//             },
//             {
//               id: 20305,
//               name: "Petunia Seeds",
//               images: ["petunia1.jpg", "petunia2.jpg"],
//               MRP: 85,
//               OFFER_PRICE: 68,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Trailing petunia seeds for hanging baskets and containers.",
//               key_points: [
//                 "Trailing habit",
//                 "Multiple colors",
//                 "Long flowering",
//                 "Container friendly",
//               ],
//             },
//             {
//               id: 20306,
//               name: "Dahlia Seeds",
//               images: ["dahlia1.jpg", "dahlia2.jpg"],
//               MRP: 150,
//               OFFER_PRICE: 120,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Showy dahlia seeds for large and colorful blooms.",
//               key_points: [
//                 "Large blooms",
//                 "Multiple forms",
//                 "Cut flowers",
//                 "Summer to fall",
//               ],
//             },
//             {
//               id: 20307,
//               name: "Cosmos Seeds",
//               images: ["cosmos1.jpg", "cosmos2.jpg"],
//               MRP: 65,
//               OFFER_PRICE: 50,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Feathery cosmos seeds for delicate and airy flowers.",
//               key_points: [
//                 "Feathery foliage",
//                 "Drought tolerant",
//                 "Butterfly friendly",
//                 "Easy to grow",
//               ],
//             },
//             {
//               id: 20308,
//               name: "Hibiscus Seeds",
//               images: ["hibiscus1.jpg", "hibiscus2.jpg"],
//               MRP: 90,
//               OFFER_PRICE: 72,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Tropical hibiscus seeds for large colorful flowers.",
//               key_points: [
//                 "Large flowers",
//                 "Tropical look",
//                 "Medicinal uses",
//                 "Perennial",
//               ],
//             },
//             {
//               id: 20309,
//               name: "Chrysanthemum Seeds",
//               images: ["chrysanthemum1.jpg", "chrysanthemum2.jpg"],
//               MRP: 95,
//               OFFER_PRICE: 75,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Fall-blooming chrysanthemum seeds for autumn color.",
//               key_points: [
//                 "Fall bloomer",
//                 "Multiple colors",
//                 "Cut flowers",
//                 "Perennial",
//               ],
//             },
//             {
//               id: 20310,
//               name: "Jasmine Seeds",
//               images: ["jasmine1.jpg", "jasmine2.jpg"],
//               MRP: 110,
//               OFFER_PRICE: 85,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Fragrant jasmine seeds for aromatic flowers and teas.",
//               key_points: [
//                 "Highly fragrant",
//                 "Medicinal uses",
//                 "Climbing habit",
//                 "Night blooming",
//               ],
//             },
//           ],
//         },
//         {
//           id: 204,
//           name: "Herbal Seeds",
//           products: [
//             {
//               id: 20401,
//               name: "Tulsi (Holy Basil) Seeds",
//               images: ["tulsi1.jpg", "tulsi2.jpg"],
//               MRP: 80,
//               OFFER_PRICE: 60,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Sacred tulsi seeds with medicinal properties and religious significance.",
//               key_points: [
//                 "Medicinal properties",
//                 "Aromatic leaves",
//                 "Easy to grow",
//                 "Perennial plant",
//               ],
//             },
//             {
//               id: 20402,
//               name: "Aloe Vera Seeds",
//               images: ["aloe_vera1.jpg", "aloe_vera2.jpg"],
//               MRP: 95,
//               OFFER_PRICE: 75,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Medicinal aloe vera seeds for skin care and health benefits.",
//               key_points: [
//                 "Medicinal gel",
//                 "Skin care",
//                 "Drought tolerant",
//                 "Easy to grow",
//               ],
//             },
//             {
//               id: 20403,
//               name: "Lemongrass Seeds",
//               images: ["lemongrass1.jpg", "lemongrass2.jpg"],
//               MRP: 85,
//               OFFER_PRICE: 65,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Aromatic lemongrass seeds for tea and culinary uses.",
//               key_points: [
//                 "Citrus aroma",
//                 "Culinary uses",
//                 "Mosquito repellent",
//                 "Perennial grass",
//               ],
//             },
//             {
//               id: 20404,
//               name: "Mint Seeds",
//               images: ["mint1.jpg", "mint2.jpg"],
//               MRP: 70,
//               OFFER_PRICE: 55,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Refreshing mint seeds for teas and culinary applications.",
//               key_points: [
//                 "Refreshing flavor",
//                 "Fast spreading",
//                 "Culinary uses",
//                 "Medicinal properties",
//               ],
//             },
//             {
//               id: 20405,
//               name: "Ashwagandha Seeds",
//               images: ["ashwagandha1.jpg", "ashwagandha2.jpg"],
//               MRP: 120,
//               OFFER_PRICE: 95,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Ayurvedic ashwagandha seeds for stress relief and vitality.",
//               key_points: [
//                 "Ayurvedic herb",
//                 "Stress relief",
//                 "Medicinal roots",
//                 "Adaptogenic properties",
//               ],
//             },
//             {
//               id: 20406,
//               name: "Giloy Seeds",
//               images: ["giloy1.jpg", "giloy2.jpg"],
//               MRP: 110,
//               OFFER_PRICE: 85,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Immunity-boosting giloy seeds for traditional medicine.",
//               key_points: [
//                 "Immunity booster",
//                 "Climbing vine",
//                 "Medicinal uses",
//                 "Ayurvedic herb",
//               ],
//             },
//             {
//               id: 20407,
//               name: "Stevia Seeds",
//               images: ["stevia1.jpg", "stevia2.jpg"],
//               MRP: 130,
//               OFFER_PRICE: 105,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Natural sweetener stevia seeds for sugar substitute.",
//               key_points: [
//                 "Natural sweetener",
//                 "Zero calories",
//                 "Diabetes friendly",
//                 "Easy to grow",
//               ],
//             },
//             {
//               id: 20408,
//               name: "Bhringraj Seeds",
//               images: ["bhringraj1.jpg", "bhringraj2.jpg"],
//               MRP: 90,
//               OFFER_PRICE: 70,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Hair care bhringraj seeds for traditional hair treatments.",
//               key_points: [
//                 "Hair care",
//                 "Ayurvedic herb",
//                 "Medicinal uses",
//                 "Easy to cultivate",
//               ],
//             },
//             {
//               id: 20409,
//               name: "Curry Leaf Seeds",
//               images: ["curry_leaf1.jpg", "curry_leaf2.jpg"],
//               MRP: 100,
//               OFFER_PRICE: 80,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Aromatic curry leaf seeds for Indian cooking.",
//               key_points: [
//                 "Aromatic leaves",
//                 "Culinary uses",
//                 "Perennial tree",
//                 "Easy to grow",
//               ],
//             },
//             {
//               id: 20410,
//               name: "Neem Seeds",
//               images: ["neem1.jpg", "neem2.jpg"],
//               MRP: 85,
//               OFFER_PRICE: 65,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Medicinal neem seeds for natural pesticides and health benefits.",
//               key_points: [
//                 "Natural pesticide",
//                 "Medicinal properties",
//                 "Hardy tree",
//                 "Multiple uses",
//               ],
//             },
//           ],
//         },
//         {
//           id: 205,
//           name: "Organic Seeds",
//           products: [
//             {
//               id: 20501,
//               name: "Organic Tomato Seeds",
//               images: ["org_tomato1.jpg", "org_tomato2.jpg"],
//               MRP: 150,
//               OFFER_PRICE: 120,
//               choose_weight: ["50g", "100g", "250g", "500g"],
//               product_description:
//                 "Certified organic tomato seeds grown without synthetic pesticides.",
//               key_points: [
//                 "100% organic",
//                 "No chemical treatment",
//                 "Non-GMO",
//                 "Rich flavor",
//               ],
//             },
//             {
//               id: 20502,
//               name: "Organic Chilli Seeds",
//               images: ["org_chilli1.jpg", "org_chilli2.jpg"],
//               MRP: 110,
//               OFFER_PRICE: 85,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Organic chilli seeds for spicy and chemical-free cultivation.",
//               key_points: [
//                 "Organic certified",
//                 "No chemicals",
//                 "Spicy flavor",
//                 "Easy to grow",
//               ],
//             },
//             {
//               id: 20503,
//               name: "Organic Spinach Seeds",
//               images: ["org_spinach1.jpg", "org_spinach2.jpg"],
//               MRP: 90,
//               OFFER_PRICE: 70,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Nutrient-rich organic spinach seeds for healthy greens.",
//               key_points: [
//                 "Organic greens",
//                 "High iron",
//                 "Fast growing",
//                 "Chemical free",
//               ],
//             },
//             {
//               id: 20504,
//               name: "Organic Coriander Seeds",
//               images: ["org_coriander1.jpg", "org_coriander2.jpg"],
//               MRP: 85,
//               OFFER_PRICE: 65,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Aromatic organic coriander seeds for herbs and spices.",
//               key_points: [
//                 "Organic certified",
//                 "Aromatic leaves",
//                 "Dual purpose",
//                 "Easy to grow",
//               ],
//             },
//             {
//               id: 20505,
//               name: "Organic Okra Seeds",
//               images: ["org_okra1.jpg", "org_okra2.jpg"],
//               MRP: 120,
//               OFFER_PRICE: 95,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Organic okra seeds for chemical-free lady fingers.",
//               key_points: [
//                 "Organic GreenAgroing",
//                 "Continuous yield",
//                 "Summer crop",
//                 "No pesticides",
//               ],
//             },
//             {
//               id: 20506,
//               name: "Organic Brinjal Seeds",
//               images: ["org_brinjal1.jpg", "org_brinjal2.jpg"],
//               MRP: 130,
//               OFFER_PRICE: 105,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Organic brinjal seeds for safe and healthy eggplants.",
//               key_points: [
//                 "Organic certified",
//                 "Safe to eat",
//                 "High yield",
//                 "No chemicals",
//               ],
//             },
//             {
//               id: 20507,
//               name: "Organic Bottle Gourd Seeds",
//               images: ["org_bottle_gourd1.jpg", "org_bottle_gourd2.jpg"],
//               MRP: 110,
//               OFFER_PRICE: 85,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Organic bottle gourd seeds for summer vegetables.",
//               key_points: [
//                 "Organic vegetables",
//                 "Summer crop",
//                 "Climbing habit",
//                 "Chemical free",
//               ],
//             },
//             {
//               id: 20508,
//               name: "Organic Cucumber Seeds",
//               images: ["org_cucumber1.jpg", "org_cucumber2.jpg"],
//               MRP: 125,
//               OFFER_PRICE: 100,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description: "Organic cucumber seeds for fresh salads.",
//               key_points: [
//                 "Organic salad",
//                 "Crisp texture",
//                 "Summer crop",
//                 "No pesticides",
//               ],
//             },
//             {
//               id: 20509,
//               name: "Organic Carrot Seeds",
//               images: ["org_carrot1.jpg", "org_carrot2.jpg"],
//               MRP: 100,
//               OFFER_PRICE: 80,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Organic carrot seeds for sweet and healthy roots.",
//               key_points: [
//                 "Organic roots",
//                 "Sweet flavor",
//                 "Rich in vitamins",
//                 "Chemical free",
//               ],
//             },
//             {
//               id: 20510,
//               name: "Organic Beetroot Seeds",
//               images: ["org_beetroot1.jpg", "org_beetroot2.jpg"],
//               MRP: 95,
//               OFFER_PRICE: 75,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Organic beetroot seeds for nutritious roots.",
//               key_points: [
//                 "Organic certified",
//                 "Nutritious roots",
//                 "Deep red color",
//                 "No chemicals",
//               ],
//             },
//           ],
//         },
//         {
//           id: 206,
//           name: "Hybrid Seeds",
//           products: [
//             {
//               id: 20601,
//               name: "Hybrid Tomato Seeds",
//               images: ["hyb_tomato1.jpg", "hyb_tomato2.jpg"],
//               MRP: 200,
//               OFFER_PRICE: 160,
//               choose_weight: ["50g", "100g", "250g", "500g"],
//               product_description:
//                 "High-yield hybrid tomato seeds with superior disease resistance.",
//               key_points: [
//                 "High yield potential",
//                 "Disease resistant",
//                 "Uniform fruit size",
//                 "Early maturity",
//               ],
//             },
//             {
//               id: 20602,
//               name: "Hybrid Chilli Seeds",
//               images: ["hyb_chilli1.jpg", "hyb_chilli2.jpg"],
//               MRP: 150,
//               OFFER_PRICE: 120,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "High-yielding hybrid chilli seeds with uniform pungency.",
//               key_points: [
//                 "Uniform pungency",
//                 "High yield",
//                 "Disease resistant",
//                 "Early maturing",
//               ],
//             },
//             {
//               id: 20603,
//               name: "Hybrid Capsicum Seeds",
//               images: ["hyb_capsicum1.jpg", "hyb_capsicum2.jpg"],
//               MRP: 180,
//               OFFER_PRICE: 145,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Colorful hybrid capsicum seeds for thick-walled peppers.",
//               key_points: [
//                 "Thick walls",
//                 "Multiple colors",
//                 "High yield",
//                 "Uniform size",
//               ],
//             },
//             {
//               id: 20604,
//               name: "Hybrid Cucumber Seeds",
//               images: ["hyb_cucumber1.jpg", "hyb_cucumber2.jpg"],
//               MRP: 160,
//               OFFER_PRICE: 130,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Parthenocarpic hybrid cucumber seeds for seedless fruits.",
//               key_points: [
//                 "Seedless fruits",
//                 "High yield",
//                 "Disease resistant",
//                 "Greenhouse suitable",
//               ],
//             },
//             {
//               id: 20605,
//               name: "Hybrid Brinjal Seeds",
//               images: ["hyb_brinjal1.jpg", "hyb_brinjal2.jpg"],
//               MRP: 170,
//               OFFER_PRICE: 135,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Long and shiny hybrid brinjal seeds for commercial cultivation.",
//               key_points: [
//                 "Long fruits",
//                 "Shiny skin",
//                 "High yield",
//                 "Disease resistant",
//               ],
//             },
//             {
//               id: 20606,
//               name: "Hybrid Watermelon Seeds",
//               images: ["hyb_watermelon1.jpg", "hyb_watermelon2.jpg"],
//               MRP: 220,
//               OFFER_PRICE: 180,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Seedless hybrid watermelon seeds for sweet fruits.",
//               key_points: [
//                 "Seedless variety",
//                 "Sweet flavor",
//                 "Large size",
//                 "High yield",
//               ],
//             },
//             {
//               id: 20607,
//               name: "Hybrid Bitter Gourd Seeds",
//               images: ["hyb_bitter_gourd1.jpg", "hyb_bitter_gourd2.jpg"],
//               MRP: 140,
//               OFFER_PRICE: 110,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "High-yield hybrid bitter gourd seeds with uniform fruits.",
//               key_points: [
//                 "Uniform fruits",
//                 "High yield",
//                 "Early maturity",
//                 "Disease resistant",
//               ],
//             },
//             {
//               id: 20608,
//               name: "Hybrid Bottle Gourd Seeds",
//               images: ["hyb_bottle_gourd1.jpg", "hyb_bottle_gourd2.jpg"],
//               MRP: 130,
//               OFFER_PRICE: 105,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "Straight and uniform hybrid bottle gourd seeds.",
//               key_points: [
//                 "Straight fruits",
//                 "Uniform size",
//                 "High yield",
//                 "Early harvest",
//               ],
//             },
//             {
//               id: 20609,
//               name: "Hybrid Ridge Gourd Seeds",
//               images: ["hyb_ridge_gourd1.jpg", "hyb_ridge_gourd2.jpg"],
//               MRP: 125,
//               OFFER_PRICE: 100,
//               choose_weight: ["25g", "50g", "100g"],
//               product_description:
//                 "High-yielding hybrid ridge gourd seeds for commercial GreenAgroing.",
//               key_points: [
//                 "High yield",
//                 "Uniform ridges",
//                 "Early maturity",
//                 "Disease tolerant",
//               ],
//             },
//             {
//               id: 20610,
//               name: "Hybrid Okra Seeds",
//               images: ["hyb_okra1.jpg", "hyb_okra2.jpg"],
//               MRP: 135,
//               OFFER_PRICE: 110,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Green and tender hybrid okra seeds for continuous yield.",
//               key_points: [
//                 "Tender pods",
//                 "Continuous yield",
//                 "Disease resistant",
//                 "High production",
//               ],
//             },
//           ],
//         },
//         {
//           id: 207,
//           name: "Field Crop Seeds",
//           products: [
//             {
//               id: 20701,
//               name: "Wheat Seeds",
//               images: ["wheat1.jpg", "wheat2.jpg"],
//               MRP: 40,
//               OFFER_PRICE: 32,
//               choose_weight: ["1kg", "2kg", "5kg", "10kg", "25kg"],
//               product_description:
//                 "High-quality wheat seeds for excellent grain production.",
//               key_points: [
//                 "High yield",
//                 "Disease resistant",
//                 "Good grain quality",
//                 "Suitable for various soils",
//               ],
//             },
//             {
//               id: 20702,
//               name: "Rice Seeds",
//               images: ["rice1.jpg", "rice2.jpg"],
//               MRP: 45,
//               OFFER_PRICE: 36,
//               choose_weight: ["1kg", "2kg", "5kg", "10kg", "25kg"],
//               product_description:
//                 "Premium rice seeds for high-yield paddy cultivation.",
//               key_points: [
//                 "High yield",
//                 "Good grain quality",
//                 "Disease resistant",
//                 "Suitable for paddy",
//               ],
//             },
//             {
//               id: 20703,
//               name: "Maize Seeds",
//               images: ["maize1.jpg", "maize2.jpg"],
//               MRP: 50,
//               OFFER_PRICE: 40,
//               choose_weight: ["1kg", "2kg", "5kg", "10kg"],
//               product_description:
//                 "High-yield maize seeds for grain and fodder.",
//               key_points: [
//                 "Dual purpose",
//                 "High yield",
//                 "Disease resistant",
//                 "All season",
//               ],
//             },
//             {
//               id: 20704,
//               name: "Bajra (Pearl Millet) Seeds",
//               images: ["bajra1.jpg", "bajra2.jpg"],
//               MRP: 35,
//               OFFER_PRICE: 28,
//               choose_weight: ["1kg", "2kg", "5kg", "10kg"],
//               product_description:
//                 "Drought-resistant bajra seeds for dryland GreenAgroing.",
//               key_points: [
//                 "Drought resistant",
//                 "Nutritious grain",
//                 "Rainfed crop",
//                 "Summer season",
//               ],
//             },
//             {
//               id: 20705,
//               name: "Jowar (Sorghum) Seeds",
//               images: ["jowar1.jpg", "jowar2.jpg"],
//               MRP: 38,
//               OFFER_PRICE: 30,
//               choose_weight: ["1kg", "2kg", "5kg", "10kg"],
//               product_description:
//                 "Versatile jowar seeds for grain and fodder production.",
//               key_points: [
//                 "Dual purpose",
//                 "Drought tolerant",
//                 "Nutritious",
//                 "Rainfed crop",
//               ],
//             },
//             {
//               id: 20706,
//               name: "Barley Seeds",
//               images: ["barley1.jpg", "barley2.jpg"],
//               MRP: 42,
//               OFFER_PRICE: 34,
//               choose_weight: ["1kg", "2kg", "5kg", "10kg"],
//               product_description:
//                 "Nutritious barley seeds for food and animal feed.",
//               key_points: [
//                 "Nutritious grain",
//                 "Animal feed",
//                 "Winter crop",
//                 "Disease resistant",
//               ],
//             },
//             {
//               id: 20707,
//               name: "Cotton Seeds",
//               images: ["cotton1.jpg", "cotton2.jpg"],
//               MRP: 60,
//               OFFER_PRICE: 48,
//               choose_weight: ["1kg", "2kg", "5kg", "10kg"],
//               product_description:
//                 "High-quality cotton seeds for fiber production.",
//               key_points: [
//                 "High fiber yield",
//                 "Disease resistant",
//                 "Commercial crop",
//                 "Summer season",
//               ],
//             },
//             {
//               id: 20708,
//               name: "Groundnut Seeds",
//               images: ["groundnut1.jpg", "groundnut2.jpg"],
//               MRP: 55,
//               OFFER_PRICE: 44,
//               choose_weight: ["5kg", "10kg", "25kg"],
//               product_description: "Oil-rich groundnut seeds for high yield.",
//               key_points: [
//                 "High oil content",
//                 "Nutritious",
//                 "Kharif crop",
//                 "Good yield",
//               ],
//             },
//             {
//               id: 20709,
//               name: "Soybean Seeds",
//               images: ["soybean1.jpg", "soybean2.jpg"],
//               MRP: 52,
//               OFFER_PRICE: 42,
//               choose_weight: ["5kg", "10kg", "25kg"],
//               product_description:
//                 "Protein-rich soybean seeds for food and oil.",
//               key_points: [
//                 "High protein",
//                 "Oil crop",
//                 "Kharif season",
//                 "Commercial crop",
//               ],
//             },
//             {
//               id: 20710,
//               name: "Mustard Seeds",
//               images: ["mustard1.jpg", "mustard2.jpg"],
//               MRP: 48,
//               OFFER_PRICE: 38,
//               choose_weight: ["1kg", "2kg", "5kg", "10kg"],
//               product_description:
//                 "Oilseed mustard seeds for cooking oil production.",
//               key_points: [
//                 "Oil crop",
//                 "Rabi season",
//                 "High yield",
//                 "Disease resistant",
//               ],
//             },
//           ],
//         },
//         {
//           id: 208,
//           name: "Fodder Seeds",
//           products: [
//             {
//               id: 20801,
//               name: "Napier Grass Seeds",
//               images: ["napier1.jpg", "napier2.jpg"],
//               MRP: 35,
//               OFFER_PRICE: 28,
//               choose_weight: ["500g", "1kg", "2kg", "5kg"],
//               product_description:
//                 "High-yield fodder seeds for livestock feed.",
//               key_points: [
//                 "High biomass production",
//                 "Nutritious fodder",
//                 "Fast growing",
//                 "Drought tolerant",
//               ],
//             },
//             {
//               id: 20802,
//               name: "Lucerne (Alfalfa) Seeds",
//               images: ["lucerne1.jpg", "lucerne2.jpg"],
//               MRP: 45,
//               OFFER_PRICE: 36,
//               choose_weight: ["500g", "1kg", "2kg", "5kg"],
//               product_description:
//                 "Protein-rich lucerne seeds for quality fodder.",
//               key_points: [
//                 "High protein",
//                 "Perennial crop",
//                 "Nutritious",
//                 "Multiple cuttings",
//               ],
//             },
//             {
//               id: 20803,
//               name: "Berseem Seeds",
//               images: ["berseem1.jpg", "berseem2.jpg"],
//               MRP: 40,
//               OFFER_PRICE: 32,
//               choose_weight: ["1kg", "2kg", "5kg", "10kg"],
//               product_description:
//                 "Winter fodder seeds for green fodder production.",
//               key_points: [
//                 "Winter fodder",
//                 "Multiple cuttings",
//                 "Nutritious",
//                 "Soil improver",
//               ],
//             },
//             {
//               id: 20804,
//               name: "Maize Fodder Seeds",
//               images: ["maize_fodder1.jpg", "maize_fodder2.jpg"],
//               MRP: 38,
//               OFFER_PRICE: 30,
//               choose_weight: ["1kg", "2kg", "5kg", "10kg"],
//               product_description: "Fast-growing maize seeds for green fodder.",
//               key_points: [
//                 "Fast growth",
//                 "High biomass",
//                 "Nutritious",
//                 "All season",
//               ],
//             },
//             {
//               id: 20805,
//               name: "Cowpea Fodder Seeds",
//               images: ["cowpea1.jpg", "cowpea2.jpg"],
//               MRP: 32,
//               OFFER_PRICE: 26,
//               choose_weight: ["1kg", "2kg", "5kg"],
//               product_description:
//                 "Leguminous cowpea seeds for protein-rich fodder.",
//               key_points: [
//                 "Leguminous crop",
//                 "Protein rich",
//                 "Soil nitrogen fixer",
//                 "Drought tolerant",
//               ],
//             },
//             {
//               id: 20806,
//               name: "Sorghum Fodder Seeds",
//               images: ["sorghum_fodder1.jpg", "sorghum_fodder2.jpg"],
//               MRP: 36,
//               OFFER_PRICE: 29,
//               choose_weight: ["1kg", "2kg", "5kg"],
//               product_description:
//                 "Drought-resistant sorghum seeds for fodder.",
//               key_points: [
//                 "Drought resistant",
//                 "High biomass",
//                 "Summer fodder",
//                 "Nutritious",
//               ],
//             },
//             {
//               id: 20807,
//               name: "Oat Fodder Seeds",
//               images: ["oat_fodder1.jpg", "oat_fodder2.jpg"],
//               MRP: 42,
//               OFFER_PRICE: 34,
//               choose_weight: ["1kg", "2kg", "5kg"],
//               product_description: "Winter oat seeds for green fodder.",
//               key_points: [
//                 "Winter fodder",
//                 "Nutritious",
//                 "Fast growing",
//                 "Multiple cuttings",
//               ],
//             },
//             {
//               id: 20808,
//               name: "Rye Grass Seeds",
//               images: ["rye_grass1.jpg", "rye_grass2.jpg"],
//               MRP: 38,
//               OFFER_PRICE: 30,
//               choose_weight: ["1kg", "2kg", "5kg"],
//               product_description:
//                 "Perennial rye grass seeds for continuous fodder.",
//               key_points: [
//                 "Perennial grass",
//                 "Continuous fodder",
//                 "Nutritious",
//                 "Cool season",
//               ],
//             },
//             {
//               id: 20809,
//               name: "Sudan Grass Seeds",
//               images: ["sudan_grass1.jpg", "sudan_grass2.jpg"],
//               MRP: 34,
//               OFFER_PRICE: 27,
//               choose_weight: ["1kg", "2kg", "5kg"],
//               product_description:
//                 "Fast-growing sudan grass seeds for summer fodder.",
//               key_points: [
//                 "Fast growth",
//                 "Summer fodder",
//                 "High yield",
//                 "Drought tolerant",
//               ],
//             },
//             {
//               id: 20810,
//               name: "Bajra Fodder Seeds",
//               images: ["bajra_fodder1.jpg", "bajra_fodder2.jpg"],
//               MRP: 32,
//               OFFER_PRICE: 26,
//               choose_weight: ["1kg", "2kg", "5kg"],
//               product_description:
//                 "Drought-resistant bajra seeds for fodder production.",
//               key_points: [
//                 "Drought resistant",
//                 "Summer fodder",
//                 "High biomass",
//                 "Nutritious",
//               ],
//             },
//           ],
//         },
//         {
//           id: 209,
//           name: "Spice Seeds",
//           products: [
//             {
//               id: 20901,
//               name: "Cumin Seeds",
//               images: ["cumin1.jpg", "cumin2.jpg"],
//               MRP: 85,
//               OFFER_PRICE: 70,
//               choose_weight: ["100g", "250g", "500g", "1kg"],
//               product_description:
//                 "Aromatic cumin seeds for culinary and medicinal use.",
//               key_points: [
//                 "Strong aroma",
//                 "High oil content",
//                 "Medicinal properties",
//                 "Good yield",
//               ],
//             },
//             {
//               id: 20902,
//               name: "Coriander Seeds",
//               images: ["coriander_seeds1.jpg", "coriander_seeds2.jpg"],
//               MRP: 75,
//               OFFER_PRICE: 60,
//               choose_weight: ["100g", "250g", "500g", "1kg"],
//               product_description:
//                 "Aromatic coriander seeds for spices and medicinal use.",
//               key_points: [
//                 "Aromatic seeds",
//                 "Culinary uses",
//                 "Medicinal properties",
//                 "Easy to grow",
//               ],
//             },
//             {
//               id: 20903,
//               name: "Fennel Seeds",
//               images: ["fennel1.jpg", "fennel2.jpg"],
//               MRP: 80,
//               OFFER_PRICE: 65,
//               choose_weight: ["100g", "250g", "500g", "1kg"],
//               product_description:
//                 "Sweet fennel seeds for cooking and digestive health.",
//               key_points: [
//                 "Sweet flavor",
//                 "Digestive aid",
//                 "Culinary uses",
//                 "Medicinal properties",
//               ],
//             },
//             {
//               id: 20904,
//               name: "Fenugreek Seeds",
//               images: ["fenugreek1.jpg", "fenugreek2.jpg"],
//               MRP: 65,
//               OFFER_PRICE: 52,
//               choose_weight: ["100g", "250g", "500g", "1kg"],
//               product_description:
//                 "Bitter fenugreek seeds for spices and health benefits.",
//               key_points: [
//                 "Bitter flavor",
//                 "Medicinal uses",
//                 "Culinary spice",
//                 "Easy to grow",
//               ],
//             },
//             {
//               id: 20905,
//               name: "Mustard Seeds",
//               images: ["mustard_seeds1.jpg", "mustard_seeds2.jpg"],
//               MRP: 70,
//               OFFER_PRICE: 56,
//               choose_weight: ["100g", "250g", "500g", "1kg"],
//               product_description: "Pungent mustard seeds for oil and spices.",
//               key_points: [
//                 "Pungent flavor",
//                 "Oil production",
//                 "Culinary uses",
//                 "Easy cultivation",
//               ],
//             },
//             {
//               id: 20906,
//               name: "Chilli Seeds",
//               images: ["chilli_seeds1.jpg", "chilli_seeds2.jpg"],
//               MRP: 90,
//               OFFER_PRICE: 72,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Spicy chilli seeds for hot peppers and spices.",
//               key_points: [
//                 "Spicy flavor",
//                 "Culinary uses",
//                 "Medicinal properties",
//                 "High yield",
//               ],
//             },
//             {
//               id: 20907,
//               name: "Turmeric Seeds",
//               images: ["turmeric1.jpg", "turmeric2.jpg"],
//               MRP: 95,
//               OFFER_PRICE: 76,
//               choose_weight: ["500g", "1kg", "2kg"],
//               product_description:
//                 "Medicinal turmeric seeds for rhizome production.",
//               key_points: [
//                 "Medicinal rhizome",
//                 "Yellow color",
//                 "Culinary uses",
//                 "High demand",
//               ],
//             },
//             {
//               id: 20908,
//               name: "Black Pepper Seeds",
//               images: ["black_pepper1.jpg", "black_pepper2.jpg"],
//               MRP: 120,
//               OFFER_PRICE: 95,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "King of spices black pepper seeds for climbing vines.",
//               key_points: [
//                 "King of spices",
//                 "Climbing vine",
//                 "High value",
//                 "Tropical climate",
//               ],
//             },
//             {
//               id: 20909,
//               name: "Cardamom Seeds",
//               images: ["cardamom1.jpg", "cardamom2.jpg"],
//               MRP: 150,
//               OFFER_PRICE: 120,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Aromatic cardamom seeds for queen of spices.",
//               key_points: [
//                 "Queen of spices",
//                 "Aromatic pods",
//                 "High value",
//                 "Shade loving",
//               ],
//             },
//             {
//               id: 20910,
//               name: "Clove Seeds",
//               images: ["clove1.jpg", "clove2.jpg"],
//               MRP: 130,
//               OFFER_PRICE: 105,
//               choose_weight: ["50g", "100g", "250g"],
//               product_description:
//                 "Aromatic clove seeds for medicinal and culinary use.",
//               key_points: [
//                 "Aromatic buds",
//                 "Medicinal properties",
//                 "Culinary uses",
//                 "Tropical tree",
//               ],
//             },
//           ],
//         },
//         {
//           id: 210,
//           name: "Microgreen Seeds",
//           products: [
//             {
//               id: 21001,
//               name: "Sunflower Microgreens Seeds",
//               images: ["sunflower_micro1.jpg", "sunflower_micro2.jpg"],
//               MRP: 120,
//               OFFER_PRICE: 95,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Premium seeds for nutritious sunflower microgreens.",
//               key_points: [
//                 "High germination rate",
//                 "Nutrient dense",
//                 "Fast growing",
//                 "Great for salads",
//               ],
//             },
//             {
//               id: 21002,
//               name: "Pea Shoots Seeds",
//               images: ["pea_shoots1.jpg", "pea_shoots2.jpg"],
//               MRP: 110,
//               OFFER_PRICE: 85,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Sweet pea shoots seeds for tender microgreens.",
//               key_points: [
//                 "Sweet flavor",
//                 "Tender shoots",
//                 "Fast growing",
//                 "Nutrient rich",
//               ],
//             },
//             {
//               id: 21003,
//               name: "Radish Microgreens Seeds",
//               images: ["radish_micro1.jpg", "radish_micro2.jpg"],
//               MRP: 95,
//               OFFER_PRICE: 75,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Spicy radish microgreens seeds for peppery flavor.",
//               key_points: [
//                 "Peppery flavor",
//                 "Fast growing",
//                 "Nutrient dense",
//                 "Great for garnishing",
//               ],
//             },
//             {
//               id: 21004,
//               name: "Broccoli Microgreens Seeds",
//               images: ["broccoli_micro1.jpg", "broccoli_micro2.jpg"],
//               MRP: 130,
//               OFFER_PRICE: 105,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Nutrient-packed broccoli microgreens seeds.",
//               key_points: [
//                 "High antioxidants",
//                 "Nutrient dense",
//                 "Fast growing",
//                 "Health benefits",
//               ],
//             },
//             {
//               id: 21005,
//               name: "Spinach Microgreens Seeds",
//               images: ["spinach_micro1.jpg", "spinach_micro2.jpg"],
//               MRP: 105,
//               OFFER_PRICE: 85,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description: "Iron-rich spinach microgreens seeds.",
//               key_points: [
//                 "High iron content",
//                 "Nutritious",
//                 "Fast growing",
//                 "Great for smoothies",
//               ],
//             },
//             {
//               id: 21006,
//               name: "Mustard Microgreens Seeds",
//               images: ["mustard_micro1.jpg", "mustard_micro2.jpg"],
//               MRP: 90,
//               OFFER_PRICE: 72,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Spicy mustard microgreens seeds for zesty flavor.",
//               key_points: [
//                 "Spicy flavor",
//                 "Fast growing",
//                 "Nutrient rich",
//                 "Great for sandwiches",
//               ],
//             },
//             {
//               id: 21007,
//               name: "Beetroot Microgreens Seeds",
//               images: ["beetroot_micro1.jpg", "beetroot_micro2.jpg"],
//               MRP: 115,
//               OFFER_PRICE: 92,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Colorful beetroot microgreens seeds with earthy flavor.",
//               key_points: [
//                 "Earthy flavor",
//                 "Colorful stems",
//                 "Nutrient dense",
//                 "Fast growing",
//               ],
//             },
//             {
//               id: 21008,
//               name: "Fenugreek Microgreens Seeds",
//               images: ["fenugreek_micro1.jpg", "fenugreek_micro2.jpg"],
//               MRP: 100,
//               OFFER_PRICE: 80,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description: "Bitter-sweet fenugreek microgreens seeds.",
//               key_points: [
//                 "Bitter-sweet flavor",
//                 "Medicinal properties",
//                 "Fast growing",
//                 "Nutritious",
//               ],
//             },
//             {
//               id: 21009,
//               name: "Coriander Microgreens Seeds",
//               images: ["coriander_micro1.jpg", "coriander_micro2.jpg"],
//               MRP: 110,
//               OFFER_PRICE: 88,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Aromatic coriander microgreens seeds for fresh flavor.",
//               key_points: [
//                 "Aromatic leaves",
//                 "Fresh flavor",
//                 "Fast growing",
//                 "Great for garnishing",
//               ],
//             },
//             {
//               id: 21010,
//               name: "Basil Microgreens Seeds",
//               images: ["basil_micro1.jpg", "basil_micro2.jpg"],
//               MRP: 125,
//               OFFER_PRICE: 100,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Aromatic basil microgreens seeds for Italian dishes.",
//               key_points: [
//                 "Aromatic leaves",
//                 "Italian cuisine",
//                 "Fast growing",
//                 "Pesto making",
//               ],
//             },
//           ],
//         },
//       ],
//     },
//     {
//       id: 3,
//       name: "Protection",
//       subcategories: [
//         {
//           id: 301,
//           name: "Insecticides",
//           products: [
//             {
//               id: 30101,
//               name: "Imidacloprid Insecticide",
//               images: ["imidacloprid1.jpg", "imidacloprid2.jpg"],
//               MRP: 350,
//               OFFER_PRICE: 280,
//               choose_weight: ["100ml", "250ml", "500ml", "1L", "5L"],
//               product_description:
//                 "Systemic insecticide effective against sucking pests.",
//               key_points: [
//                 "Systemic action",
//                 "Long lasting effect",
//                 "Broad spectrum",
//                 "Rainfast",
//               ],
//             },
//             {
//               id: 30102,
//               name: "Chlorpyrifos Insecticide",
//               images: ["chlorpyrifos1.jpg", "chlorpyrifos2.jpg"],
//               MRP: 320,
//               OFFER_PRICE: 256,
//               choose_weight: ["250ml", "500ml", "1L", "5L"],
//               product_description:
//                 "Contact and stomach poison for chewing and sucking pests.",
//               key_points: [
//                 "Contact action",
//                 "Stomach poison",
//                 "Broad spectrum",
//                 "Effective",
//               ],
//             },
//             {
//               id: 30103,
//               name: "Cypermethrin Insecticide",
//               images: ["cypermethrin1.jpg", "cypermethrin2.jpg"],
//               MRP: 380,
//               OFFER_PRICE: 304,
//               choose_weight: ["100ml", "250ml", "500ml", "1L"],
//               product_description:
//                 "Synthetic pyrethroid for quick knock-down of insects.",
//               key_points: [
//                 "Quick action",
//                 "Contact insecticide",
//                 "Low mammalian toxicity",
//                 "Broad spectrum",
//               ],
//             },
//             {
//               id: 30104,
//               name: "Lambda Cyhalothrin Insecticide",
//               images: ["lambda1.jpg", "lambda2.jpg"],
//               MRP: 420,
//               OFFER_PRICE: 336,
//               choose_weight: ["100ml", "250ml", "500ml", "1L"],
//               product_description:
//                 "Highly effective pyrethroid against lepidopteran pests.",
//               key_points: [
//                 "Highly effective",
//                 "Low dosage",
//                 "Rainfast",
//                 "Broad spectrum",
//               ],
//             },
//             {
//               id: 30105,
//               name: "Thiamethoxam Insecticide",
//               images: ["thiamethoxam1.jpg", "thiamethoxam2.jpg"],
//               MRP: 450,
//               OFFER_PRICE: 360,
//               choose_weight: ["50g", "100g", "250g", "500g"],
//               product_description:
//                 "Systemic insecticide with translaminar movement.",
//               key_points: [
//                 "Systemic action",
//                 "Translaminar movement",
//                 "Long residual",
//                 "Rainfast",
//               ],
//             },
//             {
//               id: 30106,
//               name: "Deltamethrin Insecticide",
//               images: ["deltamethrin1.jpg", "deltamethrin2.jpg"],
//               MRP: 400,
//               OFFER_PRICE: 320,
//               choose_weight: ["100ml", "250ml", "500ml", "1L"],
//               product_description:
//                 "Highly active pyrethroid against wide range of pests.",
//               key_points: [
//                 "Highly active",
//                 "Low volume",
//                 "Fast acting",
//                 "Broad spectrum",
//               ],
//             },
//             {
//               id: 30107,
//               name: "Quinalphos Insecticide",
//               images: ["quinalphos1.jpg", "quinalphos2.jpg"],
//               MRP: 360,
//               OFFER_PRICE: 288,
//               choose_weight: ["250ml", "500ml", "1L", "5L"],
//               product_description:
//                 "Organophosphate insecticide for sucking and chewing pests.",
//               key_points: [
//                 "Contact action",
//                 "Systemic action",
//                 "Broad spectrum",
//                 "Effective",
//               ],
//             },
//             {
//               id: 30108,
//               name: "Acephate Insecticide",
//               images: ["acephate1.jpg", "acephate2.jpg"],
//               MRP: 340,
//               OFFER_PRICE: 272,
//               choose_weight: ["250g", "500g", "1kg"],
//               product_description:
//                 "Systemic insecticide with contact and stomach action.",
//               key_points: [
//                 "Systemic action",
//                 "Contact action",
//                 "Stomach poison",
//                 "Broad spectrum",
//               ],
//             },
//             {
//               id: 30109,
//               name: "Bifenthrin Insecticide",
//               images: ["bifenthrin1.jpg", "bifenthrin2.jpg"],
//               MRP: 430,
//               OFFER_PRICE: 344,
//               choose_weight: ["100ml", "250ml", "500ml", "1L"],
//               product_description:
//                 "Broad-spectrum pyrethroid with long residual activity.",
//               key_points: [
//                 "Long residual",
//                 "Broad spectrum",
//                 "Contact action",
//                 "Rainfast",
//               ],
//             },
//             {
//               id: 30110,
//               name: "Profenofos Insecticide",
//               images: ["profenofos1.jpg", "profenofos2.jpg"],
//               MRP: 370,
//               OFFER_PRICE: 296,
//               choose_weight: ["250ml", "500ml", "1L", "5L"],
//               product_description:
//                 "Organophosphate with contact and stomach action.",
//               key_points: [
//                 "Contact action",
//                 "Stomach poison",
//                 "Broad spectrum",
//                 "Effective",
//               ],
//             },
//           ],
//         },
//         {
//           id: 302,
//           name: "Fungicides",
//           products: [
//             {
//               id: 30201,
//               name: "Mancozeb Fungicide",
//               images: ["mancozeb1.jpg", "mancozeb2.jpg"],
//               MRP: 280,
//               OFFER_PRICE: 220,
//               choose_weight: ["250g", "500g", "1kg", "5kg"],
//               product_description:
//                 "Contact fungicide for broad-spectrum disease control.",
//               key_points: [
//                 "Broad spectrum",
//                 "Protective action",
//                 "Multi-site activity",
//                 "Low resistance risk",
//               ],
//             },
//             {
//               id: 30202,
//               name: "Carbendazim Fungicide",
//               images: ["carbendazim1.jpg", "carbendazim2.jpg"],
//               MRP: 320,
//               OFFER_PRICE: 256,
//               choose_weight: ["100g", "250g", "500g", "1kg"],
//               product_description:
//                 "Systemic fungicide with curative and protective action.",
//               key_points: [
//                 "Systemic action",
//                 "Curative effect",
//                 "Protective action",
//                 "Broad spectrum",
//               ],
//             },
//             {
//               id: 30203,
//               name: "Copper Oxychloride Fungicide",
//               images: ["copper1.jpg", "copper2.jpg"],
//               MRP: 290,
//               OFFER_PRICE: 232,
//               choose_weight: ["250g", "500g", "1kg", "5kg"],
//               product_description:
//                 "Contact fungicide and bactericide for disease control.",
//               key_points: [
//                 "Contact action",
//                 "Bactericide",
//                 "Protective",
//                 "Broad spectrum",
//               ],
//             },
//             {
//               id: 30204,
//               name: "Propiconazole Fungicide",
//               images: ["propiconazole1.jpg", "propiconazole2.jpg"],
//               MRP: 380,
//               OFFER_PRICE: 304,
//               choose_weight: ["100ml", "250ml", "500ml", "1L"],
//               product_description:
//                 "Systemic fungicide with protective and curative action.",
//               key_points: [
//                 "Systemic action",
//                 "Protective",
//                 "Curative",
//                 "Broad spectrum",
//               ],
//             },
//             {
//               id: 30205,
//               name: "Hexaconazole Fungicide",
//               images: ["hexaconazole1.jpg", "hexaconazole2.jpg"],
//               MRP: 350,
//               OFFER_PRICE: 280,
//               choose_weight: ["100ml", "250ml", "500ml", "1L"],
//               product_description:
//                 "Systemic fungicide with eradicant and protective action.",
//               key_points: [
//                 "Systemic action",
//                 "Eradicant",
//                 "Protective",
//                 "Broad spectrum",
//               ],
//             },
//             {
//               id: 30206,
//               name: "Metalaxyl Fungicide",
//               images: ["metalaxyl1.jpg", "metalaxyl2.jpg"],
//               MRP: 400,
//               OFFER_PRICE: 320,
//               choose_weight: ["100g", "250g", "500g"],
//               product_description:
//                 "Systemic fungicide specific for oomycete diseases.",
//               key_points: [
//                 "Systemic action",
//                 "Oomycete specific",
//                 "Curative",
//                 "Protective",
//               ],
//             },
//             {
//               id: 30207,
//               name: "Tebuconazole Fungicide",
//               images: ["tebuconazole1.jpg", "tebuconazole2.jpg"],
//               MRP: 370,
//               OFFER_PRICE: 296,
//               choose_weight: ["100ml", "250ml", "500ml", "1L"],
//               product_description:
//                 "Triazole fungicide with systemic and protective action.",
//               key_points: [
//                 "Systemic action",
//                 "Protective",
//                 "Curative",
//                 "Broad spectrum",
//               ],
//             },
//             {
//               id: 30208,
//               name: "Tricyclazole Fungicide",
//               images: ["tricyclazole1.jpg", "tricyclazole2.jpg"],
//               MRP: 420,
//               OFFER_PRICE: 336,
//               choose_weight: ["250g", "500g", "1kg"],
//               product_description:
//                 "Specific fungicide for blast disease in rice.",
//               key_points: [
//                 "Rice blast specific",
//                 "Systemic action",
//                 "Protective",
//                 "Curative",
//               ],
//             },
//             {
//               id: 30209,
//               name: "Sulphur (Wettable Powder) Fungicide",
//               images: ["sulphur1.jpg", "sulphur2.jpg"],
//               MRP: 220,
//               OFFER_PRICE: 176,
//               choose_weight: ["500g", "1kg", "5kg", "10kg"],
//               product_description:
//                 "Contact fungicide and miticide for organic GreenAgroing.",
//               key_points: [
//                 "Contact action",
//                 "Miticide",
//                 "Organic use",
//                 "Broad spectrum",
//               ],
//             },
//             {
//               id: 30210,
//               name: "Captan Fungicide",
//               images: ["captan1.jpg", "captan2.jpg"],
//               MRP: 300,
//               OFFER_PRICE: 240,
//               choose_weight: ["250g", "500g", "1kg"],
//               product_description:
//                 "Protective fungicide for seed treatment and foliar application.",
//               key_points: [
//                 "Protective action",
//                 "Seed treatment",
//                 "Broad spectrum",
//                 "Contact fungicide",
//               ],
//             },
//           ],
//         },
//       ],
//     },
//   ],
// };

// // Define all categories including the ones without data
// const allCategories = [
//   { id: 1, name: "All", icon: "🛒" },
//   { id: 2, name: "Seeds", icon: "🌱" },
//   { id: 3, name: "Protection", icon: "🛡️" },
//   { id: 4, name: "Hardware", icon: "🔧" },
//   { id: 5, name: "Nutrition", icon: "🧪" },
//   { id: 6, name: "Combo Kit", icon: "🎁" },
// ];

// let currentCategory = "All";
// let currentSearchTerm = "";

// // Product Finder Modal Function
// function openProductFinder() {
//   // Create modal overlay
//   const modal = document.createElement("div");
//   modal.className = "product-finder-modal";
//   modal.innerHTML = `
//                 <div class="modal-content">
//                     <div class="modal-header">
//                         <h2><i class="fas fa-search-plus"></i> Find Farming Products</h2>
//                         <button class="close-modal" onclick="closeProductFinder()" aria-label="Close">
//                             <i class="fas fa-times"></i>
//                         </button>
//                     </div>
//                     <div class="modal-body">
//                         <div class="product-search-box">
//                             <input 
//                                 type="text" 
//                                 id="productFinderInput" 
//                                 placeholder="Search for seeds, fertilizers, tools, equipment..." 
//                                 class="product-finder-input"
//                                 autocomplete="off"
//                             >
//                             <button class="product-search-btn" onclick="searchProducts()">
//                                 <i class="fas fa-search"></i> Search
//                             </button>
//                         </div>
                        
//                         <div class="quick-categories">
//                             <h3>Popular Categories:</h3>
//                             <div class="category-chips" id="categoryChips">
//                                 ${allCategories
//                                   .map(
//                                     (category) => `
//                                     <button class="category-chip ${
//                                       category.name === "All" ? "active" : ""
//                                     }" 
//                                             onclick="filterByCategory('${
//                                               category.name
//                                             }')">
//                                         ${category.icon} ${category.name}
//                                     </button>
//                                 `
//                                   )
//                                   .join("")}
//                             </div>
//                         </div>
                        
//                         <div id="productResults" class="product-results">
//                             <div class="results-header">
//                                 <h3>All Products</h3>
//                                 <span class="results-count" id="resultsCount"></span>
//                             </div>
//                             <div class="product-grid" id="productsGrid">
//                                 <!-- Products will be loaded here -->
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             `;

//   document.body.appendChild(modal);
//   document.body.style.overflow = "hidden";

//   // Focus on search input
//   setTimeout(() => {
//     document.getElementById("productFinderInput").focus();
//   }, 100);

//   // Add enter key listener
//   document
//     .getElementById("productFinderInput")
//     .addEventListener("keypress", function (e) {
//       if (e.key === "Enter") {
//         searchProducts();
//       }
//     });

//   // Add input listener for real-time search
//   document
//     .getElementById("productFinderInput")
//     .addEventListener("input", function (e) {
//       currentSearchTerm = e.target.value.trim().toLowerCase();
//       filterProducts();
//     });

//   // Load all products initially
//   loadAllProducts();
// }

// function closeProductFinder() {
//   const modal = document.querySelector(".product-finder-modal");
//   if (modal) {
//     modal.remove();
//     document.body.style.overflow = "";
//   }
// }

// function filterByCategory(categoryName) {
//   // Update active category chip
//   document.querySelectorAll(".category-chip").forEach((chip) => {
//     chip.classList.remove("active");
//   });
//   event.target.classList.add("active");

//   currentCategory = categoryName;
//   filterProducts();
// }

// function searchProducts() {
//   currentSearchTerm = document
//     .getElementById("productFinderInput")
//     .value.trim()
//     .toLowerCase();
//   filterProducts();
// }

// function filterProducts() {
//   let filteredProducts = getAllProducts();

//   // Filter by category
//   if (currentCategory !== "All") {
//     if (currentCategory === "Seeds" || currentCategory === "Protection") {
//       filteredProducts = filteredProducts.filter(
//         (product) => product.category === currentCategory
//       );
//     } else {
//       // For Hardware, Nutrition, Combo Kit - show empty state
//       filteredProducts = [];
//     }
//   }

//   // Filter by search term
//   if (currentSearchTerm) {
//     filteredProducts = filteredProducts.filter(
//       (product) =>
//         product.name.toLowerCase().includes(currentSearchTerm) ||
//         product.category.toLowerCase().includes(currentSearchTerm) ||
//         product.subcategory.toLowerCase().includes(currentSearchTerm) ||
//         product.product_description.toLowerCase().includes(currentSearchTerm)
//     );
//   }

//   displayProducts(filteredProducts);
// }

// function getAllProducts() {
//   let allProducts = [];

//   productData.categories.forEach((category) => {
//     if (category.subcategories && category.subcategories.length > 0) {
//       category.subcategories.forEach((subcategory) => {
//         if (subcategory.products && subcategory.products.length > 0) {
//           allProducts = allProducts.concat(
//             subcategory.products.map((product) => ({
//               ...product,
//               category: category.name,
//               subcategory: subcategory.name,
//             }))
//           );
//         }
//       });
//     }
//   });

//   return allProducts;
// }

// function loadAllProducts() {
//   const allProducts = getAllProducts();
//   displayProducts(allProducts);
// }

// function displayProducts(products) {
//   const productsGrid = document.getElementById("productsGrid");
//   const resultsCount = document.getElementById("resultsCount");

//   // Update results count
//   resultsCount.textContent = `${products.length} product${
//     products.length === 1 ? "" : "s"
//   } found`;

//   if (products.length === 0) {
//     productsGrid.innerHTML = `
//                     <div class="no-results" style="grid-column: 1 / -1;">
//                         <i class="fas fa-search"></i>
//                         <p>No products found</p>
//                         <p>Try searching with different keywords or select another category</p>
//                     </div>
//                 `;
//   } else {
//     productsGrid.innerHTML = products
//       .map(
//         (product) => `
//                     <div class="product-card">
//                         <div class="product-icon">
//                             ${getProductIcon(
//                               product.category,
//                               product.subcategory
//                             )}
//                         </div>
//                         <h4>${product.name}</h4>
//                         <p class="category">${product.category} • ${
//           product.subcategory
//         }</p>
//                         <p class="product-description">${
//                           product.product_description
//                         }</p>
//                         <p class="price">
//                             ₹${product.OFFER_PRICE} 
//                             <span class="original-price">₹${product.MRP}</span>
//                         </p>
                        
//                         ${
//                           product.choose_weight &&
//                           product.choose_weight.length > 0
//                             ? `
//                         <div class="weight-selector">
//                             <select id="weight-${product.id}">
//                                 ${product.choose_weight
//                                   .map(
//                                     (weight) =>
//                                       `<option value="${weight}">${weight}</option>`
//                                   )
//                                   .join("")}
//                             </select>
//                         </div>
//                         `
//                             : ""
//                         }
                        
//                         <button class="add-to-cart-btn" onclick="addToCart(${
//                           product.id
//                         }, '${product.name.replace(/'/g, "\\'")}', ${
//           product.OFFER_PRICE
//         })">
//                             <i class="fas fa-shopping-cart"></i> Add to Cart
//                         </button>
//                     </div>
//                 `
//       )
//       .join("");
//   }
// }

// // Helper function to get appropriate icons for products
// function getProductIcon(category, subcategory) {
//   const icons = {
//     Seeds: "🌱",
//     "Vegetable Seeds": "🍅",
//     "Fruit Seeds": "🍉",
//     "Flower Seeds": "🌺",
//     "Herbal Seeds": "🌿",
//     "Organic Seeds": "🟢",
//     "Hybrid Seeds": "🧬",
//     "Field Crop Seeds": "🌾",
//     "Fodder Seeds": "🐄",
//     "Spice Seeds": "🌶️",
//     "Microgreen Seeds": "🥬",
//     Protection: "🛡️",
//     Insecticides: "🐛",
//     Fungicides: "🍄",
//   };

//   return icons[subcategory] || icons[category] || "📦";
// }

// // Cart functionality
// let cart = JSON.parse(localStorage.getItem("cart")) || [];

// function addToCart(productId, productName, price) {
//   // Get selected weight if available
//   const weightSelect = document.getElementById(`weight-${productId}`);
//   const selectedWeight = weightSelect ? weightSelect.value : "";

//   const cartItem = {
//     id: productId,
//     name: productName,
//     price: price,
//     weight: selectedWeight,
//     quantity: 1,
//     timestamp: Date.now(),
//   };

//   // Check if item already in cart
//   const existingItemIndex = cart.findIndex(
//     (item) => item.id === productId && item.weight === selectedWeight
//   );

//   if (existingItemIndex > -1) {
//     cart[existingItemIndex].quantity += 1;
//   } else {
//     cart.push(cartItem);
//   }

//   // Save to localStorage
//   localStorage.setItem("cart", JSON.stringify(cart));

//   // Show notification
//   showNotification(
//     `${productName} ${
//       selectedWeight ? `(${selectedWeight})` : ""
//     } added to cart!`,
//     "success"
//   );

//   // Update cart count in the main header (if exists)
//   updateCartCount();
// }

// function showNotification(message, type = "info") {
//   // Create notification element
//   const notification = document.createElement("div");
//   notification.style.cssText = `
//                 position: fixed;
//                 top: 20px;
//                 right: 20px;
//                 background: ${
//                   type === "success"
//                     ? "#10b981"
//                     : type === "error"
//                     ? "#ef4444"
//                     : "#3b82f6"
//                 };
//                 color: white;
//                 padding: 12px 20px;
//                 border-radius: 8px;
//                 box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
//                 z-index: 10001;
//                 transform: translateX(100%);
//                 transition: all 0.3s ease-out;
//                 max-width: 300px;
//                 font-size: 0.875rem;
//                 font-weight: 500;
//             `;

//   notification.innerHTML = `
//                 <div style="display: flex; align-items: center; gap: 8px;">
//                     <i class="fas fa-${
//                       type === "success"
//                         ? "check-circle"
//                         : type === "error"
//                         ? "exclamation-triangle"
//                         : "info-circle"
//                     }"></i>
//                     <span>${message}</span>
//                 </div>
//             `;

//   document.body.appendChild(notification);

//   // Animate in
//   setTimeout(() => {
//     notification.style.transform = "translateX(0)";
//   }, 10);

//   // Auto remove after 3 seconds
//   setTimeout(() => {
//     notification.style.transform = "translateX(100%)";
//     setTimeout(() => {
//       if (notification.parentElement) {
//         notification.remove();
//       }
//     }, 300);
//   }, 3000);
// }

// function updateCartCount() {
//   // Update cart count in the main header if it exists
//   const cartCountElement = document.getElementById("cartCount");
//   if (cartCountElement) {
//     const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
//     cartCountElement.textContent = totalItems;

//     // Add animation
//     cartCountElement.style.animation = "none";
//     setTimeout(() => {
//       cartCountElement.style.animation = "pulse 0.6s ease-in-out";
//     }, 10);
//   }
// }

// // Close modal when clicking outside
// document.addEventListener("click", function (event) {
//   const modal = document.querySelector(".product-finder-modal");
//   if (event.target === modal) {
//     closeProductFinder();
//   }
// });

// // Initialize cart count on page load
// document.addEventListener("DOMContentLoaded", function () {
//   updateCartCount();
// });

// function openSupportModal(event) {
//   event.preventDefault();
//   const modal = document.getElementById("supportModal");
//   modal.classList.add("active");
//   document.body.style.overflow = "hidden";
// }

// function closeSupportModal() {
//   const modal = document.getElementById("supportModal");
//   modal.classList.remove("active");
//   document.body.style.overflow = "";
// }

// function toggleLanguage(event) {
//   event.preventDefault();
//   showNotification("Language selection coming soon!", "info");
// }

// function contactSupport(type) {
//   switch (type) {
//     case "phone":
//       window.location.href = "tel:+918511916407";
//       break;
//     case "whatsapp":
//       window.open("https://wa.me/918511916407", "_blank");
//       break;
//     case "email":
//       window.location.href = "mailto:hello@greenagro.com";
//       break;
//     case "chat":
//       showNotification("Live chat will open shortly...", "info");
//       break;
//   }
//   closeSupportModal();
// }

// document.addEventListener("keydown", function (e) {
//   if (e.key === "Escape") {
//     closeProductFinder();
//     closeSupportModal();
//   }
// });

// // Initialize tooltips for top info links
// document.querySelectorAll(".top-info-left a[aria-label]").forEach((link) => {
//   link.addEventListener("mouseenter", function () {
//     this.title = this.getAttribute("aria-label");
//   });
// });

// // Mock order data - In a real application, this would come from a server
// const orderDatabase = {
//   GRN123456789: {
//     id: "GRN123456789",
//     status: "Shipped",
//     date: "2023-10-15",
//     estimatedDelivery: "2023-10-20",
//     customer: {
//       name: "Rajesh Kumar",
//       email: "rajesh@example.com",
//       phone: "+91 9876543210",
//     },
//     shippingAddress: {
//       name: "Rajesh Kumar",
//       street: "123 Green Farm Road",
//       city: "Agro City",
//       state: "Maharashtra",
//       pincode: "411001",
//       phone: "+91 9876543210",
//     },
//     items: [
//       {
//         id: 20101,
//         name: "Tomato Seeds",
//         price: 95,
//         quantity: 2,
//         weight: "100g",
//       },
//       {
//         id: 20102,
//         name: "Brinjal (Eggplant) Seeds",
//         price: 85,
//         quantity: 1,
//         weight: "50g",
//       },
//       {
//         id: 20103,
//         name: "Chilli Seeds",
//         price: 70,
//         quantity: 1,
//         weight: "50g",
//       },
//     ],
//     timeline: [
//       {
//         date: "2023-10-15 10:30",
//         status: "Order Placed",
//         description: "Your order has been placed successfully",
//       },
//       {
//         date: "2023-10-15 14:20",
//         status: "Order Confirmed",
//         description: "We have confirmed your order",
//       },
//       {
//         date: "2023-10-16 09:15",
//         status: "Order Shipped",
//         description: "Your order has been shipped",
//       },
//       {
//         date: "2023-10-20",
//         status: "Out for Delivery",
//         description: "Expected delivery today",
//       },
//       {
//         date: "",
//         status: "Delivered",
//         description: "Your order has been delivered",
//       },
//     ],
//     subtotal: 345,
//     shipping: 40,
//     tax: 31,
//     total: 416,
//   },
//   GRN987654321: {
//     id: "GRN987654321",
//     status: "Delivered",
//     date: "2023-10-10",
//     estimatedDelivery: "2023-10-15",
//     customer: {
//       name: "Priya Sharma",
//       email: "priya@example.com",
//       phone: "+91 8765432109",
//     },
//     shippingAddress: {
//       name: "Priya Sharma",
//       street: "456 Organic Garden",
//       city: "Farmville",
//       state: "Karnataka",
//       pincode: "560001",
//       phone: "+91 8765432109",
//     },
//     items: [
//       {
//         id: 20201,
//         name: "Watermelon Seeds",
//         price: 150,
//         quantity: 1,
//         weight: "250g",
//       },
//       {
//         id: 20301,
//         name: "Marigold Seeds",
//         price: 45,
//         quantity: 3,
//         weight: "25g",
//       },
//     ],
//     timeline: [
//       {
//         date: "2023-10-10 11:45",
//         status: "Order Placed",
//         description: "Your order has been placed successfully",
//       },
//       {
//         date: "2023-10-10 15:30",
//         status: "Order Confirmed",
//         description: "We have confirmed your order",
//       },
//       {
//         date: "2023-10-11 10:20",
//         status: "Order Shipped",
//         description: "Your order has been shipped",
//       },
//       {
//         date: "2023-10-12 14:15",
//         status: "Out for Delivery",
//         description: "Your order is out for delivery",
//       },
//       {
//         date: "2023-10-12 16:45",
//         status: "Delivered",
//         description: "Your order has been delivered",
//       },
//     ],
//     subtotal: 285,
//     shipping: 40,
//     tax: 26,
//     total: 351,
//   },
//   GRN555555555: {
//     id: "GRN555555555",
//     status: "Processing",
//     date: "2023-10-18",
//     estimatedDelivery: "2023-10-25",
//     customer: {
//       name: "Amit Patel",
//       email: "amit@example.com",
//       phone: "+91 7654321098",
//     },
//     shippingAddress: {
//       name: "Amit Patel",
//       street: "789 Harvest Street",
//       city: "Green Valley",
//       state: "Gujarat",
//       pincode: "380001",
//       phone: "+91 7654321098",
//     },
//     items: [
//       {
//         id: 20501,
//         name: "Organic Tomato Seeds",
//         price: 120,
//         quantity: 1,
//         weight: "100g",
//       },
//       {
//         id: 20601,
//         name: "Hybrid Tomato Seeds",
//         price: 160,
//         quantity: 1,
//         weight: "100g",
//       },
//     ],
//     timeline: [
//       {
//         date: "2023-10-18 09:20",
//         status: "Order Placed",
//         description: "Your order has been placed successfully",
//       },
//       {
//         date: "2023-10-18 13:45",
//         status: "Order Confirmed",
//         description: "We have confirmed your order",
//       },
//       {
//         date: "",
//         status: "Processing",
//         description: "We are preparing your order",
//       },
//       {
//         date: "",
//         status: "Shipped",
//         description: "Your order will be shipped soon",
//       },
//       {
//         date: "",
//         status: "Delivered",
//         description: "Your order will be delivered",
//       },
//     ],
//     subtotal: 280,
//     shipping: 40,
//     tax: 29,
//     total: 349,
//   },
// };

// // Track Order Modal Functions
// function openTrackOrderModal(event) {
//   event.preventDefault();
//   const modal = document.getElementById("trackOrderModal");
//   modal.classList.add("active");
//   document.body.style.overflow = "hidden";

//   // Focus on order ID input
//   setTimeout(() => {
//     document.getElementById("orderId").focus();
//   }, 100);

//   // Add enter key listener
//   document.getElementById("orderId").addEventListener("keypress", function (e) {
//     if (e.key === "Enter") {
//       trackOrder();
//     }
//   });
// }

// function closeTrackOrderModal() {
//   const modal = document.getElementById("trackOrderModal");
//   modal.classList.remove("active");
//   document.body.style.overflow = "";
// }

// function trackOrder() {
//   const orderId = document.getElementById("orderId").value.trim().toUpperCase();
//   const orderInfo = document.getElementById("orderInfo");

//   if (!orderId) {
//     showNotification("Please enter an Order ID", "error");
//     return;
//   }

//   // Check if order exists in our database
//   if (orderDatabase[orderId]) {
//     const order = orderDatabase[orderId];
//     displayOrderInfo(order);
//     orderInfo.classList.add("active");
//   } else {
//     showNotification(
//       "Order ID not found. Please check and try again.",
//       "error"
//     );
//     orderInfo.classList.remove("active");
//   }
// }

// function displayOrderInfo(order) {
//   // Update order status
//   document.getElementById("orderStatus").textContent = `Order ${order.status}`;

//   // Update order timeline
//   const timelineElement = document.getElementById("orderTimeline");
//   timelineElement.innerHTML = "";

//   order.timeline.forEach((event, index) => {
//     let statusClass = "pending";
//     if (event.date) {
//       statusClass =
//         index < order.timeline.findIndex((e) => e.status === order.status)
//           ? "completed"
//           : event.status === order.status
//           ? "active"
//           : "completed";
//     }

//     const timelineItem = document.createElement("div");
//     timelineItem.className = `timeline-item ${statusClass}`;
//     timelineItem.innerHTML = `
//                     <div class="timeline-date">${event.date || "Pending"}</div>
//                     <div class="timeline-content">${event.status}</div>
//                     <div style="font-size: 0.85rem; color: #666; margin-top: 5px;">${
//                       event.description
//                     }</div>
//                 `;
//     timelineElement.appendChild(timelineItem);
//   });

//   // Update order items
//   const itemsElement = document.getElementById("orderItems");
//   itemsElement.innerHTML = "";

//   order.items.forEach((item) => {
//     const itemElement = document.createElement("div");
//     itemElement.className = "order-item";
//     itemElement.innerHTML = `
//                     <div class="item-name">${item.name} (${item.weight})</div>
//                     <div class="item-qty">Qty: ${item.quantity}</div>
//                     <div class="item-price">₹${item.price * item.quantity}</div>
//                 `;
//     itemsElement.appendChild(itemElement);
//   });

//   // Update order summary
//   document.getElementById("subtotal").textContent = `₹${order.subtotal}`;
//   document.getElementById("shipping").textContent = `₹${order.shipping}`;
//   document.getElementById("tax").textContent = `₹${order.tax}`;
//   document.getElementById("total").textContent = `₹${order.total}`;
// }

// function showNotification(message, type = "success") {
//   const notification = document.getElementById("notification");
//   const notificationText = document.getElementById("notificationText");

//   notificationText.textContent = message;
//   notification.className = `notification ${type}`;
//   notification.classList.add("active");

//   setTimeout(() => {
//     notification.classList.remove("active");
//   }, 3000);
// }

// // Login functionality
// function openLoginModal() {
//   const modal = document.getElementById("loginModal");
//   modal.classList.add("active");
//   document.body.style.overflow = "hidden";

//   // Reset forms
//   resetLoginForms();

//   // Focus on first input
//   setTimeout(() => {
//     document.getElementById("mobileNumber").focus();
//   }, 100);
// }

// function closeLoginModal() {
//   const modal = document.getElementById("loginModal");
//   modal.classList.remove("active");
//   document.body.style.overflow = "";
// }

// function switchLoginTab(tab) {
//   // Update tab buttons
//   document.querySelectorAll(".tab-button").forEach((button) => {
//     button.classList.remove("active");
//   });
//   event.target.classList.add("active");

//   // Show corresponding form
//   document.querySelectorAll(".login-form").forEach((form) => {
//     form.classList.remove("active");
//   });
//   document.getElementById(tab + "LoginForm").classList.add("active");

//   // Reset forms when switching tabs
//   resetLoginForms();
// }

// function resetLoginForms() {
//   // Clear all inputs
//   document.querySelectorAll(".login-form input").forEach((input) => {
//     input.value = "";
//     input.classList.remove("error");
//   });

//   // Remove error messages
//   document.querySelectorAll(".error-message").forEach((error) => {
//     error.remove();
//   });
// }

// function loginWithMobile() {
//   const countryCode = document.getElementById("countryCode").value;
//   const mobileNumber = document.getElementById("mobileNumber").value;
//   const password = document.getElementById("mobilePassword").value;
//   const rememberMe = document.getElementById("rememberMobile").checked;

//   // Validation
//   if (!validateMobileNumber(mobileNumber)) {
//     showInputError(
//       "mobileNumber",
//       "Please enter a valid 10-digit mobile number"
//     );
//     return;
//   }

//   if (!validatePassword(password, 6)) {
//     showInputError("mobilePassword", "Password must be exactly 6 digits");
//     return;
//   }

//   // Simulate login process
//   const loginBtn = event.target;
//   const originalText = loginBtn.innerHTML;
//   loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
//   loginBtn.disabled = true;

//   // Simulate API call
//   setTimeout(() => {
//     // Mock successful login
//     showNotification("Successfully logged in!", "success");
//     closeLoginModal();

//     // Update UI for logged-in state
//     updateUserState({
//       name: "Rajesh Kumar",
//       email: "rajesh@example.com",
//       mobile: countryCode + mobileNumber,
//     });

//     // Reset button
//     loginBtn.innerHTML = originalText;
//     loginBtn.disabled = false;
//   }, 2000);
// }

// function loginWithEmail() {
//   const email = document.getElementById("email").value;
//   const password = document.getElementById("emailPassword").value;
//   const rememberMe = document.getElementById("rememberEmail").checked;

//   // Validation
//   if (!validateEmail(email)) {
//     showInputError("email", "Please enter a valid email address");
//     return;
//   }

//   if (!validatePassword(password)) {
//     showInputError(
//       "emailPassword",
//       "Password must be at least 6 characters long"
//     );
//     return;
//   }

//   // Simulate login process
//   const loginBtn = event.target;
//   const originalText = loginBtn.innerHTML;
//   loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
//   loginBtn.disabled = true;

//   // Simulate API call
//   setTimeout(() => {
//     // Mock successful login
//     showNotification("Successfully logged in!", "success");
//     closeLoginModal();

//     // Update UI for logged-in state
//     updateUserState({
//       name: "Rajesh Kumar",
//       email: email,
//       mobile: "+91 9876543210",
//     });

//     // Reset button
//     loginBtn.innerHTML = originalText;
//     loginBtn.disabled = false;
//   }, 2000);
// }

// function validateMobileNumber(mobile) {
//   const mobileRegex = /^[6-9]\d{9}$/;
//   return mobileRegex.test(mobile);
// }

// function validateEmail(email) {
//   const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//   return emailRegex.test(email);
// }

// function validatePassword(password, minLength = 6) {
//   return password.length >= minLength;
// }

// function showInputError(inputId, message) {
//   const input = document.getElementById(inputId);
//   input.classList.add("error");

//   // Remove existing error message
//   const existingError = input.parentNode.querySelector(".error-message");
//   if (existingError) {
//     existingError.remove();
//   }

//   // Add new error message
//   const errorElement = document.createElement("div");
//   errorElement.className = "error-message";
//   errorElement.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
//   input.parentNode.appendChild(errorElement);

//   // Focus on the input
//   input.focus();
// }

// function forgotPassword(type) {
//   showNotification("Password reset feature coming soon!", "info");
// }

// function socialLogin(provider) {
//   showNotification(`Logging in with ${provider}...`, "info");

//   // Simulate social login process
//   setTimeout(() => {
//     showNotification(`Successfully logged in with ${provider}!`, "success");
//     closeLoginModal();

//     updateUserState({
//       name: "Social User",
//       email: `user@${provider}.com`,
//       mobile: "+91 0000000000",
//     });
//   }, 2000);
// }

// function updateUserState(user) {
//   // Update account button
//   const accountBtn = document.getElementById("accountBtn");
//   if (accountBtn) {
//     accountBtn.innerHTML = `
//                     <i class="fas fa-user-circle"></i>
//                     <span>${user.name.split(" ")[0]}</span>
//                 `;
//     accountBtn.title = `Welcome, ${user.name}`;
//   }

//   // Update login button
//   const loginBtn = document.getElementById("loginBtn");
//   if (loginBtn) {
//     loginBtn.textContent = "Logout";
//     loginBtn.href = "#logout";
//     loginBtn.onclick = function (e) {
//       e.preventDefault();
//       logoutUser();
//     };
//   }

//   // Show welcome notification
//   showNotification(`Welcome back, ${user.name}!`, "success");

//   // Store user data in localStorage
//   localStorage.setItem("currentUser", JSON.stringify(user));
// }

// function logoutUser() {
//   localStorage.removeItem("currentUser");

//   // Reset account button
//   const accountBtn = document.getElementById("accountBtn");
//   if (accountBtn) {
//     accountBtn.innerHTML = `
//                     <i class="fas fa-user-circle"></i>
//                     <span>Account</span>
//                 `;
//     accountBtn.title = "My Account";
//   }

//   // Reset login button
//   const loginBtn = document.getElementById("loginBtn");
//   if (loginBtn) {
//     loginBtn.textContent = "Login / Get Started";
//     loginBtn.href = "#login";
//     loginBtn.onclick = function (e) {
//       e.preventDefault();
//       openLoginModal();
//     };
//   }

//   showNotification("Successfully logged out!", "success");
// }

// function openSignupModal() {
//   closeLoginModal();
//   showNotification("Signup feature coming soon!", "info");
// }

// // Initialize login functionality when page loads
// document.addEventListener("DOMContentLoaded", function () {
//   // Add click event to account button
//   const accountBtn = document.getElementById("accountBtn");
//   if (accountBtn) {
//     accountBtn.addEventListener("click", function (e) {
//       e.preventDefault();
//       openLoginModal();
//     });
//   }

//   // Add click event to login button
//   const loginBtn = document.getElementById("loginBtn");
//   if (loginBtn) {
//     loginBtn.addEventListener("click", function (e) {
//       e.preventDefault();
//       openLoginModal();
//     });
//   }

//   // Check if user is already logged in
//   const currentUser = localStorage.getItem("currentUser");
//   if (currentUser) {
//     updateUserState(JSON.parse(currentUser));
//   }
// });

// // Close modals when clicking outside
// document.addEventListener("click", function (event) {
//   const loginModal = document.getElementById("loginModal");

//   if (event.target === loginModal) {
//     closeLoginModal();
//   }
// });

// // Support modal functions
// function openSupportModal(event) {
//   event.preventDefault();
//   const modal = document.getElementById("supportModal");
//   modal.classList.add("active");
//   document.body.style.overflow = "hidden";
// }

// function closeSupportModal() {
//   const modal = document.getElementById("supportModal");
//   modal.classList.remove("active");
//   document.body.style.overflow = "";
// }

// function contactSupport(type) {
//   switch (type) {
//     case "phone":
//       window.location.href = "tel:+918511916407";
//       break;
//     case "whatsapp":
//       window.open("https://wa.me/918511916407", "_blank");
//       break;
//     case "email":
//       window.location.href = "mailto:hello@greenagro.com";
//       break;
//     case "chat":
//       showNotification("Live chat will open shortly...", "info");
//       break;
//   }
//   closeSupportModal();
// }

// function toggleLanguage(event) {
//   event.preventDefault();
//   showNotification("Language selection coming soon!", "info");
// }

// function showNotification(message, type = "success") {
//   // Create a simple notification
//   const notification = document.createElement("div");
//   notification.style.cssText = `
//                 position: fixed;
//                 top: 20px;
//                 right: 20px;
//                 background: ${
//                   type === "success"
//                     ? "#10b981"
//                     : type === "error"
//                     ? "#ef4444"
//                     : "#3b82f6"
//                 };
//                 color: white;
//                 padding: 12px 20px;
//                 border-radius: 8px;
//                 box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
//                 z-index: 10001;
//                 font-size: 0.875rem;
//                 font-weight: 500;
//             `;
//   notification.innerHTML = `
//                 <div style="display: flex; align-items: center; gap: 8px;">
//                     <i class="fas fa-${
//                       type === "success"
//                         ? "check-circle"
//                         : type === "error"
//                         ? "exclamation-triangle"
//                         : "info-circle"
//                     }"></i>
//                     <span>${message}</span>
//                 </div>
//             `;
//   document.body.appendChild(notification);

//   // Remove after 3 seconds
//   setTimeout(() => {
//     notification.remove();
//   }, 3000);
// }

// let selectedOption = null;

// // Open login modal
// function openLoginModal() {
//   document.getElementById("loginModal").classList.add("active");
//   resetForms();
//   showOptions();
// }

// // Close login modal
// function closeLoginModal() {
//   document.getElementById("loginModal").classList.remove("active");
//   resetForms();
// }

// // Show login options
// function showOptions() {
//   document.getElementById("loginOptions").style.display = "flex";
//   document
//     .querySelectorAll(".login-form")
//     .forEach((form) => form.classList.remove("active"));
//   document
//     .querySelectorAll(".login-option")
//     .forEach((option) => option.classList.remove("selected"));
// }

// // Select login option
// function selectLoginOption(option) {

//   // Update UI
//   document
//     .querySelectorAll(".login-option")
//     .forEach((opt) => opt.classList.remove("selected"));
//   document
//     .querySelector(`.login-option[data-option="${option}"]`)
//     .classList.add("selected");

//   // Hide options and show appropriate form
//   document.getElementById("loginOptions").style.display = "none";

//   if (option === "mobile") {
//     document.getElementById("mobileLoginForm").classList.add("active");
//   } else if (option === "email") {
//     document.getElementById("emailLoginForm").classList.add("active");
//   } else if (option === "google") {
//     loginWithGoogle();
//   } else if (option === "facebook") {
//     loginWithFacebook();
//   }
// }

// // Back to options
// function backToOptions() {
//   showOptions();
// }

// // Reset all forms to initial state
// function resetForms() {
//   // Reset mobile form
//   document.getElementById("mobileNumber").value = "";
//   document.getElementById("otpSection").style.display = "none";
//   document.getElementById("mobileError").style.display = "none";
//   document.getElementById("otpError").style.display = "none";
//   document.getElementById("otpSuccess").style.display = "none";
//   document.getElementById("countdown").style.display = "none";

//   // Reset OTP inputs
//   const otpInputs = document.querySelectorAll(".otp-input");
//   otpInputs.forEach((input) => (input.value = ""));

//   // Reset email form
//   document.getElementById("email").value = "";
//   document.getElementById("password").value = "";
//   document.getElementById("emailError").style.display = "none";
//   document.getElementById("passwordError").style.display = "none";
// }

// // Get OTP for mobile login
// function getOTP() {
//   const mobileNumber = document.getElementById("mobileNumber").value;
//   const mobileError = document.getElementById("mobileError");

//   // Validate mobile number
//   if (!mobileNumber || mobileNumber.length !== 10 || isNaN(mobileNumber)) {
//     mobileError.style.display = "block";
//     return;
//   }

//   mobileError.style.display = "none";

//   // Show OTP section
//   document.getElementById("otpSection").style.display = "block";

//   // Start countdown for resend OTP
//   startCountdown();

//   // In a real app, you would send the OTP to the mobile number here
//   console.log(`OTP sent to ${mobileNumber}`);

//   // For demo purposes, we'll auto-fill a sample OTP
//   setTimeout(() => {
//     const otpInputs = document.querySelectorAll(".otp-input");
//     const sampleOTP = "123456";

//     otpInputs.forEach((input, index) => {
//       input.value = sampleOTP[index];
//     });
//   }, 1000);
// }

// // Verify OTP
// function verifyOTP() {
//   const otpInputs = document.querySelectorAll(".otp-input");
//   let otp = "";

//   otpInputs.forEach((input) => {
//     otp += input.value;
//   });

//   const otpError = document.getElementById("otpError");
//   const otpSuccess = document.getElementById("otpSuccess");

//   // Validate OTP
//   if (otp.length !== 6) {
//     otpError.style.display = "block";
//     otpSuccess.style.display = "none";
//     return;
//   }

//   // In a real app, you would verify the OTP with your backend
//   // For demo, we'll assume it's correct
//   otpError.style.display = "none";
//   otpSuccess.style.display = "block";

//   // Simulate login success
//   setTimeout(() => {
//     alert(`Login successful! Welcome to GreenAgro.`);
//     closeLoginModal();

//     // In a real app, you would redirect to the user's dashboard
//   }, 1000);
// }

// // Resend OTP
// function resendOTP() {
//   const mobileNumber = document.getElementById("mobileNumber").value;

//   // In a real app, you would resend the OTP to the mobile number
//   console.log(`OTP resent to ${mobileNumber}`);

//   // Reset OTP inputs
//   const otpInputs = document.querySelectorAll(".otp-input");
//   otpInputs.forEach((input) => (input.value = ""));

//   // Restart countdown
//   startCountdown();

//   // For demo purposes, we'll auto-fill a sample OTP again
//   setTimeout(() => {
//     const sampleOTP = "123456";

//     otpInputs.forEach((input, index) => {
//       input.value = sampleOTP[index];
//     });
//   }, 1000);
// }

// // Start countdown for resend OTP
// function startCountdown() {
//   const countdownElement = document.getElementById("countdown");
//   const countdownTimer = document.getElementById("countdownTimer");
//   const resendLink = document.getElementById("resendOtpLink");

//   countdownElement.style.display = "inline";
//   resendLink.style.display = "none";

//   let timeLeft = 60;

//   const countdownInterval = setInterval(() => {
//     timeLeft--;
//     countdownTimer.textContent = timeLeft;

//     if (timeLeft <= 0) {
//       clearInterval(countdownInterval);
//       countdownElement.style.display = "none";
//       resendLink.style.display = "inline";
//     }
//   }, 1000);
// }

// // Move to next OTP input
// function moveToNext(current, nextIndex) {
//   if (current.value.length === 1) {
//     const nextInput = document.querySelectorAll(".otp-input")[nextIndex];
//     if (nextInput) {
//       nextInput.focus();
//     }
//   }
// }

// // Login with email and password
// function loginWithEmail() {
//   const email = document.getElementById("email").value;
//   const password = document.getElementById("password").value;

//   const emailError = document.getElementById("emailError");
//   const passwordError = document.getElementById("passwordError");

//   let isValid = true;

//   // Validate email
//   if (!email || !isValidEmail(email)) {
//     emailError.style.display = "block";
//     isValid = false;
//   } else {
//     emailError.style.display = "none";
//   }

//   // Validate password
//   if (!password) {
//     passwordError.style.display = "block";
//     isValid = false;
//   } else {
//     passwordError.style.display = "none";
//   }

//   if (isValid) {
//     // In a real app, you would send the login request to your backend
//     console.log(`Login attempt with email: ${email}`);

//     // Simulate login success
//     setTimeout(() => {
//       alert(`Login successful! Welcome to GreenAgro.`);
//       closeLoginModal();

//       // In a real app, you would redirect to the user's dashboard
//     }, 1000);
//   }
// }

// // Validate email format
// function isValidEmail(email) {
//   const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//   return emailRegex.test(email);
// }

// // Toggle password visibility
// document
//   .getElementById("passwordToggle")
//   .addEventListener("click", function () {
//     const passwordInput = document.getElementById("password");
//     const icon = this.querySelector("i");

//     if (passwordInput.type === "password") {
//       passwordInput.type = "text";
//       icon.classList.remove("fa-eye");
//       icon.classList.add("fa-eye-slash");
//     } else {
//       passwordInput.type = "password";
//       icon.classList.remove("fa-eye-slash");
//       icon.classList.add("fa-eye");
//     }
//   });

// // Social login functions
// function loginWithGoogle() {
//   // In a real app, you would integrate with Google OAuth
//   console.log("Google login clicked");

//   // Simulate login success
//   setTimeout(() => {
//     alert(`Google login successful! Welcome to GreenAgro.`);
//     closeLoginModal();
//   }, 1000);
// }

// function loginWithFacebook() {
//   // In a real app, you would integrate with Facebook OAuth
//   console.log("Facebook login clicked");

//   // Simulate login success
//   setTimeout(() => {
//     alert(`Facebook login successful! Welcome to GreenAgro.`);
//     closeLoginModal();
//   }, 1000);
// }

// // Show signup form (for demo purposes)
// function showSignup() {
//   alert("Sign up form would be shown here");
//   // In a real app, you would switch to a signup form or open a registration modal
// }

// // Close modal when clicking outside
// document.getElementById("loginModal").addEventListener("click", function (e) {
//   if (e.target === this) {
//     closeLoginModal();
//   }
// });

// // Allow pressing Enter to submit forms
// document.addEventListener("keypress", function (e) {
//   if (e.key === "Enter") {
//     if (selectedOption === "mobile") {
//       if (document.getElementById("otpSection").style.display === "block") {
//         verifyOTP();
//       } else {
//         getOTP();
//       }
//     } else if (selectedOption === "email") {
//       loginWithEmail();
//     }
//   }
// });


// Assets/js/header.js
// Enhanced announcement bar close functionality
function closeAnnouncement() {
  const announcement = document.getElementById("announcement");
  if (announcement) {
    announcement.style.transform = "translateY(-100%)";
    announcement.style.opacity = "0";
    setTimeout(() => {
      announcement.style.display = "none";
    }, 300);
  }
}

// Mobile menu toggle with accessibility
const mobileToggle = document.getElementById("mobileToggle");
const navMenu = document.getElementById("navMenu");

if (mobileToggle && navMenu) {
  mobileToggle.addEventListener("click", function () {
    const isExpanded = this.getAttribute("aria-expanded") === "true";

    this.setAttribute("aria-expanded", !isExpanded);
    this.classList.toggle("active");
    navMenu.classList.toggle("active");

    // Prevent body scroll when menu is open
    document.body.style.overflow = navMenu.classList.contains("active")
      ? "hidden"
      : "";
  });

  // Close mobile menu when clicking outside
  document.addEventListener("click", function (e) {
    if (!e.target.closest(".navbar") && navMenu.classList.contains("active")) {
      mobileToggle.click();
    }
  });
}

// Enhanced search functionality
const searchInput = document.getElementById("searchInput");
const searchBtn = document.querySelector(".search-btn");
const voiceBtn = document.querySelector(".voice-search");

let searchTimeout;

// Search suggestions data
const searchSuggestions = [
  "Tomato Seeds",
  "Organic Fertilizer",
  "Drip Irrigation Kit",
  "Wheat Seeds",
  "Pesticide Spray",
  "GreenAgro Tools",
  "Crop Planning Software",
  "Soil Testing Kit",
];

// Debounced search with suggestions
if (searchInput) {
  searchInput.addEventListener("input", function () {
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

    console.log("Searching for:", searchTerm);

    // Add loading state
    if (searchBtn) {
      searchBtn.innerHTML =
        '<i class="fas fa-spinner fa-spin"></i> <span>Searching...</span>';
      searchInput.classList.add("loading");
    }

    // Simulate search API call
    setTimeout(() => {
      if (searchBtn) {
        searchBtn.innerHTML = '<i class="fas fa-search"></i> <span>Search</span>';
      }
      searchInput.classList.remove("loading");
      hideSearchSuggestions();

      // Show search results notification
      showNotification(`Found results for "${searchTerm}"`, "success");
    }, 1000);
  }

  searchInput.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();
      performSearch();
    }
  });
}

if (searchBtn) {
  searchBtn.addEventListener("click", performSearch);
}

// Voice search functionality
if (voiceBtn) {
  voiceBtn.addEventListener("click", function () {
    if (
      !("webkitSpeechRecognition" in window) &&
      !("SpeechRecognition" in window)
    ) {
      showNotification("Voice search not supported in your browser", "error");
      return;
    }

    const SpeechRecognition =
      window.SpeechRecognition || window.webkitSpeechRecognition;
    const recognition = new SpeechRecognition();

    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.lang = "en-US";

    recognition.onstart = () => {
      this.innerHTML =
        '<i class="fas fa-stop" style="color: var(--danger);"></i>';
      this.setAttribute("aria-label", "Stop voice search");
    };

    recognition.onresult = (event) => {
      const transcript = event.results[0][0].transcript;
      if (searchInput) {
        searchInput.value = transcript;
        searchInput.focus();
      }

      if (event.results[0][0].confidence > 0.7) {
        setTimeout(performSearch, 500);
      }
    };

    recognition.onend = () => {
      this.innerHTML = '<i class="fas fa-microphone"></i>';
      this.setAttribute("aria-label", "Start voice search");
    };

    recognition.onerror = () => {
      showNotification("Voice search error. Please try again.", "error");
      this.innerHTML = '<i class="fas fa-microphone"></i>';
      this.setAttribute("aria-label", "Start voice search");
    };

    recognition.start();
  });
}

// Search suggestions UI
function showSearchSuggestions(query) {
  const suggestions = searchSuggestions
    .filter((item) => item.toLowerCase().includes(query.toLowerCase()))
    .slice(0, 6);

  if (suggestions.length === 0) return;

  let dropdown = document.querySelector(".search-suggestions");
  if (!dropdown) {
    dropdown = document.createElement("div");
    dropdown.className = "search-suggestions";
    dropdown.setAttribute("role", "listbox");
    const searchBar = document.querySelector(".search-bar");
    if (searchBar) {
      searchBar.appendChild(dropdown);
    }
  }

  dropdown.innerHTML = suggestions
    .map(
      (suggestion, index) => `
                <div class="suggestion-item" 
                     role="option" 
                     data-value="${suggestion}"
                     aria-selected="false"
                     tabindex="-1">
                    <i class="fas fa-search"></i>
                    ${suggestion}
                </div>
            `
    )
    .join("");

  // Add click handlers
  dropdown.querySelectorAll(".suggestion-item").forEach((item) => {
    item.addEventListener("click", () => {
      if (searchInput) {
        searchInput.value = item.dataset.value;
      }
      hideSearchSuggestions();
      performSearch();
    });
  });
}

function hideSearchSuggestions() {
  const dropdown = document.querySelector(".search-suggestions");
  if (dropdown) {
    dropdown.remove();
  }
}

// Close suggestions when clicking outside
document.addEventListener("click", function (e) {
  if (!e.target.closest(".search-bar")) {
    hideSearchSuggestions();
  }
});

// Notification system
function showNotification(message, type = "info") {
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
                z-index: 10000;
                transform: translateX(100%);
                transition: all 0.3s ease-out;
                max-width: 300px;
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

  // Animate in
  setTimeout(() => {
    notification.style.transform = "translateX(0)";
  }, 10);

  // Auto remove
  setTimeout(() => {
    notification.style.transform = "translateX(100%)";
    setTimeout(() => {
      if (notification.parentElement) {
        notification.remove();
      }
    }, 300);
  }, 4000);
}

// Scroll behavior for navbar
let lastScrollY = window.scrollY;

window.addEventListener(
  "scroll",
  () => {
    const navbar = document.getElementById("navbar");
    const currentScrollY = window.scrollY;

    if (navbar) {
      if (currentScrollY > 100) {
        navbar.style.boxShadow = "var(--shadow-md)";
      } else {
        navbar.style.boxShadow = "var(--shadow-sm)";
      }
    }

    lastScrollY = currentScrollY;
  },
  {
    passive: true,
  }
);

// Cart interaction enhancement
document.querySelectorAll(".action-btn").forEach((btn) => {
  btn.addEventListener("click", function (e) {
    const count = this.querySelector(".cart-count, .wishlist-count");
    if (
      (count && this.getAttribute("href")?.includes("cart")) ||
      this.getAttribute("href")?.includes("wishlist")
    ) {
      e.preventDefault();

      // Animate count badge
      count.style.animation = "none";
      setTimeout(() => {
        count.style.animation = "pulse 0.6s ease-in-out";
      }, 10);

      const itemType = this.getAttribute("href").includes("cart")
        ? "cart"
        : "wishlist";
      showNotification(`Opening your ${itemType}...`, "info");
    }
  });
});

// Initialize on page load
document.addEventListener("DOMContentLoaded", function () {
  console.log("🌿 GreenAgro header initialized successfully!");

  // Auto-hide announcement after 15 seconds
  setTimeout(() => {
    const announcement = document.getElementById("announcement");
    if (announcement && announcement.style.display !== "none") {
      announcement.style.opacity = "0.8";
    }
  }, 15000);
});

// Handle window resize
let resizeTimeout;
window.addEventListener("resize", function () {
  clearTimeout(resizeTimeout);
  resizeTimeout = setTimeout(() => {
    // Reset mobile menu state on larger screens
    if (window.innerWidth > 1023 && navMenu && navMenu.classList.contains("active")) {
      mobileToggle.click();
    }

    // Hide search suggestions on resize
    hideSearchSuggestions();
  }, 250);
});

// Define all categories including the ones without data
const allCategories = [
  { id: 1, name: "All", icon: "🛒" },
  { id: 2, name: "Seeds", icon: "🌱" },
  { id: 3, name: "Protection", icon: "🛡️" },
  { id: 4, name: "Hardware", icon: "🔧" },
  { id: 5, name: "Nutrition", icon: "🧪" },
  { id: 6, name: "Combo Kit", icon: "🎁" },
];

// Your complete JSON data
const productData = {
  categories: [
    {
      id: 1,
      name: "All",
      subcategories: [],
    },
    {
      id: 2,
      name: "Seeds",
      subcategories: [
        {
          id: 201,
          name: "Vegetable Seeds",
          products: [
            {
              id: 20101,
              name: "Tomato Seeds",
              images: [
                "./Assets/imagess/tomato1.jpg",
                "./Assets/imagess/tomato2.jpg",
              ],
              MRP: 120,
              OFFER_PRICE: 95,
              choose_weight: ["50g", "100g", "250g", "500g", "1kg"],
              product_description:
                "High-yield tomato seeds with excellent disease resistance. Perfect for home gardens and commercial GreenAgroing.",
              key_points: [
                "High germination rate",
                "Disease resistant",
                "Suitable for all seasons",
                "Fast growing",
              ],
            },
            // ... (rest of your product data remains the same)
          ],
        },
        // ... (rest of your categories remain the same)
      ],
    },
    {
      id: 3,
      name: "Protection",
      subcategories: [
        {
          id: 301,
          name: "Insecticides",
          products: [
            {
              id: 30101,
              name: "Imidacloprid Insecticide",
              images: ["imidacloprid1.jpg", "imidacloprid2.jpg"],
              MRP: 350,
              OFFER_PRICE: 280,
              choose_weight: ["100ml", "250ml", "500ml", "1L", "5L"],
              product_description:
                "Systemic insecticide effective against sucking pests.",
              key_points: [
                "Systemic action",
                "Long lasting effect",
                "Broad spectrum",
                "Rainfast",
              ],
            },
            // ... (rest of protection products)
          ],
        },
        // ... (rest of protection subcategories)
      ],
    },
  ],
};

let currentCategory = "All";
let currentSearchTerm = "";

// Product Finder Modal Function
function openProductFinder(event) {
  if (event) event.preventDefault();
  
  // Create modal overlay
  const modal = document.createElement("div");
  modal.className = "product-finder-modal";
  modal.innerHTML = `
                <div class="modal-content">
                    <div class="modal-header">
                        <h2><i class="fas fa-search-plus"></i> Find Farming Products</h2>
                        <button class="close-modal" onclick="closeProductFinder()" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="product-search-box">
                            <input 
                                type="text" 
                                id="productFinderInput" 
                                placeholder="Search for seeds, fertilizers, tools, equipment..." 
                                class="product-finder-input"
                                autocomplete="off"
                            >
                            <button class="product-search-btn" onclick="searchProducts()">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                        
                        <div class="quick-categories">
                            <h3>Popular Categories:</h3>
                            <div class="category-chips" id="categoryChips">
                                ${allCategories
                                  .map(
                                    (category) => `
                                    <button class="category-chip ${
                                      category.name === "All" ? "active" : ""
                                    }" 
                                            onclick="filterByCategory('${
                                              category.name
                                            }')">
                                        ${category.icon} ${category.name}
                                    </button>
                                `
                                  )
                                  .join("")}
                            </div>
                        </div>
                        
                        <div id="productResults" class="product-results">
                            <div class="results-header">
                                <h3>All Products</h3>
                                <span class="results-count" id="resultsCount"></span>
                            </div>
                            <div class="product-grid" id="productsGrid">
                                <!-- Products will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            `;

  document.body.appendChild(modal);
  document.body.style.overflow = "hidden";

  // Focus on search input
  setTimeout(() => {
    const input = document.getElementById("productFinderInput");
    if (input) input.focus();
  }, 100);

  // Add enter key listener
  const productFinderInput = document.getElementById("productFinderInput");
  if (productFinderInput) {
    productFinderInput.addEventListener("keypress", function (e) {
      if (e.key === "Enter") {
        searchProducts();
      }
    });

    // Add input listener for real-time search
    productFinderInput.addEventListener("input", function (e) {
      currentSearchTerm = e.target.value.trim().toLowerCase();
      filterProducts();
    });
  }

  // Load all products initially
  loadAllProducts();
}

function closeProductFinder() {
  const modal = document.querySelector(".product-finder-modal");
  if (modal) {
    modal.remove();
    document.body.style.overflow = "";
  }
}

function filterByCategory(categoryName) {
  // Update active category chip
  document.querySelectorAll(".category-chip").forEach((chip) => {
    chip.classList.remove("active");
  });
  event.target.classList.add("active");

  currentCategory = categoryName;
  filterProducts();
}

function searchProducts() {
  const input = document.getElementById("productFinderInput");
  if (input) {
    currentSearchTerm = input.value.trim().toLowerCase();
    filterProducts();
  }
}

function filterProducts() {
  let filteredProducts = getAllProducts();

  // Filter by category
  if (currentCategory !== "All") {
    if (currentCategory === "Seeds" || currentCategory === "Protection") {
      filteredProducts = filteredProducts.filter(
        (product) => product.category === currentCategory
      );
    } else {
      // For Hardware, Nutrition, Combo Kit - show empty state
      filteredProducts = [];
    }
  }

  // Filter by search term
  if (currentSearchTerm) {
    filteredProducts = filteredProducts.filter(
      (product) =>
        product.name.toLowerCase().includes(currentSearchTerm) ||
        product.category.toLowerCase().includes(currentSearchTerm) ||
        product.subcategory.toLowerCase().includes(currentSearchTerm) ||
        product.product_description.toLowerCase().includes(currentSearchTerm)
    );
  }

  displayProducts(filteredProducts);
}

function getAllProducts() {
  let allProducts = [];

  productData.categories.forEach((category) => {
    if (category.subcategories && category.subcategories.length > 0) {
      category.subcategories.forEach((subcategory) => {
        if (subcategory.products && subcategory.products.length > 0) {
          allProducts = allProducts.concat(
            subcategory.products.map((product) => ({
              ...product,
              category: category.name,
              subcategory: subcategory.name,
            }))
          );
        }
      });
    }
  });

  return allProducts;
}

function loadAllProducts() {
  const allProducts = getAllProducts();
  displayProducts(allProducts);
}

function displayProducts(products) {
  const productsGrid = document.getElementById("productsGrid");
  const resultsCount = document.getElementById("resultsCount");

  if (!productsGrid || !resultsCount) return;

  // Update results count
  resultsCount.textContent = `${products.length} product${
    products.length === 1 ? "" : "s"
  } found`;

  if (products.length === 0) {
    productsGrid.innerHTML = `
                    <div class="no-results" style="grid-column: 1 / -1;">
                        <i class="fas fa-search"></i>
                        <p>No products found</p>
                        <p>Try searching with different keywords or select another category</p>
                    </div>
                `;
  } else {
    productsGrid.innerHTML = products
      .map(
        (product) => `
                    <div class="product-card">
                        <div class="product-icon">
                            ${getProductIcon(
                              product.category,
                              product.subcategory
                            )}
                        </div>
                        <h4>${product.name}</h4>
                        <p class="category">${product.category} • ${
          product.subcategory
        }</p>
                        <p class="product-description">${
                          product.product_description
                        }</p>
                        <p class="price">
                            ₹${product.OFFER_PRICE} 
                            <span class="original-price">₹${product.MRP}</span>
                        </p>
                        
                        ${
                          product.choose_weight &&
                          product.choose_weight.length > 0
                            ? `
                        <div class="weight-selector">
                            <select id="weight-${product.id}">
                                ${product.choose_weight
                                  .map(
                                    (weight) =>
                                      `<option value="${weight}">${weight}</option>`
                                  )
                                  .join("")}
                            </select>
                        </div>
                        `
                            : ""
                        }
                        
                        <button class="add-to-cart-btn" onclick="addToCart(${
                          product.id
                        }, '${product.name.replace(/'/g, "\\'")}', ${
          product.OFFER_PRICE
        })">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                    </div>
                `
      )
      .join("");
  }
}

// Helper function to get appropriate icons for products
function getProductIcon(category, subcategory) {
  const icons = {
    Seeds: "🌱",
    "Vegetable Seeds": "🍅",
    "Fruit Seeds": "🍉",
    "Flower Seeds": "🌺",
    "Herbal Seeds": "🌿",
    "Organic Seeds": "🟢",
    "Hybrid Seeds": "🧬",
    "Field Crop Seeds": "🌾",
    "Fodder Seeds": "🐄",
    "Spice Seeds": "🌶️",
    "Microgreen Seeds": "🥬",
    Protection: "🛡️",
    Insecticides: "🐛",
    Fungicides: "🍄",
  };

  return icons[subcategory] || icons[category] || "📦";
}

// Cart functionality
let cart = JSON.parse(localStorage.getItem("cart")) || [];

function addToCart(productId, productName, price) {
  // Get selected weight if available
  const weightSelect = document.getElementById(`weight-${productId}`);
  const selectedWeight = weightSelect ? weightSelect.value : "";

  const cartItem = {
    id: productId,
    name: productName,
    price: price,
    weight: selectedWeight,
    quantity: 1,
    timestamp: Date.now(),
  };

  // Check if item already in cart
  const existingItemIndex = cart.findIndex(
    (item) => item.id === productId && item.weight === selectedWeight
  );

  if (existingItemIndex > -1) {
    cart[existingItemIndex].quantity += 1;
  } else {
    cart.push(cartItem);
  }

  // Save to localStorage
  localStorage.setItem("cart", JSON.stringify(cart));

  // Show notification
  showNotification(
    `${productName} ${
      selectedWeight ? `(${selectedWeight})` : ""
    } added to cart!`,
    "success"
  );

  // Update cart count in the main header (if exists)
  updateCartCount();
}

function updateCartCount() {
  // Update cart count in the main header if it exists
  const cartCountElement = document.getElementById("cartCount");
  if (cartCountElement) {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCountElement.textContent = totalItems;

    // Add animation
    cartCountElement.style.animation = "none";
    setTimeout(() => {
      cartCountElement.style.animation = "pulse 0.6s ease-in-out";
    }, 10);
  }
}

// Close modal when clicking outside
document.addEventListener("click", function (event) {
  const modal = document.querySelector(".product-finder-modal");
  if (event.target === modal) {
    closeProductFinder();
  }
});

// Initialize cart count on page load
document.addEventListener("DOMContentLoaded", function () {
  updateCartCount();
});

// Mock order data - In a real application, this would come from a server
const orderDatabase = {
  GRN123456789: {
    id: "GRN123456789",
    status: "Shipped",
    date: "2023-10-15",
    estimatedDelivery: "2023-10-20",
    customer: {
      name: "Rajesh Kumar",
      email: "rajesh@example.com",
      phone: "+91 9876543210",
    },
    shippingAddress: {
      name: "Rajesh Kumar",
      street: "123 Green Farm Road",
      city: "Agro City",
      state: "Maharashtra",
      pincode: "411001",
      phone: "+91 9876543210",
    },
    items: [
      {
        id: 20101,
        name: "Tomato Seeds",
        price: 95,
        quantity: 2,
        weight: "100g",
      },
      {
        id: 20102,
        name: "Brinjal (Eggplant) Seeds",
        price: 85,
        quantity: 1,
        weight: "50g",
      },
      {
        id: 20103,
        name: "Chilli Seeds",
        price: 70,
        quantity: 1,
        weight: "50g",
      },
    ],
    timeline: [
      {
        date: "2023-10-15 10:30",
        status: "Order Placed",
        description: "Your order has been placed successfully",
      },
      {
        date: "2023-10-15 14:20",
        status: "Order Confirmed",
        description: "We have confirmed your order",
      },
      {
        date: "2023-10-16 09:15",
        status: "Order Shipped",
        description: "Your order has been shipped",
      },
      {
        date: "2023-10-20",
        status: "Out for Delivery",
        description: "Expected delivery today",
      },
      {
        date: "",
        status: "Delivered",
        description: "Your order has been delivered",
      },
    ],
    subtotal: 345,
    shipping: 40,
    tax: 31,
    total: 416,
  },
  GRN987654321: {
    id: "GRN987654321",
    status: "Delivered",
    date: "2023-10-10",
    estimatedDelivery: "2023-10-15",
    customer: {
      name: "Priya Sharma",
      email: "priya@example.com",
      phone: "+91 8765432109",
    },
    shippingAddress: {
      name: "Priya Sharma",
      street: "456 Organic Garden",
      city: "Farmville",
      state: "Karnataka",
      pincode: "560001",
      phone: "+91 8765432109",
    },
    items: [
      {
        id: 20201,
        name: "Watermelon Seeds",
        price: 150,
        quantity: 1,
        weight: "250g",
      },
      {
        id: 20301,
        name: "Marigold Seeds",
        price: 45,
        quantity: 3,
        weight: "25g",
      },
    ],
    timeline: [
      {
        date: "2023-10-10 11:45",
        status: "Order Placed",
        description: "Your order has been placed successfully",
      },
      {
        date: "2023-10-10 15:30",
        status: "Order Confirmed",
        description: "We have confirmed your order",
      },
      {
        date: "2023-10-11 10:20",
        status: "Order Shipped",
        description: "Your order has been shipped",
      },
      {
        date: "2023-10-12 14:15",
        status: "Out for Delivery",
        description: "Your order is out for delivery",
      },
      {
        date: "2023-10-12 16:45",
        status: "Delivered",
        description: "Your order has been delivered",
      },
    ],
    subtotal: 285,
    shipping: 40,
    tax: 26,
    total: 351,
  },
  GRN555555555: {
    id: "GRN555555555",
    status: "Processing",
    date: "2023-10-18",
    estimatedDelivery: "2023-10-25",
    customer: {
      name: "Amit Patel",
      email: "amit@example.com",
      phone: "+91 7654321098",
    },
    shippingAddress: {
      name: "Amit Patel",
      street: "789 Harvest Street",
      city: "Green Valley",
      state: "Gujarat",
      pincode: "380001",
      phone: "+91 7654321098",
    },
    items: [
      {
        id: 20501,
        name: "Organic Tomato Seeds",
        price: 120,
        quantity: 1,
        weight: "100g",
      },
      {
        id: 20601,
        name: "Hybrid Tomato Seeds",
        price: 160,
        quantity: 1,
        weight: "100g",
      },
    ],
    timeline: [
      {
        date: "2023-10-18 09:20",
        status: "Order Placed",
        description: "Your order has been placed successfully",
      },
      {
        date: "2023-10-18 13:45",
        status: "Order Confirmed",
        description: "We have confirmed your order",
      },
      {
        date: "",
        status: "Processing",
        description: "We are preparing your order",
      },
      {
        date: "",
        status: "Shipped",
        description: "Your order will be shipped soon",
      },
      {
        date: "",
        status: "Delivered",
        description: "Your order will be delivered",
      },
    ],
    subtotal: 280,
    shipping: 40,
    tax: 29,
    total: 349,
  },
};

// Track Order Modal Functions
function openTrackOrderModal(event) {
  if (event) event.preventDefault();
  const modal = document.getElementById("trackOrderModal");
  if (modal) {
    modal.classList.add("active");
    document.body.style.overflow = "hidden";

    // Focus on order ID input
    setTimeout(() => {
      const orderIdInput = document.getElementById("orderId");
      if (orderIdInput) orderIdInput.focus();
    }, 100);

    // Add enter key listener
    const orderIdInput = document.getElementById("orderId");
    if (orderIdInput) {
      orderIdInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
          trackOrder();
        }
      });
    }
  }
}

function closeTrackOrderModal() {
  const modal = document.getElementById("trackOrderModal");
  if (modal) {
    modal.classList.remove("active");
    document.body.style.overflow = "";
  }
}

function trackOrder() {
  const orderIdInput = document.getElementById("orderId");
  const orderInfo = document.getElementById("orderInfo");
  
  if (!orderIdInput || !orderInfo) return;

  const orderId = orderIdInput.value.trim().toUpperCase();

  if (!orderId) {
    showNotification("Please enter an Order ID", "error");
    return;
  }

  // Check if order exists in our database
  if (orderDatabase[orderId]) {
    const order = orderDatabase[orderId];
    displayOrderInfo(order);
    orderInfo.classList.add("active");
  } else {
    showNotification(
      "Order ID not found. Please check and try again.",
      "error"
    );
    orderInfo.classList.remove("active");
  }
}

function displayOrderInfo(order) {
  // Update order status
  const orderStatus = document.getElementById("orderStatus");
  if (orderStatus) {
    orderStatus.textContent = `Order ${order.status}`;
  }

  // Update order timeline
  const timelineElement = document.getElementById("orderTimeline");
  if (timelineElement) {
    timelineElement.innerHTML = "";

    order.timeline.forEach((event, index) => {
      let statusClass = "pending";
      if (event.date) {
        statusClass =
          index < order.timeline.findIndex((e) => e.status === order.status)
            ? "completed"
            : event.status === order.status
            ? "active"
            : "completed";
      }

      const timelineItem = document.createElement("div");
      timelineItem.className = `timeline-item ${statusClass}`;
      timelineItem.innerHTML = `
                    <div class="timeline-date">${event.date || "Pending"}</div>
                    <div class="timeline-content">${event.status}</div>
                    <div style="font-size: 0.85rem; color: #666; margin-top: 5px;">${
                      event.description
                    }</div>
                `;
      timelineElement.appendChild(timelineItem);
    });
  }

  // Update order items
  const itemsElement = document.getElementById("orderItems");
  if (itemsElement) {
    itemsElement.innerHTML = "";

    order.items.forEach((item) => {
      const itemElement = document.createElement("div");
      itemElement.className = "order-item";
      itemElement.innerHTML = `
                    <div class="item-name">${item.name} (${item.weight})</div>
                    <div class="item-qty">Qty: ${item.quantity}</div>
                    <div class="item-price">₹${item.price * item.quantity}</div>
                `;
      itemsElement.appendChild(itemElement);
    });
  }

  // Update order summary
  const subtotal = document.getElementById("subtotal");
  const shipping = document.getElementById("shipping");
  const tax = document.getElementById("tax");
  const total = document.getElementById("total");
  
  if (subtotal) subtotal.textContent = `₹${order.subtotal}`;
  if (shipping) shipping.textContent = `₹${order.shipping}`;
  if (tax) tax.textContent = `₹${order.tax}`;
  if (total) total.textContent = `₹${order.total}`;
}

// Support modal functions
function openSupportModal(event) {
  if (event) event.preventDefault();
  const modal = document.getElementById("supportModal");
  if (modal) {
    modal.classList.add("active");
    document.body.style.overflow = "hidden";
  }
}

function closeSupportModal() {
  const modal = document.getElementById("supportModal");
  if (modal) {
    modal.classList.remove("active");
    document.body.style.overflow = "";
  }
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
  if (event) event.preventDefault();
  showNotification("Language selection coming soon!", "info");
}

// Login functionality
let selectedOption = null;

// Open login modal
function openLoginModal() {
  const modal = document.getElementById("loginModal");
  if (modal) {
    modal.classList.add("active");
    document.body.style.overflow = "hidden";
    resetForms();
    showOptions();

    // Focus on first input
    setTimeout(() => {
      const mobileInput = document.getElementById("mobileNumber");
      if (mobileInput) mobileInput.focus();
    }, 100);
  }
}

// Close login modal
function closeLoginModal() {
  const modal = document.getElementById("loginModal");
  if (modal) {
    modal.classList.remove("active");
    document.body.style.overflow = "";
    resetForms();
  }
}

// Show login options
function showOptions() {
  const loginOptions = document.getElementById("loginOptions");
  if (loginOptions) {
    loginOptions.style.display = "flex";
    document
      .querySelectorAll(".login-form")
      .forEach((form) => form.classList.remove("active"));
    document
      .querySelectorAll(".login-option")
      .forEach((option) => option.classList.remove("selected"));
    selectedOption = null;
  }
}

// Select login option
function selectLoginOption(option) {
  selectedOption = option;

  // Update UI
  document
    .querySelectorAll(".login-option")
    .forEach((opt) => opt.classList.remove("selected"));
  const selectedElement = document.querySelector(`.login-option[data-option="${option}"]`);
  if (selectedElement) {
    selectedElement.classList.add("selected");
  }

  // Hide options and show appropriate form
  const loginOptions = document.getElementById("loginOptions");
  if (loginOptions) {
    loginOptions.style.display = "none";
  }

  if (option === "mobile") {
    const mobileForm = document.getElementById("mobileLoginForm");
    if (mobileForm) mobileForm.classList.add("active");
  } else if (option === "email") {
    const emailForm = document.getElementById("emailLoginForm");
    if (emailForm) emailForm.classList.add("active");
  } else if (option === "google") {
    loginWithGoogle();
  } else if (option === "facebook") {
    loginWithFacebook();
  }
}

// Back to options
function backToOptions() {
  showOptions();
}

// Reset all forms to initial state
function resetForms() {
  // Reset mobile form
  const mobileNumber = document.getElementById("mobileNumber");
  const otpSection = document.getElementById("otpSection");
  const mobileError = document.getElementById("mobileError");
  const otpError = document.getElementById("otpError");
  const otpSuccess = document.getElementById("otpSuccess");
  const countdown = document.getElementById("countdown");

  if (mobileNumber) mobileNumber.value = "";
  if (otpSection) otpSection.style.display = "none";
  if (mobileError) mobileError.style.display = "none";
  if (otpError) otpError.style.display = "none";
  if (otpSuccess) otpSuccess.style.display = "none";
  if (countdown) countdown.style.display = "none";

  // Reset OTP inputs
  const otpInputs = document.querySelectorAll(".otp-input");
  otpInputs.forEach((input) => (input.value = ""));

  // Reset email form
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");

  if (email) email.value = "";
  if (password) password.value = "";
  if (emailError) emailError.style.display = "none";
  if (passwordError) passwordError.style.display = "none";
}

// Get OTP for mobile login
function getOTP() {
  const mobileNumber = document.getElementById("mobileNumber");
  const mobileError = document.getElementById("mobileError");
  const otpSection = document.getElementById("otpSection");

  if (!mobileNumber || !mobileError || !otpSection) return;

  const mobileValue = mobileNumber.value;

  // Validate mobile number
  if (!mobileValue || mobileValue.length !== 10 || isNaN(mobileValue)) {
    mobileError.style.display = "block";
    return;
  }

  mobileError.style.display = "none";

  // Show OTP section
  otpSection.style.display = "block";

  // Start countdown for resend OTP
  startCountdown();

  // In a real app, you would send the OTP to the mobile number here
  console.log(`OTP sent to ${mobileValue}`);

  // For demo purposes, we'll auto-fill a sample OTP
  setTimeout(() => {
    const otpInputs = document.querySelectorAll(".otp-input");
    const sampleOTP = "123456";

    otpInputs.forEach((input, index) => {
      input.value = sampleOTP[index];
    });
  }, 1000);
}

// Verify OTP
function verifyOTP() {
  const otpInputs = document.querySelectorAll(".otp-input");
  const otpError = document.getElementById("otpError");
  const otpSuccess = document.getElementById("otpSuccess");

  if (!otpError || !otpSuccess) return;

  let otp = "";
  otpInputs.forEach((input) => {
    otp += input.value;
  });

  // Validate OTP
  if (otp.length !== 6) {
    otpError.style.display = "block";
    otpSuccess.style.display = "none";
    return;
  }

  // In a real app, you would verify the OTP with your backend
  // For demo, we'll assume it's correct
  otpError.style.display = "none";
  otpSuccess.style.display = "block";

  // Simulate login success
  setTimeout(() => {
    alert(`Login successful! Welcome to GreenAgro.`);
    closeLoginModal();

    // In a real app, you would redirect to the user's dashboard
  }, 1000);
}

// Resend OTP
function resendOTP() {
  const mobileNumber = document.getElementById("mobileNumber");
  if (!mobileNumber) return;

  const mobileValue = mobileNumber.value;

  // In a real app, you would resend the OTP to the mobile number
  console.log(`OTP resent to ${mobileValue}`);

  // Reset OTP inputs
  const otpInputs = document.querySelectorAll(".otp-input");
  otpInputs.forEach((input) => (input.value = ""));

  // Restart countdown
  startCountdown();

  // For demo purposes, we'll auto-fill a sample OTP again
  setTimeout(() => {
    const sampleOTP = "123456";

    otpInputs.forEach((input, index) => {
      input.value = sampleOTP[index];
    });
  }, 1000);
}

// Start countdown for resend OTP
function startCountdown() {
  const countdownElement = document.getElementById("countdown");
  const countdownTimer = document.getElementById("countdownTimer");
  const resendLink = document.getElementById("resendOtpLink");

  if (!countdownElement || !countdownTimer || !resendLink) return;

  countdownElement.style.display = "inline";
  resendLink.style.display = "none";

  let timeLeft = 60;

  const countdownInterval = setInterval(() => {
    timeLeft--;
    countdownTimer.textContent = timeLeft;

    if (timeLeft <= 0) {
      clearInterval(countdownInterval);
      countdownElement.style.display = "none";
      resendLink.style.display = "inline";
    }
  }, 1000);
}

// Move to next OTP input
function moveToNext(current, nextIndex) {
  if (current.value.length === 1) {
    const nextInput = document.querySelectorAll(".otp-input")[nextIndex];
    if (nextInput) {
      nextInput.focus();
    }
  }
}

// Login with email and password
function loginWithEmail() {
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");

  if (!email || !password || !emailError || !passwordError) return;

  const emailValue = email.value;
  const passwordValue = password.value;

  let isValid = true;

  // Validate email
  if (!emailValue || !isValidEmail(emailValue)) {
    emailError.style.display = "block";
    isValid = false;
  } else {
    emailError.style.display = "none";
  }

  // Validate password
  if (!passwordValue) {
    passwordError.style.display = "block";
    isValid = false;
  } else {
    passwordError.style.display = "none";
  }

  if (isValid) {
    // In a real app, you would send the login request to your backend
    console.log(`Login attempt with email: ${emailValue}`);

    // Simulate login success
    setTimeout(() => {
      alert(`Login successful! Welcome to GreenAgro.`);
      closeLoginModal();

      // In a real app, you would redirect to the user's dashboard
    }, 1000);
  }
}

// Validate email format
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

// Toggle password visibility
const passwordToggle = document.getElementById("passwordToggle");
if (passwordToggle) {
  passwordToggle.addEventListener("click", function () {
    const passwordInput = document.getElementById("password");
    const icon = this.querySelector("i");

    if (passwordInput && icon) {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }
  });
}

// Social login functions
function loginWithGoogle() {
  // In a real app, you would integrate with Google OAuth
  console.log("Google login clicked");

  // Simulate login success
  setTimeout(() => {
    alert(`Google login successful! Welcome to GreenAgro.`);
    closeLoginModal();
  }, 1000);
}

function loginWithFacebook() {
  // In a real app, you would integrate with Facebook OAuth
  console.log("Facebook login clicked");

  // Simulate login success
  setTimeout(() => {
    alert(`Facebook login successful! Welcome to GreenAgro.`);
    closeLoginModal();
  }, 1000);
}

// Show signup form (for demo purposes)
function showSignup() {
  alert("Sign up form would be shown here");
  // In a real app, you would switch to a signup form or open a registration modal
}

// Close modal when clicking outside
const loginModal = document.getElementById("loginModal");
if (loginModal) {
  loginModal.addEventListener("click", function (e) {
    if (e.target === this) {
      closeLoginModal();
    }
  });
}

// Allow pressing Enter to submit forms
document.addEventListener("keypress", function (e) {
  if (e.key === "Enter") {
    if (selectedOption === "mobile") {
      const otpSection = document.getElementById("otpSection");
      if (otpSection && otpSection.style.display === "block") {
        verifyOTP();
      } else {
        getOTP();
      }
    } else if (selectedOption === "email") {
      loginWithEmail();
    }
  }
});

// Initialize tooltips for top info links
document.querySelectorAll(".top-info-left a[aria-label]").forEach((link) => {
  link.addEventListener("mouseenter", function () {
    this.title = this.getAttribute("aria-label");
  });
});

// Close modals with Escape key
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    closeProductFinder();
    closeSupportModal();
    closeTrackOrderModal();
    closeLoginModal();
  }
});

// Initialize login functionality when page loads
document.addEventListener("DOMContentLoaded", function () {
  console.log("🌿 GreenAgro header initialized successfully!");

  // Add click event to account button
  const accountBtn = document.getElementById("accountBtn");
  if (accountBtn) {
    accountBtn.addEventListener("click", function (e) {
      e.preventDefault();
      openLoginModal();
    });
  }

  // Auto-hide announcement after 15 seconds
  setTimeout(() => {
    const announcement = document.getElementById("announcement");
    if (announcement && announcement.style.display !== "none") {
      announcement.style.opacity = "0.8";
    }
  }, 15000);
});
