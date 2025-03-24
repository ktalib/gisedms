@extends('layouts.app')
@section('page-title')
    {{ __('Tag') }}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ __('Tag') }}</a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if (Gate::check('create tag'))
        <a class="btn btn-secondary btn-sm ml-20 customModal" href="#" data-size="md" data-url="{{ route('tag.create') }}"
            data-title="{{ __('Create Tag') }}"> <i class="ti-plus mr-5"></i>{{ __('Create Tag') }}</a>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>
                                {{ __('Tag') }}
                            </h5>
                        </div>
                        @if (Gate::check('create tag'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('tag.create') }}" data-title="{{ __('Create Tag') }} ">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Tag') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Tag') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    @if (Gate::check('edit tag') || Gate::check('delete tag'))
                                        <th class="text-right">{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr role="row">
                                        <td>
                                            {{ $tag->title }}
                                        </td>
                                        <td>
                                            {{ dateFormat($tag->created_at) }} {{ timeFormat($tag->created_at) }}
                                        </td>

                                        @if (Gate::check('edit tag') || Gate::check('delete tag'))
                                            <td class="text-right">
                                                <div class="cart-action">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['tag.destroy', $tag->id]]) !!}

                                                    @if (Gate::check('edit tag'))
                                                        <a class="avtar avtar-xs btn-link-secondary text-secondary customModal" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Edit') }}" href="#"
                                                            data-url="{{ route('tag.edit', $tag->id) }}"
                                                            data-title="{{ __('Edit Tag') }}"> <i
                                                                data-feather="edit"></i></a>
                                                    @endif
                                                    @if (Gate::check('delete tag'))
                                                        <a class=" avtar avtar-xs btn-link-danger text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Detete') }}" href="#"> <i
                                                                data-feather="trash-2"></i></a>
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
