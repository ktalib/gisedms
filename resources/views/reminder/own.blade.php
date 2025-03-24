@extends('layouts.app')
@section('page-title')
    {{ __('Reminder') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">
            {{ __('Dashboard') }}
        </a>
    </li>
    <li class="breadcrumb-item active">
        <a href="#">{{ __('Reminder') }}</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>
                                {{ __('Reminder') }}
                            </h5>
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Time') }}</th>
                                    <th>{{ __('Subject') }}</th>
                                    <th>{{ __('Created By') }}</th>
                                    <th>{{ __('Assigned') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
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

                                        <td>
                                            @foreach ($reminder->users() as $user)
                                                @if ($user)
                                                    {{-- Check if user is not null --}}
                                                    {{ $user->name }} <br>
                                                @endif
                                            @endforeach
                                        </td>


                                        @if (Gate::check('edit reminder') || Gate::check('delete reminder') || Gate::check('show reminder'))
                                            <td class="text-right">
                                                <div class="cart-action">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['reminder.destroy', $reminder->id]]) !!}
                                                    @if (Gate::check('show reminder'))
                                                        <a class="avtar avtar-xs btn-link-warning text-warning customModal" data-size="lg"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Show') }}" href="#"
                                                            data-url="{{ route('reminder.show', $reminder->id) }}"
                                                            data-title="{{ __('Details') }}"> <i
                                                                data-feather="eye"></i></a>
                                                    @endif

                                                    {!! Form::close() !!}
                                                </div>
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
@endsection
