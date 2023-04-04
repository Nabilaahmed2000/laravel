@extends('layouts.app')

@section('title') Create @endsection
@foreach ($post as $post)
@php    
        $id=$post->id ;
        $title=$post->title;
        $description=$post->description;

@endphp
@endforeach
@section('content')
<form action="{{route('posts.update',$id)}}" method="POST">
    @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea name="description" class="form-control"  rows="3"></textarea>
        </div>

        <div class="mb-3">
        <label  class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
            @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
