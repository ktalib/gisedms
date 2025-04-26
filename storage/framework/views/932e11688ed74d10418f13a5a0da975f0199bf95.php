<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KLAS - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .hide-scrollbar::-webkit-scrollbar {
      display: none;
    }
    
    /* Hide scrollbar for IE, Edge and Firefox */
    .hide-scrollbar {
      -ms-overflow-style: none;  /* IE and Edge */
      scrollbar-width: none;  /* Firefox */
    }
  </style>
</head>
<body>
  <div class="h-screen flex bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 overflow-hidden">
    <!-- Left side - Login form (static) -->
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center p-8 h-screen">
      <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-xl shadow-lg">
        <div class="flex flex-col items-center justify-center">
          <div class="w-32 h-32 relative mb-4">
            <img
              src="<?php echo e(asset('storage/upload/logo/1.jpeg')); ?>"
              alt="KLAS Logo"
              class="rounded-lg w-full h-full object-cover"
            />
          </div>
          <h2 class="text-2xl font-bold text-gray-900">Welcome to KLAS</h2>
          <p class="text-sm text-gray-600 mt-1">Kano State  Land Administration System</p>
        </div>

        <form action="<?php echo e(route('login')); ?>" method="post" id="loginForm" class="login-form">
            <?php echo csrf_field(); ?>
     
        <?php if(session('error')): ?>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?php echo e(session('error')); ?>',
                confirmButtonColor: '#4B5563'
                });
            });
            </script>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?php echo e(session('success')); ?>',
                confirmButtonColor: '#4B5563'
                });
            });
            </script>
        <?php endif; ?>
          <div class="space-y-4">
            <div class="space-y-2">
              <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
              <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-3 h-4 w-4 text-gray-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                <input
                  id="email"
                  type="email"
                  name="email"
                  placeholder="Enter your email"
                  class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md text-sm"
                  required
                />
              </div>
            </div>

            <div class="space-y-2">
              <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <a href="<?php echo e(route('password.request')); ?>" class="text-xs  hover:underline">
                  Forgot password?
                </a>
              </div>
              <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-3 h-4 w-4 text-gray-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <input
                  id="password"
                  type="password"
                  name="password"
                  placeholder="Enter your password"
                  class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md text-sm"
                  required
                />
                <button
                  type="button"
                  id="togglePassword"
                  class="absolute right-3 top-3 text-gray-400 hover:text-gray-600"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" id="eyeIcon" class="h-4 w-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" id="eyeOffIcon" class="h-4 w-4 hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                    <line x1="2" x2="22" y1="2" y2="22"></line>
                  </svg>
                </button>
              </div>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-2">
                <input
                  type="checkbox"
                  id="remember-me"
                  class="h-4 w-4  focus:ring-blue-500 border-gray-300 rounded"
                />
                <label for="remember-me" class="text-sm text-gray-700">
                  Remember me
                </label>
              </div>
            </div>
          </div>

          <button 
            type="submit" 
            id="loginButton"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
          >
            Sign in
          </button>
        </form>

        <div class="mt-6 text-center">
          <p class="text-sm text-gray-600">
            Don't have an account?
            <a href="#" class=" hover:underline">
              Contact administrator
            </a>
          </p>
        </div>
      </div>
    </div>

    <!-- Right side - KLAS information (scrollable with hidden scrollbar) -->
    <div
      class="hidden md:block md:w-1/2 bg-gray-100 h-screen overflow-y-auto hide-scrollbar"
    >
      <div class="w-full max-w-3xl px-12 py-8 mx-auto">
        <div class="flex justify-center mb-6">
          <div class="w-64 h-auto relative">
            <img
              src="https://astralisco.com/images/faanlas2.jpg"
              alt="LAAD-SYS Logo"
              class="rounded-lg w-full h-auto"
            />
          </div>
        </div>

        <div class="text-center mb-8">
          <h1 class="text-4xl font-bold text-gray-900 mb-2">KLAS</h1>
          <h2 class="text-2xl font-semibold text-gray-800 mb-3">Kano State Land Administration System</h2>
          <p class="text-lg text-gray-700 font-medium italic">
            Powering a Smart, Secure & Integrated Future for Land Governance in Kano State whilst Leveraging on Block
            Chain Technology and AI
          </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
          <p class="text-gray-700 leading-relaxed">
            The Kano State Land Administration System (KLAS) is a next-generation, enterprise-grade Land Information
            System designed to revolutionize how land is managed, administered, and serviced across Kano State. Built
            with a modern, modular architecture, KLAS serves as the digital backbone of the Ministry of Land and
            Physical Planning, enabling interoperability between departments and seamless integration of core land
            services.
          </p>
        </div>

        <div class="bg-blue-50 p-6 rounded-lg shadow-sm mb-6 border border-blue-100">
          <h3 class="font-semibold text-xl  mb-3 text-center">
            KLAS – Interoperable, Intelligent, and Future-Proof
          </h3>
          <p class="text-gray-700 leading-relaxed">
            By bringing together these features, KLAS is not just a software—it's a statewide digital land governance
            ecosystem, enabling smarter workflows, greater transparency, and improved service delivery.
          </p>
          <p class="text-gray-700 leading-relaxed mt-3">
            Whether it's planning infrastructure, registering titles, performing legal search, or managing land
            disputes, KLAS ensures every department, from Survey to Legal, works in lockstep with synchronized data
            and automated processes.
          </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
          <h3 class="font-semibold text-xl text-gray-900 mb-4">Key Features of KLAS</h3>

          <div class="space-y-6">
            <!-- Digital Legal Search -->
            <div class="feature-item">
              <h4 class="flex items-center text-lg font-medium  mb-2">
                <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center mr-2 flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                </div>
                Digital Legal Search (Online & On-Premise)
              </h4>
              <ul class="pl-8 space-y-1.5">
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Offers official (on-premise) and commercial (online) legal search options.
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Generates complete land history from ownership to encumbrances.
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Leverages Blockchain Technology to guarantee record immutability and Artificial Intelligence (AI)
                    to detect anomalies or duplication in land transactions.
                  </span>
                </li>
              </ul>
            </div>

            <!-- Automated Billing and Revenue Management System -->
            <div class="feature-item">
              <h4 class="flex items-center text-lg font-medium  mb-2">
                <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center mr-2 flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                </div>
                Automated Billing and Revenue Management System (ABRM)
              </h4>
              <ul class="pl-8 space-y-1.5">
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">Fully Automated Billing Workflow</span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">Real-time Integration with INTERSWITCH & KIRMAS</span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Direct API-based integration with INTERSWITCH payment gateway and KIRMAS (Kano State Internal
                    Revenue Service) ensures that:
                    <ul class="pl-6 pt-1.5 space-y-1.5">
                      <li class="flex items-start">
                        <div class="h-2 w-2 rounded-full bg-gray-600 mt-1.5 mr-2 flex-shrink-0"></div>
                        <span class="text-gray-700">All payments are tracked and validated in real-time.</span>
                      </li>
                      <li class="flex items-start">
                        <div class="h-2 w-2 rounded-full bg-gray-600 mt-1.5 mr-2 flex-shrink-0"></div>
                        <span class="text-gray-700">
                          Receipts are auto-generated and digitally attached to the customer's profile.
                        </span>
                      </li>
                      <li class="flex items-start">
                        <div class="h-2 w-2 rounded-full bg-gray-600 mt-1.5 mr-2 flex-shrink-0"></div>
                        <span class="text-gray-700">
                          Reconciliations with state treasury accounts are seamless and auditable.
                        </span>
                      </li>
                    </ul>
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">Transparency & Accountability</span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Customer Portal with Digital Invoicing
                    <ul class="pl-6 pt-1.5 space-y-1.5">
                      <li class="flex items-start">
                        <div class="h-2 w-2 rounded-full bg-gray-600 mt-1.5 mr-2 flex-shrink-0"></div>
                        <span class="text-gray-700">Applicants and property owners can:</span>
                      </li>
                      <li class="flex items-start">
                        <div class="h-2 w-2 rounded-full bg-gray-600 mt-1.5 mr-2 flex-shrink-0"></div>
                        <span class="text-gray-700">View, download, and print invoices online.</span>
                      </li>
                      <li class="flex items-start">
                        <div class="h-2 w-2 rounded-full bg-gray-600 mt-1.5 mr-2 flex-shrink-0"></div>
                        <span class="text-gray-700">
                          Make payments through multiple channels—bank, POS, USSD, or mobile.
                        </span>
                      </li>
                      <li class="flex items-start">
                        <div class="h-2 w-2 rounded-full bg-gray-600 mt-1.5 mr-2 flex-shrink-0"></div>
                        <span class="text-gray-700">Monitor balances, payment history, and penalties.</span>
                      </li>
                    </ul>
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">Multi-Tiered Approval & Alerts</span>
                </li>
              </ul>
            </div>

            <!-- New Sectional Titling Module -->
            <div class="feature-item">
              <h4 class="flex items-center text-lg font-medium  mb-2">
                <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center mr-2 flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                </div>
                New Sectional Titling (ST) Module
              </h4>
              <ul class="pl-8 space-y-1.5">
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">Allows original owners to apply for property fragmentation.</span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Supports full application workflows including betterment billing, planning approvals, and final
                    conveyancing.
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Nested application system for main and sub-units under a unified schema.
                  </span>
                </li>
              </ul>
            </div>

            <!-- Systematic Land Titling & Registration -->
            <div class="feature-item">
              <h4 class="flex items-center text-lg font-medium  mb-2">
                <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center mr-2 flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                </div>
                Systematic Land Titling & Registration (SLTR)
              </h4>
              <ul class="pl-8 space-y-1.5">
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">Empowers mass titling of informal settlements.</span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Integrates community-based land identification with formal parcel-based mapping.
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Outputs recognized legal documentation for untitled property owners.
                  </span>
                </li>
              </ul>
            </div>

            <!-- e-Registry -->
            <div class="feature-item">
              <h4 class="flex items-center text-lg font-medium  mb-2">
                <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center mr-2 flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                </div>
                e-Registry
              </h4>
              <ul class="pl-8 space-y-1.5">
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">A digitally centralized repository of all title records.</span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Enables secure, instant retrieval, search and registration of land documents.
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Built to ensure data integrity, audit trails, and secure multi-agency access.
                  </span>
                </li>
              </ul>
            </div>

            <!-- Electronic Document Management System -->
            <div class="feature-item">
              <h4 class="flex items-center text-lg font-medium  mb-2">
                <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center mr-2 flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                </div>
                Electronic Document Management System (EDMS)
              </h4>
              <ul class="pl-8 space-y-1.5">
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Manages scanned documents, file archiving, indexing and retrieval.
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">Integrates with RFID tracking for physical files.</span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Supports bulk uploads and document workflows tied to land records.
                  </span>
                </li>
              </ul>
            </div>

            <!-- Customer Relationship Management System -->
            <div class="feature-item">
              <h4 class="flex items-center text-lg font-medium  mb-2">
                <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center mr-2 flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                </div>
                Customer Relationship Management (CRM) System
              </h4>
              <ul class="pl-8 space-y-1.5">
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Streamlines interaction between the Ministry and stakeholders.
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Tracks customer requests, complaints, service timelines, and feedback.
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Fully integrated with billing, messaging, and ticketing modules.
                  </span>
                </li>
              </ul>
            </div>

            <!-- Enterprise GIS -->
            <div class="feature-item">
              <h4 class="flex items-center text-lg font-medium  mb-2">
                <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center mr-2 flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                </div>
                Enterprise GIS (Geographic Information System)
              </h4>
              <ul class="pl-8 space-y-1.5">
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Multi-user access to live spatial databases of parcels, layouts, infrastructure, and encumbrances.
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Supports spatial analysis, parcel querying, site planning, and survey integration.
                  </span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4  mt-1 mr-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <span class="text-gray-700">
                    Fully integrated with the Parcel Fabric, COGO tools, and land applications.
                  </span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="text-center mb-8">
          <p class="text-xl  font-semibold italic">
            "KLAS: Interoperable Land Governance for a Smarter Kano."
          </p>
        </div>

        <div class="mt-4 mb-8 text-sm text-gray-600 text-center">
          © 2025 LAAD-Sys - Land Admin System. All rights reserved.
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const loginForm = document.getElementById('loginForm');
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      const eyeOffIcon = document.getElementById('eyeOffIcon');
      
      // Toggle password visibility
      togglePassword.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          eyeIcon.classList.add('hidden');
          eyeOffIcon.classList.remove('hidden');
        } else {
          passwordInput.type = 'password';
          eyeIcon.classList.remove('hidden');
          eyeOffIcon.classList.add('hidden');
        }
      });
      
    
    });
  </script>
</body>
</html><?php /**PATH C:\wamp64\www\gisedms\resources\views/auth/login.blade.php ENDPATH**/ ?>