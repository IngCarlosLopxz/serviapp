// Datos simulados (Mock Data) de profesionales
const professionals = [
  {
    id: 1,
    name: "Carlos Mendoza",
    specialty: "Experto en Baldosas y Cerámica",
    category: "baldosas",
    rating: 4.9,
    reviews: 148,
    price: 18000,
    priceUnit: "trabajo",
    photo: "https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=256&h=256",
    experience: "8 años de experiencia",
    bio: "Especialista en instalación de porcelanato, baldosas y revestimiento de baños y cocinas. Detallista y con terminaciones de alta calidad.",
    completedJobs: 320,
    location: "Palermo, CABA"
  },
  {
    id: 2,
    name: "Juan Pérez",
    specialty: "Carpintería Fina y Estructuras",
    category: "carpinteria",
    rating: 4.8,
    reviews: 96,
    price: 3500,
    priceUnit: "hora",
    photo: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=256&h=256",
    experience: "12 años de experiencia",
    bio: "Restauración de muebles, fabricación de alacenas a medida y colocación de puertas. Pasión por la madera y el diseño duradero.",
    completedJobs: 245,
    location: "Las Condes, Santiago"
  },
  {
    id: 3,
    name: "Sofía Altieri",
    specialty: "Diseño y Tapicería Premium",
    category: "tapiceria",
    rating: 4.95,
    reviews: 112,
    price: 15000,
    priceUnit: "trabajo",
    photo: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=256&h=256",
    experience: "6 años de experiencia",
    bio: "Tapizado de sillones, sillas y respaldos de cama. Gran variedad de telas importadas, linos y cueros ecológicos. Diseño moderno.",
    completedJobs: 189,
    location: "Chapinero, Bogotá"
  },
  {
    id: 4,
    name: "Ricardo Torres",
    specialty: "Instalación Eléctrica y Clima",
    category: "servicios-tecnicos",
    rating: 4.7,
    reviews: 210,
    price: 3800,
    priceUnit: "hora",
    photo: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=256&h=256",
    experience: "15 años de experiencia",
    bio: "Soporte técnico integral. Reparación de cortocorticuitos, instalación de aire acondicionado (con certificación) y tableros eléctricos.",
    completedJobs: 430,
    location: "Polanco, CDMX"
  },
  {
    id: 5,
    name: "Marcos Delgado",
    specialty: "Albañilería y Ampliaciones",
    category: "albanileria",
    rating: 4.6,
    reviews: 82,
    price: 45000,
    priceUnit: "trabajo",
    photo: "https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=256&h=256",
    experience: "10 años de experiencia",
    bio: "Construcción en seco, revoques, colocación de techos y reformas estructurales completas. Presupuestos transparentes y sin sorpresas.",
    completedJobs: 110,
    location: "San Isidro, Lima"
  },
  {
    id: 6,
    name: "Elena Gómez",
    specialty: "Mantenimiento y Pintura Profesional",
    category: "albanileria",
    rating: 4.9,
    reviews: 134,
    price: 2800,
    priceUnit: "hora",
    photo: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=256&h=256",
    experience: "7 años de experiencia",
    bio: "Especialista en impermeabilización de techos, pintura de interiores, exteriores y colocación de molduras decorativas. Trabajo limpio.",
    completedJobs: 215,
    location: "Belgrano, CABA"
  },
  {
    id: 7,
    name: "Andrés Silva",
    specialty: "Soporte Técnico de Electrodomésticos",
    category: "servicios-tecnicos",
    rating: 4.75,
    reviews: 156,
    price: 4000,
    priceUnit: "hora",
    photo: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=256&h=256",
    experience: "9 años de experiencia",
    bio: "Diagnóstico y reparación express de lavarropas, heladeras, microondas e instalaciones inteligentes en el hogar. Garantía escrita de 3 meses.",
    completedJobs: 298,
    location: "Providencia, Santiago"
  }
];

// Estado global de la aplicación
let selectedCategory = "todos";
let searchQuery = "";
let currentSelectedTech = null;
let currentUser = null; // null = no logueado
let registerRole = "client"; // "client" o "tech"
let activeAuthTab = "login"; // "login" o "register"

