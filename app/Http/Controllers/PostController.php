<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(){
        $data = request()->validate([
            'body' => '',

        ]);

        Post::create($data);

        return response([], 201);  // nothing got created
    }
}
