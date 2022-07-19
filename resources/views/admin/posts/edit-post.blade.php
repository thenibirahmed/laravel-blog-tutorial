<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <a href="{{ route('posts.index') }}" class="btn btn-primary mb-3 text-light">Go Back</a> <br>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <h2>Update Post</h2>
    <form action="{{ route('posts.update',['post'=>$post->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <label class="mt-3"><b>Title</b></label>
        <input name="title" type="text" value="{{ $post->title }}" class="form-control">
    
        <label class="mt-3"><b>Description</b></label>
        <textarea name="description" id="mytextarea" cols="30" rows="10" class="form-control">{{ $post->description }}</textarea>
    
        <label class="mt-3"><b>Category</b></label>
        <select name="category_id" id="" class="form-control">
            @foreach ($categories as $cat_id => $category)
                @if ($cat_id == $post->category_id)
                    <option selected value="{{ $cat_id }}">{{ $category }}</option>
                @else
                    <option value="{{ $cat_id }}">{{ $category }}</option>
                @endif
            @endforeach
        </select>
    
        <label class="mt-3"><b>Tags</b></label>
        <select name="tag_id[]" id="tags" multiple class="form-control">
            @foreach ($tags as $tag_id => $tag)
                @if ( in_array( $tag_id, array_keys($post->tags()->get()->pluck('name','id')->toArray()) ) )
                    <option selected value="{{ $tag_id }}">{{ $tag }}</option>
                @else
                    <option value="{{ $tag_id }}">{{ $tag }}</option>
                @endif
            @endforeach
        </select>
    
        <label class="mt-3 mb-2"><b>Featured Image</b></label>
        <input name="featured_image" type="file" class="form-control">
        <img class="img-fluid mt-4 d-block" src="{{ Storage::url($post->featured_image) }}" alt="">
    
        <input type="submit" value="Update Post" class="btn btn-primary text-light mt-4">
    </form>

    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#tags').select2();
                tinymce.init({
                    selector: '#mytextarea',
                    plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
                    menubar: 'file edit view insert format tools table tc help',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                });

            });
        </script>
    @endpush
</x-app-layout>
