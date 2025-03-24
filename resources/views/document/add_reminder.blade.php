{{ Form::open(['url' => 'reminder', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        {{ Form::hidden('document_id', $document->id, ['class' => 'form-control']) }}
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

</div>
{{ Form::close() }}
