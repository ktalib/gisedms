{{ Form::open(['route' => ['document.share', \Illuminate\Support\Facades\Crypt::encrypt($document->id)], 'method' => 'post']) }}
<div class="modal-body">

    <div class="row">
    {{ Form::hidden('document_id', $document->id, ['class' => 'form-control']) }}
    <div class="form-group col-md-12">
        {{ Form::label('assign_user', __('Assign Users'), ['class' => 'form-label']) }}
        {{ Form::select('assign_user[]', $users, null, ['class' => 'form-control hidesearch', 'multiple']) }}
    </div>
    <div class="form-group col-md-12">
        <div class="form-check custom-chek">
            <input class="form-check-input" type="checkbox" name="time_duration" value="1" id="time_duration">
            <label class="form-check-label" for="time_duration">{{ __('Time Duration') }} ? </label>
        </div>
    </div>
    <div class="col-md-12 time_duration d-none">
        <div class="row">
            <div class="form-group  col-md-6">
                {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                {{ Form::date('start_date', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group  col-md-6">
                {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                {{ Form::date('end_date', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="form-group  col-md-12 text-end">
        {{ Form::submit(__('Share'), ['class' => 'btn btn-secondary btn-rounded']) }}
    </div>
</div>
</div>
{{ Form::close() }}
<script>
    "use strict";
    $(document).on('click', '#time_duration', function() {
        if ($("#time_duration").is(':checked'))
            $(".time_duration").removeClass('d-none');
        else
            $(".time_duration").addClass('d-none');
    });
</script>
