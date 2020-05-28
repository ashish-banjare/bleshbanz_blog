<article class="entry">

	<header class="entry-header">

		<h2 class="entry-title">
			<a href="{{ url('posts/' . $post->slug) }}" title="">{{ $post->title }}</a>
		</h2> 				 

		<div class="entry-meta">
			<ul>
				<li>{{ date('Y-m-d', strtotime($post->created_at)) }}</li>
				<span class="meta-sep">&bull;</span>[
				@foreach($post->categories as $category )
					<li><a href="{{ route('category', [$category->slug]) }}">{{ $category->title }}</a></li>,
				@endforeach ]
				<span class="meta-sep">&bull;</span>
				<li>{{ ($post->user) ? $post->user->name : '' }}</li>
			</ul>
		</div> 

	</header> 

	<div class="entry-content">
		<p>{{ $post->excerpt }}</p>
	</div> 

</article> <!-- end entry -->						