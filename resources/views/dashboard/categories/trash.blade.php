@extends('layouts.dashboard')
@section('title','Trashed categories')
@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Categories</li>
  @endsection
@section('content')
<div class="mb-5">
    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-primary">Back</a>
</div>
<x-alert type="success"/>
<x-alert type="info"/>
<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')"/>
    <select name="status" class="form-control" class="mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status')== 'active')>Active</option>
        <option value="archived" @selected(request('status')== 'archived')>Archived</option>
    </select>
   <button class="btn btn-dark mx-2">Filter</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Deleted At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
   <tboady>
      
      @forelse($categories as $category)
    <tr>
        <td><img src="{{asset('storage/'.$category->image)}}" alt="" height="50"></td>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->parent_name}}</td>
        <td>{{$category->status}}</td>
        <td>{{$category->deleted_at}}</td>
        <td>
        <form action="{{ route('categories.restore', $category->id) }}" method="post">
        @csrf
       @method('put')
       <button type="submit" class="btn btn-sm btn-outline-info ">Restore</button>
       </form>

        </td>
        <td>
        <form action="{{ route('categories.force-delete', $category->id) }}" method="post">
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
{{$categories->withQueryString()->appends(['search'=>1])->links()}}
@endsection