// Referencias a elementos del DOM
const techContainer = document.getElementById("tech-container");
const categoryButtons = document.querySelectorAll(".category-btn");
const searchInput = document.getElementById("search-input");
const clearSearchBtn = document.getElementById("clear-search-btn");
const resultsCount = document.getElementById("results-count");

// Bottom Sheet / Modal Elements
const bottomSheet = document.getElementById("bottom-sheet");
const sheetBackdrop = document.getElementById("sheet-backdrop");
const sheetContent = document.getElementById("sheet-content");

// Formato de moneda local ($ con separador de miles)
function formatCurrency(value) {
  return new Intl.NumberFormat('es-AR', { style: 'currency', currency: 'ARS', maximumFractionDigits: 0 }).format(value);
}

// Generar estrellas visuales
function renderStars(rating) {
  const fullStars = Math.floor(rating);
  const hasHalf = rating % 1 >= 0.5;
  let starsHtml = '';
  
  for (let i = 0; i < 5; i++) {
    if (i < fullStars) {
      starsHtml += '<i class="fa-solid fa-star text-amber-400"></i>';
    } else if (i === fullStars && hasHalf) {
      starsHtml += '<i class="fa-solid fa-star-half-stroke text-amber-400"></i>';
    } else {
      starsHtml += '<i class="fa-regular fa-star text-gray-300"></i>';
    }
  }
  return starsHtml;
}

// Renderizar las Tarjetas de Profesionales (Responsivas)
function renderCards() {
  const filtered = professionals.filter(tech => {
    const matchesCategory = selectedCategory === "todos" || tech.category === selectedCategory;
    const matchesSearch = tech.name.toLowerCase().includes(searchQuery.toLowerCase()) || 
                          tech.specialty.toLowerCase().includes(searchQuery.toLowerCase()) ||
                          tech.bio.toLowerCase().includes(searchQuery.toLowerCase());
    return matchesCategory && matchesSearch;
  });

  techContainer.innerHTML = '';
  resultsCount.textContent = `${filtered.length} profesional${filtered.length === 1 ? '' : 'es'} disponible${filtered.length === 1 ? '' : 's'}`;

  if (filtered.length === 0) {
    techContainer.innerHTML = `
      <div class="col-span-full flex flex-col items-center justify-center py-16 px-4 text-center bg-white rounded-3xl border border-gray-100">
        <div class="bg-red-50 text-red-500 w-16 h-16 rounded-full flex items-center justify-center mb-4 text-2xl">
          <i class="fa-solid fa-user-slash"></i>
        </div>
        <h3 class="text-gray-800 font-semibold text-lg mb-1">No encontramos resultados</h3>
        <p class="text-gray-500 text-sm max-w-xs">Prueba con otra palabra clave o selecciona otra categoría.</p>
      </div>
    `;
    return;
  }

  filtered.forEach((tech, index) => {
    const card = document.createElement("div");
    card.className = "bg-white rounded-3xl p-5 shadow-sm hover:shadow-md border border-gray-100 flex flex-col justify-between space-y-4 animate-card opacity-0 transition-all duration-300";
    card.style.animationDelay = `${index * 40}ms`;

    card.innerHTML = `
      <div class="flex items-start space-x-3.5">
        <div class="relative flex-shrink-0">
          <img src="${tech.photo}" alt="${tech.name}" class="w-14 h-14 rounded-2xl object-cover border-2 border-white shadow-md">
          <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
        </div>
        
        <div class="flex-1 min-w-0">
          <div class="flex items-center justify-between">
            <h3 class="text-gray-900 font-bold text-base truncate pr-2">${tech.name}</h3>
            <span class="text-[10px] text-gray-500 flex items-center bg-gray-50 px-2.5 py-1 rounded-full border border-gray-100 font-semibold">
              <i class="fa-solid fa-location-dot text-red-400 mr-1"></i>${tech.location.split(',')[0]}
            </span>
          </div>
          <p class="text-red-600 font-semibold text-xs truncate mt-0.5">${tech.specialty}</p>
          
          <div class="flex items-center space-x-1.5 mt-1">
            <span class="text-amber-500 font-extrabold text-xs">${tech.rating.toFixed(1)}</span>
            <div class="flex items-center text-[10px] space-x-0.5">
              ${renderStars(tech.rating)}
            </div>
            <span class="text-gray-400 text-[10px]">(${tech.reviews} reseñas)</span>
          </div>
        </div>
      </div>

      <p class="text-gray-600 text-xs line-clamp-2 leading-relaxed">
        ${tech.bio}
      </p>

      <div class="border-t border-gray-100 my-1"></div>

      <div class="flex items-center justify-between pt-1">
        <div>
          <span class="text-[9px] uppercase tracking-wider text-gray-400 block font-bold">Precio estimado</span>
          <div class="flex items-baseline">
            <span class="text-gray-900 font-extrabold text-lg">${formatCurrency(tech.price)}</span>
            <span class="text-gray-500 text-xs ml-1 font-normal">/ ${tech.priceUnit}</span>
          </div>
        </div>
        
        <div class="flex space-x-2">
          <button onclick="openProfileSheet(${tech.id})" class="btn-touch px-4 py-2.5 rounded-xl border border-gray-200 text-gray-700 font-bold text-xs bg-gray-50 hover:bg-gray-100 transition-all">
            Ficha
          </button>
          <button onclick="openBookingSheet(${tech.id})" class="btn-touch px-4 py-2.5 rounded-xl bg-red-600 text-white font-extrabold text-xs hover:bg-red-700 transition-all shadow-md shadow-red-600/10">
            Reservar
          </button>
        </div>
      </div>
    `;

    techContainer.appendChild(card);
  });
}

