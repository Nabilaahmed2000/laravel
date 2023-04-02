@extends('layouts.app')

@section('title') Index @endsection

@section('content')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="text-center">
    <a href="/posts/create" class="mt-4 btn btn-success">Create Post</a>
    </div>
    <table class="table table-striped table-dark mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['posted_by']}}</td>
                <td>{{$post['created_at']}}</td>
                <td>
                    <a href="/posts/{{$post['id']}}" class="btn btn-info">View</a>
                    <a href="/posts/edit/{{$post['id']}}" class="btn btn-primary">Edit</a>
                    <a href="/posts/delete/{{$post['id']}}" class="btn btn-danger">Delete</a>
                </td>
            </tr>

        @endforeach


        </tbody>
    </table>
    <script>$('.alert').alert()</script>

@endsection

