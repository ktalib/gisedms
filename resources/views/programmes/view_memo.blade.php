@extends('layouts.app')

@section('page-title')
    {{ $pageTitle ?? __('Data View') }}
@endsection

@section('styles')

@endsection

@section('content')
 

 
<div  id="mainContent" class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">

     @include('programmes.memo_content')
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const mainContent = document.getElementById('mainContent');
        
        if (urlParams.get('action') === 'generate') {
            // Hide content while loading
            mainContent.style.display = 'none';
            
            Swal.fire({
                title: 'Generate Memo...',
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
            }, 4000);
        }
    });
</script>


@endsection


