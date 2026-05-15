@extends('layouts.frontend')
@section('content')

<div>
    <h1>MacBook<h1>
    @foreach ($products as $product)
        <div class="card">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }}</p>
            <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-1000 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-110" loading="lazy">
        </div>
    @endforeach
</div>


@endsection
