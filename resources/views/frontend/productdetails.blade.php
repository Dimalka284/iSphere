@extends('layouts.frontend')

@section('content')
<div class="min-h-screen pt-8 pb-24 bg-white">
    <livewire:product-slider :product="$product" />
</div>
@endsection