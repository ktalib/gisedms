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
                                @if (Gate::check('create version'))
                                            <div class="row align-items-center g-2">
                                                <div class="col">
                                                    <h5>{{ __('Version History') }}</h5>
                                                </div>

                                            </div>
                                            {{ Form::open(['route' => ['document.new.version', \Illuminate\Support\Facades\Crypt::encrypt($document->id)], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                            {{ Form::hidden('document_id', $document->id, ['class' => 'form-control']) }}
                                            <div class="row">
                                                <div class="form-group  col-md-12">
                                                    {{ Form::label('document', __('Document'), ['class' => 'form-label']) }}
                                                    {{ Form::file('document', ['class' => 'form-control']) }}
                                                </div>
                                                <div class="form-group  col-md-12 text-end">
                                                    {{ Form::submit(__('Upload'), ['class' => 'btn btn-secondary btn-rounded']) }}
                                                </div>
                                            </div>
                                            {{ Form::close() }}
                                @endif
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="dt-responsive table-responsive">
                                            <table class="table table-hover advance-datatable">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Uploaded At') }}</th>
                                                        <th>{{ __('Uploaded By') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                        @if (Gate::check('preview document') || Gate::check('download document'))
                                                            <th>{{ __('Action') }}</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($versions as $version)
                                                        <tr role="row">
                                                            <td>{{ dateFormat($version->created_at) }}
                                                                {{ timeFormat($version->created_at) }}</td>
                                                            <td>{{ !empty($version->createdBy) ? $version->createdBy->name : '-' }}
                                                            </td>
                                                            <td>
                                                                @if ($version->current_version == 1)
                                                                    <span
                                                                        class="d-inline badge text-bg-success">{{ __('Current Version') }}</span>
                                                                @else
                                                                    <span
                                                                        class="d-inline badge text-bg-warning">{{ __('Old Version') }}</span>
                                                                @endif
                                                            </td>
                                                            @if (Gate::check('preview document') || Gate::check('download document'))
                                                                <td>
                                                                    @if (Gate::check('preview document'))
                                                                        <a class="avtar avtar-xs btn-link-info text-info"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-original-title="{{ __('View') }}"
                                                                            href="{{ !empty($version->document) ? asset(Storage::url('upload/document/')) . '/' . $version->document : '#' }}"
                                                                            target="_blank"> <i
                                                                                data-feather="maximize"></i></a>
                                                                    @endif
                                                                    @if (Gate::check('download document'))
                                                                        <a class="avtar avtar-xs btn-link-primary text-primary"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-original-title="{{ __('Download') }}"
                                                                            href="{{ !empty($version->document) ? asset(Storage::url('upload/document/')) . '/' . $version->document : '#' }}"
                                                                            download=""> <i
                                                                                data-feather="download"></i></a>
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
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
