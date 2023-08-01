@extends('layouts.dashboard')
@section('title','products')
@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Product</li>
  @endsection
@section('content')
<div class="mb-5">
    <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
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
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
   <tboady>
      
      @forelse($products as $product)
    <tr>
        <td><img src="{{asset('storage/'.$product->image)}}" alt="" height="50"></td>
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->category()->first()->name}}</td>
        <td>{{$product->store->name}}</td>
        <td>{{$product->status}}</td>
        <td>{{$product->created_at}}</td>
        <td>
        <a href="{{ route('products.edit', $product->id) }}"class="btnbtn-smbtn-outline-success">Edit<a>
        </td>
        <td>
        <form action="{{ route('products.destroy', $product->id) }}" method="post">
        @csrf
       @method('delete')
       <button type="submit" class="btn btn-sm btn-outline-danger ">Delete</button>
       </form>

        </td>
    </tr>
    @empty
    <tr>
     <td colspan="9">No products defined.</td>
    </tr>
      @endforelse
   </tboady>
</table>
{{$products->withQueryString()->appends(['search'=>1])->links()}}
@endsection