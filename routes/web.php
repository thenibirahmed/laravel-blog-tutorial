<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Livewire\AllUser;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\TagComponent;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get( '/', [FrontendController::class, 'frontpage'] );
Route::get( 'about', [FrontendController::class, 'about'] )->name( 'about' );
Route::get( 'contact', [FrontendController::class, 'contact'] )->name( 'contact' );
Route::get( 'post/{slug}', [PostController::class, 'show'] )->name( 'post.show' );

Route::middleware( ['auth:sanctum', config( 'jetstream.auth_session' ), 'verified'] )->group( function () {

    Route::get( '/dashboard', function () {
        return view( 'dashboard', [
            'postCount'     => Post::count(),
            'tagCount'      => Tag::count(),
            'categoryCount' => Category::count(),
            'posts'         => Post::latest()->take(5)->get('title'),
        ] );
    } )->name( 'dashboard' );

    Route::get( 'users', AllUser::class )->name( 'users' );
    Route::get( 'categories', CategoryComponent::class )->name( 'categories' );
    Route::get( 'tags', TagComponent::class )->name( 'tags' );

    Route::resource( 'posts', PostController::class )->except( 'show' );
    Route::view( 'filemanager', 'admin.filemanager.filemanager' )->name( 'filemanager' );
    Route::view( 'sms', 'admin.sms.sms' )->name( 'sms' );
    Route::post( 'sms', function ( Request $request ) {
        $request->validate( [
            'message' => 'required|string',
        ] );

        return redirect()->back()->with( 'success', 'SMS Send Successfully' );
    } )->name( 'sms.send' );

} );
