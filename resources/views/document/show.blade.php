@extends('layouts.app')
@section('page-title')
    {{ __('Document Details') }}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('document.index') }}">{{ __('Document') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ __('Details') }}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('document.main')
                        <div class="col-lg-9">
                            <div class="email-body">
                                <div class="card">
                                    <div class="">
                                        <div class="row align-items-center g-2">
                                            <div class="col">
                                                <h5>{{ __('Basic Details') }}</h5>
                                            </div>
                                            <div class="col-auto">
                                                @if (Gate::check('edit document'))
                                                    <a class="btn btn-secondary" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Preview') }}"
                                                        href="{{ !empty($latestVersion->document) ? asset(Storage::url('upload/document/')) . '/' . $latestVersion->document : '#' }}"
                                                        target="_blank"><i data-feather="maximize"> </i></a>
                                                @endif
                                                @if (Gate::check('download document'))
                                                    <a class="btn btn-secondary" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Download') }}"
                                                        href="{{ !empty($latestVersion->document) ? asset(Storage::url('upload/document/')) . '/' . $latestVersion->document : '#' }}"><i
                                                            data-feather="download"> </i></a>
                                                @endif
                                                @if (Gate::check('preview document'))
                                                    <a class="btn btn-secondary customModal" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Edit') }}" href="#"
                                                        data-url="{{ route('document.edit', $document->id) }}"
                                                        data-title="{{ __('Edit Support') }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-muted py-1">{{ __('Document Name') }}</td>
                                                            <td class="py-1">{{ $document->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted py-1">{{ __('Category') }}</td>
                                                            <td class="py-1">
                                                                {{ !empty($document->category) ? $document->category->title : '-' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted py-1">{{ __('Sub Category') }}</td>
                                                            <td class="py-1">
                                                                {{ !empty($document->subCategory) ? $document->subCategory->title : '-' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted py-1">{{ __('Created By') }}</td>
                                                            <td class="py-1">
                                                                {{ !empty($document->createdBy) ? $document->createdBy->name : '' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted py-1">{{ __('Created At') }}</td>
                                                            <td class="py-1">{{ dateFormat($document->created_at) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted py-1">{{ __('Tags') }}</td>
                                                            <td class="py-1">
                                                                @foreach ($document->tags() as $tag)
                                                                    {{ $tag->title }},
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted py-1">{{ __('Description') }}</td>
                                                            <td class="py-1">{{ $document->description }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
