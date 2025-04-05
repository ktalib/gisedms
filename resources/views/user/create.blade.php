<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {{ Form::open(['url' => 'users', 'method' => 'post']) }}

        @php
            $assignRoles = DB::table('assign_roles')->select('id', 'role_name')->get()->pluck('role_name', 'role_name')->toArray();
        @endphp

        <div class="modal-body">
            <div class="row">
                @if (\Auth::user()->type != 'super admin')
                    <div class="col-md-8">
                        {{-- Inputs Section --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('role', __('Department'), ['class' => 'form-label']) }}
                                    {!! Form::select('role', $userRoles, null, ['class' => 'form-control hidesearch', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
                                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter email'), 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('password', __('Password'), ['class' => 'form-label']) }}
                                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter password'), 'required' => 'required', 'minlength' => '6']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('phone_number', __('Phone Number'), ['class' => 'form-label']) }}
                                    {{ Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => __('Enter phone number')]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{-- Roles Section --}}
                        <div class="form-group">
                            {{ Form::label('assign_role', __('Select role(s)'), ['class' => 'form-label']) }}
                            <div class="row">
                                @foreach ($assignRoles as $role)
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            {{ Form::checkbox('assign_role[]', $role, false, ['class' => 'form-check-input', 'id' => 'role_'.$role]) }}
                                            {{ Form::label('role_'.$role, $role, ['class' => 'form-check-label']) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="modal-footer">
            {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary ml-10']) }}
        </div>
        {{ Form::close() }}
    </div>
</div>



