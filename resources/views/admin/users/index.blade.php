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
                <h5>Users</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tickersTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Email Address</th>
                                <th>Referred Affiliates</th>
                                <th>Status</th>
                                <th class="">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="ihub-news-records">
                            @foreach($users as $user)
                            <tr class="gradeX">
                                <td>{{$loop->iteration}}</td>
                                <td><img src="{{asset('uploads/profile/' . ($user->image ?? 'avatar.jpg'))}}" style="width:24px; height: 24px; border-radius: 100px; margin-right:12px;" alt="">{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{calculate_referred_affiliates($user->id)}}</td>
                                <td>
                                    @if($user->status == 1)
                                    <span class="badge badge-primary">Active</span> <br>
                                    @elseif($user->status == 0)
                                    <span class="badge badge-danger">Blocked</span>
                                    @endif
                                </td>
                                <td class="">
                                    <a class="btn btn-dark btn-sm btn-block" href="{{ route('admin.user-view', $user->id) }}" id="edit_button">
                                        <i class="fa fa-edit"> </i> View
                                    </a>
                                    @if($user->status == 0)
                                    <button class="btn btn-primary btn-sm btn-block activate-button" onclick="activatePrompt({{$user->id}})" data-id="{{$user->id}}">
                                        <i class="fa fa-unlock"> </i> Unblock
                                    </button>
                                    @elseif($user->status == 1)
                                    <button class="btn btn-warning btn-sm btn-block deactivate-button" onclick="deactivatePrompt({{$user->id}})" data-id="{{$user->id}}">
                                        <i class="fa fa-lock"> </i> Block
                                    </button>
                                    @endif
                                    <button class="btn btn-danger btn-sm btn-block delete-button" onclick="deletePrompt({{$user->id}})" data-id="{{$user->id}}">
                                        <i class="fa fa-trash"> </i> Delete
                                    </button>
                                    <form action="{{ route('admin.user-delete') }}" id="delForm-{{$user->id}}" method="post">
                                        @csrf
                                        <input type="text" name="id" id="id" value="{{$user->id}}" hidden>
                                        <button type="submit" hidden>Submit</button>
                                    </form>
                                    <form action="{{ route('admin.user-activate') }}" id="activate-{{$user->id}}" method="post">
                                        @csrf
                                        <input type="text" name="id" id="id" value="{{$user->id}}" hidden>
                                        <button type="submit" hidden>Submit</button>
                                    </form>
                                    <form action="{{ route('admin.user-deactivate') }}" id="deactivate-{{$user->id}}" method="post">
                                        @csrf
                                        <input type="text" name="id" id="id" value="{{$user->id}}" hidden>
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


<script>
    function deactivatePrompt(id) {
        var deactivateForm = $('#deactivate-' + id); // Use a unique ID for each form

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to block this record!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, block it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                deactivateForm.submit();
            }
        });
    }

    function activatePrompt(id) {
        var activateForm = $('#activate-' + id);
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to unblock this record!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, unblock it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                activateForm.submit();
            }
        });
    }

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

    $(document).ready(function() {
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
        });
        $('[data-toggle="tooltip"]').tooltip();
        $('.delete-button').click(function() {
            var id = $(this).data('id');
            var deleteForm = $('#delForm-' + id);

            // Show SweetAlert2 confirmation dialog
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
        });

        // Handler for Deactivate button click
        // $('.deactivate-button').click(function() {
        //     var id = $(this).data('id');
        //     var deactivateForm = $('#deactivate-' + id); // Use a unique ID for each form

        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: 'You want to block this record!',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, block it!',
        //         cancelButtonText: 'No, cancel!',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             deactivateForm.submit();
        //         }
        //     });
        // });



        // Handler for Activate button click
        // $('.activate-button').click(function() {
        //     var id = $(this).data('id');
        //     var activateForm = $('#activate-' + id); // Use a unique ID for each form

        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: 'You want to unblock this record!',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, unblock it!',
        //         cancelButtonText: 'No, cancel!',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             activateForm.submit();
        //         }
        //     });
        // });
    });
</script>
@endsection