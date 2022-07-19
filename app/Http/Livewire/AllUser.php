<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\User as Users;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class AllUser extends Component {

    use WithPagination;

    public $user;

    public $delete_id;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'user.name'     => ['required', 'string', 'max:255'],
        'user.email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'user.password' => ['required', 'string'],
        'user.phone'    => ['required'],
        // 'user.phone' => ['required', 'min:0', 'max:11'],
        'user.role'     => ['required', 'string'],
    ];

    public function create_user() {
        $this->validate();

        $this->user['password'] = Hash::make( $this->user['password'] );

        User::create( $this->user );
        $this->user = [];

        $this->dispatchBrowserEvent( 'modalClose', ['newName' => 'nibi'] );

        session()->flash( 'success', 'User created successfully' );
    }

    public function update_user() {
        $validatedData = $this->validate( [
            'user.name'     => ['required', 'string', 'max:255'],
            'user.email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user['id']],
            'user.password' => ['nullable', 'string'],
            'user.phone'    => ['required'],
            // 'user.phone' => ['required', 'min:0', 'max:11'],
            'user.role'     => ['required', 'string'],
        ] );

        if ( isset( $validatedData['user']['password'] ) ) {
            $validatedData['user']['password'] = Hash::make( $validatedData['user']['password'] );
        }

        User::findOrFail( $this->user['id'] )->update( $validatedData['user'] );

        $this->user = [];
        $this->dispatchBrowserEvent( 'modalClose', ['newName' => 'nibi'] );

        session()->flash( 'success', 'User updated successfully' );
    }

    public function edit_user( $id ) {
        $this->user = User::findOrFail( $id )->toArray();
    }

    public function set_delete_user( $id ) {
        $this->delete_id = $id;
    }

    public function delete_user() {
        User::findOrFail($this->delete_id)->delete();
        $this->delete_id = null;
        $this->dispatchBrowserEvent( 'modalClose' );
        session()->flash( 'success', 'User deleted successfully' );
    }

    public function render() {
        return view( 'livewire.all-user', [
            'users' => Users::paginate( 10 ),
        ] );
    }

}
