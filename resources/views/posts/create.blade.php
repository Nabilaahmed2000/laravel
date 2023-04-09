@extends('layouts.app')

@section('title') Create @endsection
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <form action="{{ROUTE('posts.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        @method('POST')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea name="description" class="form-control"  rows="3"></textarea>
        </div>
        <div class="mb-3">
                    <label  class="form-label">Image</label>
                    <input class="form-control form-control-lg" name="image" id="formFileLg" type="file">
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
