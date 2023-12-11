@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{session('success')}}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{session('error')}}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="ibox">
            <div class="ibox-title d-flex justify-content-between align-items-center">
                <h5>Products</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" style="margin-right: -66px !important;" data-bs-target="#addRecord">
                    <i class="fa fa-plus"> </i> Add New Product
                </button>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tickersTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Creation Date</th>
                                <th>Status</th>
                                <th class="">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="ihub-news-records">
                            @foreach($products as $product)
                            <tr class="gradeX" style="cursor: pointer;">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$product->name}}</td>
                                <td>
                                    @php
                                    $datetime = \Carbon\Carbon::createFromDate($product->created_at);
                                    echo $datetime->format('d/m/y');
                                    @endphp
                                </td>
                                <td>
                                    @if($product->status == 1)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="">
                                    <button type="button" class="btn btn-dark btn-sm btn-block" id="edit_button" data-bs-toggle="modal" data-bs-target="#editRecord" data-id="{{$product->id}}" data-name="{{$product->name}}" data-short_description="{{$product->short_description}}" data-description="{{$product->description}}" data-price="{{$product->price}}" data-image="{{$product->image}}" data-status="{{$product->status}}">
                                        <i class="fa fa-edit"> </i> View/Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-block delete-button" onclick="deletePrompt({{$product->id}})" data-id="{{$product->id}}">
                                        <i class="fa fa-trash"> </i> Delete
                                    </button>
                                    <form action="{{ route('admin.products-delete') }}" id="delForm-{{$product->id}}" method="post">
                                        @csrf
                                        <input type="text" name="id" id="id" value="{{$product->id}}" hidden>
                                        <button type="submit" hidden>Submit</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Record Modal -->
<div class="modal fade" id="addRecord" tabindex="-1" aria-labelledby="addRecord" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Add Product</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.products-store') }}" method="post" id="addRecordForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <div class="row mb-3">
                                <div class="col">
                                    <h4><label for="exampleInputEmail1" class="form-label">Product Name</label></h4>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                    <div class="invalid-feedback">Name is required.</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <h4><label for="exampleInputEmail1" class="form-label">Short Description</label></h4>
                                    <textarea rows="5" class="form-control" name="short_description" id="short_description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <h4><label for="exampleInputEmail1" class="form-label">Long Description</label></h4>
                                    <textarea rows="5" class="form-control" name="description" id="description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <h4><label for="exampleInputEmail1" class="form-label">Price</label></h4>
                                    <input type="text" class="form-control" name="price" id="price" required>
                                </div>
                                <div class="col-6">
                                    <h4><label for="exampleInputEmail1" class="form-label">Image</label></h4>
                                    <input type="file" class="form-control" name="image" id="image" required>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="addRecordForm" class="btn btn-primary">Add product</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Record Modal -->
<div class="modal fade" id="editRecord" tabindex="-1" aria-labelledby="editRecord" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Edit Product</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.products-update') }}" method="post" id="editRecordForm" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id" id="edit_id" hidden>

                    <div class="row mb-2">
                        <div class="col">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h4><label for="exampleInputEmail1" class="form-label">Product Name</label></h4>
                                    <input type="text" class="form-control" name="name" id="edit_name" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h4><label for="exampleInputEmail1" class="form-label">Short Description</label></h4>
                                    <textarea rows="5" class="form-control" name="short_description" id="edit_short_description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h4><label for="exampleInputEmail1" class="form-label">Long Description</label></h4>
                                    <textarea rows="5" class="form-control" name="description" id="edit_description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <h4><label for="exampleInputEmail1" class="form-label">Price</label></h4>
                                    <input type="text" class="form-control" name="price" id="edit_price" required>
                                </div>
                                <div class="col-4">
                                    <h4><label for="exampleInputEmail1" class="form-label">Image</label></h4>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <div class="col-4">
                                    <h4><label for="exampleInputEmail1" class="form-label">Active Status</label></h4>
                                    <div class="switch mt-3">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="status_box" name="status">
                                            <label class="onoffswitch-label" for="status_box">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editRecordForm" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
        });
        $('[data-toggle="tooltip"]').tooltip();
        $('#editRecord').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id');
            var name = button.data('name');
            var short_description = button.data('short_description');
            var description = button.data('description');
            var price = button.data('price');
            $('#edit_name').val(name);
            $('#edit_id').val(id);
            $('#edit_price').val(price);
            $('#edit_short_description').val(short_description);
            $('#edit_description').val(description);
            if (button.data('status') == 1) {
                $('#status_box').prop('checked', true);
            } else {
                $('#status_box').prop('checked', false);
            }
        });
        // $('.delete-button').click(function() {
        //     var id = $(this).data('id');
        //     var deleteForm = $('#delForm-' + id);

        //     // Show SweetAlert2 confirmation dialog
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: 'You will not be able to recover this record!',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, delete it!',
        //         cancelButtonText: 'No, cancel!',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             deleteForm.submit();
        //         }
        //     });
        // });
    });

    function deletePrompt(id) {
        var deleteForm = $('#delForm-' + id);
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this record!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                deleteForm.submit();
            }
        });
    }
</script>
@endsection