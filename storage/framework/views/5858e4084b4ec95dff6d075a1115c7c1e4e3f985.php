<?php $__env->startPush('script-page'); ?>


    <script>
        
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="p-6">
    <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Stats Cards -->
    <div class="grid grid-cols-5 gap-4 mb-6">
      <div class="stat-card">
        <div class="flex justify-between items-start mb-4">
          <h3 class="text-gray-600 font-medium">Total Applications</h3>
          <i data-lucide="file-text" class="text-gray-400 w-5 h-5"></i>
        </div>
        <div class="text-3xl font-bold">1,284</div>
        <div class="flex items-center mt-2 text-sm">
          <i data-lucide="arrow-up" class="text-green-500 w-4 h-4 mr-1"></i>
          <span class="text-green-500">12% from last month</span>
        </div>
      </div>

      <div class="stat-card">
        <div class="flex justify-between items-start mb-4">
          <h3 class="text-gray-600 font-medium">Pending Approvals</h3>
          <i data-lucide="clock" class="text-gray-400 w-5 h-5"></i>
        </div>
        <div class="text-3xl font-bold">145</div>
        <div class="flex items-center mt-2 text-sm">
          <i data-lucide="arrow-down" class="text-red-500 w-4 h-4 mr-1"></i>
          <span class="text-red-500">8% from last month</span>
        </div>
      </div>

      <div class="stat-card">
        <div class="flex justify-between items-start mb-4">
          <h3 class="text-gray-600 font-medium">Registered Properties</h3>
          <i data-lucide="home" class="text-gray-400 w-5 h-5"></i>
        </div>
        <div class="text-3xl font-bold">8,549</div>
        <div class="flex items-center mt-2 text-sm">
          <i data-lucide="arrow-up" class="text-green-500 w-4 h-4 mr-1"></i>
          <span class="text-green-500">4% from last month</span>
        </div>
      </div>

      <div class="stat-card">
        <div class="flex justify-between items-start mb-4">
          <h3 class="text-gray-600 font-medium">Registered Users</h3>
          <i data-lucide="users" class="text-gray-400 w-5 h-5"></i>
        </div>
        <div class="text-3xl font-bold">3,672</div>
        <div class="flex items-center mt-2 text-sm">
          <i data-lucide="arrow-up" class="text-green-500 w-4 h-4 mr-1"></i>
          <span class="text-green-500">9% from last month</span>
        </div>
      </div>

      <div class="stat-card">
        <div class="flex justify-between items-start mb-4">
          <h3 class="text-gray-600 font-medium">Active Modules</h3>
          <i data-lucide="layers" class="text-gray-400 w-5 h-5"></i>
        </div>
        <div class="text-3xl font-bold">9</div>
        <div class="flex items-center mt-2 text-sm">
          <i data-lucide="arrow-up" class="text-green-500 w-4 h-4 mr-1"></i>
          <span class="text-green-500">2 new this month</span>
        </div>
      </div>
    </div>

    <!-- Tabs -->
    <div class="flex space-x-6 border-b border-gray-200 mb-6">
      <div class="tab active">Overview</div>
      <div class="tab">Applications</div>
      <div class="tab">Information Products</div>
      <div class="tab">Analytics</div>
      <div class="tab">Modules</div>
    </div>

    <!-- Main Content Sections -->
    <div class="grid grid-cols-3 gap-6">
      <!-- Applications Overview -->
      <div class="col-span-2 bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-4">
          <div>
            <h2 class="text-xl font-bold">Applications Overview</h2>
            <p class="text-gray-500 text-sm">Application submissions over the past 30 days</p>
          </div>
          <button class="flex items-center space-x-1 px-3 py-1.5 border border-gray-200 rounded-md text-sm">
            <i data-lucide="filter" class="w-4 h-4"></i>
            <span>Filter</span>
          </button>
        </div>

        <!-- Chart Placeholder -->
        <div class="h-64 bg-gray-50 rounded-md flex items-center justify-center">
          <div class="text-center">
            <i data-lucide="bar-chart-2" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
            <p class="text-gray-400">Chart visualization would appear here</p>
          </div>
        </div>
      </div>

      <!-- Upcoming Appointments -->
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-bold">Upcoming Appointments</h2>
          <a href="#" class="text-blue-500 text-sm">View All</a>
        </div>
        <p class="text-gray-500 text-sm mb-4">Your schedule for today</p>

        <!-- Appointment 1 -->
        <div class="border border-gray-100 rounded-md p-4 mb-3">
          <div class="flex items-start">
            <div class="bg-gray-100 p-2 rounded-md mr-3">
              <i data-lucide="calendar" class="w-5 h-5 text-gray-500"></i>
            </div>
            <div>
              <div class="font-medium">Property Inspection</div>
              <div class="text-sm text-gray-500 flex items-center mt-1">
                <i data-lucide="clock" class="w-3.5 h-3.5 mr-1"></i>
                10:00 AM with John Smith
              </div>
              <div class="text-sm text-gray-500 flex items-center mt-1">
                <i data-lucide="map-pin" class="w-3.5 h-3.5 mr-1"></i>
                Riverside Apartments
              </div>
              <span class="inline-block mt-2 px-2 py-0.5 bg-gray-800 text-white text-xs rounded-full">
                Upcoming
              </span>
            </div>
          </div>
        </div>

        <!-- Appointment 2 -->
        <div class="border border-gray-100 rounded-md p-4 mb-3">
          <div class="flex items-start">
            <div class="bg-gray-100 p-2 rounded-md mr-3">
              <i data-lucide="file-check" class="w-5 h-5 text-gray-500"></i>
            </div>
            <div>
              <div class="font-medium">Document Verification</div>
              <div class="text-sm text-gray-500 flex items-center mt-1">
                <i data-lucide="clock" class="w-3.5 h-3.5 mr-1"></i>
                11:30 AM with Sarah Johnson
              </div>
              <div class="text-sm text-gray-500 flex items-center mt-1">
                <i data-lucide="map-pin" class="w-3.5 h-3.5 mr-1"></i>
                KLAS Office
              </div>
              <span class="inline-block mt-2 px-2 py-0.5 bg-gray-800 text-white text-xs rounded-full">
                Upcoming
              </span>
            </div>
          </div>
        </div>

        <!-- Appointment 3 -->
        <div class="border border-gray-100 rounded-md p-4">
          <div class="flex items-start">
            <div class="bg-gray-100 p-2 rounded-md mr-3">
              <i data-lucide="file-signature" class="w-5 h-5 text-gray-500"></i>
            </div>
            <div>
              <div class="font-medium">Title Deed Handover</div>
              <div class="text-sm text-gray-500 flex items-center mt-1">
                <i data-lucide="clock" class="w-3.5 h-3.5 mr-1"></i>
                1:00 PM with Michael Brown
              </div>
              <div class="text-sm text-gray-500 flex items-center mt-1">
                <i data-lucide="map-pin" class="w-3.5 h-3.5 mr-1"></i>
                Central Plaza
              </div>
              <span class="inline-block mt-2 px-2 py-0.5 bg-green-600 text-white text-xs rounded-full">
                Confirmed
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Second Row -->
    <div class="grid grid-cols-3 gap-6 mt-6">
      <!-- Recent Activities -->
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="mb-4">
          <h2 class="text-xl font-bold">Recent Activities</h2>
          <p class="text-gray-500 text-sm">Latest system activities</p>
        </div>

        <!-- Activity 1 -->
        <div class="mb-4">
          <div class="flex items-start">
            <div class="mr-3 text-gray-400">
              <i data-lucide="file-plus" class="w-5 h-5"></i>
            </div>
            <div class="flex-1">
              <div class="font-medium">New application submitted</div>
              <div class="text-sm text-gray-500">John Smith • 10 minutes ago</div>
            </div>
            <div class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
              Sectional Titling
            </div>
          </div>
        </div>

        <!-- Activity 2 -->
        <div class="mb-4">
          <div class="flex items-start">
            <div class="mr-3 text-gray-400">
              <i data-lucide="check-circle" class="w-5 h-5"></i>
            </div>
            <div class="flex-1">
              <div class="font-medium">Document approved</div>
              <div class="text-sm text-gray-500">Admin User • 30 minutes ago</div>
            </div>
            <div class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
              Certificate of Occupancy
            </div>
          </div>
        </div>

        <!-- Activity 3 -->
        <div class="mb-4">
          <div class="flex items-start">
            <div class="mr-3 text-gray-400">
              <i data-lucide="user-plus" class="w-5 h-5"></i>
            </div>
            <div class="flex-1">
              <div class="font-medium">User account created</div>
              <div class="text-sm text-gray-500">System • 1 hour ago</div>
            </div>
            <div class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
              System Admin
            </div>
          </div>
        </div>

        <!-- Activity 4 -->
        <div>
          <div class="flex items-start">
            <div class="mr-3 text-gray-400">
              <i data-lucide="upload" class="w-5 h-5"></i>
            </div>
            <div class="flex-1">
              <div class="font-medium">File uploaded</div>
              <div class="text-sm text-gray-500">Sarah Johnson • 2 hours ago</div>
            </div>
            <div class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
              File Digital Registry
            </div>
          </div>
        </div>
      </div>

      <!-- Module Usage -->
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="mb-6">
          <h2 class="text-xl font-bold">Module Usage</h2>
          <p class="text-gray-500 text-sm">Most active modules</p>
        </div>

        <!-- Module 1 -->
        <div class="mb-4">
          <div class="flex justify-between mb-1">
            <div class="flex items-center">
              <i data-lucide="layout-grid" class="w-4 h-4 mr-2 text-blue-500"></i>
              <span>Sectional Titling</span>
            </div>
            <span class="font-medium">42%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-bar-fill" style="width: 42%"></div>
          </div>
        </div>

        <!-- Module 2 -->
        <div class="mb-4">
          <div class="flex justify-between mb-1">
            <div class="flex items-center">
              <i data-lucide="repeat" class="w-4 h-4 mr-2 text-blue-500"></i>
              <span>Recertification</span>
            </div>
            <span class="font-medium">28%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-bar-fill" style="width: 28%"></div>
          </div>
        </div>

        <!-- Module 3 -->
        <div class="mb-4">
          <div class="flex justify-between mb-1">
            <div class="flex items-center">
              <i data-lucide="folder" class="w-4 h-4 mr-2 text-blue-500"></i>
              <span>File Digital Registry</span>
            </div>
            <span class="font-medium">15%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-bar-fill" style="width: 15%"></div>
          </div>
        </div>

        <!-- Module 4 -->
        <div>
          <div class="flex justify-between mb-1">
            <div class="flex items-center">
              <i data-lucide="users" class="w-4 h-4 mr-2 text-blue-500"></i>
              <span>Customer Management</span>
            </div>
            <span class="font-medium">15%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-bar-fill" style="width: 15%"></div>
          </div>
        </div>
      </div>

      <!-- Quick Stats -->
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="mb-6">
          <h2 class="text-xl font-bold">Quick Stats</h2>
          <p class="text-gray-500 text-sm">System performance</p>
        </div>

        <!-- Stat 1 -->
        <div class="mb-4">
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
              </div>
              <div>
                <div class="font-medium">Approved Applications</div>
              </div>
            </div>
            <div class="text-right">
              <div class="font-bold text-xl">432</div>
              <div class="text-green-500 text-sm">+12%</div>
            </div>
          </div>
        </div>

        <!-- Stat 2 -->
        <div class="mb-4">
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center mr-3">
                <i data-lucide="x" class="w-4 h-4 text-red-500"></i>
              </div>
              <div>
                <div class="font-medium">Rejected Applications</div>
              </div>
            </div>
            <div class="text-right">
              <div class="font-bold text-xl">67</div>
              <div class="text-red-500 text-sm">-5%</div>
            </div>
          </div>
        </div>

        <!-- Stat 3 -->
        <div class="mb-4">
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                <i data-lucide="clock" class="w-4 h-4 text-yellow-500"></i>
              </div>
              <div>
                <div class="font-medium">Average Processing Time</div>
              </div>
            </div>
            <div class="text-right">
              <div class="font-bold text-xl">3.2</div>
              <div class="text-red-500 text-sm">-0.5 days</div>
            </div>
          </div>
        </div>

        <!-- Stat 4 -->
        <div>
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                <i data-lucide="thumbs-up" class="w-4 h-4 text-blue-500"></i>
              </div>
              <div>
                <div class="font-medium">User Satisfaction</div>
              </div>
            </div>
            <div class="text-right">
              <div class="font-bold text-xl">92%</div>
              <div class="text-green-500 text-sm">+4%</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/dashboard/index.blade.php ENDPATH**/ ?>