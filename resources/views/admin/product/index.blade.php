@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Products</h4>

        <button type="button" class="btn btn-primary mb-3" id="addProductButton">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Add Product
        </button>

        <table id="dataTable" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#dataTable').DataTable({
                "bDestroy": true,
                ajax: '{{ route("product.datatable") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'category.name', name: 'category.name' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'price', name: 'price' },
                    { data: 'stock', name: 'stock' },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, row) {
                            const imageUrl = data ? `{{ asset('storage/') }}/${data}` : 'https://placehold.co/200x200';
                            return `<img src="${imageUrl}" alt="${row.name}" width="50">`;
                        }
                    },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex justify-content-around">
                                    <a href="#" class="btn btn-info btn-sm mx-1" title="View" onclick="viewProduct(${row.id})">
                                        <i class='bx bx-show'></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-sm mx-1" title="Edit" onclick="editProduct(${row.id})">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm mx-1" title="Delete" onclick="deleteProduct(${row.id})">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>`;
                        }
                    }
                ]
            });


            $('#addProductButton').click(function() {
                $.ajax({
                    url: '/categories',
                    method: 'GET',
                    success: function(response) {
                        let categoryOptions = '';
                        response.data.forEach(category => {
                            categoryOptions += `<option value="${category.id}">${category.name}</option>`;
                        });

                        Swal.fire({
                            title: 'Add Product',
                            html: `
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select id="productCategory" class="form-control">
                            ${categoryOptions}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Name</label>
                        <input id="productName" class="form-control" type="text" placeholder="Enter product name">
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <input id="productDescription" class="form-control" type="text" placeholder="Enter product description">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input id="productPrice" class="form-control" type="number" placeholder="Enter product price">
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock</label>
                        <input id="productStock" class="form-control" type="number" placeholder="Enter product stock">
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input id="productImage" class="form-control" type="file">
                    </div>
                `,
                            showCancelButton: true,
                            confirmButtonText: 'Add',
                            preConfirm: () => {
                                const category_id = $('#productCategory').val();
                                const name = $('#productName').val();
                                const description = $('#productDescription').val();
                                const price = $('#productPrice').val();
                                const stock = $('#productStock').val();
                                const image = $('#productImage')[0].files[0];
                                return { category_id, name, description, price, stock, image };
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const formData = new FormData();
                                formData.append('category_id', result.value.category_id);
                                formData.append('name', result.value.name);
                                formData.append('description', result.value.description);
                                formData.append('price', result.value.price);
                                formData.append('stock', result.value.stock);
                                formData.append('image', result.value.image);

                                $.ajax({
                                    url: '/product',
                                    method: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function() {
                                        Swal.fire('Added!', 'Product has been added.', 'success');
                                        $('#dataTable').DataTable().ajax.reload();
                                    },
                                    error: function(xhr) {
                                        Swal.fire('Error', 'An error occurred while adding the product: ' + xhr.responseText, 'error');
                                    }
                                });
                            }
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'An error occurred while fetching categories.', 'error');
                    }
                });
            });
        });

        function viewProduct(id) {
            $.ajax({
                url: `/product/${id}`,
                method: 'GET',
                success: function(response) {
                    const imageUrl = response.data.image ? `{{ asset('storage/') }}/${response.data.image}` : 'https://placehold.co/500x500';
                    Swal.fire({
                        title: 'Product Details',
                        html: `
                    <p><strong>ID:</strong> ${response.data.id}</p>
                    <p><strong>Name:</strong> ${response.data.name}</p>
                    <p><strong>Description:</strong> ${response.data.description}</p>
                    <p><strong>Price:</strong> ${response.data.price}</p>
                    <p><strong>Stock:</strong> ${response.data.stock}</p>
                    <p><strong>Category:</strong> ${response.data.category.name}</p>
                    <img src="${imageUrl}" alt="${response.data.name}" width="500" height="500">
                `,
                        icon: 'info'
                    });
                },
                error: function() {
                    Swal.fire('Error', 'An error occurred while retrieving the product.', 'error');
                }
            });
        }

        function editProduct(id) {
            $.ajax({
                url: `/product/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    $.ajax({
                        url: '/categories',
                        method: 'GET',
                        success: function(categoriesResponse) {
                            let categoryOptions = '';
                            categoriesResponse.data.forEach(category => {
                                const selected = category.id === response.data.category_id ? 'selected' : '';
                                categoryOptions += `<option value="${category.id}" ${selected}>${category.name}</option>`;
                            });

                            Swal.fire({
                                title: 'Edit Product',
                                html: `
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Category</label>
                                <select id="productCategory" class="form-control">
                                    ${categoryOptions}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productName" class="form-label">Name</label>
                                <input id="productName" class="form-control" type="text" value="${response.data.name}">
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Description</label>
                                <input id="productDescription" class="form-control" type="text" value="${response.data.description}">
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Price</label>
                                <input id="productPrice" class="form-control" type="number" value="${response.data.price}">
                            </div>
                            <div class="mb-3">
                                <label for="productStock" class="form-label">Stock</label>
                                <input id="productStock" class="form-control" type="number" value="${response.data.stock}">
                            </div>
                        `,
                                showCancelButton: true,
                                confirmButtonText: 'Save',
                                preConfirm: () => {
                                    const category_id = $('#productCategory').val();
                                    const name = $('#productName').val();
                                    const description = $('#productDescription').val();
                                    const price = $('#productPrice').val();
                                    const stock = $('#productStock').val();
                                    return { category_id, name, description, price, stock };
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: `/product/${id}`,
                                        method: 'PUT',
                                        data: result.value,
                                        success: function() {
                                            Swal.fire('Updated!', 'Product has been updated.', 'success');
                                            $('#dataTable').DataTable().ajax.reload();
                                        },
                                        error: function() {
                                            Swal.fire('Error', 'An error occurred while updating the product.', 'error');
                                        }
                                    });
                                }
                            });
                        },
                        error: function() {
                            Swal.fire('Error', 'An error occurred while fetching categories.', 'error');
                        }
                    });
                },
                error: function() {
                    Swal.fire('Error', 'An error occurred while editing the product.', 'error');
                }
            });
        }

        function deleteProduct(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/product/${id}`,
                        method: 'DELETE',
                        success: function() {
                            Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                            $('#dataTable').DataTable().ajax.reload();
                        },
                        error: function() {
                            Swal.fire('Error', 'An error occurred while deleting the product.', 'error');
                        }
                    });
                }
            });
        }
    </script>
@endpush
