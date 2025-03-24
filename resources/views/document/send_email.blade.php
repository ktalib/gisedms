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

                                        <div class="row align-items-center g-2">
                                            <div class="col">
                                                <h5>{{ __('Send Email') }}</h5>
                                            </div>
                                        </div>
                                        {{ Form::open(['route' => ['document.send.email', \Illuminate\Support\Facades\Crypt::encrypt($document->id)], 'method' => 'post']) }}
                                        {{ Form::hidden('document_id', $document->id, ['class' => 'form-control']) }}
                                        <div class="row">
                                            <div class="form-group  col-md-12">
                                                {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
                                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter email')]) }}
                                            </div>
                                            <div class="form-group  col-md-12">
                                                {{ Form::label('subject', __('Subject'), ['class' => 'form-label']) }}
                                                {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => __('Enter subject')]) }}
                                            </div>
                                            <div class="form-group  col-md-12">
                                                {{ Form::label('message', __('Message'), ['class' => 'form-label']) }}
                                                {{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => __('Enter message'), 'rows' => 10]) }}
                                            </div>
                                            @if (Gate::check('send mail'))
                                                <div class="form-group  col-md-12 text-end">
                                                    {{ Form::submit(__('Send'), ['class' => 'btn btn-secondary btn-rounded']) }}
                                                </div>
                                            @endif
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
@endsection
