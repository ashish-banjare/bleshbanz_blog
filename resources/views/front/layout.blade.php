<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html class="no-js" lang="{{ config('app.locale') }}"> <!--<![endif]-->
<head>

	<!--- Basic Page Needs  -->
	<meta charset="utf-8">
	<title>{{ isset($post) && $post->seo_title ? $post->seo_title : __(lcfirst('Title'))  }}</title>
	<meta name="description" content="{{ isset($post) && $post->meta_description ? $post->meta_description : __('description') }}">
	<meta name="author" content="@lang(lcfirst ('Author'))">
	@if(isset($post) && $post->meta_keywords)
	<meta name="keywords" content="{{ $post->meta_keywords }}">
	@endif
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- mobile specific metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS -->
	<link rel="stylesheet" href="{{ asset('css/default.css') }}">
	<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
	<link rel="stylesheet" href="{{ asset('css/media-queries.css') }}">
	@yield('css')

   <!-- Script
   	================================================== -->
   	<script src="{{ asset('js/modernizr.js') }}"></script>

   <!-- Favicons
   	================================================== -->
   	<link rel="shortcut icon" href="favicon.png" >

   </head>

   <body>

   <!-- Header
   	================================================== -->
   	<header id="top">

   		<div class="row">

   			<div class="header-content twelve columns">

   				<h1 id="logo-text"><a href="{{ route('home') }}" title="">My Blog</a></h1>
   				<p id="intro">Stop Overthinking, Believe In Your self...</p>
   			</div>			

   		</div>

   		<nav id="nav-wrap"> 

   			<a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show Menu</a>
   			<a class="mobile-btn" href="#" title="Hide navigation">Hide Menu</a>

   			<div class="row">    		            

   				<ul id="nav" class="nav">
   					<li {{ currentRoute('home') }}>
   						<a href="{{ route('home') }}">Home</a>
   					</li>
   					<li class="has-children"><a href="javascript:;">@lang('Categories')</a>
   						<ul>
   							@foreach ($categories as $category)
   							<li><a href="{{ route('category', [$category->slug ]) }}">{{ $category->title }}</a></li>
   							@endforeach
   						</ul>
   					</li>
   					@guest
						<li {{ currentRoute('contacts.create') }}>
							<a href="{{ route('contacts.create') }}">@lang('Contact')</a>
						</li>
					@endguest
					@request('register')
						<li class="current">
							<a href="{{ request()->url() }}">@lang('Register')</a>
						</li>
					@endrequest
					@request('password/email')
						<li class="current">
							<a href="{{ request()->url() }}">@lang('Forgotten password')</a>
						</li>
					@else
						@guest
							<li {{ currentRoute('login') }}>
								<a href="{{ route('login') }}">@lang('Login')</a>
							</li>
						@else
							@admin
								<li>
									<a href="{{ url('admin') }}">@lang('Administration')</a>
								</li>
							@endadmin
							@redac
								<li>
									<a href="{{ url('admin/posts') }}">@lang('Administration')</a>
								</li>
							@endredac
							<li>
								<a id="logout" href="{{ route('logout') }}">@lang('Logout')</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
									{{ csrf_field() }}
								</form>
							</li>
						@endguest
					@endrequest		      	
   				</ul> <!-- end #nav -->			   	 

   			</div> 

   		</nav> <!-- end #nav-wrap --> 	     

   	</header> <!-- Header End -->

   	@yield('main')


   <!-- Footer
   	================================================== -->
   	<footer>

   		<div class="row"> 

   			<div class="twelve columns">	
   				<ul class="social-links">
   					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
   					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
   					<li><a href="#"><i class="fa fa-google-plus"></i></a></li>               
   					<li><a href="#"><i class="fa fa-github-square"></i></a></li>
   					<li><a href="#"><i class="fa fa-instagram"></i></a></li>
   					<li><a href="#"><i class="fa fa-flickr"></i></a></li>               
   					<li><a href="#"><i class="fa fa-skype"></i></a></li>
   				</ul>			
   			</div>

   			<div class="six columns info">

   				<h3>About Keep It Simple</h3> 

   				<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
   					Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem
   					nibh id elit. 
   				</p>

   				<p>Lorem ipsum Sed nulla deserunt voluptate elit occaecat culpa cupidatat sit irure sint 
   				sint incididunt cupidatat esse in Ut sed commodo tempor consequat culpa fugiat incididunt.</p>

   			</div>

   			<div class="four columns">

   				<h3>Photostream</h3>

   				<ul class="photostream group">
   					<li><a href="#"><img alt="thumbnail" src="{{ asset('images/thumb.jpg') }}"></a></li>
   					<li><a href="#"><img alt="thumbnail" src="{{ asset('images/thumb.jpg') }}"></a></li>
   					<li><a href="#"><img alt="thumbnail" src="{{ asset('images/thumb.jpg') }}"></a></li>
   					<li><a href="#"><img alt="thumbnail" src="{{ asset('images/thumb.jpg') }}"></a></li>
   					<li><a href="#"><img alt="thumbnail" src="{{ asset('images/thumb.jpg') }}"></a></li>
   					<li><a href="#"><img alt="thumbnail" src="{{ asset('images/thumb.jpg') }}"></a></li>
   					<li><a href="#"><img alt="thumbnail" src="{{ asset('images/thumb.jpg') }}"></a></li>
   					<li><a href="#"><img alt="thumbnail" src="{{ asset('images/thumb.jpg') }}"></a></li>
   				</ul>           

   			</div>

   			<div class="two columns">
   				<h3 class="social">Navigate</h3>

   				<ul class="navigate group">
   					<li><a href="#">Home</a></li>
   					<li><a href="#">Blog</a></li>
   					<li><a href="#">Demo</a></li>
   					<li><a href="#">Archives</a></li>
   					<li><a href="#">About</a></li>
   				</ul>
   			</div>

   			<p class="copyright">&copy; Copyright 2020 The Blesh Banz. &nbsp; Design by <a title="Styleshout" href="http://www.styleshout.com/">Styleshout</a>.</p>

   		</div> <!-- End row -->

   		<div id="go-top"><a class="smoothscroll" title="Back to Top" href="#top"><i class="fa fa-chevron-up"></i></a></div>

   	</footer> <!-- End Footer-->

   	<div id="preloader">
   		<div id="loader"></div>
   	</div>

   <!-- Java Script
   	================================================== -->
   	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   	<script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
   	<script type="text/javascript" src="{{ asset('js/jquery-migrate-1.2.1.min.js')}}"></script>  
   	<script src="{{ asset('js/main.js')}}"></script>

   	@yield('scripts')

   </body>

   </html>