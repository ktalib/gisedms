@extends('layouts.app')

@section('page-title')
    {{ $pageTitle ?? __('Data View') }}
@endsection

@section('styles')

@endsection

@section('content')
<style>

    .badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.25rem 0.5rem;
      border-radius: 0.25rem;
      font-size: 0.75rem;
      font-weight: 500;
    }
    .badge-approved {
      background-color: #d1fae5;
      color: #059669;
    }
    .badge-pending {
      background-color: #fef3c7;
      color: #d97706;
    }
    .badge-declined {
      background-color: #fee2e2;
      color: #dc2626;
    }
    .table-header {
      background-color: #f9fafb;
      font-weight: 500;
      color: rgb(13, 136, 13);
      text-align: left;
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #e5e7eb;
    }
    .table-cell {
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #e5e7eb;
    }
  </style>
<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
  <div class="tabs">
    <div class="flex justify-between items-center mb-6">
     
    <ul class="flex border-b">
      <li class="mr-1">
        <a class="bg-white inline-block py-2 px-4 text-blue-500 font-semibold" href="#primary-application">Primary Application</a>
      </li>
      <li class="mr-1">
        <a class="bg-white inline-block py-2 px-4 text-blue-500 font-semibold" href="#unit-application">Unit Application</a>
      </li>
      {{-- <li class="mr-1">
        <a class="bg-white inline-block py-2 px-4 text-blue-500 font-semibold" href="#initial-payment">Initial Payment</a>
      </li> --}}
    </ul>
    </div>
    <div id="primary-application" class="tab-content">
      @include('programmes.partials.report-primary')
    </div>
    <div id="unit-application" class="tab-content hidden">
     @include('programmes.partials.report-unit') 
    </div>
    <div id="initial-payment" class="tab-content hidden">
      @include('programmes.partials.report-initial-bill')
    </div>
  </div>
  <script>
    document.querySelectorAll('.tabs a').forEach(tab => {
      tab.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
        document.querySelectorAll('.tabs a').forEach(link => link.classList.remove('text-blue-500', 'font-semibold'));
        this.classList.add('text-blue-500', 'font-semibold');
        const target = this.getAttribute('href');
        document.querySelector(target).classList.remove('hidden');
        
        // Initialize DataTables when switching to initial payment tab
        if (target === '#initial-payment' && typeof $.fn.DataTable !== 'undefined') {
          if (!$.fn.DataTable.isDataTable('#primary-initial-payments-table')) {
            $('#primary-initial-payments-table').DataTable({
              responsive: true,
              pageLength: 10,
              dom: 'Bfrtip',
              buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
          }
          
          if (!$.fn.DataTable.isDataTable('#unit-initial-payments-table')) {
            $('#unit-initial-payments-table').DataTable({
              responsive: true,
              pageLength: 10,
              dom: 'Bfrtip',
              buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
          }
        }
      });
    });
  </script>


   
 
 
    </div>
    
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>
@endsection

@section('scripts')

@endsection


