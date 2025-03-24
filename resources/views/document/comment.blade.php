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
                                @if (Gate::check('create comment'))
                                    <div class="row align-items-center g-2">
                                        <div class="col">
                                            <h5>{{ __('Comment') }}</h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{ Form::open(['route' => ['document.comment', \Illuminate\Support\Facades\Crypt::encrypt($document->id)], 'method' => 'post']) }}
                                        <div class="form-group">
                                            {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('Write a comment')]) }}
                                        </div>
                                        <div class="form-group col-md-12 text-end">
                                            {{ Form::submit(__('Add'), ['class' => 'btn btn-secondary']) }}
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                @endif
                                <div class="row">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($comments as $comment)
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col-md-3 mb-3 mb-md-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img class="img-radius img-fluid wid-40"
                                                                    src="{{ !empty($comment->user) ? asset(Storage::url('upload/profile/')) . '/' . $comment->user->profile : asset(Storage::url('upload/profile')) . '/avatar.png' }}"
                                                                    alt="User image">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h5 class="mb-1">
                                                                    {{ !empty($comment->user) ? $comment->user->name : '-' }}
                                                                    <i
                                                                        class="material-icons-two-tone text-success f-16">verified_user</i>
                                                                </h5>
                                                                <h6 class="text-muted mb-0">
                                                                    {{ !empty($comment) ? dateFormat($comment->created_at) : '-' }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 me-3">
                                                                {{-- <div class="star">
                                                                    <i class="fas fa-star text-warning"></i>
                                                                    <i class="fas fa-star text-warning"></i>
                                                                    <i class="fas fa-star text-warning"></i>
                                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                                    <i class="far fa-star text-muted"></i>
                                                                </div> --}}
                                                                <p class="mb-0 text-muted mt-2">
                                                                    {{ !empty($comment) ? $comment->comment : '-' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
