@extends('layouts.app')
@section('page-title')
    {{ __('Document Details') }}
@endsection
@push('script-page')
    <script>
        "use strict";
        $(document).on('click', '#time_duration', function() {
            if ($("#time_duration").is(':checked'))
                $(".time_duration").removeClass('d-none');
            else
                $(".time_duration").addClass('d-none');
        });
    </script>
@endpush
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
                                    @if (Gate::check('create share document'))
                                            <div class="row align-items-center g-2">
                                                <div class="col">
                                                    <h5>{{ __('Share Document') }}</h5>
                                                </div>
                                                <div class="col-auto">
                                                    <a class="btn btn-secondary btn-sm ml-20 customModal" href="#"
                                                        data-size="lg"
                                                        data-url="{{ route('document.add.share', $document->id) }}"
                                                        data-title="{{ __('Share Document') }}"> <i
                                                            class="ti ti-plus mr-5"></i>{{ __('Share Document') }}</a>
                                                </div>
                                            </div>
                                    @endif
                                <div class="card">
                                    <div class="  pt-0">
                                        <div class="dt-responsive table-responsive">
                                            <table class="table table-hover advance-datatable">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('User Name') }}</th>
                                                        <th>{{ __('Email') }}</th>
                                                        <th>{{ __('Assign At') }}</th>
                                                        <th>{{ __('Start Date') }}</th>
                                                        <th>{{ __('End Date') }}</th>
                                                        @if (Gate::check('delete share document'))
                                                            <th>{{ __('Action') }}</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($shareDocuments as $shareDocument)
                                                        <tr role="row">
                                                            <td>{{ !empty($shareDocument->user) ? $shareDocument->user->name : '-' }}
                                                            </td>
                                                            <td>{{ !empty($shareDocument->user) ? $shareDocument->user->email : '-' }}
                                                            </td>
                                                            <td>{{ dateFormat($shareDocument->created_at) }}</td>
                                                            <td>{{ !empty($shareDocument->start_date) ? dateFormat($shareDocument->start_date) : '-' }}
                                                            </td>
                                                            <td>{{ !empty($shareDocument->end_date) ? dateFormat($shareDocument->end_date) : '-' }}
                                                            </td>
                                                            @if (Gate::check('delete share document'))
                                                                <td>
                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['document.share.destroy', $shareDocument->id]]) !!}
                                                                    <a class=" avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="{{ __('Detete') }}"
                                                                        href="#"> <i data-feather="trash-2"></i></a>
                                                                    {!! Form::close() !!}
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
