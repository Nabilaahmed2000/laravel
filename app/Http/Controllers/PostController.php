<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Queue;

Queue::push(new PruneOldPostsJob);

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
    }
    public function show($id)
    {
        $post = Post::find($id);  
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
public function store(StorePostRequest $request)
    {
        $data = $request->all();
        // dd($data);
        // dd($request->file('image'));
        if($request->file('image')){
            $file_extension=$request->image->getClientOriginalExtension();
            $file_name=time().'.'.$file_extension;
            $path ='images/posts';
            $request->file('image')->move( $path,$file_name);
            Post::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],
                'image'=>$file_name

            ]);
        }
        else{
            Post::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],

            ]);
        }
        return redirect('/posts')->with('success', 'Your posts has been created successfully!');
    }
    public function edit($id)
    {
        $post=Post::all()->where('id',$id);
        $users = User::all();
        return view('posts.edit',[
            'post' => $post,'users' => $users
        ]);
    }

public function update($id,StorePostRequest $request)
    {
        $post = Post::find($id);
          if ($post) {
              $post->update($request->except('image'));
              if ($request->hasFile('image')) {
                  $old_image = $post->image;
                  $image = $request->image;
                  $image_new_name = time() .'.'. $image->getClientOriginalExtension();
                  if ($image->move('images/posts', $image_new_name)) {
                      unlink('images/posts/'.$old_image);
                  }
                  $post->image = $image_new_name;
              }
          }
            $post->save();
            return redirect('/posts')->with('success', 'Your posts has been updated successfully!');
    }
    
public function delete($id)
    {
        echo $id;
        $deleted = Post::where('id', $id)->delete();
        return redirect('/posts')->with('success', 'Item has been deleted!');
    }

}
