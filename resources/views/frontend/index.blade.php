@extends('layouts.frontend')

@section('header-banner')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('assets/assets/img/home-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Code Ecstasy Blogging System</h1>
                        <span class="subheading">A Tutorial on How To Build a CMS</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                @foreach ($posts as $post)
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="{{ route('post.show',[ 'slug' => $post->slug ]) }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <h3 class="post-subtitle">{!! Str::words($post->description,10) !!}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">{{ $post->user->name }}</a>
                            on {{ $post->created_at->format('M d, Y') }}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                @endforeach
                <!-- Pager-->
                
                <div class="d-flex justify-content-end mb-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
