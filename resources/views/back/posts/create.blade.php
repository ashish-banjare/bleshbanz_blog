@extends('back.layout')

@section('css')
    <style>
        textarea { resize: vertical; }
    </style>
    <link href="{{ asset('adminlte/plugins/colorbox/colorbox.css') }}" rel="stylesheet">
@endsection

@section('main')
		<form method="post" action="{{ route('posts.store') }}">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-8">
					@if(session('post-ok'))
						@component('back.components.alert')
							@slot('type')
								success
							@endslot
							{!! session('post-ok') !!}
						@endcomponent
					@endif

					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">{{__('Title')}}</h3>
							<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					            </button>
					        </div>
					        <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
								<label for="title">title</label>
								<input type="text" class="form-control" id="title" name="title" value="{{ old('title', isset($post) ? $post->title : '') }}">
								{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
							</div>
						</div>
						<!-- /.box-body -->
					</div>

					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">{{__('Excerpt')}}</h3>
							<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					            </button>
					        </div>
					        <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
								<label for="excerpt">excerpt</label>
								<textarea class="form-control" rows="3" id="excerpt" name="excerpt">{{ old('excerpt', isset($post) ? $post->excerpt : '') }}</textarea>
								{!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}
							</div>
						</div>
						<!-- /.box-body -->
					</div>

					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">{{__('Body')}}</h3>
							<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					            </button>
					        </div>
					        <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
								<label for="body">body</label>
								<textarea class="form-control" rows="6" id="body" name="body">{{ old('body', isset($post) ? $post->body : '') }}</textarea>
								{!! $errors->first('body', '<span class="help-block">:message</span>') !!}
							</div>
						</div>
						<!-- /.box-body -->
					</div>

					<button type="submit" class="btn btn-primary">@lang('Submit')</button>
				</div>

				<div class="col-md-4">
					@component('back.components.box')
	                    @slot('type')
	                        warning
	                    @endslot
	                    @slot('boxTitle')
	                        @lang('Categories')
	                    @endslot
	                    <div class="form-group {{ $errors->has('categories') ? 'has-error' : '' }}">
		                    <select multiple class="form-control" name="categories[]" id="categories">
					            @foreach($categories as $id => $title)
					            	<?php $input_values = isset($post) ? $post->categories : collect(); ?>
					                <option value="{{ $id }}" {{ old('categories') ? ( in_array( $id, old('categories') ) ? 'selected' : '') : ($input_values->contains('id', $id) ? 'selected' : '') }} >{{ $title }}</option>
					            @endforeach
					        </select>
				    	</div>
	                @endcomponent

	                @component('back.components.box')
	                	@slot('type')
	                		danger
	                	@endslot
	                	@slot('boxTitle')
	                		@lang('Tags')
	                	@endslot
	                	<div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
		                	<input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags', isset($post) ? implode(',', $post->tags->pluck('tag')->toArray()) : '') }}">
							{!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
						</div>
	                @endcomponent

	                @component('back.components.box')
	                	@slot('type')
	                		success
	                	@endslot
	                	@slot('boxTitle')
	                		@lang('Details')
	                	@endslot
	                	<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
		                	<label for="slug">{{ __('Slug') }}</label>
		                	<input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', isset($post) ? $post->slug : '') }}">
							{!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
	                	</div>
	                	<div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
		                	<label for="active">{{ __('Status') }}</label>
	            	        <div class="checkbox">
					            <label>
					                <input id="active" name="active" type="checkbox" {{ (isset($post) ? $post->active : false) ? 'checked' : '' }}>{{ __('Active') }}
					            </label>
					        </div>
				    	</div>
						{!! $errors->first('active', '<span class="help-block">:message</span>') !!}
	                @endcomponent


	                @component('back.components.box')
	                	@slot('type')
	                		info
	                	@endslot
	                	@slot('boxTitle')
	                		SEO
	                	@endslot
	                	<div class="form-group {{ $errors->has('meta_description') ? 'has-error' : '' }}">
							<label for="meta_description">{{__('META Description')}}</label>
							<textarea class="form-control" rows="3" id="meta_description" name="meta_description">{{ old('meta_description', isset($post) ? $post->meta_description : '') }}</textarea>
							{!! $errors->first('meta_description', '<span class="help-block">:message</span>') !!}
						</div>
	                	<div class="form-group {{ $errors->has('meta_keywords') ? 'has-error' : '' }}">
							<label for="meta_keywords">{{__('META Keywords')}}</label>
							<textarea class="form-control" rows="3" id="meta_keywords" name="meta_keywords">{{ old('meta_keywords', isset($post) ? $post->meta_keywords : '') }}</textarea>
							{!! $errors->first('meta_keywords', '<span class="help-block">:message</span>') !!}
						</div>
	                	<div class="form-group {{ $errors->has('seo_title') ? 'has-error' : '' }}">
							<label for="seo_title">{{__('SEO Title')}}</label>
							<input type="text" class="form-control" id="seo_title" name="seo_title" value="{{ old('seo_title', isset($post) ? $post->seo_title : '') }}">
							{!! $errors->first('seo_title', '<span class="help-block">:message</span>') !!}
						</div>
	                @endcomponent
				</div>
			</div>
		</form>
@endsection