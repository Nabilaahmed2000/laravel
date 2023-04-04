<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
        // $allPosts = Post::all();
        // return view('posts.index', ['posts'=> $allPosts]);
    }
    public function show($id)
    {
        $post = Post::find($id);  //query in db select * from posts where id = $postId
        $user_id=$post->user_id;
        $user =User::find($user_id);
        return view('posts.show',[ 'post' => $post,'user' =>$user]);
    }
public function create()
    {
        $users = User::all();

        return view('posts.create',[
            'users' => $users
        ]);

        return view('posts.create');
    }
public function store(Request $request)
    {
        $data = $request->all();
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],

        ]);
        return redirect('/posts')->with('success', 'Your posts has been created successfully!');
    }
    public function edit($id)
    {
        $post=Post::all()->where('id',$id);
        //query in db select * from posts where id = $postId
        $users = User::all();
        return view('posts.edit',[
            'post' => $post,'users' => $users
        ]);
    }

public function update($id,Request $request)
    {
        $data = $request->all();
        Post::where('id',$id)
        ->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
            ]);
            return redirect('/posts')->with('success', 'Your posts has been updated successfully!');
    }
    
// public function delete()
//     {
//         //do some actionto delete post
//         // return view('posts.index', ['posts'=> $this -> allPosts]);
//         return redirect('/posts')->with('error', 'Are You Sure You Want To Delete This Post !!');

//     }

}