// Configurar comportamiento del Buscador
searchInput.addEventListener("input", (e) => {
  searchQuery = e.target.value.trim();
  if (searchQuery.length > 0) {
    clearSearchBtn.classList.remove("hidden");
  } else {
    clearSearchBtn.classList.add("hidden");
  }
  renderCards();
});

clearSearchBtn.addEventListener("click", () => {
  searchInput.value = "";
  searchQuery = "";
  clearSearchBtn.classList.add("hidden");
  renderCards();
  searchInput.focus();
});

// Filtrado táctil por Categorías (Con centrado automático en scroll)
categoryButtons.forEach(btn => {
  btn.addEventListener("click", () => {
    categoryButtons.forEach(b => {
      b.classList.remove("bg-red-600", "text-white", "shadow-active", "scale-105");
      b.classList.add("bg-white", "text-gray-600", "border-gray-100");
    });

    btn.classList.remove("bg-white", "text-gray-600", "border-gray-100");
    btn.classList.add("bg-red-600", "text-white", "shadow-active", "scale-105");

    selectedCategory = btn.getAttribute("data-category");
    btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });

    renderCards();
  });
});

// Filtrado rápido por Categorías (Desde tarjetas generales o clics secundarios)
function filterByCategory(catName) {
  const btn = document.querySelector(`.category-btn[data-category="${catName}"]`);
  if (btn) {
    btn.click();
  } else {
    selectedCategory = catName;
    renderCards();
  }
  showSection('inicio');
}

