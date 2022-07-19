<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card border-primary mb-3">
                    <div class="card-header">Posts</div>
                    <div class="card-body text-primary">
                        <h5 class="card-title">Number of posts</h5>
                        <p class="card-text">
                            <h1>{{ $postCount }}</h1>
                        </p>
                    </div>
                </div>
            </div>  
            <div class="col">
                <div class="card border-secondary mb-3">
                    <div class="card-header">Categories</div>
                    <div class="card-body text-secondary">
                        <h5 class="card-title">Number of categories</h5>
                        <p class="card-text">
                            <h1>{{ $tagCount }}</h1>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-success mb-3">
                    <div class="card-header">Tags</div>
                    <div class="card-body text-success">
                        <h5 class="card-title">Number of tags</h5>
                        <p class="card-text">
                            <h1>{{ $categoryCount }}</h1>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="card border-info mb-3">
                    <div class="card-header">Last 5 posts</div>
                    <div class="card-body text-seccondary">
                        <p class="card-text">
                            @foreach ($posts as $post)
                                {{ $post->title }} 
                                @if (!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
