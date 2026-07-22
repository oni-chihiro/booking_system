@extends('layouts.app')

@section('content')

<h2>Product Information</h2>

<form action="{{ route('sales.store', 2) }}" method="POST">
    @csrf

    <label>Spa Service</label>
    <input type="text" name="product" value="{{ old('product') }}">
    @error('product')
        <p class="error">{{ $message }}</p>
    @enderror

    <label>Quantity</label>
    <input type="number" name="quantity" value="{{ old('quantity') }}">
    @error('quantity')
        <p class="error">{{ $message }}</p>
    @enderror

    <label>Price</label>
    <input type="number" step="0.01" name="price" value="{{ old('price') }}">
    @error('price')
        <p class="error">{{ $message }}</p>
    @enderror

    <a href="{{ route('sales.show',1) }}"><button type="button">Back</button></a>
    <button type="submit">Next</button>

</form>

@endsection