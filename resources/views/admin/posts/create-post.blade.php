<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <a href="{{ route('posts.index') }}" class="btn btn-primary mb-3 text-light">Go Back</a> <br>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <h2>Add Post</h2>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="mt-3"><b>Title</b></label>
        <input name="title" type="text" class="form-control">
    
        <label class="mt-3"><b>Description</b></label>
        <textarea name="description" id="mytextarea" cols="30" rows="10" class="form-control"></textarea>
    
        <label class="mt-3"><b>Category</b></label>
        <select name="category_id" id="" class="form-control">
            @foreach ($categories as $cat_id => $category)
                <option value="{{ $cat_id }}">{{ $category }}</option>
            @endforeach
        </select>
    
        <label class="mt-3"><b>Tags</b></label>
        <select name="tag_id[]" id="tags" multiple class="form-control">
            @foreach ($tags as $tag_id => $tag)
                <option value="{{ $tag_id }}">{{ $tag }}</option>
            @endforeach
        </select>
    
        <label class="mt-3 mb-2"><b>Featured Image</b></label>
        <input name="featured_image" type="file" class="form-control">
    
        <input type="submit" value="Create Post" class="btn btn-primary text-light mt-4">
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
