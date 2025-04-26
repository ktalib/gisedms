@extends('layouts.app')

@section('page-title')
    {{ $pageTitle ?? __('Data View') }}
@endsection

@section('styles')
<style>
  
</style>
@endsection

@section('content')
<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
  
    </div>
    
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>
@endsection

@section('scripts')

@endsection


