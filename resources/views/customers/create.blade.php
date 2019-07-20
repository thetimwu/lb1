@extends('layouts.app')

@section('title', 'Add Customer')
    

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Add New Customer</h1>
        
    </div>
</div>

<div class="row">
        <div class="col-12">
            <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
                   
                @include('customers.form')
    
                <button type="submit" class="btn btn-primary">Add Customer</button>
            
                
            </form>
        </div>
    </div>

@endsection