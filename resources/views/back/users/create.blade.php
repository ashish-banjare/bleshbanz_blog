@extends('back.layout')

@section('css')

@endsection

@section('main')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            @if (session('user-created'))
                @component('back.components.alert')
                    @slot('type')
                        success
                    @endslot
                    {!! session('user-created') !!}
                @endcomponent
            @endif
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('users.store') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                    	<div class="col-md-6">
	                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	                            <label for="name">@lang('Name')</label>
	                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
	                            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
	                        </div>
                    	</div>
                    	<div class="col-md-6">
	                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
	                            <label for="email">@lang('Email')</label>
	                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
	                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
	                        </div>
                    	</div>
                    	<div class="col-md-6">
                    		<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
	                            <label for="password">@lang('Password')</label>
	                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
	                            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
	                        </div>
                    	</div>
                    	<div class="col-md-6">
                    		<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
	                            <label for="password_confirmation">@lang('Confirm Password')</label>
	                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
	                            {!! $errors->first('password_confirmation', '<small class="help-block">:message</small>') !!}
	                        </div>
                    	</div>
                    	<div class="col-md-6">
	                        <div class="form-group">
	                            <label for="role">@lang('Role')</label>
	                            <select class="form-control" name="role" id="role">
	                                <option value="admin">@lang('Administrator')</option>
	                                <option value="redac">@lang('Redactor')</option>
	                                <option value="user">@lang('User')</option>
	                            </select>
	                        </div>
                    	</div>
                    	<div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="new" checked> @lang('New')
                                </label>
                            </div>
                        
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="confirmed" value="on" {{ old('confirmed') ? 'checked' : ''}}> @lang('Confirmed')
                                </label>
                            </div>
                        
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="valid" value="on" {{ old('valid') ? 'checked' : ''}}> @lang('Valid')
                                </label>
                            </div>
                    	</div>
                        
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
@endsection