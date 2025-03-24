@php
    $admin_logo = getSettingsValByName('company_logo');
    $ids = parentId();
    $authUser = \App\Models\User::find($ids);
    $subscription = \App\Models\Subscription::find($authUser->subscription);
    $routeName = \Request::route()->getName();
    $pricing_feature_settings = getSettingsValByIdName(1, 'pricing_feature');
@endphp
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <img src="{{ asset(Storage::url('upload/logo/')) . '/' . (isset($admin_logo) && !empty($admin_logo) ? $admin_logo : 'logo.png') }}"
                    alt="" class="logo logo-lg" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>{{ __('Home') }}</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item {{ in_array($routeName, ['dashboard', 'home', '']) ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                @if (\Auth::user()->type == 'super admin')
                    @if (Gate::check('manage user'))
                        <li class="pc-item {{ in_array($routeName, ['users.index', 'users.show']) ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                                <span class="pc-mtext">{{ __('Customers') }}</span>
                            </a>
                        </li>
                    @endif
                @else
                    @if (Gate::check('manage user') || Gate::check('manage role') || Gate::check('manage logged history'))
                        <li
                            class="pc-item pc-hasmenu {{ in_array($routeName, ['users.index', 'logged.history', 'role.index', 'role.create', 'role.edit']) ? 'pc-trigger active' : '' }}">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="pc-mtext">{{ __('Staff Management') }}</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: {{ in_array($routeName, ['users.index', 'logged.history', 'role.index', 'role.create', 'role.edit']) ? 'block' : 'none' }}">
                                @if (Gate::check('manage user'))
                                    <li class="pc-item {{ in_array($routeName, ['users.index']) ? 'active' : '' }}">
                                        <a class="pc-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage role'))
                                    <li
                                        class="pc-item  {{ in_array($routeName, ['role.index', 'role.create', 'role.edit']) ? 'active' : '' }}">
                                        <a class="pc-link" href="{{ route('role.index') }}">{{ __('Roles') }} </a>
                                    </li>
                                @endif
                                @if ($pricing_feature_settings == 'off' || $subscription->enabled_logged_history == 1)
                                    @if (Gate::check('manage logged history'))
                                        <li
                                            class="pc-item  {{ in_array($routeName, ['logged.history']) ? 'active' : '' }}">
                                            <a class="pc-link"
                                                href="{{ route('logged.history') }}">{{ __('Logged History') }}</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </li>
                    @endif
                @endif
                @if (Gate::check('manage document') ||
                        Gate::check('manage my document') ||
                        Gate::check('manage reminder') ||
                        Gate::check('manage my reminder') ||
                        Gate::check('manage document history') ||
                        Gate::check('manage logged history') ||
                        Gate::check('manage support') ||
                        Gate::check('manage contact') ||
                        Gate::check('manage note'))
                    <li class="pc-item pc-caption">
                        <label>{{ __('Business Management') }}</label>
                        <i class="ti ti-chart-arcs"></i>
                    </li>
                    @if (Gate::check('manage document'))
                        <li
                            class="pc-item {{ Request::route()->getName() == 'document.index' || Request::route()->getName() == 'document.show' || Request::route()->getName() == 'document.comment' || Request::route()->getName() == 'document.reminder' || Request::route()->getName() == 'document.version.history' || Request::route()->getName() == 'document.share' || Request::route()->getName() == 'document.send.email' ? 'active' : '' }}">
                            <a href="{{ route('document.index') }}" class="pc-link">
                                <span class="pc-micon"><i data-feather="file-text"></i></span>
                                <span class="pc-mtext">{{ __('All Documents') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage my document'))
                        <li
                            class="pc-item {{ Request::route()->getName() == 'document.my-document' ? 'active' : '' }}">
                            <a href="{{ route('document.my-document') }}" class="pc-link">
                                <span class="pc-micon"><i data-feather="file"></i></span>
                                <span class="pc-mtext">{{ __('My Documents') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage reminder'))
                        <li class="pc-item {{ Request::route()->getName() == 'reminder.index' ? 'active' : '' }}">
                            <a href="{{ route('reminder.index') }}" class="pc-link">
                                <span class="pc-micon"><i data-feather="cpu"></i></span>
                                <span class="pc-mtext">{{ __('All Reminders') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage my reminder'))
                        <li class="pc-item {{ Request::route()->getName() == 'my-reminder' ? 'active' : '' }}">
                            <a href="{{ route('my-reminder') }}" class="pc-link">
                                <span class="pc-micon"><i data-feather="aperture"></i></span>
                                <span class="pc-mtext">{{ __('My Reminders') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage document history') && !empty($subscription) && $subscription->enabled_document_history == 1)
                        <li class="pc-item {{ Request::route()->getName() == 'document.history' ? 'active' : '' }}">
                            <a href="{{ route('document.history') }}" class="pc-link">
                                <span class="pc-micon"><i data-feather="wind"></i></span>
                                <span class="pc-mtext">{{ __('Document History') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage contact'))
                        <li class="pc-item {{ in_array($routeName, ['contact.index']) ? 'active' : '' }}">
                            <a href="{{ route('contact.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-phone-call"></i></span>
                                <span class="pc-mtext">{{ __('Contact Diary') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage note'))
                        <li class="pc-item {{ in_array($routeName, ['note.index']) ? 'active' : '' }} ">
                            <a href="{{ route('note.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-notebook"></i></span>
                                <span class="pc-mtext">{{ __('Notice Board') }}</span>
                            </a>
                        </li>
                    @endif
                @endif


                @if (Gate::check('manage category') ||
                        Gate::check('manage sub category') ||
                        Gate::check('manage tag') ||
                        Gate::check('manage notification'))
                    <li class="pc-item pc-caption">
                        <label>{{ __('System Configuration') }}</label>
                        <i class="ti ti-chart-arcs"></i>
                    </li>
                    @if (Gate::check('manage category'))
                        <li class="pc-item {{ Request::route()->getName() == 'category.index' ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}" class="pc-link">
                                <span class="pc-micon"><i data-feather="list"></i></span>
                                <span class="pc-mtext">{{ __('Category') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage sub category'))
                        <li class="pc-item {{ Request::route()->getName() == 'sub-category.index' ? 'active' : '' }}">
                            <a href="{{ route('sub-category.index') }}" class="pc-link">
                                <span class="pc-micon"><i data-feather="sliders"></i></span>
                                <span class="pc-mtext">{{ __('Sub Category') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage tag'))
                        <li class="pc-item {{ Request::route()->getName() == 'tag.index' ? 'active' : '' }}">
                            <a href="{{ route('tag.index') }}" class="pc-link">
                                <span class="pc-micon"><i data-feather="layers"></i></span>
                                <span class="pc-mtext">{{ __('Tags') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Gate::check('manage notification'))
                        <li class="pc-item {{ in_array($routeName, ['notification.index']) ? 'active' : '' }} ">
                            <a href="{{ route('notification.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-bell"></i></span>
                                <span class="pc-mtext">{{ __('Email Notification') }}</span>
                            </a>
                        </li>
                    @endif
                @endif


                @if (Gate::check('manage pricing packages') ||
                        Gate::check('manage pricing transation') ||
                        Gate::check('manage account settings') ||
                        Gate::check('manage password settings') ||
                        Gate::check('manage general settings') ||
                        Gate::check('manage email settings') ||
                        Gate::check('manage payment settings') ||
                        Gate::check('manage company settings') ||
                        Gate::check('manage seo settings') ||
                        Gate::check('manage google recaptcha settings'))
                    <li class="pc-item pc-caption">
                        <label>{{ __('System Settings') }}</label>
                        <i class="ti ti-chart-arcs"></i>
                    </li>

                    @if (Gate::check('manage FAQ') || Gate::check('manage Page'))
                        <li
                            class="pc-item pc-hasmenu {{ in_array($routeName, ['homepage.index', 'FAQ.index', 'pages.index', 'footerSetting']) ? 'active' : '' }}">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-layout-rows"></i>
                                </span>
                                <span class="pc-mtext">{{ __('CMS') }}</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: {{ in_array($routeName, ['homepage.index', 'FAQ.index', 'pages.index', 'footerSetting']) ? 'block' : 'none' }}">
                                @if (Gate::check('manage home page'))
                                    <li
                                        class="pc-item {{ in_array($routeName, ['homepage.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('homepage.index') }}"
                                            class="pc-link">{{ __('Home Page') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage Page'))
                                    <li class="pc-item {{ in_array($routeName, ['pages.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('pages.index') }}"
                                            class="pc-link">{{ __('Custom Page') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage FAQ'))
                                    <li class="pc-item {{ in_array($routeName, ['FAQ.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('FAQ.index') }}" class="pc-link">{{ __('FAQ') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage footer'))
                                    <li
                                        class="pc-item {{ in_array($routeName, ['footerSetting']) ? 'active' : '' }} ">
                                        <a href="{{ route('footerSetting') }}"
                                            class="pc-link">{{ __('Footer') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage footer'))
                                    <li
                                        class="pc-item {{ in_array($routeName, ['authPage.index']) ? 'active' : '' }} ">
                                        <a href="{{ route('authPage.index') }}"
                                            class="pc-link">{{ __('Auth Page') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->type == 'super admin' || $pricing_feature_settings == 'on')
                        @if (Gate::check('manage pricing packages') || Gate::check('manage pricing transation'))
                            <li
                                class="pc-item pc-hasmenu {{ in_array($routeName, ['subscriptions.index', 'subscriptions.show', 'subscription.transaction']) ? 'active' : '' }}">
                                <a href="#!" class="pc-link">
                                    <span class="pc-micon">
                                        <i class="ti ti-package"></i>
                                    </span>
                                    <span class="pc-mtext">{{ __('Pricing') }}</span>
                                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                                </a>
                                <ul class="pc-submenu"
                                    style="display: {{ in_array($routeName, ['subscriptions.index', 'subscriptions.show', 'subscription.transaction']) ? 'block' : 'none' }}">
                                    @if (Gate::check('manage pricing packages'))
                                        <li
                                            class="pc-item {{ in_array($routeName, ['subscriptions.index', 'subscriptions.show']) ? 'active' : '' }}">
                                            <a class="pc-link"
                                                href="{{ route('subscriptions.index') }}">{{ __('Packages') }}</a>
                                        </li>
                                    @endif
                                    @if (Gate::check('manage pricing transation'))
                                        <li
                                            class="pc-item {{ in_array($routeName, ['subscription.transaction']) ? 'active' : '' }}">
                                            <a class="pc-link"
                                                href="{{ route('subscription.transaction') }}">{{ __('Transactions') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif
                    @if (Gate::check('manage coupon') || Gate::check('manage coupon history'))
                        <li
                            class="pc-item pc-hasmenu {{ in_array($routeName, ['coupons.index', 'coupons.history']) ? 'active' : '' }}">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-shopping-cart-discount"></i>
                                </span>
                                <span class="pc-mtext">{{ __('Coupons') }}</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu"
                                style="display: {{ in_array($routeName, ['coupons.index', 'coupons.history']) ? 'block' : 'none' }}">
                                @if (Gate::check('manage coupon'))
                                    <li class="pc-item {{ in_array($routeName, ['coupons.index']) ? 'active' : '' }}">
                                        <a class="pc-link"
                                            href="{{ route('coupons.index') }}">{{ __('All Coupon') }}</a>
                                    </li>
                                @endif
                                @if (Gate::check('manage coupon history'))
                                    <li
                                        class="pc-item {{ in_array($routeName, ['coupons.history']) ? 'active' : '' }}">
                                        <a class="pc-link"
                                            href="{{ route('coupons.history') }}">{{ __('Coupon History') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (Gate::check('manage account settings') ||
                            Gate::check('manage password settings') ||
                            Gate::check('manage general settings') ||
                            Gate::check('manage email settings') ||
                            Gate::check('manage payment settings') ||
                            Gate::check('manage company settings') ||
                            Gate::check('manage seo settings') ||
                            Gate::check('manage google recaptcha settings'))
                        <li class="pc-item {{ in_array($routeName, ['setting.index']) ? 'active' : '' }} ">
                            <a href="{{ route('setting.index') }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-settings"></i></span>
                                <span class="pc-mtext">{{ __('Settings') }}</span>
                            </a>
                        </li>
                    @endif

                @endif
            </ul>
            <div class="w-100 text-center">
                <div class="badge theme-version badge rounded-pill bg-light text-dark f-12"></div>
            </div>
        </div>
    </div>
</nav>
