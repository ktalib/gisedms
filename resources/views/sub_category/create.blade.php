{{Form::open(array('url'=>'sub-category','method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            {{Form::label('title',__('Title'),array('class'=>'form-label'))}}
            {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter sub category title')))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('category_id',__('Category'),array('class'=>'form-label'))}}
            {{Form::select('category_id',$categories,null,array('class'=>'form-control hidesearch'))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{Form::submit(__('Create'),array('class'=>'btn btn-secondary btn-rounded'))}}
</div>
{{ Form::close() }}


