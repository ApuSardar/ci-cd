@extends('layouts.app')
@section('title', 'Create Product')
@section('content')
<div class="container mt-5">
    <h2>Create Product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <div class="row">
            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Slug -->
            <div class="col-md-6 mb-3">
                <label for="slug" class="form-label">Slug:</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug') }}" required>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Description -->
            <div class="col-md-6 mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Short Description -->
            <div class="col-md-6 mb-3">
                <label for="short_description" class="form-label">Short Description:</label>
                <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description" id="short_description" rows="4">{{ old('short_description') }}</textarea>
                @error('short_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Price -->
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price') }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

              <!-- Main Image -->
              <div class="col-md-6 mb-3">
                <label for="main_image" class="form-label">Main Image:</label>
                <input type="file" class="form-control @error('main_image') is-invalid @enderror" name="main_image" id="main_image" onchange="previewMainImage()">
                @error('main_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <!-- Main Image Preview -->
                <div id="main_image_preview" class="mt-3"></div>
            </div>
        </div>

        <div class="row">
            <!-- Multiple Images -->
             <div class="col-md-6 mb-3">
                <label for="multiple_images" class="form-label">Multiple Images:</label>
                <input type="file" class="form-control @error('multiple_images.*') is-invalid @enderror" name="multiple_images[]" id="multiple_images" multiple onchange="previewMultipleImages()">
                @error('multiple_images.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <!-- Multiple Images Preview -->
                <div id="multiple_images_preview" class="mt-3 row"></div>
            </div>

            <!-- Stock -->
            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" value="{{ old('stock') }}" required>
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Discount -->
            <div class="col-md-6 mb-3">
                <label for="discount" class="form-label">Discount (%):</label>
                <input type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" id="discount" value="{{ old('discount') }}">
                @error('discount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Minimum Dispatch Quantity -->
            <div class="col-md-6 mb-3">
                <label for="minimum_dispatch_quantity" class="form-label">Minimum Dispatch Quantity:</label>
                <input type="text" class="form-control @error('minimum_dispatch_quantity') is-invalid @enderror" name="minimum_dispatch_quantity" id="minimum_dispatch_quantity" value="{{ old('minimum_dispatch_quantity') }}" required>
                @error('minimum_dispatch_quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Minimum Order Quantity -->
            <div class="col-md-6 mb-3">
                <label for="minimum_order_quantity" class="form-label">Minimum Order Quantity:</label>
                <input type="text" class="form-control @error('minimum_order_quantity') is-invalid @enderror" name="minimum_order_quantity" id="minimum_order_quantity" value="{{ old('minimum_order_quantity') }}" required>
                @error('minimum_order_quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Send at Least -->
            <div class="col-md-6 mb-3">
                <label for="send_at_least" class="form-label">Send at Least:</label>
                <input type="text" class="form-control @error('send_at_least') is-invalid @enderror" name="send_at_least" id="send_at_least" value="{{ old('send_at_least') }}" required>
                @error('send_at_least')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Minimum Shipment Quantity -->
            <div class="col-md-6 mb-3">
                <label for="minimum_shipment_qty" class="form-label">Minimum Shipment Quantity:</label>
                <input type="text" class="form-control @error('minimum_shipment_qty') is-invalid @enderror" name="minimum_shipment_qty" id="minimum_shipment_qty" value="{{ old('minimum_shipment_qty') }}" required>
                @error('minimum_shipment_qty')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bulk Order Threshold -->
            <div class="col-md-6 mb-3">
                <label for="bulk_order_threshold" class="form-label">Bulk Order Threshold:</label>
                <input type="text" class="form-control @error('bulk_order_threshold') is-invalid @enderror" name="bulk_order_threshold" id="bulk_order_threshold" value="{{ old('bulk_order_threshold') }}" required>
                @error('bulk_order_threshold')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Minimum Pack Quantity -->
            <div class="col-md-6 mb-3">
                <label for="minimum_pack_quantity" class="form-label">Minimum Pack Quantity:</label>
                <input type="text" class="form-control @error('minimum_pack_quantity') is-invalid @enderror" name="minimum_pack_quantity" id="minimum_pack_quantity" value="{{ old('minimum_pack_quantity') }}" required>
                @error('minimum_pack_quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Required Stock for Order -->
            <div class="col-md-6 mb-3">
                <label for="required_stock_for_order" class="form-label">Required Stock for Order:</label>
                <input type="text" class="form-control @error('required_stock_for_order') is-invalid @enderror" name="required_stock_for_order" id="required_stock_for_order" value="{{ old('required_stock_for_order') }}" required>
                @error('required_stock_for_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Order Min Quantity -->
            <div class="col-md-6 mb-3">
                <label for="order_min_quantity" class="form-label">Order Min Quantity:</label>
                <input type="text" class="form-control @error('order_min_quantity') is-invalid @enderror" name="order_min_quantity" id="order_min_quantity" value="{{ old('order_min_quantity') }}" required>
                @error('order_min_quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Product</button>
    </form>
</div>
@endsection

@section('js')
<script>
<!-- Custom JS for Image Previews -->

    function previewMainImage() {
        const mainImageInput = document.getElementById('main_image');
        const previewContainer = document.getElementById('main_image_preview');
        previewContainer.innerHTML = ''; // Clear previous preview

        if (mainImageInput.files && mainImageInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'mb-3');
                img.style.maxWidth = '200px';
                previewContainer.appendChild(img);

                // Add remove button
                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'mt-2');
                removeButton.onclick = function() {
                    mainImageInput.value = ''; // Clear input
                    previewContainer.innerHTML = ''; // Clear preview
                };
                previewContainer.appendChild(removeButton);
            };
            reader.readAsDataURL(mainImageInput.files[0]);
        }
    }

    function previewMultipleImages() {
        const multipleImagesInput = document.getElementById('multiple_images');
        const previewContainer = document.getElementById('multiple_images_preview');
        previewContainer.innerHTML = ''; // Clear previous previews

        Array.from(multipleImagesInput.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('col-md-4', 'mb-3', 'position-relative');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail');
                img.style.maxWidth = '100%';
                imgContainer.appendChild(img);

                // Add remove button
                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute', 'top-0', 'end-0');
                removeButton.onclick = function() {
                    multipleImagesInput.value = ''; // Clear input
                    previewContainer.innerHTML = ''; // Clear all previews
                    previewMultipleImages(); // Rebuild preview with remaining images
                };
                imgContainer.appendChild(removeButton);

                previewContainer.appendChild(imgContainer);
            };
            reader.readAsDataURL(file);
        });
    }

</script>
@endsection
