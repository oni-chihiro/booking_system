@extends('layouts.app')

@section('content')

<h2>Upload Documents</h2>

<form action="{{ route('sales.store', 3) }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    <label>Upload Documents</label>
    <input type="file" name="documents[]" multiple>

    @error('documents.*')
        <p class="error">{{ $message }}</p>
    @enderror
    
    <a href="{{ route('sales.show',2) }}">
    <button type="button">Back</button></a>
    <button type="submit">Submit</button>
</form>

@endsection