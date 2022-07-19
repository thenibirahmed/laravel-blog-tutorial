<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Tags') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-md-6">
            @if ($showAddForm)  
                <h2>Add Tag</h2>
            @endif
            @if ($showEditForm)  
                <h2>Edit Tag</h2>
            @endif

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

            @if ($showAddForm)   
            <!-- Add Form -->
            <form class="mt-4" wire:submit.prevent="add">
                <label>Name</label>
                <input wire:model.debounce.500ms="tag.name" type="text" class="form-control">                

                <label class="mt-3">Description</label>
                <textarea wire:model.debounce.500ms="tag.description" rows="5" class="form-control"></textarea>

                <input type="submit" value="Add" class="btn btn-primary text-light mt-3">
            </form>
            @endif

            @if ($showEditForm)    
                <!-- Edit Form -->
                <form class="mt-4" wire:submit.prevent="update_tag">
                    <label>Name</label>
                    <input wire:model.debounce.500ms="tag.name" type="text" class="form-control">                

                    <label class="mt-3">Description</label>
                    <textarea wire:model.debounce.500ms="tag.description" rows="5" class="form-control"></textarea>

                    <input type="submit" value="Update" class="btn btn-primary text-light mt-3">
                </form>
                <button wire:click="cancel_edit" class="btn btn-danger text-light mt-3">Cancel</button>
            @endif
        </div>
        <div class="col-md-6">
            <h2>All Tags</h2>
            <table class="table table-bordered table-hover mt-5">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                
                    @forelse ($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->description ?? '' }}</td>
                            <td>
                                <button wire:click="edit_tag({{ $tag->id }})" class="btn btn-primary text-light">Edit</button>
                                <button type="button" wire:click="set_delete_tag( {{ $tag->id }} )" class="btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr colspan="3">
                            <td colspan="3">No Tags Found</td>                        
                        </tr>
                    @endforelse
                
            </table>
        </div>
    </div>


    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Tag?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:click="delete_tag" class="btn btn-danger text-light">Delete Now!</button>
                    </div>
                </div>
        </div>
    </div>


    @push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        window.addEventListener('modalClose', event => {
            $('#deleteModal').modal('hide')
        })
    </script>
@endpush

</div>
