@php
    $routeName = \Request::route()->getName();
@endphp
<div class="col-lg-3">

    <ul class="nav flex-column nav-tabs account-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ empty($routeName) || $routeName == 'document.show' ? ' active ' : '' }}"
                href="{{ route('document.show', \Illuminate\Support\Facades\Crypt::encrypt($document->id)) }}"
                aria-selected="true">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i data-feather="list"></i>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h5 class="mb-0">{{ __('Basic Details') }}</h5>
                    </div>
                </div>
            </a>
        </li>
        @if (Gate::check('manage comment'))
            <li class="nav-item">
                <a class="nav-link {{ empty($routeName) || $routeName == 'document.comment' ? ' active ' : '' }}"
                    href="{{ route('document.comment', \Illuminate\Support\Facades\Crypt::encrypt($document->id)) }}"
                    aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i data-feather="message-circle"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="mb-0">{{ __('Comment') }}</h5>
                        </div>
                    </div>
                </a>
            </li>
        @endif
        @if (Gate::check('manage reminder'))
            <li class="nav-item">
                <a class="nav-link {{ empty($routeName) || $routeName == 'document.reminder' ? ' active ' : '' }}"
                    href="{{ route('document.reminder', \Illuminate\Support\Facades\Crypt::encrypt($document->id)) }}"
                    aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i data-feather="user-check"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="mb-0">{{ __('Reminder') }}</h5>
                        </div>
                    </div>
                </a>
            </li>
        @endif
        @if (Gate::check('manage version'))
            <li class="nav-item">
                <a class="nav-link {{ empty($routeName) || $routeName == 'document.version.history' ? ' active ' : '' }}"
                    href="{{ route('document.version.history', \Illuminate\Support\Facades\Crypt::encrypt($document->id)) }}"
                    aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i data-feather="briefcase"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="mb-0">{{ __('Version') }}</h5>
                        </div>
                    </div>
                </a>
            </li>
        @endif
        @if (Gate::check('manage share document'))
            <li class="nav-item">
                <a class="nav-link {{ empty($routeName) || $routeName == 'document.share' ? ' active ' : '' }}"
                    href="{{ route('document.share', \Illuminate\Support\Facades\Crypt::encrypt($document->id)) }}"
                    aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i data-feather="share-2"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="mb-0">{{ __('Share') }}</h5>
                        </div>
                    </div>
                </a>
            </li>
        @endif
        @if (Gate::check('manage mail'))
            <li class="nav-item">
                <a class="nav-link {{ empty($routeName) || $routeName == 'document.send.email' ? ' active ' : '' }}"
                    href="{{ route('document.send.email', \Illuminate\Support\Facades\Crypt::encrypt($document->id)) }}"
                    aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i data-feather="mail"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="mb-0">{{ __('Send Email') }}</h5>
                        </div>
                    </div>
                </a>
            </li>
        @endif

    </ul>
</div>
