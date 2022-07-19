<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3 text-light">Add Post</a>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table table-bordered table-hover">
        <tr>
            <th>Name</th>
            <th>Created By</th>
            <th>Featured Image</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Created At</th>
            <th>Update At</th>
            <th>Actions</th>
        </tr>
        @forelse ($posts as $post)
            <tr>
                <td class="w-25">{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td><img width="150" src="{{ Storage::url($post->featured_image) }}" alt=""></td>
                <td>{{ $post->category?->name }}</td>
                <td>
                    @foreach ($post->tags as $tag)
                        <u>{{ $tag->name }}</u>,<br>
                    @endforeach
                </td>
                <td>{{ $post->created_at->format('d-M-Y g:i a') }}</td>
                <td>{{ $post->updated_at->format('d-M-Y g:i a') }}</td>
                <td>
                    <a type="button" href="{{ route('post.show',['slug'=>$post->slug]) }}" class="btn btn-primary text-light">
                        View post
                    </a>
                    <a type="button" href="{{ route('posts.edit',['post'=>$post->id]) }}" class="btn btn-primary text-light">
                        Edit post
                    </a>
                    <form action="{{ route('posts.destroy',['post'=>$post->id]) }}" method="POST" class="d-inline-block mt-2">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger text-light" onclick="return confirm('Are you sure you want to delete this post?')">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No posts found</td>
            </tr>
        @endforelse

    </table>

    {{ $posts->links() }}

</x-app-layout>
