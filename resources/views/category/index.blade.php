@extends('layouts.app')
@section('page-title')
    {{ __('Category') }}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ __('Category') }}</a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if (Gate::check('create category'))
        <a class="btn btn-secondary btn-sm ml-20 customModal" href="#" data-size="md"
            data-url="{{ route('category.create') }}" data-title="{{ __('Create Category') }}"> <i
                class="ti-plus mr-5"></i>{{ __('Create Category') }}</a>
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
                                {{ __('Category') }}
                            </h5>
                        </div>
                        @if (Gate::check('create category'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('category.create') }}" data-title="{{ __('Create Category') }} ">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Category') }}
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
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    @if (Gate::check('edit category') || Gate::check('delete category'))
                                        <th class="text-right">{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr role="row">
                                        <td>
                                            {{ $category->title }}
                                        </td>
                                        <td>
                                            {{ $category->created_at }}
                                        </td>

                                        @if (Gate::check('edit category') || Gate::check('delete category'))
                                            <td class="text-right">
                                                <div class="cart-action">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $category->id]]) !!}

                                                    @if (Gate::check('edit category'))
                                                        <a class="avtar avtar-xs btn-link-secondary text-secondary customModal" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Edit') }}" href="#"
                                                            data-url="{{ route('category.edit', $category->id) }}"
                                                            data-title="{{ __('Edit Category') }}"> <i
                                                                data-feather="edit"></i></a>
                                                    @endif
                                                    @if (Gate::check('delete category'))
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
