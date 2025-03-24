
{{Form::model($document, array('route' => array('document.update', $document->id), 'method' => 'PUT','enctype' => "multipart/form-data")) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            {{Form::label('name',__('Name'),array('class'=>'form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter document name')))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('category_id',__('Category'),array('class'=>'form-label'))}}
            {{Form::select('category_id',$category,null,array('class'=>'form-control hidesearch','id'=>'category'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('sub_category_id',__('Sub Category'),array('class'=>'form-label'))}}
            <div class="sc_div">
                <select class="form-control hidesearch sub_category_id" id="sub_category_id" name="sub_category_id">
                    <option value="">{{__('Select Sub Category')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-12">
            {{Form::label('tages',__('Tages'),array('class'=>'form-label'))}}
            {{Form::select('tages[]',$tages,explode(',',$document->tages),array('class'=>'form-control hidesearch','multiple'))}}
        </div>
        <div class="form-group  col-md-12">
            {{Form::label('description',__('Description'),array('class'=>'form-label'))}}
            {{Form::textarea('description',null,array('class'=>'form-control','rows'=>3))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{Form::submit(__('Update'),array('class'=>'btn btn-secondary btn-rounded'))}}
</div>
{{ Form::close() }}
<script>
    var url = "{{ route("category.sub-category", ":id") }}";
</script>
<script src="{{ asset('js/custom/document.js') }}"></script>

<script>
    $('#category').trigger('change');
</script>


