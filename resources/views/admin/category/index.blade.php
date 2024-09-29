@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Categories</h4>

        <button type="button" class="btn btn-primary mb-3" id="addCategoryButton">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Add Category
        </button>

        <table id="dataTable" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
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
                ajax: '{{ route("category.datatable") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex justify-content-around">
                                    <a href="#" class="btn btn-warning btn-sm mx-1" title="Edit" onclick="editCategory(${row.id})">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm mx-1" title="Delete" onclick="deleteCategory(${row.id})">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>`;
                        }
                    }
                ]
            });

            $('#addCategoryButton').click(function() {
                Swal.fire({
                    title: 'Add Category',
                    html: `
                        <input id="categoryName" class="swal2-input" placeholder="Name">
                        <input id="categoryDescription" class="swal2-input" placeholder="Description">
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Add',
                    preConfirm: () => {
                        const name = $('#categoryName').val();
                        const description = $('#categoryDescription').val();
                        return { name, description };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/category',
                            method: 'POST',
                            data: result.value,
                            success: function() {
                                Swal.fire('Added!', 'Category has been added.', 'success');
                                $('#dataTable').DataTable().ajax.reload();
                            },
                            error: function() {
                                Swal.fire('Error', 'An error occurred while adding the category.', 'error');
                            }
                        });
                    }
                });
            });
        });

        function editCategory(id) {
            $.ajax({
                url: `/category/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        title: 'Edit Category',
                        html: `
                            <input id="categoryName" class="swal2-input" value="${response.data.name}">
                            <input id="categoryDescription" class="swal2-input" value="${response.data.description}">
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        preConfirm: () => {
                            const name = $('#categoryName').val();
                            const description = $('#categoryDescription').val();
                            return { name, description };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/category/${id}`,
                                method: 'PUT',
                                data: result.value,
                                success: function() {
                                    Swal.fire('Updated!', 'Category has been updated.', 'success');
                                    $('#dataTable').DataTable().ajax.reload();
                                },
                                error: function() {
                                    Swal.fire('Error', 'An error occurred while updating the category.', 'error');
                                }
                            });
                        }
                    });
                },
                error: function() {
                    Swal.fire('Error', 'An error occurred while editing the category.', 'error');
                }
            });
        }

        function deleteCategory(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/category/${id}`,
                        method: 'DELETE',
                        success: function() {
                            Swal.fire('Deleted!', 'Category has been deleted.', 'success');
                            $('#dataTable').DataTable().ajax.reload();
                        },
                        error: function() {
                            Swal.fire('Error', 'An error occurred while deleting the category.', 'error');
                        }
                    });
                }
            });
        }
    </script>
@endpush
