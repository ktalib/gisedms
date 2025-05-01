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

     @include('programmes.memo_content_primary')
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>



@endsection


