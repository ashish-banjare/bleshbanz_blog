@extends('back.layout')

@section('main')

    <form method="post" action="{{ route('categories.store') }}">
        {{ csrf_field() }}

        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                	<div class="box-body">
                		<div class="col-md-12">
                			<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                				<label for="title">@lang('Title')</label>
	                            <input type="text" class="form-control" id="title" name="title" value="{{ isset($category) ? $category->title : '' }}">
	                            {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
                			</div>
                		</div>
                	</div>
                </div>
                <div class="box box-primary">
                	<div class="box-body">
                		<div class="col-md-12">
                			<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                				<label for="slug">@lang('Slug')</label>
	                            <input type="text" class="form-control" id="slug" name="slug" value="{{ isset($category) ? $category->slug : '' }}">
	                            {!! $errors->first('slug', '<small class="help-block">:message</small>') !!}
                			</div>
                		</div>
                	</div>
                </div>
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>
            </div>

        </div>
        <!-- /.row -->
    </form>

@endsection

@section('js')

    <script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
    <script>

        $('#slug').keyup(function () {
            $(this).val(v.slugify($(this).val()))
        })

        $('#title').keyup(function () {
            $('#slug').val(v.slugify($(this).val()))
        })

    </script>

@endsection