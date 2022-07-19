<?php

namespace App\Http\Controllers;

use App\Models\Post;

class FrontendController extends Controller {
    public function frontpage() {
        return view( 'frontend.index', [
            'posts' => Post::latest()->simplePaginate( 10 ),
        ] );
    }

    public function about() {
        return view('frontend.about');
    }

    public function contact() {
        return view('frontend.contact');
    }
}
