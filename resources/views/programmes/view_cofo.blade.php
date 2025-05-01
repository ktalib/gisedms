@extends('layouts.app')

@section('page-title')
    {{ $pageTitle ?? __('Certificate of Occupancy') }}
@endsection

@section('styles')
    <!-- SweetAlert CSS if not already included -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<div id="mainContent" class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
        <!-- Flash Messages -->
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
        @endif
        
        @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p>{{ session('error') }}</p>
        </div>
        @endif
        
        @include('programmes.cofo_content')
    </div>
    
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const mainContent = document.getElementById('mainContent');
        
        if (urlParams.get('action') === 'generate') {
            // Hide content while loading
            mainContent.style.display = 'none';
            
            Swal.fire({
                title: 'Generate CofO...',
                text: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            setTimeout(() => {
                Swal.close();
                // Show content after loading
                mainContent.style.display = 'block';
            }, 2000);
        }
    });
</script>
@endsection
