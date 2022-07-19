<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component {

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $category;

    public $delete_id;

    public $bulkDeleteId = [];

    public $showAddForm  = true;
    public $showEditForm = false;

    protected $rules = [
        'category.name'        => ['required', 'string', 'max:255'],
        'category.description' => ['nullable'],
    ];

    public function add() {
        $this->validate();

        Category::create( $this->category );

        $this->category = [];
        session()->flash( 'success', 'Category Created Successfully' );
    }

    public function edit_category( $id ) {
        $this->category     = Category::findOrFail( $id )->toArray();
        $this->showAddForm  = false;
        $this->showEditForm = true;
    }

    public function update_category() {
        $validatedData = $this->validate( [
            'category.name'        => ['required', 'string', 'max:255'],
            'category.description' => ['nullable'],
        ] );

        Category::findOrFail( $this->category['id'] )->update( $validatedData['category'] );
        $this->category     = [];
        $this->showAddForm  = true;
        $this->showEditForm = false;
        session()->flash( 'success', 'Category Updated Successfully' );
    }

    public function set_delete_category( $id ) {
        $this->delete_id = $id;
    }

    public function delete_category() {
        Category::findOrFail( $this->delete_id )->delete();
        $this->delete_id = null;
        $this->dispatchBrowserEvent( 'modalClose' );
        session()->flash( 'success', 'Category deleted successfully' );
    }

    public function bulkDelete() {
        $categoryToDelete = [];

        foreach($this->bulkDeleteId as $key => $value){
            if( $value ){
                $categoryToDelete[] = $key;
            }
        }

        Category::destroy($categoryToDelete);
        $this->bulkDeleteId = [];
        $this->dispatchBrowserEvent( 'modalClose' );
        session()->flash( 'success', 'Categories deleted successfully' );
    
    }

    public function cancel_edit() {
        $this->category     = [];
        $this->showAddForm  = true;
        $this->showEditForm = false;
    }

    public function render() {
        return view( 'livewire.category-component', [
            'categories' => Category::paginate( 15 ),
        ] );
    }
}
