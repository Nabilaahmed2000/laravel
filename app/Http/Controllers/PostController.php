<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
   private $allPosts = [
        [
            'id' => 1,
            'title' => 'Laravel',
            'description' => 'hello laravel',
            'posted_by' => 'Nabila',
            'created_at' => '2023-04-01 10:00:00',
        ],

        [
            'id' => 2,
            'title' => 'PHP',
            'description' => 'hello php',
            'posted_by' => 'Habiba',
            'created_at' => '2023-04-01 10:00:00',
        ],

        [
            'id' => 3,
            'title' => 'Javascript',
            'description' => 'hello javascript',
            'posted_by' => 'Somaya',
            'created_at' => '2023-04-01 10:00:00',
        ],
        [
            'id' => 4,
            'title' => 'BootStrap',
            'description' => 'hello BootStrap',
            'posted_by' => 'Mariam',
            'created_at' => '2023-04-01 10:00:00',
        ],
    ];
    public function index()
    {
        return view('posts.index', ['posts'=> $this -> allPosts]);
    }
    public function show($id)
    {
        $post = [
            'id' => 1,
                'title' => 'Laravel',
                'description' => 'hello laravel',
                'posted_by' => 'Nabila',
                'created_at' => '2023-04-01 10:00:00'
        ];

        return view('posts.show', ['post' => $post]);
    }
public function create()
    {

        return view('posts.create');
    }
public function store()
    {

        return view('posts.index', ['posts'=> $this -> allPosts]);
        return redirect('/posts')->with('success', 'Your posts has been created successfully!');
    }
public function edit()
    {
        
        return view('posts.edit');
    }
public function update()
    {
        //do some actionto update post
        // return view('posts.index', ['posts'=> $this -> allPosts]);
        return redirect('/posts')->with('success', 'Your posts has been updated successfully!');
    }
public function delete()
    {
        //do some actionto delete post
        // return view('posts.index', ['posts'=> $this -> allPosts]);
        return redirect('/posts')->with('error', 'Are You Sure You Want To Delete This Post !!');

    }

}
