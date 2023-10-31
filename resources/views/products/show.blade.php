@extends('default')

@section('content')
    <hr>
    <pre>
        {{ printf($product) }}
    </pre>
    <hr>
    <h6>Variations</h6>
    <br>
	{{ $product->variations }}

@stop
