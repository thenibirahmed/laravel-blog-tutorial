@extends('layouts.frontend')

@section('header-banner')

<!-- Page Header-->
<header class="masthead" style="background-image: url('{{ $post->featured_image ? Storage::url($post->featured_image) : asset('assets/assets/img/home-bg.jpg') }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>{{ $post->title }}</h1>
                    <span class="meta">Posted By: {{ $post->user->name }}, Posted At: {{ $post->created_at->format('M d,Y, h:i A') }}</span>
                </div>
            </div>
        </div>
    </div>
</header>

@endsection

@section('content')
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                {!! $post->description !!}
        </div>
        <div class="mt-5" id="disqus_thread"></div>
    </div>
</article>

{{-- <script id="dsq-count-scr" src="//tutorial-18.disqus.com/count.js" async></script> --}}

<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    
    var disqus_config = function () {
    this.page.url = '{{ request()->url() }}';  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = '{{ $post->id }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://tutorial-18.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endsection
