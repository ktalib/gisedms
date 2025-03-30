{{-- filepath: c:\wamp64\www\gisedms\resources\views\instruments\index.blade.php --}}
@extends('layouts.app')
@section('page-title')
    {{ __('Landuse Types') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Landuse Types') }}</li>
@endsection
@push('script-page')
    <script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>

    <script>
        if ($('#classic-editor').length > 0) {
            ClassicEditor.create(document.querySelector('#classic-editor')).catch((error) => {
                console.error(error);
            });
        }
        setTimeout(() => {
            feather.replace();
        }, 500);
    </script>
@endpush


<style>
    a {
       
    }
    
    </style>
@section('content')
   <br>
<div class="card rounded-lg shadow-lg bg-gray-50 border-gray-200">
     
    <div class="card-body">
        <div class="container mx-auto mt-8 p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('sectionaltitling.create') }}?landuse=Residential" class="transform transition-transform hover:scale-105">
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 hover:shadow-blue-200">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800 hover:text-blue-500 transition-colors duration-300">Residential</div>
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                    </div>
                </a>
        
                <a href="{{ route('sectionaltitling.create') }}?landuse=Commercial" class="transform transition-transform hover:scale-105">
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 hover:shadow-green-200">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800 hover:text-green-500 transition-colors duration-300">Commercial</div>
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                </a>
        
                <a href="#" class="transform transition-transform hover:scale-105">
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 hover:shadow-yellow-200">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800 hover:text-yellow-500 transition-colors duration-300">Industrial</div>
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
    </div>
</div>


  @endsection