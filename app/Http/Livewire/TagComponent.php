<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class TagComponent extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $tag;

    public $delete_id;

    public $showAddForm  = true;
    public $showEditForm = false;

    protected $rules = [
        'tag.name'        => ['required', 'string', 'max:255'],
        'tag.description' => ['nullable'],
    ];

    public function add() {
        $this->validate();

        Tag::create( $this->tag );

        $this->tag = [];
        session()->flash( 'success', 'Tag Created Successfully' );
    }

    public function edit_tag( $id ) {
        $this->tag     = Tag::findOrFail( $id )->toArray();
        $this->showAddForm  = false;
        $this->showEditForm = true;
    }

    public function update_tag() {
        $validatedData = $this->validate( [
            'tag.name'        => ['required', 'string', 'max:255'],
            'tag.description' => ['nullable'],
        ] );

        Tag::findOrFail( $this->tag['id'] )->update( $validatedData['tag'] );
        $this->tag     = [];
        $this->showAddForm  = true;
        $this->showEditForm = false;
        session()->flash( 'success', 'Tag Updated Successfully' );
    }

    public function set_delete_tag( $id ) {
        $this->delete_id = $id;
    }

    public function delete_tag() {
        Tag::findOrFail( $this->delete_id )->delete();
        $this->delete_id = null;
        $this->dispatchBrowserEvent( 'modalClose' );
        session()->flash( 'success', 'Tag deleted successfully' );
    }

    public function cancel_edit() {
        $this->tag     = [];
        $this->showAddForm  = true;
        $this->showEditForm = false;
    }

    public function render() {
        return view( 'livewire.tag-component',[
            'tags' => Tag::paginate(15),
        ] );
    }
}
