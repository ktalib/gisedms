@extends('layouts.app')
@section('page-title')
    {{ __('History') }}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ __('History') }}</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>
                                {{ __('History') }}
                            </h5>
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Document') }}</th>
                                    <th>{{ __('Action') }}</th>
                                    <th>{{ __('Action Time') }}</th>
                                    <th>{{ __('Action User') }}</th>
                                    <th>{{ __('Description') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $history)
                                    <tr role="row">
                                        <td> {{ !empty($history->documents) ? $history->documents->name : '-' }} </td>
                                        <td> {{ ucfirst($history->action) }} </td>
                                        <td>{{ dateFormat($history->created_at) }} {{ timeFormat($history->created_at) }}
                                        </td>
                                        <td> {{ !empty($history->actionUser) ? $history->actionUser->name : '-' }} </td>
                                        <td> {{ $history->description }} </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
