@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('product.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>title</th>
				<th>description</th>
				<th>quantity</th>
				<th>base price</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $product)

				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->title }}</td>
					<td>{{ $product->description }}</td>
					<td>{{ $product->quantity }}</td>
					<td>{{ $product->base_price }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('product.show', [$product->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('product.edit', [$product->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $product->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
