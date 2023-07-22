@extends('layouts.dashboard')
@section('title','categories')
@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Categories</li>
  @endsection
@section('content')
<div class="mb-5">
    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">Create</a>
</div>
@if(session()->has('success'))
<div class="alert-alert-success">
    {{session('success')}}
</div>

@endif
@if(session()->has('info'))
<div class="alert-alert-info">
    {{session('info')}}
</div>

@endif
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
   <tboady>
      
      @forelse($categories as $category)
    <tr>
        <td><img src="{{asset('storage/'.$category->image)}}" alt="" height="50"></td>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->parent_id}}</td>
        <td>{{$category->created_at}}</td>
        <td>
        <a href="{{ route('categories.edit', $category->id) }}"class="btnbtn-smbtn-outline-success">Edit<a>
        </td>
        <td>
        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
        @csrf
       @method('delete')
       <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
       </form>

        </td>
    </tr>
    @empty
    <tr>
     <td colspan="7">No categories defined.</td>
    </tr>
      @endforelse
   </tboady>
</table>
@endsection