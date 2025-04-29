<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KLAS - Kano State Land Admin System</title>

  
  <style>
    .sidebar-item {
      display: flex;
      align-items: center;
      padding: 0.75rem;
      cursor: pointer;
      border-radius: 0.375rem;
      transition: background-color 0.2s;
    }
    .sidebar-item:hover {
      background-color: #f3f4f6;
    }
    .sidebar-item.active {
      background-color: #eff6ff;
      color: #2563eb;
    }
    .sidebar-icon {
      width: 1.5rem;
      height: 1.5rem;
      margin-right: 0.75rem;
 
    }
    .klas-logo {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2px;
      width: 24px;
      height: 24px;
    }
    .klas-logo-red { background-color: #ef4444; }
    .klas-logo-green { background-color: #10b981; }
    .klas-logo-yellow { background-color: #f59e0b; }
    .klas-logo-blue { background-color: #3b82f6; }

    .submenu-item {
      display: flex;
      align-items: center;
      padding: 0.5rem 0.75rem 0.5rem 2.5rem;
      cursor: pointer;
      border-radius: 0.375rem;
      transition: background-color 0.2s;
    }
    .submenu-item:hover {
      background-color: #f3f4f6;
    }
    .submenu-item.active {
      background-color: #eff6ff;
      color: #2563eb;
    }

    .submenu {
    display: none;
  }

  .submenu.hidden {
    display: none;
  }

  .submenu:not(.hidden) {
    display: block;
  }



  .sidebar {
    width: 280px;
    height: 100vh;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }
  
  .sidebar-content {
    flex: 1;
    overflow-y: auto;
    height: calc(100vh - 8rem);
  }
  
  .sidebar-content::-webkit-scrollbar {
    width: 4px;
  }
  
  .sidebar-content::-webkit-scrollbar-track {
    background: transparent;
  }
  
  .sidebar-content::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 10px;
  }
  
  .active {
    font-weight: 500;
    background-color: #EBF5FF;
    border-left: 4px solid #3B82F6;
  }
  
  .sidebar-badge {
    font-size: 0.65rem;
    padding: 0.1rem 0.4rem;
    border-radius: 9999px;
    background-color: #E5E7EB;
    color: #374151;
  }
  
  .module-badge-programmes {
    background-color: #DBEAFE;
    color: #1E40AF;
  }
  
  .module-badge-legal-search {
    background-color: #DCFCE7;
    color: #166534;
  }
  
  .module-badge-instrument {
    background-color: #FEF3C7;
    color: #92400E;
  }
  
  .sidebar-item {
    transition: all 0.2s;
  }
  
  .sidebar-item:hover {
    background-color: #F9FAFB;
  }
  
  .animate-ping {
    animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
  }
  
  @keyframes ping {
    75%, 100% {
      transform: scale(2);
      opacity: 0;
    }
  }
  
  /* Module icon colors for different sections */
  .module-icon-dashboard {
    opacity: 0.8;
    color: #2563eb; /* Blue */
  }
  
  .module-icon-customer {
    opacity: 0.8;
    color: #7c3aed; /* Purple */
  }
  
  .module-icon-programmes {
    opacity: 0.8;
    color: #059669; /* Green */
  }
  
  .module-icon-info-products {
    opacity: 0.8;
    color: #d97706; /* Orange */
  }
  
  .module-icon-legal-search {
    opacity: 0.8;
    color: #0891b2; /* Teal */
  }
  
  .module-icon-instrument {
    opacity: 0.8;
    color: #002f64; /* Red */
  }
  
  .module-icon-file-registry {
    opacity: 0.8;
    color: #4f46e5; /* Indigo */
  }
  
  .module-icon-systems {
    opacity: 0.8;
    color: #db2777; /* Pink */
  }
  
  .module-icon-legacy {
    opacity: 0.8;
    color: #92400e; /* Brown */
  }
  
  .module-icon-admin {
    opacity: 0.8;
    color: #4b5563; /* Gray */
  }
  
  /* Nested submenu styles */
  .submenu-l1 {
    padding-left: 1.5rem;
  }
  
  .submenu-l2 {
    padding-left: 2.5rem;
  }
  
  .submenu-l3 {
    padding-left: 3.5rem;
  }
  
  .submenu-item {
    font-size: 0.875rem;
    padding: 0.5rem 0.75rem;
    display: flex;
    align-items: center;
    border-radius: 0.375rem;
    transition: all 0.2s;
  }
  
  .submenu-item:hover {
    background-color: #F9FAFB;
  }
  
  .submenu-item.active {
    font-weight: 500;
    background-color: #EBF5FF;
    border-left: 4px solid #3B82F6;
  }
</style>
<style>

  

  .stat-card {
    background-color: white;
    border-radius: 0.375rem;
    padding: 1.25rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
  }
  .tab {
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: all 0.2s;
    border-bottom: 2px solid transparent;
  }
  .tab:hover {
    color: #4b5563;
  }
  .tab.active {
    color: #3b82f6;
    border-bottom-color: #3b82f6;
  }
  .service-card {
    background-color: white;
    border-radius: 0.375rem;
    padding: 1.5rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
  }
  .badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 500;
  }
  .badge-primary {
    background-color: #f3f4f6;
    color: #4b5563;
  }
  .badge-progress {
    background-color: #dbeafe;
    color: #2563eb;
  }
  .badge-approved {
    background-color: #d1fae5;
    color: #059669;
  }
  .badge-pending {
    background-color: #fef3c7;
    color: #d97706;
  }
  .progress-bar {
    height: 8px;
    border-radius: 4px;
    background-color: #e5e7eb;
    overflow: hidden;
  }
  .progress-bar-fill {
    height: 100%;
    border-radius: 4px;
  }
  .progress-bar-blue {
    background-color: #3b82f6;
  }
  .progress-bar-orange {
    background-color: #f59e0b;
  }
  .progress-bar-red {
    background-color: #ef4444;
  }
  .table-header {
    background-color: #f9fafb;
    font-weight: 500;
    color: #4b5563;
    text-align: left;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #e5e7eb;
  }
  .table-cell {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #e5e7eb;
  }
  </style>
</head>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js" integrity="sha512-w3u9q/DeneCSwUDjhiMNibTRh/1i/gScBVp2imNVAMCt6cUHIw6xzhzcPFIaL3Q1EbI2l+nu17q2aLJJLo4ZYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/jspdf@3.0.1/dist/jspdf.es.min.js"></script>
<body class="bg-gray-100 flex h-screen">
<!-- Preloader -->
<div id="preloader" class="fixed inset-0 bg-white bg-opacity-80 flex items-center justify-center z-50">
  <img src="<?php echo e(asset('storage/upload/logo/klas_logo.gif')); ?>" alt="Loading..." style="width: 200px; height: auto;">
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const preloader = document.getElementById('preloader');
    setTimeout(function () {
      preloader.style.display = 'none';
    }, 3000); // 5 seconds timer
  });
