@extends('back.layout')

@section('css')
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-slider/slider.css') }}">
@endsection

@section('main')
	<div class="row">
		<div class="col-md-12">
			@if($errors->count())
				@component('back.components.alert')
					@slot('type')
                        danger
                    @endslot
                    @lang('There is some validation issue...')
				@endcomponent
			@endif
			@if (session('ok'))
                @component('back.components.alert')
                    @slot('type')
                        success
                    @endslot
                    {!! session('ok') !!}
                @endcomponent
            @endif
            <div class="row">
            	<div class="col-md-12">
            		<div class="nav-tabs-custom">
            			<ul class="nav nav-pills">
            				<li><a href="#tab_1" data-toggle="tab">@lang('Application')</a></li>
            				<li><a href="#tab_2" data-toggle="tab">@lang('Paginations')</a></li>
            				<li><a href="#tab_3" data-toggle="tab">@lang('Comments')</a></li>
            				<li><a href="#tab_4" data-toggle="tab">@lang('Database')</a></li>
            				<li><a href="#tab_5" data-toggle="tab">@lang('Mails')</a></li>
            			</ul>
            			<div class="tab-content">
            				@inject('envRepository', 'App\Repositories\EnvRepository')
            				<!-- Tab 1 -->
            				<div class="tab-pane fade" id="tab_1">
                                <form method="post" action="{{ route('settings.update', ['page' => 1]) }}">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('app_name') ? 'has-error' : '' }}">
                                    	<label for="app_name">{{ __('Application name') }}</label>
                                    	<input type="text" class="form-control" id="app_name" name="app_name" value="{{ old( 'app_name', old('app_name', config('app.name')) ) }}">
                                    	{!! $errors->first('app_name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('app_url') ? 'has-error' : '' }}">
                                    	<label for="app_url">{{ __('Base URL') }}</label>
                                    	<input type="text" class="form-control" id="app_url" name="app_url" value="{{ old('app_url', old('app_url', $envRepository->get('APP_URL'))) }}">
                                    	{!! $errors->first('app_url', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="locale">@lang('Default language')</label>
                                        <select id="locale" name="locale" class="form-control">
                                            @foreach($locales as $id => $locale)
                                                <option value="{{ $id }}" {{ old('locale') ? (($id === old('locale') ? 'selected' : '')) : ($locale === $actualLocale ? 'selected' : '') }} > {{ $locale }} </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('locale', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="timezone">@lang('Server timezone')</label>
                                        <select id="timezone" name="timezone" class="form-control">
                                            @foreach($timezones as $key =>$value)
                                                <option value="{{ $key }}" {{ old('timezone') ? (($id === old('timezone') ? 'selected' : '')) : ($key === $actualTimezone ? 'selected' : '') }}>{{ $key . ' - ' . $value}}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('timezone', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="cache_driver">@lang('Cache driver')</label>
                                        <select id="cache_driver" name="cache_driver" class="form-control">
                                            @foreach($caches as $cache)
                                                <option value="{{ $cache }}" {{ old('mail_driver') ? ($cache === old('cache_driver') ? 'selected' : '') : ($cache === $actualCacheDriver ? 'selected' : '') }}>{{ $cache }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('cache_driver', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <button class="btn btn-primary" type="submit">@lang('Submit')</button>
                                </form>
                            </div>
                            <!-- Tab 2 -->
                            <div class="tab-pane fade" id="tab_2">
                                <form method="post" action="{{ route('settings.update', ['page' => 2]) }}">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <div class="box box-warning">
									    <div class="box-header with-border">
									        <h3 class="box-title">{{ __('Front') }}</h3>
									        <div class="box-tools pull-right">
									            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									            </button>
									        </div>
									        <!-- /.box-tools -->
									    </div>
									    <!-- /.box-header -->
									    <div class="box-body">
									        <div class="form-group {{ $errors->has('frontposts') ? 'has-error' : '' }}">
									        	<label for="{{ 'frontposts' }}">{{ __('Posts') }}</label>
									        	<input class="slider" id="'frontposts'" name="'frontposts'" type="text" data-slider-min="2" data-slider-max="10" data-slider-step="1" data-slider-value="{{ old('frontposts', old('frontposts', config('app.nbrPages.front.posts')) ) }}"/>
									        	{!! $errors->first('frontposts', '<span class="help-block">:message</span>') !!}
									        </div>
									    </div>
									    <!-- /.box-body -->
									</div>
									<!-- /.box -->

                                    @component('back.components.boxinputs')
                                        @slot('boxtype')
                                            warning
                                        @endslot
                                        @slot('boxtitle')
                                            @lang('Back')
                                        @endslot
                                        <div class="form-group {{ $errors->has('backposts') ? 'has-error' : '' }}">
								        	<label for="{{ 'backposts' }}">{{ __('Posts') }}</label>
                                    		<input class="slider" id="'backposts'" name="'backposts'" type="text" data-slider-min="2" data-slider-max="16" data-slider-step="1" data-slider-value="{{ old('backposts', old('backposts', config('app.nbrPages.back.posts')) ) }}"/>
                                    		{!! $errors->first('backposts', '<span class="help-block">:message</span>') !!}
								        </div>
                                        <div class="form-group {{ $errors->has('backusers') ? 'has-error' : '' }}">
								        	<label for="{{ 'backusers' }}">{{ __('Posts') }}</label>
                                        	<input class="slider" id="'backusers'" name="'backusers'" type="text" data-slider-min="2" data-slider-max="16" data-slider-step="1" data-slider-value="{{ old('backusers', old('backusers', config('app.nbrPages.back.users')) ) }}"/>
                                        	{!! $errors->first('backusers', '<span class="help-block">:message</span>') !!}
								        </div>
                                        <div class="form-group {{ $errors->has('backcomments') ? 'has-error' : '' }}">
								        	<label for="{{ 'backcomments' }}">{{ __('Comments') }}</label>
                                        	<input class="slider" id="'backcomments'" name="'backcomments'" type="text" data-slider-min="2" data-slider-max="10" data-slider-step="1" data-slider-value="{{ old('backcomments', old('backcomments', config('app.nbrPages.back.comments')) ) }}"/>
                                        	{!! $errors->first('backcomments', '<span class="help-block">:message</span>') !!}
								        </div>
                                        <div class="form-group {{ $errors->has('backcontacts') ? 'has-error' : '' }}">
								        	<label for="{{ 'backcontacts' }}">{{ __('Contacts') }}</label>
                                        	<input class="slider" id="'backcontacts'" name="'backcontacts'" type="text" data-slider-min="2" data-slider-max="10" data-slider-step="1" data-slider-value="{{ old('backcontacts', old('backcontacts', config('app.nbrPages.back.contacts')) ) }}"/>
                                        	{!! $errors->first('backcontacts', '<span class="help-block">:message</span>') !!}
								        </div>
                                    @endcomponent
                                    <button class="btn btn-primary" type="submit">@lang('Submit')</button>
                                </form>
                            </div>
                            <!-- Tab 3 -->
                            <div class="tab-pane fade" id="tab_3">
                            	<form method="post" action="{{ route('settings.update', ['page' => 3]) }}">
                            		{{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('backcommentsnestedlevel') ? 'has-error' : '' }}">
							        	<label for="{{ 'backcommentsnestedlevel' }}">{{ __('Comments nested level') }}</label>
                                    	<input class="slider" id="'backcommentsnestedlevel'" name="'backcommentsnestedlevel'" type="text" data-slider-min="2" data-slider-max="10" data-slider-step="1" data-slider-value="{{ old('backcommentsnestedlevel', old('backcommentsnestedlevel', config('app.commentsNestedLevel')) ) }}"/>
                                    	{!! $errors->first('backcommentsnestedlevel', '<span class="help-block">:message</span>') !!}
							        </div>
                                    <div class="form-group {{ $errors->has('backcommentsparent') ? 'has-error' : '' }}">
							        	<label for="{{ 'backcommentsparent' }}">{{ __('Number of parent comments to see each time') }}</label>
                                    	<input class="slider" id="'backcommentsparent'" name="'backcommentsparent'" type="text" data-slider-min="2" data-slider-max="10" data-slider-step="1" data-slider-value="{{ old('backcommentsparent', old('backcommentsparent', config('app.numberParentComments')) ) }}"/>
                                    	{!! $errors->first('backcommentsparent', '<span class="help-block">:message</span>') !!}
							        </div>
							        <button class="btn btn-primary" type="submit">@lang('Submit')</button>
                            	</form>
                            </div>
                            <!-- Tab 4 -->
                            <div class="tab-pane fade" id="tab_4">
                            	<h3 class="text-danger text-center">@lang('Be careful not to enter wrong parameters!')</h3>
                                <form id="formdatabase" method="post" action="{{ route('settings.update', ['page' => 4]) }}">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="db_connection">@lang('Connection')</label>
                                        <select id="db_connection" name="db_connection" class="form-control">
                                            @foreach($connections as $connection)
                                                <option value="{{ $connection }}" {{ old('db_connection') ? ($connection === old('db_connection') ? 'selected' : '') : ($connection === $actualConnection ? 'selected' : '') }}>{{ $connection }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('db_connection', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('db_host') ? 'has-error' : '' }}">
                                    	<label for="db_host">{{ __('Host') }}</label>
                                    	<input type="text" class="form-control" id="db_host" name="db_host" value="{{ old( 'db_host', old('db_host', $envRepository->get('DB_HOST')) ) }}">
                                    	{!! $errors->first('db_host', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('db_port') ? 'has-error' : '' }}">
                                    	<label for="db_port">{{ __('Port') }}</label>
                                    	<input type="text" class="form-control" id="db_port" name="db_port" value="{{ old( 'db_port', old('db_port', $envRepository->get('DB_HOST')) ) }}">
                                    	{!! $errors->first('db_port', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('db_database') ? 'has-error' : '' }}">
                                    	<label for="db_database">{{ __('Database name') }}</label>
                                    	<input type="text" class="form-control" id="db_database" name="db_database" value="{{ old( 'db_database', old('db_database', $envRepository->get('DB_DATABASE')) ) }}">
                                    	{!! $errors->first('db_database', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('db_username') ? 'has-error' : '' }}">
                                    	<label for="db_username">{{ __('User name') }}</label>
                                    	<input type="text" class="form-control" id="db_username" name="db_username" value="{{ old( 'db_username', old('db_username', $envRepository->get('DB_USERNAME')) ) }}">
                                    	{!! $errors->first('db_username', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->has('db_password') ? 'has-error' : '' }}">
                                    	<label for="db_password">{{ __('Password') }}</label>
                                    	<input type="text" class="form-control" id="db_password" name="db_password" value="{{ old( 'db_password', old('db_password', $envRepository->get('DB_PASSWORD')) ) }}">
                                    	{!! $errors->first('db_password', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <button class="btn btn-primary" type="submit">@lang('Submit')</button>
                                </form>
                            </div>
                            <!-- Tab 5 -->
                            <div  class="tab-pane fade" id="tab_5">
                            	<form method="post" action="{{ route('settings.update', ['page' => 5]) }}">
                            		{{ method_field('PUT') }}
                            		{{ csrf_field() }}
                            		<div class="form-group {{ $errors->has('mail_from_address') ? 'has-error' : '' }}">
                                    	<label for="mail_from_address">{{ __('Sender mail address') }}</label>
                                    	<input type="text" class="form-control" id="mail_from_address" name="mail_from_address" value="{{ old( 'mail_from_address', old('mail_from_address', $envRepository->get('MAIL_FROM_ADDRESS')) ) }}">
                                    	{!! $errors->first('mail_from_address', '<span class="help-block">:message</span>') !!}
                                    </div>
                            		<div class="form-group {{ $errors->has('mail_from_name') ? 'has-error' : '' }}">
                                    	<label for="mail_from_name">{{ __('Sender name') }}</label>
                                    	<input type="text" class="form-control" id="mail_from_name" name="mail_from_name" value="{{ old( 'mail_from_name', old('mail_from_name', $envRepository->get('MAIL_FROM_NAME')) ) }}">
                                    	{!! $errors->first('mail_from_name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="mail_driver">@lang('Driver')</label>
                                        <select id="mail_driver" name="mail_driver" class="form-control">
                                            @foreach($drivers as $key => $value)
                                                <option value="{{ $key }}" {{ old('mail_driver') ? ($key === old('mail_driver') ? 'selected' : '') : ($key === $actualDriver ? 'selected' : '') }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('mail_driver', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div id="smtp" @if (old('mail_driver', $actualDriver) === 'mail') style="display: none" @endif>
                                    	<div class="form-group {{ $errors->has('mail_host') ? 'has-error' : '' }}">
	                                    	<label for="mail_host">{{ __('Host') }}</label>
	                                    	<input type="text" class="form-control" id="mail_host" name="mail_host" value="{{ old( 'mail_host', old('mail_host', $envRepository->get('MAIL_HOST')) ) }}">
	                                    	{!! $errors->first('mail_host', '<span class="help-block">:message</span>') !!}
	                                    </div>
                                    	<div class="form-group {{ $errors->has('mail_port') ? 'has-error' : '' }}">
	                                    	<label for="mail_port">{{ __('Port') }}</label>
	                                    	<input type="text" class="form-control" id="mail_port" name="mail_port" value="{{ old( 'mail_port', old('mail_port', $envRepository->get('MAIL_PORT')) ) }}">
	                                    	{!! $errors->first('mail_port', '<span class="help-block">:message</span>') !!}
	                                    </div>
                                    	<div class="form-group {{ $errors->has('mail_username') ? 'has-error' : '' }}">
	                                    	<label for="mail_username">{{ __('User name') }}</label>
	                                    	<input type="text" class="form-control" id="mail_username" name="mail_username" value="{{ old( 'mail_username', old('mail_username', $envRepository->get('MAIL_USERNAME')) ) }}">
	                                    	{!! $errors->first('mail_username', '<span class="help-block">:message</span>') !!}
	                                    </div>
                                    	<div class="form-group {{ $errors->has('mail_password') ? 'has-error' : '' }}">
	                                    	<label for="mail_password">{{ __('Password') }}</label>
	                                    	<input type="text" class="form-control" id="mail_password" name="mail_password" value="{{ old( 'mail_password', old('mail_password', $envRepository->get('MAIL_PASSWORD')) ) }}">
	                                    	{!! $errors->first('mail_password', '<span class="help-block">:message</span>') !!}
	                                    </div>
                                    	<div class="form-group {{ $errors->has('mail_encryption') ? 'has-error' : '' }}">
	                                    	<label for="mail_encryption">{{ __('Encryption') }}</label>
	                                    	<input type="text" class="form-control" id="mail_encryption" name="mail_encryption" value="{{ old( 'mail_encryption', old('mail_encryption', $envRepository->get('MAIL_ENCRYPTION')) ) }}">
	                                    	{!! $errors->first('mail_encryption', '<span class="help-block">:message</span>') !!}
	                                    </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">@lang('Submit')</button>
                            	</form>
                            </div>
            			</div>
            		</div>
            	</div>
            </div>
		</div>
	</div>
@endsection


@section('js')
    <script src="{{ asset('adminlte/plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>
    <script>
        $(function() {
            $('.slider').slider()
            $('#mail_driver').change (function() {
                if ($(this).val() == 'smtp') {
                    $('#smtp').show().slow()
                } else {
                    $('#smtp').hide().slow()
                }
            })
            $('a[href="#tab_{{ setTabActive () }}"]').tab('show')
        })
    </script>
@endsection