// Navegación entre secciones (Adaptable para móvil y desktop)
function showSection(sectionId) {
  const sections = ["inicio-section", "categorias-section", "auth-section", "perfil-section"];
  
  // Si entra a "perfil", verificar autenticación
  let targetSection = sectionId;
  if (sectionId === "perfil" && currentUser === null) {
    targetSection = "auth";
  }

  sections.forEach(secId => {
    const el = document.getElementById(`${secId}`);
    if (!el) return;
    if (secId === `${targetSection}-section`) {
      el.classList.remove("hidden");
    } else {
      el.classList.add("hidden");
    }
  });

  // Sincronizar botones activos de Bottom Nav (Móvil)
  const bottomNavItems = document.querySelectorAll(".bottom-nav-item");
  bottomNavItems.forEach(nav => {
    const target = nav.getAttribute("data-target");
    // Si la pestaña objetivo es perfil, también coincide con 'auth'
    const isProfileMatch = target === "perfil" && (targetSection === "perfil" || targetSection === "auth");
    
    if (target === targetSection || isProfileMatch) {
      nav.classList.remove("text-gray-400");
      nav.classList.add("text-red-600");
      nav.querySelector(".nav-dot")?.classList.remove("scale-0");
    } else {
      nav.classList.remove("text-red-600");
      nav.classList.add("text-gray-400");
      nav.querySelector(".nav-dot")?.classList.add("scale-0");
    }
  });

  // Hacer scroll al inicio al cambiar de pantalla
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Configurar enlaces del Bottom Nav de forma unificada
document.querySelectorAll(".bottom-nav-item").forEach(item => {
  item.addEventListener("click", (e) => {
    e.preventDefault();
    const target = item.getAttribute("data-target");
    showSection(target);
  });
});


// ================= AUTENTICACIÓN Y REGISTRO (LÓGICA) =================

// Intercambiar pestañas entre Login y Registro
function toggleAuthTab(tab) {
  activeAuthTab = tab;
  const tabLogin = document.getElementById("tab-login");
  const tabRegister = document.getElementById("tab-register");
  const loginForm = document.getElementById("login-form");
  const registerContainer = document.getElementById("register-container");

  if (tab === "login") {
    tabLogin.className = "flex-1 pb-3 text-center border-b-2 border-red-600 font-extrabold text-sm text-red-600 transition-all";
    tabRegister.className = "flex-1 pb-3 text-center border-b-2 border-transparent font-extrabold text-sm text-gray-400 hover:text-gray-600 transition-all";
    loginForm.classList.remove("hidden");
    registerContainer.classList.add("hidden");
  } else {
    tabRegister.className = "flex-1 pb-3 text-center border-b-2 border-red-600 font-extrabold text-sm text-red-600 transition-all";
    tabLogin.className = "flex-1 pb-3 text-center border-b-2 border-transparent font-extrabold text-sm text-gray-400 hover:text-gray-600 transition-all";
    loginForm.classList.add("hidden");
    registerContainer.classList.remove("hidden");
  }
}

// Seleccionar rol en el Registro ("client" o "tech")
function selectRegisterRole(role) {
  registerRole = role;
  const roleClient = document.getElementById("role-client");
  const roleTech = document.getElementById("role-tech");
  const techFields = document.getElementById("tech-fields");

  // Inputs del profesional
  const reqFields = [
    "reg-tech-specialty",
    "reg-tech-price",
    "reg-tech-location",
    "reg-tech-bio"
  ];

  if (role === "client") {
    roleClient.className = "btn-touch border-2 border-red-600 bg-red-50 text-red-600 font-bold text-xs py-3 rounded-xl flex items-center justify-center space-x-1.5";
    roleTech.className = "btn-touch border border-gray-200 bg-white text-gray-600 font-bold text-xs py-3 rounded-xl flex items-center justify-center space-x-1.5";
    techFields.classList.add("hidden");
    
    // Quitar requerimientos de formulario
    reqFields.forEach(id => document.getElementById(id).removeAttribute("required"));
  } else {
    roleTech.className = "btn-touch border-2 border-red-600 bg-red-50 text-red-600 font-bold text-xs py-3 rounded-xl flex items-center justify-center space-x-1.5";
    roleClient.className = "btn-touch border border-gray-200 bg-white text-gray-600 font-bold text-xs py-3 rounded-xl flex items-center justify-center space-x-1.5";
    techFields.classList.remove("hidden");
    
    // Añadir requerimientos de formulario
    reqFields.forEach(id => document.getElementById(id).setAttribute("required", "true"));
  }
}

// Redireccionar al flujo de Registro de Profesional (Ofrecer Servicio)
function goToRegisterTech() {
  showSection("auth");
  toggleAuthTab("register");
  selectRegisterRole("tech");
}

// Alternar visibilidad de contraseña
function togglePasswordVisibility(inputId, btn) {
  const input = document.getElementById(inputId);
  const icon = btn.querySelector("i");
  if (input.type === "password") {
    input.type = "text";
    icon.className = "fa-solid fa-eye-slash";
  } else {
    input.type = "password";
    icon.className = "fa-solid fa-eye";
  }
}

// Simulación de Login con redes sociales (Google / Apple)
function handleSocialLogin(provider) {
  currentUser = {
    name: `Usuario ${provider}`,
    email: `${provider.toLowerCase()}_user@example.com`,
    role: "Cliente",
    avatar: provider.substring(0, 2).toUpperCase()
  };

  updateUserProfileUI();
  showSection("perfil");
  showToast(`¡Sesión iniciada con ${provider} exitosamente!`, "success");
}

// Procesar Formulario de Login
function handleLogin(event) {
  event.preventDefault();
  const email = document.getElementById("login-email").value;
  
  // Simulación de ingreso
  currentUser = {
    name: "Carlos López",
    email: email,
    role: "Cliente",
    avatar: "CL"
  };

  updateUserProfileUI();
  showSection("perfil");
  showToast("¡Inicio de sesión exitoso!", "success");
}

// Procesar Formulario de Registro
function handleRegister(event) {
  event.preventDefault();
  const name = document.getElementById("reg-name").value;
  const email = document.getElementById("reg-email").value;
  const password = document.getElementById("reg-password").value;
  const phone = document.getElementById("reg-phone").value;

  if (registerRole === "client") {
    currentUser = {
      name: name,
      email: email,
      role: "Cliente",
      phone: phone,
      avatar: name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0,2)
    };
    
    updateUserProfileUI();
    showSection("perfil");
    showToast("Cuenta de Cliente creada con éxito", "success");
  } else {
    // Es un profesional/técnico
    const category = document.getElementById("reg-tech-category").value;
    const specialty = document.getElementById("reg-tech-specialty").value;
    const price = parseFloat(document.getElementById("reg-tech-price").value);
    const priceUnit = document.getElementById("reg-tech-price-unit").value;
    const exp = document.getElementById("reg-tech-exp").value || "Sin especificar";
    const location = document.getElementById("reg-tech-location").value;
    const bio = document.getElementById("reg-tech-bio").value;

    // Colección de fotos de Unsplash según categoría para asignación automática premium
    const categoryPhotos = {
      albanileria: "https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=256&h=256",
      tapiceria: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=256&h=256",
      carpinteria: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=256&h=256",
      baldosas: "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&q=80&w=256&h=256",
      "servicios-tecnicos": "https://images.unsplash.com/photo-1500048993953-d23a436266cf?auto=format&fit=crop&q=80&w=256&h=256"
    };

    const randomPhoto = categoryPhotos[category] || "https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&q=80&w=256&h=256";

    // Crear y añadir nuevo profesional al feed global dinámico
    const newTech = {
      id: professionals.length + 1,
      name: name,
      specialty: specialty,
      category: category,
      rating: 5.0, // Calificación inicial perfecta
      reviews: 0,
      price: price,
      priceUnit: priceUnit,
      photo: randomPhoto,
      experience: exp.includes("experiencia") ? exp : `${exp} de experiencia`,
      bio: bio,
      completedJobs: 0,
      location: location,
      phone: phone
    };

    // Añadir al inicio del array
    professionals.unshift(newTech);

    // Guardar sesión
    currentUser = {
      name: name,
      email: email,
      role: `Profesional (${category.toUpperCase().replace('-', ' ')})`,
      phone: phone,
      avatar: name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0,2)
    };

    updateUserProfileUI();
    renderCards(); // Volver a pintar tarjetas con el nuevo técnico ingresado
    
    // Ir al inicio para ver su propia tarjeta cargada
    showSection("inicio");
    showToast(`¡Tus servicios de ${category.replace('-', ' ')} se han registrado con éxito!`, "success");
    
    // Resaltar la categoría del profesional recién registrado
    filterByCategory(category);
  }

  // Resetear formularios
  document.getElementById("register-form").reset();
  document.getElementById("login-form").reset();
}

