@extends('layouts.app')

@section('title', 'Details for ' . $customer->name)
    

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Details for {{$customer->name}}</h1>
        <p><a href="{{ route('customers.edit', ['customer' => $customer]) }}">Edit</a></p>

        <form action="{{ route('customers.destroy', ['customer' => $customer]) }}" method="POST">
            @method('delete')
            @csrf    
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <p><strong>Name</strong> {{$customer->name}}</p>
    </div>
</div>

@if($customer->image)
    <div class="row">
        <div class="col-12"><img src="{{ asset('storage/' . $customer->image) }}" alt="" class="img-thumbnail"></div>
    </div>
@endif

@endsection