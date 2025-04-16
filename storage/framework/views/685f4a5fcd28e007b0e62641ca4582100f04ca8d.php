<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KLAS - Kano State Land Admin System</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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
<body class="bg-gray-100 flex h-screen">
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

  <div class="w-64 h-full bg-white border-r border-gray-200 flex flex-col">
    <!-- Logo Header -->
    <div class="p-4 border-b border-gray-200 bg-purple-50">
      <div class="flex items-center">
        <div class="mr-2 flex-shrink-0">
          <div class="klas-logo">
            <div class="klas-logo-red"></div>
            <div class="klas-logo-green"></div>
            <div class="klas-logo-yellow"></div>
            <div class="klas-logo-blue"></div>
          </div>
        </div>
        <span class="text-xl font-bold">KLAS</span>
      </div>
    </div>

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