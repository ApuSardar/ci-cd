@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class="container mt-5">
        <h1>Product List</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create New Product</a>
        <a href="{{ route('products.update-discount') }}" class="btn btn-warning mb-3">Apply Discount to All Products</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="products-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('products.index') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
