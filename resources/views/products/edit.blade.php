@extends('default')

@section('content')

    @if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }} <br>
        @endforeach
    </div>
    @endif
    <form action="{{ route('product.update', $product->id) }}" accept-charset="UTF-8">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input class="form-control" name="title" type="text" value="{{ $product->title }}" id="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" cols="50" rows="10" id="description">{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input class="form-control" name="quantity" type="number" value="{{ $product->quantity }}" id="quantity">
        </div>
        <div class="mb-3">
            <label for="base_price" class="form-label">Base price</label>
            <input class="form-control" step=".01" name="base_price" type="number" value="{{ $product->base_price }}" id="base_price">
        </div>

        <input class="btn btn-primary" type="submit" value="Edit">
    </form>

@stop
