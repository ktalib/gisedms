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
                                @if (Gate::check('create reminder'))
                                    <div class="row align-items-center g-2">
                                        <div class="col">
                                            <h5>{{ __('Reminder') }}</h5>
                                        </div>
                                        <div class="col-auto">
                                            @if (Gate::check('create reminder'))
                                                <a class="btn btn-secondary btn-sm ml-20 customModal" href="#"
                                                    data-size="lg"
                                                    data-url="{{ route('document.add.reminder', $document->id) }}"
                                                    data-title="{{ __('Create Reminder') }}"> <i
                                                        class="ti ti-plus mr-5"></i>{{ __('Create Reminder') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="collapse" id="collapse1">
                                        {{ Form::open(['url' => 'reminder', 'method' => 'post']) }}
                                        {{ Form::hidden('document_id', $document->id, ['class' => 'form-control']) }}
                                        <div class="row">
                                            <div class="form-group  col-md-6">
                                                {{ Form::label('date', __('Date'), ['class' => 'form-label']) }}
                                                {{ Form::date('date', null, ['class' => 'form-control']) }}
                                            </div>
                                            <div class="form-group  col-md-6">
                                                {{ Form::label('time', __('Time'), ['class' => 'form-label']) }}
                                                {{ Form::time('time', null, ['class' => 'form-control']) }}
                                            </div>
                                            <div class="form-group col-md-6">
                                                {{ Form::label('assign_user', __('Assign Users'), ['class' => 'form-label']) }}
                                                {{ Form::select('assign_user[]', $users, null, ['class' => 'form-control hidesearch', 'multiple']) }}
                                            </div>
                                            <div class="form-group  col-md-6">
                                                {{ Form::label('subject', __('Subject'), ['class' => 'form-label']) }}
                                                {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => __('Enter reminder subject')]) }}
                                            </div>
                                            <div class="form-group  col-md-12">
                                                {{ Form::label('message', __('Message'), ['class' => 'form-label']) }}
                                                {{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => __('Enter reminder message'), 'rows' => 2]) }}
                                            </div>
                                            <div class="form-group  col-md-12 text-end">
                                                {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded']) }}
                                            </div>
                                        </div>

                                        {{ Form::close() }}
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="dt-responsive table-responsive">
                                            <table class="table table-hover advance-datatable">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Date') }}</th>
                                                        <th>{{ __('Time') }}</th>
                                                        <th>{{ __('Subject') }}</th>
                                                        <th>{{ __('Created By') }}</th>
                                                        @if (Gate::check('show reminder'))
                                                            <th>{{ __('Action') }}</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($reminders as $reminder)
                                                        <tr role="row">
                                                            <td>{{ dateFormat($reminder->date) }}</td>
                                                            <td>{{ timeFormat($reminder->time) }}</td>
                                                            <td> {{ $reminder->subject }} </td>
                                                            <td> {{ !empty($reminder->createdBy) ? $reminder->createdBy->name : '-' }}
                                                            </td>
                                                            @if (Gate::check('show reminder'))
                                                                <td>
                                                                    <a class="avtar avtar-xs btn-link-warning text-warning customModal"
                                                                        data-size="lg" data-bs-toggle="tooltip"
                                                                        data-bs-original-title="{{ __('Show') }}"
                                                                        href="#"
                                                                        data-url="{{ route('reminder.show', $reminder->id) }}"
                                                                        data-title="{{ __('Details') }}"> <i
                                                                            data-feather="eye"></i></a>
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
