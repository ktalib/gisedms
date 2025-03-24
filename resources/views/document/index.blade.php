@extends('layouts.app')
@section('page-title')
    {{ __('Document') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#">{{ __('Document') }}</a>
    </li>
@endsection
{{-- @section('card-action-btn')

@endsection --}}
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>
                                {{ __('Document') }}
                            </h5>
                        </div>
                        @if (Gate::check('create document'))
                            <div class="col-auto">
                                <a class="btn btn-secondary customModal" href="#" data-size="md"
                                    data-url="{{ route('document.create') }}" data-title="{{ __('Create Document') }}">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>{{ __('Create Document') }}</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Sub Category') }}</th>
                                    <th>{{ __('Tags') }}</th>
                                    <th>{{ __('Created By') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    @if (Gate::check('edit document') || Gate::check('delete document') || Gate::check('show document'))
                                        <th class="text-right">{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $document)
                                    <tr role="row">
                                        <td>{{ $document->name }}</td>
                                        <td>
                                            {{ !empty($document->category) ? $document->category->title : '-' }}
                                        </td>
                                        <td>
                                            {{ !empty($document->subCategory) ? $document->subCategory->title : '-' }}
                                        </td>
                                        <td>
                                            @foreach ($document->tags() as $tag)
                                                {{ $tag->title }} <br>
                                            @endforeach
                                        </td>
                                        <td>{{ !empty($document->createdBy) ? $document->createdBy->name : '' }}</td>
                                        <td>{{ dateFormat($document->created_at) }}</td>
                                        @if (Gate::check('edit document') || Gate::check('delete document') || Gate::check('show document'))
                                            <td class="text-right">
                                                <div class="cart-action">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['document.destroy', $document->id]]) !!}
                                                    @if (Gate::check('show document'))
                                                        <a class="avtar avtar-xs btn-link-warning text-warning"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Show Details') }}"
                                                            href="{{ route('document.show', \Illuminate\Support\Facades\Crypt::encrypt($document->id)) }}">
                                                            <i data-feather="eye"></i></a>
                                                    @endif
                                                    @if (Gate::check('edit document'))
                                                        <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Edit') }}" href="#"
                                                            data-url="{{ route('document.edit', $document->id) }}"
                                                            data-title="{{ __('Edit Support') }}"> <i
                                                                data-feather="edit"></i></a>
                                                    @endif
                                                    @if (Gate::check('delete document'))
                                                        <a class=" avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                            data-bs-toggle="tooltip"
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
