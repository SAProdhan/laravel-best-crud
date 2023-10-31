@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

    <form action="{{ route('product.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input class="form-control" name="title" type="text" id="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" cols="50" rows="10" id="description"></textarea>
        </div>
        <!-- <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input class="form-control" name="quantity" type="number" id="quantity">
        </div> -->
        <div class="mb-3">
            <label for="base_price" class="form-label">Base price</label>
            <input class="form-control" step=".01" name="base_price" type="number" id="base_price">
        </div>
        <div class="mb-3" id="variation_warper">
            <div class="row mb-3">
                <div class="col-sm-3">
                    <input class="form-control" type="text" name="variation[0][title]" placeholder="Enter variation title" required>
                </div>
                <div class="col-sm-3">
                    <input class="form-control" type="number" name="variation[0][quantity]" placeholder="Enter quantity" title="Enter Quantity" required>
                </div>
                <div class="col-sm-3">
                    <input class="form-control" type="number" step=".01" name="variation[0][additional_price]" placeholder="Enter Additional Price" title="Additional price" value="0" required>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-primary add_form_field">Add New Field &nbsp;
                        <span style="font-size:16px; font-weight:bold;">+ </span>
                    </button>
                </div>
            </div>

        </div>
        <input class="btn btn-primary" type="submit" value="Create">
    </form>

@endsection


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $("#variation_warper");
        var add_button = $(".add_form_field");

        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append(`<div class="row mb-3">
                <div class="col-sm-3">
                    <input class="form-control" type="text" name="variation[`+x+`][title]" placeholder="Enter variation title" required>
                </div>
                <div class="col-sm-3">
                    <input class="form-control" type="number" name="variation[`+x+`][quantity]" placeholder="Enter quantity" title="Enter Quantity" required>
                </div>
                <div class="col-sm-3">
                    <input class="form-control" type="number" name="variation[`+x+`][additional_price]" step=".01" placeholder="Enter Additional Price" title="Additional price" value="0" required>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-danger delete">Delete &nbsp;
                        <span style="font-size:16px; font-weight:bold;"> - </span>
                    </button>
                </div>
            </div>`); //add input box
            } else {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').parent('.row').remove();
            x--;
        })
    });

</script>
@endsection