// Actualizar textos e información del Perfil del Usuario Logueado
function updateUserProfileUI() {
  if (currentUser) {
    document.getElementById("user-name").textContent = currentUser.name;
    document.getElementById("user-email").textContent = currentUser.email;
    document.getElementById("user-role-badge").textContent = currentUser.role;
    document.getElementById("user-avatar").textContent = currentUser.avatar;
    document.getElementById("desktop-profile-label").textContent = currentUser.name.split(' ')[0];
  }
}

// Cerrar sesión
function handleLogout() {
  currentUser = null;
  document.getElementById("desktop-profile-label").textContent = "Mi Perfil";
  showSection("inicio");
  showToast("Sesión cerrada correctamente", "info");
}


// ================= TOAST NOTIFICATION PREMIUM (SIMULACIÓN NATIVA) =================
function showToast(message, type = "success") {
  const toast = document.createElement("div");
  toast.className = `fixed top-5 left-1/2 -translate-x-1/2 z-55 flex items-center space-x-2 px-5 py-3.5 rounded-2xl shadow-xl transition-all duration-300 transform -translate-y-10 opacity-0 text-xs font-bold text-white`;
  
  if (type === "success") {
    toast.classList.add("bg-green-600");
    toast.innerHTML = `<i class="fa-solid fa-circle-check text-base"></i> <span>${message}</span>`;
  } else if (type === "info") {
    toast.classList.add("bg-gray-800");
    toast.innerHTML = `<i class="fa-solid fa-circle-info text-base text-red-400"></i> <span>${message}</span>`;
  }

  document.body.appendChild(toast);

  // Animación entrada
  setTimeout(() => {
    toast.classList.remove("-translate-y-10", "opacity-0");
  }, 50);

  // Auto-cierre
  setTimeout(() => {
    toast.classList.add("-translate-y-10", "opacity-0");
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}


// ================= BOTTOM SHEET MODAL (SERVICIOS Y RESERVAS) =================

// Abrir Ficha Detallada del Profesional (Bottom Sheet / Modal)
function openProfileSheet(id) {
  const tech = professionals.find(p => p.id === id);
  if (!tech) return;
  currentSelectedTech = tech;

  sheetContent.innerHTML = `
    <div class="flex flex-col md:flex-row md:items-start md:space-x-5 mb-5">
      <img src="${tech.photo}" alt="${tech.name}" class="w-20 h-20 rounded-2xl object-cover border-2 border-white shadow-lg mx-auto md:mx-0">
      <div class="text-center md:text-left mt-3 md:mt-0">
        <span class="bg-red-50 text-red-600 text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-md">
          ${tech.category.toUpperCase().replace('-', ' ')}
        </span>
        <h2 class="text-xl font-extrabold text-gray-900 mt-1">${tech.name}</h2>
        <p class="text-gray-500 text-xs flex items-center justify-center md:justify-start mt-1">
          <i class="fa-solid fa-location-dot text-red-400 mr-1.5"></i> ${tech.location}
        </p>
      </div>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-3 gap-2 py-3 px-4 bg-gray-50 rounded-2xl border border-gray-100 text-center mb-5">
      <div>
        <span class="text-gray-400 text-[9px] block font-bold uppercase">Calificación</span>
        <span class="text-gray-900 font-extrabold text-sm flex items-center justify-center mt-0.5">
          ⭐ ${tech.rating.toFixed(1)}
        </span>
      </div>
      <div class="border-x border-gray-200">
        <span class="text-gray-400 text-[9px] block font-bold uppercase">Trabajos</span>
        <span class="text-gray-900 font-extrabold text-sm block mt-0.5">${tech.completedJobs}</span>
      </div>
      <div>
        <span class="text-gray-400 text-[9px] block font-bold uppercase">Experiencia</span>
        <span class="text-gray-900 font-extrabold text-sm block mt-0.5 truncate">${tech.experience.split(' ')[0]} años</span>
      </div>
    </div>

    <!-- Biografía -->
    <div class="mb-5">
      <h3 class="text-gray-900 font-bold text-xs mb-1.5">Sobre mí</h3>
      <p class="text-gray-600 text-xs leading-relaxed">${tech.bio}</p>
    </div>

    <!-- Verificación -->
    <div class="mb-5 bg-green-50 border border-green-100 rounded-xl p-3 flex items-start space-x-2.5">
      <i class="fa-solid fa-circle-check text-green-600 text-base mt-0.5"></i>
      <div>
        <h4 class="text-green-900 font-bold text-xs">Identidad y Antecedentes Verificados</h4>
        <p class="text-green-700 text-[10px] mt-0.5 leading-snug">Este técnico ha completado la validación de identidad oficial y antecedentes penales para tu tranquilidad.</p>
      </div>
    </div>

    <!-- Botones de Acción -->
    <div class="flex space-x-3 safe-bottom">
      <a href="tel:${tech.phone || '555-555'}" class="btn-touch flex-1 py-3.5 rounded-2xl border border-gray-200 text-gray-700 font-bold text-xs bg-white text-center flex items-center justify-center space-x-2 shadow-sm">
        <i class="fa-solid fa-phone text-red-500"></i>
        <span>Llamar</span>
      </a>
      <button onclick="openBookingSheet(${tech.id})" class="btn-touch flex-[2] py-3.5 rounded-2xl bg-red-600 text-white font-bold text-xs hover:bg-red-700 shadow-lg shadow-red-600/20 text-center flex items-center justify-center space-x-2">
        <i class="fa-solid fa-calendar-check"></i>
        <span>Reservar Turno</span>
      </button>
    </div>
  `;

  toggleSheet(true);
}

// Abrir Modal de Reserva Rápida
function openBookingSheet(id) {
  // Bloqueo contextual de reserva para usuarios no registrados / deslogueados
  if (currentUser === null) {
    toggleSheet(false); // Cerrar ficha técnica si estaba abierta
    showSection("auth");
    showToast("Debes iniciar sesión para reservar un servicio", "info");
    return;
  }

  const tech = professionals.find(p => p.id === id);
  if (!tech) return;
  currentSelectedTech = tech;

  // Generar próximos 4 días móviles
  const days = [];
  const daysOfWeek = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
  for (let i = 1; i <= 4; i++) {
    const d = new Date();
    d.setDate(d.getDate() + i);
    days.push({
      dateStr: d.getDate(),
      dayName: daysOfWeek[d.getDay()],
      fullDate: d.toLocaleDateString('es-AR', { day: 'numeric', month: 'short' })
    });
  }

  sheetContent.innerHTML = `
    <div class="mb-5">
      <h2 class="text-lg font-bold text-gray-900">Reservar con ${tech.name.split(' ')[0]}</h2>
      <p class="text-xs text-gray-500 mt-0.5">Selecciona el día y horario que mejor te convenga.</p>
    </div>

    <!-- Selector de Fecha Táctil -->
    <div class="mb-5">
      <span class="text-gray-400 text-[10px] font-bold uppercase tracking-wider block mb-2">Selecciona la Fecha</span>
      <div class="grid grid-cols-4 gap-2">
        ${days.map((day, idx) => `
          <button onclick="selectDate(this, '${day.fullDate}')" class="date-btn btn-touch border ${idx === 0 ? 'border-red-600 bg-red-50 text-red-600' : 'border-gray-200 bg-white text-gray-600'} rounded-xl py-3 text-center flex flex-col items-center justify-center">
            <span class="text-[10px] font-medium uppercase opacity-75">${day.dayName}</span>
            <span class="text-base font-extrabold mt-0.5">${day.dateStr}</span>
          </button>
        `).join('')}
      </div>
    </div>

    <!-- Selector de Horarios Táctil -->
    <div class="mb-6">
      <span class="text-gray-400 text-[10px] font-bold uppercase tracking-wider block mb-2">Selecciona el Horario</span>
      <div class="grid grid-cols-3 gap-2">
        <button onclick="selectTime(this, '09:00 - Mañana')" class="time-btn btn-touch border border-red-600 bg-red-50 text-red-600 rounded-xl py-2.5 text-xs font-bold text-center">09:00 AM</button>
        <button onclick="selectTime(this, '14:30 - Tarde')" class="time-btn btn-touch border border-gray-200 bg-white text-gray-600 rounded-xl py-2.5 text-xs font-bold text-center">02:30 PM</button>
        <button onclick="selectTime(this, '17:00 - Tarde')" class="time-btn btn-touch border border-gray-200 bg-white text-gray-600 rounded-xl py-2.5 text-xs font-bold text-center">05:00 PM</button>
      </div>
    </div>

    <!-- Resumen de Costos -->
    <div class="bg-gray-50 border border-gray-100 rounded-xl p-3 mb-6">
      <div class="flex justify-between items-center text-xs">
        <span class="text-gray-500">Valor de Reserva</span>
        <span class="text-gray-900 font-bold">${formatCurrency(tech.price)}</span>
      </div>
      <div class="text-[9px] text-gray-400 mt-1 leading-snug">
        * No cobramos por adelantado. Pagas directamente al profesional una vez completado el servicio.
      </div>
    </div>

    <!-- Confirmación de Reserva -->
    <div class="safe-bottom">
      <button onclick="confirmBooking()" class="btn-touch w-full py-3.5 rounded-2xl bg-green-600 text-white font-extrabold text-xs hover:bg-green-700 shadow-lg shadow-green-600/20 text-center flex items-center justify-center space-x-2">
        <i class="fa-solid fa-square-check text-sm"></i>
        <span>Confirmar Contratación</span>
      </button>
    </div>
  `;

  toggleSheet(true);
}

// Variables para capturar la selección del flujo de reserva
let selectedBookingDate = "";
let selectedBookingTime = "09:00 - Mañana";

function selectDate(element, dateVal) {
  selectedBookingDate = dateVal;
  document.querySelectorAll('.date-btn').forEach(btn => {
    btn.classList.remove('border-red-600', 'bg-red-50', 'text-red-600');
    btn.classList.add('border-gray-200', 'bg-white', 'text-gray-600');
  });
  element.classList.remove('border-gray-200', 'bg-white', 'text-gray-600');
  element.classList.add('border-red-600', 'bg-red-50', 'text-red-600');
}

function selectTime(element, timeVal) {
  selectedBookingTime = timeVal;
  document.querySelectorAll('.time-btn').forEach(btn => {
    btn.classList.remove('border-red-600', 'bg-red-50', 'text-red-600');
    btn.classList.add('border-gray-200', 'bg-white', 'text-gray-600');
  });
  element.classList.remove('border-gray-200', 'bg-white', 'text-gray-600');
  element.classList.add('border-red-600', 'bg-red-50', 'text-red-600');
}

// Confirmar y simular pantalla de éxito
function confirmBooking() {
  sheetContent.innerHTML = `
    <div class="flex flex-col items-center justify-center py-6 px-4 text-center">
      <div class="w-16 h-16 bg-green-50 border border-green-200 rounded-full flex items-center justify-center mb-4 text-3xl text-green-500 animate-bounce">
        <i class="fa-solid fa-circle-check"></i>
      </div>
      <h2 class="text-xl font-extrabold text-gray-900 mb-1">¡Reserva Confirmada!</h2>
      <p class="text-xs text-gray-500 max-w-xs mb-6">
        Tu solicitud ha sido enviada con éxito. ${currentSelectedTech.name.split(' ')[0]} se pondrá en contacto contigo pronto.
      </p>

      <div class="w-full bg-gray-50 border border-gray-100 rounded-2xl p-4 text-left space-y-2.5 mb-6 text-xs text-gray-600">
        <div class="flex justify-between border-b border-gray-100 pb-2">
          <span class="font-semibold text-gray-400">Técnico</span>
          <span class="font-bold text-gray-900">${currentSelectedTech.name}</span>
        </div>
        <div class="flex justify-between border-b border-gray-100 pb-2">
          <span class="font-semibold text-gray-400">Servicio</span>
          <span class="text-red-600 font-semibold">${currentSelectedTech.specialty}</span>
        </div>
        <div class="flex justify-between border-b border-gray-100 pb-2">
          <span class="font-semibold text-gray-400">Fecha y Hora</span>
          <span class="text-gray-900 font-bold">${selectedBookingDate || 'Mañana'}, ${selectedBookingTime.split(' ')[0]}</span>
        </div>
        <div class="flex justify-between pt-1">
          <span class="font-semibold text-gray-400">Precio del Trabajo</span>
          <span class="text-gray-900 font-extrabold">${formatCurrency(currentSelectedTech.price)}</span>
        </div>
      </div>

      <button onclick="toggleSheet(false)" class="btn-touch w-full py-3.5 rounded-2xl bg-gray-900 text-white font-extrabold text-xs active:scale-95 transition-all">
        Volver al Inicio
      </button>
    </div>
  `;
}

// Abrir/Cerrar Bottom Sheet / Modal Adaptable
function toggleSheet(open) {
  if (open) {
    bottomSheet.classList.add("open");
    sheetBackdrop.classList.add("open");
    document.body.classList.add("overflow-hidden");

    // En pantallas grandes (desktop), manejamos animaciones de escala/opacidad
    if (window.innerWidth >= 768) {
      bottomSheet.style.transform = 'translate(-50%, -50%) scale(1)';
      bottomSheet.style.opacity = '1';
    }
  } else {
    bottomSheet.classList.remove("open");
    sheetBackdrop.classList.remove("open");
    document.body.classList.remove("overflow-hidden");

    if (window.innerWidth >= 768) {
      bottomSheet.style.transform = 'translate(-50%, -50%) scale(0.95)';
      bottomSheet.style.opacity = '0';
    }
  }
}

sheetBackdrop.addEventListener("click", () => toggleSheet(false));

// Inicializar
document.addEventListener("DOMContentLoaded", () => {
  renderCards();
});
