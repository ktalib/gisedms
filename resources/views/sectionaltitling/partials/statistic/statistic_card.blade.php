@php
  
      
  $PrimaryApplicationCount = DB::connection('sqlsrv')->table('dbo.mother_applications')->count();
        $SecondaryApplicationCount = DB::connection('sqlsrv')->table('dbo.subapplications')->count();

        $PendingPrimaryApplications = DB::connection('sqlsrv')->table('dbo.mother_applications')
                ->where('application_status', 'Pending')
                ->count();

        $PendingSecondaryApplications = DB::connection('sqlsrv')->table('dbo.subapplications')
                ->where('application_status', 'Pending')
                ->count();

        $TotalPendingApplications = $PendingPrimaryApplications + $PendingSecondaryApplications;
@endphp
<div class="grid grid-cols-5 gap-4 mb-8">
    <div class="stat-card">
      <div class="flex items-start mb-2">
        <div>
          <h3 class="text-gray-700 font-medium">Primary Applications</h3>
          <p class="text-xs text-gray-500 mt-1">Total Primary applications</p>
        </div>
        <i data-lucide="file-text" class="ml-auto text-gray-500 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold">{{$PrimaryApplicationCount}}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="arrow-up" class="text-green-500 w-4 h-4 mr-1"></i>
        <span class="text-green-500">+8% from last month</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="flex items-start mb-2">
        <div>
          <h3 class="text-gray-700 font-medium">Unit Applications</h3>
          <p class="text-xs text-gray-500 mt-1">Total unit applications</p>
        </div>
        <i data-lucide="home" class="ml-auto text-gray-500 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold">{{$SecondaryApplicationCount}}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="arrow-up" class="text-green-500 w-4 h-4 mr-1"></i>
        <span class="text-green-500">+12% from last month</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="flex items-start mb-2">
        <div>
          <h3 class="text-gray-700 font-medium">Certificates Issued</h3>
          <p class="text-xs text-gray-500 mt-1">Total CofO issued</p>
        </div>
        <i data-lucide="file-check" class="ml-auto text-gray-500 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold">156</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="arrow-up" class="text-green-500 w-4 h-4 mr-1"></i>
        <span class="text-green-500">+15% from last month</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="flex items-start mb-2">
        <div>
          <h3 class="text-gray-700 font-medium">Pending Applications</h3>
          <p class="text-xs text-gray-500 mt-1">Applications awaiting action</p>
        </div>
        <i data-lucide="clock" class="ml-auto text-gray-500 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold">{{$TotalPendingApplications}}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="arrow-down" class="text-red-500 w-4 h-4 mr-1"></i>
        <span class="text-red-500">-5% from last month</span>
      </div>
    </div>
   
    <div class="stat-card bg-green-50 border-green-100">
      <div class="flex flex-col items-center justify-center h-full">
        <a href="{{ route('map.index') }}">
        <h3 class="text-green-700 font-medium text-center">Kano State</h3>
        <h3 class="text-green-700 font-medium text-center">GIS Mapping</h3>
        <i data-lucide="map" class="text-green-500 w-10 h-10 my-2"></i>
      </a>
      </div>
    </div>

  </div>