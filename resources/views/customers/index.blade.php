@extends('layouts.app')

@section('title', 'Customer List')
    

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Customers List</h1>
    </div>
</div>

@can('create', App\Customer::class)
<div class="row">
    <div class="col-12">
        <p><a href="customers/create">Create Customer</a></p>
    </div>
</div>
@endcan


@foreach($customers as $customer)

<div class="row">
    
    <div class="col-2">
        {{$customer->id}}
    </div>
    @can('view', $customer)
        {{-- <a href="/customers/{{$customer->id}}">{{$customer->name}}</a> --}}
        ass="col-4"><a href="{{ route('customers.show', ['customer'=>$customer]) }}">{{$customer->name}}</a></div>
    @endcan

    @cannot('view', $customer)
        {{ $customer->name }}
    @endcannot
    
    <div class="col-4">{{$customer->company->name}}</div>
    <div class="col-2">{{$customer->active}}</div>
    
</div> 
@endforeach

<div class="row">
    <div class="col-12 f-flex justify-content-center pt-5">
        {{ $customers->links() }}
    </div>
</div>

    {{-- <div class="row">
        <div class="col-12">
            @foreach ($companies as $company)
                <h3>{{ $company->name}}</h3>

                <ul>
                    @foreach ($company->customers as $customer)
                        <li>{{ $customer->name}}</li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div> --}}
@endsection