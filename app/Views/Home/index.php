<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <!-- Viewport optimizado para teléfonos móviles (desactiva zoom accidental para una experiencia nativa) -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
  
  <title>ServiYA - Servicios y Soporte al Instante</title>
  
  <!-- Tailwind CSS para estilos rápidos y livianos -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              50: '#f0f7ff',
              100: '#e0effe',
              500: '#0066ff',
              600: '#0052cc',
              700: '#003d99',
            }
          }
        }
      }
    }
  </script>

  <!-- Iconos vectoriales premium FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Estilos personalizados para animaciones y UI premium -->
  <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-slate-50 flex flex-col text-gray-800 antialiased min-h-screen">

  <!-- ================= HEADER RESPONSIVO ================= -->
  <header class="bg-white border-b border-gray-100 sticky top-0 z-30 shadow-sm w-full">
    <div class="max-w-6xl mx-auto px-4 md:px-6 h-16 flex items-center justify-between">
      
      <!-- Logo e Identidad -->
      <div class="flex items-center space-x-3 cursor-pointer" onclick="showSection('inicio')">
        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-md shadow-blue-600/20">
          <i class="fa-solid fa-bolt text-lg"></i>
        </div>
        <div>
          <span class="text-xl font-extrabold text-gray-900 tracking-tight">Servi<span class="text-blue-600">YA</span></span>
          <span class="hidden md:inline-block text-[9px] uppercase font-bold tracking-widest text-gray-400 border border-gray-200 px-1.5 py-0.5 rounded ml-2 align-middle">Beta</span>
        </div>
      </div>

      <!-- Ubicación (Visible en móvil y desktop) -->
      <div class="flex items-center space-x-1.5 cursor-pointer bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-full hover:bg-gray-100 transition-all">
        <i class="fa-solid fa-location-dot text-red-500 text-xs"></i>
        <span class="text-xs font-bold text-gray-700">CABA, Buenos Aires</span>
        <i class="fa-solid fa-chevron-down text-[9px] text-gray-400"></i>
      </div>

      <!-- Menú de Navegación de Escritorio (Oculto en móvil) -->
      <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold text-gray-600">
        <a href="#" onclick="showSection('inicio')" class="nav-link hover:text-blue-600 transition-all flex items-center space-x-1.5">
          <i class="fa-solid fa-house text-xs"></i>
          <span>Inicio</span>
        </a>
        <a href="#" onclick="showSection('categorias')" class="nav-link hover:text-blue-600 transition-all flex items-center space-x-1.5">
          <i class="fa-solid fa-border-all text-xs"></i>
          <span>Categorías</span>
        </a>
        <a href="#" onclick="showSection('perfil')" class="nav-link hover:text-blue-600 transition-all flex items-center space-x-1.5">
          <i class="fa-solid fa-user text-xs"></i>
          <span id="desktop-profile-label">Mi Perfil</span>
        </a>
      </nav>

      <!-- Botón de Acción Principal y Notificaciones -->
      <div class="flex items-center space-x-3">
        <!-- Trabaja con nosotros (Solo Desktop) -->
        <button onclick="goToRegisterTech()" class="hidden md:flex btn-touch items-center space-x-2 px-4 py-2 bg-blue-50 text-blue-600 border border-blue-100 rounded-xl font-bold text-xs hover:bg-blue-100 transition-all">
          <i class="fa-solid fa-briefcase"></i>
          <span>Ofrecer mi Servicio</span>
        </button>

        <!-- Campana notificaciones -->
        <button class="btn-touch w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center border border-gray-100 relative">
          <i class="fa-regular fa-bell text-gray-600 text-base"></i>
          <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
        </button>
      </div>

    </div>
  </header>

  <!-- ================= CONTENEDOR PRINCIPAL FLUIDO ================= -->
  <div class="max-w-6xl mx-auto w-full px-4 md:px-6 flex-1 flex flex-col py-6 pb-24 md:pb-12">

    <!-- 1. SECCIÓN INICIO (RESPONSIVA) -->
    <div id="inicio-section" class="flex flex-col space-y-6 flex-1">
      
      <!-- Banner de Bienvenida y Buscador -->
      <div class="bg-white rounded-3xl p-5 md:p-8 shadow-sm border border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="max-w-xl">
          <h1 class="text-2xl md:text-3xl font-extrabold text-gray-950 leading-tight">
            Encuentra soporte técnico <br class="hidden md:inline">
            <span class="text-gradient">profesional al instante</span>
          </h1>
          <p class="text-gray-500 text-xs md:text-sm mt-2">
            Contrata albañilería, tapicería, carpintería, colocación de baldosas y soporte técnico garantizado con profesionales verificados en tu zona.
          </p>
        </div>
        
        <!-- Barra de Búsqueda Móvil/Desktop -->
        <div class="relative flex items-center w-full md:max-w-sm">
          <div class="absolute left-4 text-gray-400">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
          <input 
            type="text" 
            id="search-input" 
            placeholder="¿Qué servicio necesitas hoy?" 
            class="w-full pl-11 pr-10 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
          >
          <button 
            id="clear-search-btn" 
            class="absolute right-4 text-gray-400 hover:text-gray-600 hidden active:scale-90 transition-transform"
          >
            <i class="fa-solid fa-circle-xmark"></i>
          </button>
        </div>
      </div>

      <!-- Slider Horizontal de Categorías (Touch scrollable en móvil, centrado en desktop) -->
      <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
        <div class="mb-3 flex items-center justify-between">
          <h2 class="text-xs font-extrabold text-gray-900 uppercase tracking-wider">Categorías de Servicio</h2>
          <span onclick="showSection('categorias')" class="text-xs text-blue-600 font-bold cursor-pointer hover:underline">Ver todas</span>
        </div>
        
        <!-- Contenedor Deslizable Horizontal -->
        <div class="flex space-x-3 overflow-x-auto no-scrollbar py-1 categories-scroll-wrapper">
          <!-- Categoría Todos (Activa por defecto) -->
          <button 
            data-category="todos" 
            class="category-btn btn-touch flex-shrink-0 bg-blue-600 text-white font-bold text-xs px-4 py-3 rounded-2xl flex items-center space-x-2 border border-transparent shadow-active scale-105"
          >
            <i class="fa-solid fa-grid-2"></i>
            <span>Todos</span>
          </button>
          
          <!-- Albañilería -->
          <button 
            data-category="albanileria" 
            class="category-btn btn-touch flex-shrink-0 bg-white text-gray-600 font-bold text-xs px-4 py-3 rounded-2xl flex items-center space-x-2 border border-gray-100 shadow-sm"
          >
            <i class="fa-solid fa-trowel-bricks text-orange-500 text-sm"></i>
            <span>Albañilería</span>
          </button>
          
          <!-- Tapicería -->
          <button 
            data-category="tapiceria" 
            class="category-btn btn-touch flex-shrink-0 bg-white text-gray-600 font-bold text-xs px-4 py-3 rounded-2xl flex items-center space-x-2 border border-gray-100 shadow-sm"
          >
            <i class="fa-solid fa-couch text-purple-500 text-sm"></i>
            <span>Tapicería</span>
          </button>

          <!-- Carpintería -->
          <button 
            data-category="carpinteria" 
            class="category-btn btn-touch flex-shrink-0 bg-white text-gray-600 font-bold text-xs px-4 py-3 rounded-2xl flex items-center space-x-2 border border-gray-100 shadow-sm"
          >
            <i class="fa-solid fa-hammer text-amber-600 text-sm"></i>
            <span>Carpintería</span>
          </button>

          <!-- Baldosas -->
          <button 
            data-category="baldosas" 
            class="category-btn btn-touch flex-shrink-0 bg-white text-gray-600 font-bold text-xs px-4 py-3 rounded-2xl flex items-center space-x-2 border border-gray-100 shadow-sm"
          >
            <i class="fa-solid fa-border-all text-blue-500 text-sm"></i>
            <span>Baldosas</span>
          </button>

          <!-- Servicios Técnicos -->
          <button 
            data-category="servicios-tecnicos" 
            class="category-btn btn-touch flex-shrink-0 bg-white text-gray-600 font-bold text-xs px-4 py-3 rounded-2xl flex items-center space-x-2 border border-gray-100 shadow-sm"
          >
            <i class="fa-solid fa-bolt text-yellow-500 text-sm"></i>
            <span>Servicios Técnicos</span>
          </button>
        </div>
      </div>

      <!-- Banner Informativo (Trabaja con Nosotros en Móvil) -->
      <div class="md:hidden bg-gradient-to-r from-blue-600 to-blue-500 rounded-2xl p-4 text-white flex items-center justify-between shadow-md">
        <div>
          <h3 class="font-extrabold text-xs">¿Ofreces algún servicio técnico?</h3>
          <p class="text-[10px] text-blue-100 mt-0.5">Regístrate gratis y llega a cientos de clientes.</p>
        </div>
        <button onclick="goToRegisterTech()" class="btn-touch px-3 py-2 bg-white text-blue-600 font-bold text-[10px] rounded-xl shadow">
          Ofrecer Servicio
        </button>
      </div>

      <!-- Listado de Profesionales (Diseño Grid Auto-Adaptable) -->
      <div class="space-y-4">
        <!-- Subcabecera y Contador de Resultados -->
        <div class="flex items-center justify-between">
          <h2 class="text-xs font-extrabold text-gray-900 uppercase tracking-wider">Técnicos recomendados</h2>
          <span id="results-count" class="text-xs text-gray-400 font-bold bg-white px-2.5 py-1 rounded-full border border-gray-100">Cargando...</span>
        </div>

        <!-- Contenedor Grid responsivo de tarjetas -->
        <!-- Se adapta a 1 columna en celulares, 2 en tablets y 3 en pantallas grandes -->
        <div id="tech-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
          <!-- Renderizado dinámico desde app.js -->
        </div>
      </div>

    </div>

    <!-- 2. SECCIÓN CATEGORÍAS (PÁGINA SECUNDARIA) -->
    <div id="categorias-section" class="hidden flex-col space-y-6 flex-1 animate-fade-in">
      <div>
        <h1 class="text-2xl font-extrabold text-gray-950">Explorar Categorías</h1>
        <p class="text-gray-500 text-xs mt-1">Busca especialistas según el tipo de reparación o mantenimiento que requieras.</p>
      </div>
      
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        <!-- Albañilería -->
        <div onclick="filterByCategory('albanileria')" class="btn-touch bg-white border border-gray-100 rounded-2xl p-5 flex flex-col justify-between h-36 shadow-sm hover:shadow-md cursor-pointer transition-all">
          <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-trowel-bricks"></i>
          </div>
          <div>
            <h3 class="font-bold text-gray-900 text-sm">Albañilería</h3>
            <span class="text-[10px] text-gray-400">Revoques y reformas</span>
          </div>
        </div>

        <!-- Tapicería -->
        <div onclick="filterByCategory('tapiceria')" class="btn-touch bg-white border border-gray-100 rounded-2xl p-5 flex flex-col justify-between h-36 shadow-sm hover:shadow-md cursor-pointer transition-all">
          <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-couch"></i>
          </div>
          <div>
            <h3 class="font-bold text-gray-900 text-sm">Tapicería</h3>
            <span class="text-[10px] text-gray-400">Restauración de sillones</span>
          </div>
        </div>

        <!-- Carpintería -->
        <div onclick="filterByCategory('carpinteria')" class="btn-touch bg-white border border-gray-100 rounded-2xl p-5 flex flex-col justify-between h-36 shadow-sm hover:shadow-md cursor-pointer transition-all">
          <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-hammer"></i>
          </div>
          <div>
            <h3 class="font-bold text-gray-900 text-sm">Carpintería</h3>
            <span class="text-[10px] text-gray-400">Diseños de madera</span>
          </div>
        </div>

        <!-- Baldosas -->
        <div onclick="filterByCategory('baldosas')" class="btn-touch bg-white border border-gray-100 rounded-2xl p-5 flex flex-col justify-between h-36 shadow-sm hover:shadow-md cursor-pointer transition-all">
          <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-border-all"></i>
          </div>
          <div>
            <h3 class="font-bold text-gray-900 text-sm">Baldosas</h3>
            <span class="text-[10px] text-gray-400">Instalación cerámica</span>
          </div>
        </div>

        <!-- Soporte Técnico -->
        <div onclick="filterByCategory('servicios-tecnicos')" class="btn-touch bg-white border border-gray-100 rounded-2xl p-5 flex flex-col justify-between h-36 shadow-sm hover:shadow-md cursor-pointer transition-all col-span-2 sm:col-span-1 md:col-span-1">
          <div class="w-12 h-12 bg-yellow-50 text-yellow-500 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-bolt"></i>
          </div>
          <div>
            <h3 class="font-bold text-gray-900 text-sm">Servicios Técnicos</h3>
            <span class="text-[10px] text-gray-400">Electricidad y clima</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ================= 3. SECCIÓN DE AUTENTICACIÓN (LOGIN & REGISTRO PREMIUM) ================= -->
    <div id="auth-section" class="hidden max-w-lg mx-auto w-full bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 animate-fade-in">
      
      <!-- Cabecera de bienvenida del panel -->
      <div class="text-center mb-6">
        <h2 class="text-xl font-extrabold text-gray-950">¡Te damos la bienvenida!</h2>
        <p class="text-gray-500 text-xs mt-1">Regístrate o inicia sesión para gestionar tus solicitudes de soporte técnico y servicios.</p>
      </div>

      <!-- Navegación entre Login y Registro -->
      <div class="flex border-b border-gray-100 mb-6">
        <button id="tab-login" onclick="toggleAuthTab('login')" class="flex-1 pb-3 text-center border-b-2 border-blue-600 font-extrabold text-sm text-blue-600 transition-all">
          Iniciar Sesión
        </button>
        <button id="tab-register" onclick="toggleAuthTab('register')" class="flex-1 pb-3 text-center border-b-2 border-transparent font-extrabold text-sm text-gray-400 hover:text-gray-600 transition-all">
          Crear Cuenta
        </button>
      </div>

      <!-- A. FORMULARIO DE INICIO DE SESIÓN -->
      <div id="login-form-container" class="space-y-5">
        <!-- Botones de Inicio de Sesión Social -->
        <div class="grid grid-cols-2 gap-3">
          <button onclick="handleSocialLogin('Google')" class="btn-touch bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 py-3 rounded-xl font-bold text-xs flex items-center justify-center space-x-2 shadow-sm">
            <i class="fa-brands fa-google text-red-500 text-sm"></i>
            <span>Google</span>
          </button>
          <button onclick="handleSocialLogin('Apple')" class="btn-touch bg-black hover:bg-neutral-800 text-white py-3 rounded-xl font-bold text-xs flex items-center justify-center space-x-2 shadow-sm">
            <i class="fa-brands fa-apple text-lg"></i>
            <span>Apple</span>
          </button>
        </div>

        <!-- Divisor "o ingresar con correo" -->
        <div class="relative flex py-2 items-center">
          <div class="flex-grow border-t border-gray-100"></div>
          <span class="flex-shrink mx-4 text-gray-400 text-[9px] font-extrabold uppercase tracking-wider">o ingresar con correo</span>
          <div class="flex-grow border-t border-gray-100"></div>
        </div>

        <form id="login-form" onsubmit="handleLogin(event)" class="space-y-4">
          <!-- Campo Correo con Icono -->
          <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Correo electrónico</label>
            <div class="relative flex items-center">
              <span class="absolute left-4 text-gray-400 text-xs">
                <i class="fa-solid fa-envelope"></i>
              </span>
              <input type="email" id="login-email" required placeholder="correo@ejemplo.com" class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
            </div>
          </div>

          <!-- Campo Contraseña con Icono y Ojo -->
          <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Contraseña</label>
            <div class="relative flex items-center">
              <span class="absolute left-4 text-gray-400 text-xs">
                <i class="fa-solid fa-lock"></i>
              </span>
              <input type="password" id="login-password" required placeholder="••••••••" class="w-full pl-11 pr-11 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
              <button type="button" onclick="togglePasswordVisibility('login-password', this)" class="absolute right-4 text-gray-400 hover:text-gray-600 focus:outline-none">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
          </div>

          <div class="flex items-center justify-between pt-1">
            <label class="flex items-center space-x-2 cursor-pointer select-none">
              <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-50 border-gray-200 rounded focus:ring-blue-500/30">
              <span class="text-xs text-gray-500">Recordarme</span>
            </label>
            <a href="#" class="text-xs text-blue-600 font-bold hover:underline">¿Olvidaste tu contraseña?</a>
          </div>

          <button type="submit" class="btn-touch w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-blue-600/10 transition-all mt-4 uppercase tracking-wider">
            Ingresar
          </button>
        </form>
      </div>

      <!-- B. FORMULARIO DE REGISTRO (CON ROLES DINÁMICOS) -->
      <div id="register-container" class="hidden space-y-5">
        <!-- Selector de Tipo de Usuario (Rol) -->
        <div>
          <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Quiero registrarme como:</label>
          <div class="grid grid-cols-2 gap-3">
            <button id="role-client" onclick="selectRegisterRole('client')" class="btn-touch border-2 border-blue-600 bg-blue-50 text-blue-600 font-bold text-xs py-3 rounded-xl flex items-center justify-center space-x-1.5">
              <i class="fa-solid fa-user-tie"></i>
              <span>Cliente (Contratar)</span>
            </button>
            <button id="role-tech" onclick="selectRegisterRole('tech')" class="btn-touch border border-gray-200 bg-white text-gray-600 font-bold text-xs py-3 rounded-xl flex items-center justify-center space-x-1.5">
              <i class="fa-solid fa-briefcase"></i>
              <span>Profesional (Ofrecer)</span>
            </button>
          </div>
        </div>

        <form id="register-form" onsubmit="handleRegister(event)" class="space-y-4">
          <!-- Campos Comunes -->
          <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Nombre Completo</label>
            <div class="relative flex items-center">
              <span class="absolute left-4 text-gray-400 text-xs">
                <i class="fa-solid fa-user"></i>
              </span>
              <input type="text" id="reg-name" required placeholder="Ej: Juan Pérez" class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
            </div>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Correo Electrónico</label>
              <div class="relative flex items-center">
                <span class="absolute left-4 text-gray-400 text-xs">
                  <i class="fa-solid fa-envelope"></i>
                </span>
                <input type="email" id="reg-email" required placeholder="correo@ejemplo.com" class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
              </div>
            </div>
            <div>
              <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Teléfono Móvil</label>
              <div class="relative flex items-center">
                <span class="absolute left-4 text-gray-400 text-xs">
                  <i class="fa-solid fa-phone"></i>
                </span>
                <input type="tel" id="reg-phone" required placeholder="Ej: +54 9 11 ..." class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
              </div>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Contraseña</label>
            <div class="relative flex items-center">
              <span class="absolute left-4 text-gray-400 text-xs">
                <i class="fa-solid fa-lock"></i>
              </span>
              <input type="password" id="reg-password" required placeholder="Mínimo 6 caracteres" class="w-full pl-11 pr-11 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
              <button type="button" onclick="togglePasswordVisibility('reg-password', this)" class="absolute right-4 text-gray-400 hover:text-gray-600 focus:outline-none">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
          </div>

          <!-- Campos Específicos para el Profesional / Proveedor de Servicio (Dinamizados vía JS) -->
          <div id="tech-fields" class="hidden space-y-4 pt-3 border-t border-gray-100 animate-fade-in">
            <h3 class="text-xs font-extrabold text-blue-600 uppercase tracking-wide">Detalles de tu Servicio</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Categoría principal</label>
                <select id="reg-tech-category" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-gray-600">
                  <option value="albanileria">Albañilería</option>
                  <option value="tapiceria">Tapicería</option>
                  <option value="carpinteria">Carpintería/Madera</option>
                  <option value="baldosas">Baldosas/Pisos</option>
                  <option value="servicios-tecnicos">Servicios Técnicos</option>
                </select>
              </div>
              <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Especialidad corta</label>
                <input type="text" id="reg-tech-specialty" placeholder="Ej: Especialista en Porcelanatos" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Tarifa estimada ($)</label>
                <div class="flex space-x-2">
                  <input type="number" id="reg-tech-price" placeholder="Monto en pesos" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                  <select id="reg-tech-price-unit" class="px-3 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-gray-600">
                    <option value="hora">/ hora</option>
                    <option value="trabajo">/ trabajo</option>
                  </select>
                </div>
              </div>
              <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Experiencia</label>
                <input type="text" id="reg-tech-exp" placeholder="Ej: 5 años" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Zona de Cobertura / Barrio</label>
              <input type="text" id="reg-tech-location" placeholder="Ej: Belgrano, CABA" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
            </div>

            <div>
              <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Breve Biografía / Presentación</label>
              <textarea id="reg-tech-bio" rows="3" placeholder="Describe brevemente tu experiencia, materiales que usas y cómo trabajas para atraer clientes..." class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"></textarea>
            </div>
          </div>

          <button type="submit" class="btn-touch w-full py-3.5 bg-green-600 hover:bg-green-700 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-green-600/10 transition-all mt-6 uppercase tracking-wider">
            Confirmar Registro
          </button>
        </form>
      </div>

    </div>

    <!-- 4. SECCIÓN PERFIL (PÁGINA SECUNDARIA - SOLO SI LOGUEADO) -->
    <div id="perfil-section" class="hidden flex-col space-y-6 flex-1 max-w-lg mx-auto w-full animate-fade-in">
      <div>
        <h1 class="text-2xl font-extrabold text-gray-950">Mi Perfil</h1>
        <p class="text-gray-500 text-xs mt-1">Administra tu cuenta, historial de reservas y preferencias.</p>
      </div>
      
      <!-- Ficha del Usuario Logueado (Simulado) -->
      <div class="bg-white border border-gray-100 rounded-2xl p-5 flex items-center justify-between shadow-sm">
        <div class="flex items-center space-x-4">
          <div id="user-avatar" class="w-14 h-14 rounded-full bg-blue-600 text-white font-extrabold text-lg flex items-center justify-center shadow-md">
            CL
          </div>
          <div>
            <h2 id="user-name" class="text-lg font-bold text-gray-950">Carlos López</h2>
            <p id="user-email" class="text-xs text-gray-400">carlos.lopez@example.com</p>
            <span id="user-role-badge" class="bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-0.5 rounded-full mt-1.5 inline-block">Cliente</span>
          </div>
        </div>
        
        <!-- Botón de deslogueo -->
        <button onclick="handleLogout()" class="btn-touch text-red-500 hover:bg-red-50 px-3 py-2 rounded-xl transition-all text-xs font-bold flex items-center space-x-1">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Cerrar Sesión</span>
        </button>
      </div>

      <!-- Menú de Opciones del Perfil -->
      <div class="bg-white border border-gray-100 rounded-2xl p-2.5 space-y-1 shadow-sm">
        <button class="w-full btn-touch bg-white rounded-xl p-3.5 flex items-center justify-between text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all">
          <div class="flex items-center space-x-3">
            <i class="fa-solid fa-clock-rotate-left text-gray-400 w-5"></i>
            <span>Historial de Reservas</span>
          </div>
          <i class="fa-solid fa-chevron-right text-xs text-gray-300"></i>
        </button>
        <button class="w-full btn-touch bg-white rounded-xl p-3.5 flex items-center justify-between text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all">
          <div class="flex items-center space-x-3">
            <i class="fa-solid fa-credit-card text-gray-400 w-5"></i>
            <span>Métodos de Pago</span>
          </div>
          <i class="fa-solid fa-chevron-right text-xs text-gray-300"></i>
        </button>
        <button class="w-full btn-touch bg-white rounded-xl p-3.5 flex items-center justify-between text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all">
          <div class="flex items-center space-x-3">
            <i class="fa-solid fa-shield-halved text-gray-400 w-5"></i>
            <span>Seguridad y Privacidad</span>
          </div>
          <i class="fa-solid fa-chevron-right text-xs text-gray-300"></i>
        </button>
        <button class="w-full btn-touch bg-white rounded-xl p-3.5 flex items-center justify-between text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all">
          <div class="flex items-center space-x-3">
            <i class="fa-solid fa-headset text-gray-400 w-5"></i>
            <span>Soporte Técnico de la App</span>
          </div>
          <i class="fa-solid fa-chevron-right text-xs text-gray-300"></i>
        </button>
      </div>

      <!-- Versión e info de la App -->
      <div class="text-center text-[10px] text-gray-400 font-medium">
        <span>ServiYA Versión 1.1.0 (Prototipo Responsive Completo)</span>
      </div>
    </div>

  </div>

  <!-- ================= NAVEGACIÓN INFERIOR (Solo en Pantallas Móviles) ================= -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 glass-nav shadow-lg flex justify-around items-center px-4 pt-2.5 pb-2 safe-bottom">
    <!-- Opción Inicio -->
    <a href="#" data-target="inicio" class="bottom-nav-item btn-touch text-blue-600 flex flex-col items-center justify-center w-16 text-center select-none">
      <i class="fa-solid fa-house text-lg"></i>
      <span class="text-[9px] font-bold mt-1">Inicio</span>
      <span class="nav-dot w-1.5 h-1.5 bg-blue-600 rounded-full mt-0.5 transition-transform duration-200 scale-100"></span>
    </a>

    <!-- Opción Categorías -->
    <a href="#" data-target="categorias" class="bottom-nav-item btn-touch text-gray-400 flex flex-col items-center justify-center w-16 text-center select-none">
      <i class="fa-solid fa-border-all text-lg"></i>
      <span class="text-[9px] font-bold mt-1">Categorías</span>
      <span class="nav-dot w-1.5 h-1.5 bg-blue-600 rounded-full mt-0.5 transition-transform duration-200 scale-0"></span>
    </a>

    <!-- Opción Perfil / Autenticación -->
    <a href="#" data-target="perfil" class="bottom-nav-item btn-touch text-gray-400 flex flex-col items-center justify-center w-16 text-center select-none">
      <i class="fa-solid fa-user text-lg"></i>
      <span class="text-[9px] font-bold mt-1">Mi Cuenta</span>
      <span class="nav-dot w-1.5 h-1.5 bg-blue-600 rounded-full mt-0.5 transition-transform duration-200 scale-0"></span>
    </a>
  </nav>

  <!-- ================= MODAL / BOTTOM SHEET (Detalles de Reserva y Perfil de Técnicos) ================= -->
  <!-- Backdrop del Modal -->
  <div id="sheet-backdrop" class="fixed inset-0 z-50 bg-black/50 backdrop"></div>
  
  <!-- Cuerpo del Modal (Adaptable: Bottom sheet en móvil, centrado flotante en desktop) -->
  <div id="bottom-sheet" class="fixed bottom-0 md:bottom-auto md:top-1/2 md:left-1/2 md:-translate-x-1/2 md:-translate-y-1/2 left-0 right-0 max-w-md mx-auto z-55 bg-white rounded-t-[32px] md:rounded-[32px] max-h-[85vh] md:max-h-[90vh] overflow-y-auto px-5 pt-3 pb-6 bottom-sheet md:transform md:scale-95 md:opacity-0 md:transition-all md:duration-250 shadow-2xl">
    <!-- Indicador de cierre táctil (Solo visible en móviles) -->
    <div class="w-12 h-1.5 bg-gray-200 rounded-full mx-auto mb-5 md:hidden"></div>
    
    <!-- Botón de cerrar para Desktop (Oculto en móvil) -->
    <button onclick="toggleSheet(false)" class="hidden md:flex absolute top-4 right-4 w-8 h-8 bg-gray-50 border border-gray-100 rounded-full items-center justify-center text-gray-500 hover:text-gray-800 transition-all">
      <i class="fa-solid fa-xmark text-sm"></i>
    </button>
    
    <div id="sheet-content" class="mt-4 md:mt-2">
      <!-- Rellenado dinámicamente desde app.js -->
    </div>
  </div>

  <!-- Carga del archivo JavaScript de la aplicación -->
  <script src="app.js"></script>
</body>
</html>
