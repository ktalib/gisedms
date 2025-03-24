<?php echo e(Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT'])); ?>

<div class="modal-body">
    <div class="row">
        <?php if(\Auth::user()->type != 'super admin'): ?>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('role', __('Assign Role'), ['class' => 'form-label'])); ?>

                <?php echo Form::select('role', $userRoles, !empty($user->roles) ? $user->roles[0]->id : null, [
                    'class' => 'form-control hidesearch ',
                    'required' => 'required',
                ]); ?>

            </div>
        <?php endif; ?>
        <?php if(\Auth::user()->type == 'super admin'): ?>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required'])); ?>

            </div>
        <?php else: ?>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('first_name', __('First Name'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => __('Enter First Name'), 'required' => 'required'])); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('last_name', __('Last Name'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required'])); ?>

            </div>
        <?php endif; ?>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Email'), 'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('phone_number', __('Phone Number'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => __('Enter Phone Number')])); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Update'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\wamp64\www\gisedms\resources\views/user/edit.blade.php ENDPATH**/ ?>