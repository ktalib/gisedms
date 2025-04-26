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
  </script>
</body>
</html> <?php /**PATH C:\wamp64\www\gisedms\resources\views/layouts/app.blade.php ENDPATH**/ ?>