</script>
  <!-- Sidebar -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      <?php if(session('success')): ?>
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: '<?php echo e(session('success')); ?>',
          confirmButtonColor: '#10b981'
        });
      <?php endif; ?>

      <?php if(session('error')): ?>
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: '<?php echo e(session('error')); ?>',
          confirmButtonColor: '#ef4444'
        });
      <?php endif; ?>

      <?php if($errors->any()): ?>
        Swal.fire({
          icon: 'error',
          title: 'Validation Errors',
          html: '<ul style="text-align: left;">' +
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              '<li><?php echo e($error); ?></li>' +
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            '</ul>',
          confirmButtonColor: '#ef4444'
        });
      <?php endif; ?>
    });
  </script>

 
    <!-- Sidebar Menu -->
    <?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Main Content (Placeholder) -->
 
    <?php echo $__env->make('admin.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 

  <script>
    // Initialize Lucide icons
    lucide.createIcons();
    
    // Add click event listeners to sidebar items
    document.querySelectorAll('.sidebar-item').forEach(item => {
      item.addEventListener('click', () => {
        // Remove active class from all items
        document.querySelectorAll('.sidebar-item').forEach(i => {
          i.classList.remove('active');
          i.querySelector('[data-lucide="chevron-down"]')?.setAttribute('data-lucide', 'chevron-right');
          lucide.createIcons();
        });
        
        // Add active class to clicked item
        item.classList.add('active');
        item.querySelector('[data-lucide="chevron-right"]')?.setAttribute('data-lucide', 'chevron-down');
        lucide.createIcons();
      });
    });

    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.has-submenu').forEach(function (item) {
      item.addEventListener('click', function () {
        const submenu = this.nextElementSibling;
        if (submenu.classList.contains('hidden')) {
          submenu.classList.remove('hidden');
        } else {
          submenu.classList.add('hidden');
        }
      });
    });
  });

        // Add event listeners for the back buttons
    document.addEventListener('DOMContentLoaded', function() {
    // Footer back button
    document.getElementById('back').addEventListener('click', function() {
    window.history.back();
    });

    // Header close button
    document.getElementById('closePaymentBtn').addEventListener('click', function() {
    window.history.back();
    });
    });
  </script>
</body>
</html> <?php /**PATH C:\wamp64\www\gisedms\resources\views/layouts/app.blade.php ENDPATH**/ ?>