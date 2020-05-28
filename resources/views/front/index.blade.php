@extends('front.layout')

@section('main')
<!-- Content -->
<div id="content-wrap">

	<div class="row">

		@isset($info)
            @component('front.components.alert')
                @slot('type')
                    info
                @endslot
                {!! $info !!}
            @endcomponent
        @endisset

		<div id="main" class="eight columns">

			@foreach($posts as $post)
                @include('front.brick-standard', compact('post'))
            @endforeach

		</div> <!-- end main -->

		@include('front.sidebar')

	</div> <!-- end row -->

</div> <!-- end content-wrap -->
@endsection