@extends('front.layout')

@section('css')
@if (Auth::check())
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
@endif
@endsection

@section('main')
<!-- Content
	================================================== -->
	<div id="content-wrap">

		<div class="row">

			<div id="main" class="eight columns">

				<article class="entry">

					<header class="entry-header">

						<h2 class="entry-title">
							{{ $post->title }}
						</h2> 				 

						<div class="entry-meta">
							<ul>
								<li>{{ date('Y-m-d', strtotime($post->created_at)) }}</li>
								<span class="meta-sep">&bull;</span>							
								<li>
									@foreach($post->categories as $category )
										<a href="{{ route('category', [$category->slug]) }}">{{ $category->title }}</a>,
									@endforeach
								</li>
								<span class="meta-sep">&bull;</span>
								<li>{{ ($post->user) ? $post->user->name : '' }}</li>
							</ul>
						</div> 

					</header> 

					<div class="entry-content-media">
						<div class="post-thumb">
							<img src="{{ asset('images/m-farmerboy.jpg')}}">
						</div> 
					</div>

					<div class="entry-content">
						<p>{{ $post->body }}</p>
					</div>
					<!-- Tags -->
					@if ($post->tags->count())
						<p class="tags">
							<span>Tagged in </span>:
							@foreach($post->tags as $tag )
								<a href="{{ route('posts.tag', [$tag->id]) }}">{{ $tag->tag }}</a>
							@endforeach
						</p> 
					@endif

					<ul class="post-nav group">
						@if ($post->previous)
							<li class="prev"><a rel="prev" href="{{ url('posts/' . $post->previous->slug) }}"><strong>@lang('Previous')</strong> {{ $post->previous->title }}</a></li>
						@endif
						@if ($post->next)
							<li class="next"><a rel="next" href="{{ url('posts/' . $post->next->slug) }}"><strong>@lang('Next')</strong> {{ $post->next->title }}</a></li>
						@endif
					</ul>

				</article>

				<!-- Comments
					================================================== -->
					<div id="comments">

						@if (session('warning'))
			                @component('front.components.alert')
			                    @slot('type')
			                        notice
			                    @endslot
			                    {!! session('warning') !!}
			                @endcomponent
			            @endif

						<h3>{{ $post->valid_comments_count }} {{ trans_choice(__('comment|comments'), $post->valid_comments_count) }}</h3>

						<!-- commentlist -->
						<ol class="commentlist">

							<li class="depth-1">

								<div class="avatar">
									<img width="50" height="50" class="avatar" src="{{ asset('images/user-01.png')}}" alt="">
								</div>

								<div class="comment-content">

									<div class="comment-info">
										<cite>Itachi Uchiha</cite>

										<div class="comment-meta">
											<time class="comment-time" datetime="2014-07-12T23:05">Jul 12, 2014 @ 23:05</time>
											<span class="sep">/</span><a class="reply" href="#">Reply</a>
										</div>
									</div>

									<div class="comment-text">
										<p>Adhuc quaerendum est ne, vis ut harum tantas noluisse, id suas iisque mei. Nec te inani ponderum vulputate,
										facilisi expetenda has et. Iudico dictas scriptorem an vim, ei alia mentitum est, ne has voluptua praesent.</p>
									</div>

								</div>

							</li>

							<li class="thread-alt depth-1">

								<div class="avatar">
									<img width="50" height="50" class="avatar" src="{{ asset('images/user-03.png')}}" alt="">
								</div>

								<div class="comment-content">

									<div class="comment-info">
										<cite>John Doe</cite>

										<div class="comment-meta">
											<time class="comment-time" datetime="2014-07-12T24:05">Jul 12, 2014 @ 24:05</time>
											<span class="sep">/</span><a class="reply" href="#">Reply</a>
										</div>
									</div>

									<div class="comment-text">
										<p>Sumo euismod dissentiunt ne sit, ad eos iudico qualisque adversarium, tota falli et mei. Esse euismod
											urbanitas ut sed, et duo scaevola pericula splendide. Primis veritus contentiones nec ad, nec et
										tantas semper delicatissimi.</p>                        
									</div>

								</div>

								<ul class="children">

									<li class="depth-2">

										<div class="avatar">
											<img width="50" height="50" class="avatar" src="{{ asset('images/user-03.png')}}" alt="">
										</div>

										<div class="comment-content">

											<div class="comment-info">
												<cite>Kakashi Hatake</cite>

												<div class="comment-meta">
													<time class="comment-time" datetime="2014-07-12T25:05">Jul 12, 2014 @ 25:05</time>
													<span class="sep">/</span><a class="reply" href="#">Reply</a>
												</div>
											</div>

											<div class="comment-text">
												<p>Duis sed odio sit amet nibh vulputate
													cursus a sit amet mauris. Morbi accumsan ipsum velit. Duis sed odio sit amet nibh vulputate
												cursus a sit amet mauris</p>
											</div>

										</div>

										<ul class="children">

											<li class="depth-3">

												<div class="avatar">
													<img width="50" height="50" class="avatar" src="{{ asset('images/user-03.png')}}" alt="">
												</div>

												<div class="comment-content">

													<div class="comment-info">
														<cite>John Doe</cite>

														<div class="comment-meta">
															<time class="comment-time" datetime="2014-07-12T25:15">July 12, 2014 @ 25:15</time>
															<span class="sep">/</span><a class="reply" href="#">Reply</a>
														</div>
													</div>

													<div class="comment-text">
														<p>Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est
														etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.</p>
													</div>

												</div>

											</li>

										</ul>

									</li>

								</ul>

							</li>

							<li class="depth-1">

								<div class="avatar">
									<img width="50" height="50" class="avatar" src="{{ asset('images/user-02.png')}}" alt="">
								</div>

								<div class="comment-content">

									<div class="comment-info">
										<cite>Hinata Hyuga</cite>

										<div class="comment-meta">
											<time class="comment-time" datetime="2014-07-12T25:15">July 12, 2014 @ 25:15</time>
											<span class="sep">/</span><a class="reply" href="#">Reply</a>
										</div>
									</div>

									<div class="comment-text">
										<p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem.</p>
									</div>

								</div>

							</li>

						</ol> <!-- Commentlist End -->


						<!-- respond -->
						<div class="respond">

							<h3>Leave a Comment</h3>

							<!-- form -->
							<form name="contactForm" id="contactForm" method="post" action="">
								<fieldset>

									<div class="group">
										<label for="cName">Name <span class="required">*</span></label>
										<input name="cName" type="text" id="cName" size="35" value="" />
									</div>

									<div class="group">
										<label for="cEmail">Email <span class="required">*</span></label>
										<input name="cEmail" type="text" id="cEmail" size="35" value="" />
									</div>

									<div class="group">
										<label for="cWebsite">Website</label>
										<input name="cWebsite" type="text" id="cWebsite" size="35" value="" />
									</div>

									<div class="message group">
										<label  for="cMessage">Message <span class="required">*</span></label>
										<textarea name="cMessage"  id="cMessage" rows="10" cols="50" ></textarea>
									</div>

									<button type="submit" class="submit">Submit</button>

								</fieldset>
							</form> <!-- Form End -->

						</div> <!-- Respond End -->

					</div>  <!-- Comments End -->		


				</div> <!-- main End -->

				@include('front.sidebar')
				<!-- end sidebar -->

			</div> <!-- end row -->

		</div> <!-- end content-wrap -->   
		@endsection


		@section('scripts')
		@if (auth()->check())
		<script src="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.js"></script>
		<script>

			var post = (function () {

				var onReady = function () {
					$('body').on('click', 'a.deletecomment', deleteComment)
					.on('click', 'a.editcomment', editComment)
					.on('click', '.btnescape', escapeComment)
					.on('submit', '.comment-form', submitComment)
					.on('click', 'a.reply', replyCreation)
					.on('click', '.btnescapereply', escapeReply)
					.on('submit', '.reply-form', submitReply)
				}

				var toggleEditControls = function (id) {
					$('#comment-edit' + id).toggle()
					$('#comment-body' + id).toggle('slow')
					$('#comment-form' + id).toggle('slow')
				}

                // Delete comment
                var deleteComment = function (event) {
                	event.preventDefault()
                	var that = $(this)
                	swal({
                		title: "{!! __('Really delete this comment ?') !!}",
                		type: "warning",
                		showCancelButton: true,
                		confirmButtonColor: "#DD6B55",
                		confirmButtonText: "{!! __('Yes') !!}",
                		cancelButtonText: "{!! __('No') !!}"
                	}).then(function () {
                		that.next('form').submit()
                	})
                }

                // Set comment edition
                var editComment = function (event) {
                	event.preventDefault()
                	var i = $(this).attr('id').substring(12);
                	$('form.comment-form textarea#message' + i).val($('#comment-body' + i).text())
                	toggleEditControls(i)
                }

                // Escape comment edition
                var escapeComment = function (event) {
                	event.preventDefault()
                	var i = $(this).attr('id').substring(14)
                	toggleEditControls(i)
                	$('form.comment-form textarea#message' + i).prev().text('')
                }

                // Submit comment
                var submitComment = function (event) {
                	event.preventDefault();
                	$.ajax({
                		method: 'put',
                		url: $(this).attr('action'),
                		data: $(this).serialize()
                	})
                	.done(function (data) {
                		$('#comment-body' + data.id).text(data.message)
                		toggleEditControls(data.id)
                	})
                	.fail(function(data) {
                		var errors = data.responseJSON
                		$.each(errors, function(index, value) {
                			value = value[0].replace(index, '@lang('message')')
                			$('form.comment-form textarea[name="' + index + '"]').prev().text(value)
                		});
                	});
                }

                // Set reply creation
                var replyCreation = function (event) {
                	event.preventDefault()
                	var i = $(this).attr('id').substring(12)
                	$('form.reply-form textarea#message' + i).val('')
                	$('#reply-form' + i).toggle('slow')
                }

                // Escape reply creation
                var escapeReply = function (event) {
                	event.preventDefault()
                	var i = $(this).attr('id').substring(12)
                	$('#reply-form' + i).toggle('slow')
                }

                // Submit reply
                var submitReply = function (event) {
                	event.preventDefault()
                	$.ajax({
                		method: 'post',
                		url: $(this).attr('action'),
                		data: $(this).serialize()
                	})
                	.done(function (data) {
                		document.location.reload(true)
                	})
                	.fail(function(data) {
                		var errors = data.responseJSON
                		$.each(errors, function(index, value) {
                			value = value[0].replace(index, '@lang('message')')
                			$('form.reply-form textarea[name="' + index + '"]').prev().text(value)
                		});
                	});
                }

                return {
                	onReady: onReady
                }

            })()

            $(document).ready(post.onReady)

        </script>
        @endif

        <script>
        	$(function() {
            // Get next comments
            $('#nextcomments').click (function(event) {
            	event.preventDefault()
            	$('#morebutton').hide()
            	$('#moreicon').show()
            	$.get($(this).attr('href'))
            	.done(function(data) {
            		$('ol.commentlist').append(data.html)
            		if(data.href !== 'none') {
            			$('#nextcomments').attr('href', data.href)
            			$('#morebutton').show()
            		}
            		$('#moreicon').hide()
            	})
            })
        })
    </script>
    @endsection