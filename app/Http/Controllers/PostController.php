<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view( 'admin.posts.index', [
            'posts' => Post::latest()->paginate( 15 ),
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view( 'admin.posts.create-post', [
            'categories' => Category::pluck( 'name', 'id' ),
            'tags'       => Tag::pluck( 'name', 'id' ),
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        // dd( $request->all() );
        $validatedData = $request->validate( [
            'title'          => 'required|string',
            'description'    => 'nullable',
            'category_id'    => 'integer|nullable',
            'featured_image' => 'nullable',
            'tag_id'         => 'array|nullable',
        ] );

        if( isset($validatedData['tag_id']) ){
            $tags = $validatedData['tag_id'];
            unset($validatedData['tags']);
        }

        if( isset($validatedData['featured_image']) ){
            $path = $validatedData['featured_image']->store('featured-images');
            $validatedData['featured_image'] = $path;
        }

        $validatedData['user_id'] = Auth::user()->id;
        $post = Post::create($validatedData);

        if(isset($tags)){
            $post->tags()->sync($tags);
        }

        return redirect()->route('posts.index')->with('success','Post added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show( $slug ) {
        return view( 'frontend.post', [
            'post' => Post::whereSlug($slug)->first()
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit( Post $post ) {
        return view('admin.posts.edit-post',[
            'post' => $post,
            'categories' => Category::pluck( 'name', 'id' ),
            'tags'       => Tag::pluck( 'name', 'id' ),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Post $post ) {
        $validatedData = $request->validate( [
            'title'          => 'required|string',
            'description'    => 'nullable',
            'category_id'    => 'integer|nullable',
            'featured_image' => 'nullable',
            'tag_id'         => 'array|nullable',
        ] );

        if( isset($validatedData['tag_id']) ){
            $tags = $validatedData['tag_id'];
            unset($validatedData['tags']);
        }

        if( isset($validatedData['featured_image']) ){
            $path = $validatedData['featured_image']->store('featured-images');
            $validatedData['featured_image'] = $path;
        }

        $post->update($validatedData);

        if(isset($tags)){
            $post->tags()->sync($tags);
        }

        return redirect()->route('posts.edit',['post'=>$post->id])->with('success','Post updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy( Post $post ) {
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('posts.index')->with('success','Post deleted successfully');
    }
}
