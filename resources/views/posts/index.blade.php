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
                <td>{{ isset($post->user) ? $post->user->name : 'Not Found' }}</td>
                <td>{{ $post->created_at->format("Y-m-d")}}</td>
                <td>
                    <a href="/posts/{{$post['id']}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-primary">Edit</a>
                    <a href="/posts/delete/{{$post['id']}}" id='delete' class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
    <script>
            const del=document.getElementById('delete');
            del.addEventListener('click',function(e){
                const c=confirm("You Sure Continue Deleted !");
                if(c == false){
                    e.preventDefault();
                }
            })
        </script>

@endsection

