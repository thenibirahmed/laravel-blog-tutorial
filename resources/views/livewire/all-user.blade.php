<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3 text-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add User
    </button>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    <table class="table table-bordered table-hover">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Phone</th>
            <th>Post Count</th>
            <th>Actions</th>
        </tr>
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->posts->count() }}</td>
                <td>
                    <button type="button" wire:click="edit_user( {{ $user->id }} )" class="btn btn-primary mb-3 text-light" data-bs-toggle="modal" data-bs-target="#editModal">
                        Edit User
                    </button>
                    <button type="button" wire:click="set_delete_user( {{ $user->id }} )" class="btn btn-danger mb-3 text-light" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Delete User
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No users found</td>
            </tr>
        @endforelse

    </table>

    {{ $users->links() }}

    <!-- Create Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="create_user">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @csrf

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Name') }}" />

                            <input wire:model.debounce.500ms="user.name" class="{{ $errors->has('name') ? 'is-invalid form-control' : 'form-control' }}" type="text"
                                name="name" value="{{ old('name') }}" autofocus autocomplete="name" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Email') }}" />

                            <input wire:model.debounce.500ms="user.email" class="{{ $errors->has('email') ? 'is-invalid form-control' : 'form-control' }}" type="email"
                                name="email" value="{{ old('email') }}" />
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Phone') }}" />

                            <input wire:model.debounce.500ms="user.phone" class="{{ $errors->has('phone') ? 'is-invalid form-control' : 'form-control' }}" type="text"
                                name="phone" value="{{ old('phone') }}" />
                            <x-jet-input-error for="phone"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Role') }}" />

                            <select wire:model.debounce.500ms="user.role" class="form-control">
                                <option value="author">Author</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Password') }}" />

                            <input wire:model.debounce.500ms="user.password" class="{{ $errors->has('password') ? 'is-invalid form-control' : 'form-control' }}" type="password"
                                name="password" autocomplete="new-password" />
                            <x-jet-input-error for="password"></x-jet-input-error>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="mb-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <x-jet-button>
                                {{ __('Register') }}
                            </x-jet-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="update_user">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Add Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @csrf

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Name') }}" />

                            <input wire:model.debounce.500ms="user.name" class="{{ $errors->has('name') ? 'is-invalid form-control' : 'form-control' }}" type="text"
                                name="name" value="{{ old('name') }}" autofocus autocomplete="name" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Email') }}" />

                            <input wire:model.debounce.500ms="user.email" class="{{ $errors->has('email') ? 'is-invalid form-control' : 'form-control' }}" type="email"
                                name="email" value="{{ old('email') }}" />
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Phone') }}" />

                            <input wire:model.debounce.500ms="user.phone" class="{{ $errors->has('phone') ? 'is-invalid form-control' : 'form-control' }}" type="text"
                                name="phone" value="{{ old('phone') }}" />
                            <x-jet-input-error for="phone"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Role') }}" />

                            <select wire:model.debounce.500ms="user.role" class="form-control">
                                <option value="author">Author</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Password') }}" />

                            <input type="password" class="form-control" wire:model="user.password">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="mb-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <x-jet-button>
                                {{ __('Update') }}
                            </x-jet-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete User?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:click="delete_user" class="btn btn-danger text-light">Delete Now!</button>
                    </div>
                </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            window.addEventListener('modalClose', event => {
                $('#exampleModal').modal('hide')
                $('#editModal').modal('hide')
                $('#deleteModal').modal('hide')
            })
        </script>
    @endpush


</div>
