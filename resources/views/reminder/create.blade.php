{{Form::open(array('route'=>array('reminder.store'),'method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-6">
            {{Form::label('date',__('Date'),array('class'=>'form-label'))}}
            {{Form::date('date',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group  col-md-6">
            {{Form::label('time',__('Time'),array('class'=>'form-label'))}}
            {{Form::time('time',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('document_id',__('Document'),array('class'=>'form-label'))}}
            {{Form::select('document_id',$documents,null,array('class'=>'form-control hidesearch'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('assign_user',__('Assign Users'),array('class'=>'form-label'))}}
            {{Form::select('assign_user[]',$users,null,array('class'=>'form-control hidesearch','multiple'))}}
        </div>
        <div class="form-group  col-md-12">
            {{Form::label('subject',__('Subject'),array('class'=>'form-label'))}}
            {{Form::text('subject',null,array('class'=>'form-control','placeholder'=>__('Enter reminder subject')))}}
        </div>
        <div class="form-group  col-md-12">
            {{Form::label('message',__('Message'),array('class'=>'form-label'))}}
            {{Form::textarea('message',null,array('class'=>'form-control','placeholder'=>__('Enter reminder message'),'rows'=>2))}}
        </div>
        <div class="form-group  col-md-12 text-end">
            {{Form::submit(__('Create'),array('class'=>'btn btn-secondary btn-rounded'))}}
        </div>
    </div>
</div>
{{ Form::close() }}
