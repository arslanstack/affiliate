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
                <h5>Commsion Percentage Levels</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tickersTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Level</th>
                                <th>Order Amount Percentage</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody id="ihub-news-records">
                            @foreach($levels as $level)
                            <tr class="gradeX" style="cursor: pointer;">
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if($level->parent_level == 1)
                                    <span>Parent Affiliate Level 1</span>
                                    @elseif($level->parent_level == 2)
                                    <span>Parent Affiliate Level 2</span>
                                    @elseif($level->parent_level == 3)
                                    <span>Parent Affiliate Level 3</span>
                                    @endif
                                </td>
                                <td>{{$level->commission_percentage}}%</td>
                                <td class="">
                                    <button type="button" class="btn btn-dark btn-sm btn-block" id="edit_button" data-bs-toggle="modal" data-bs-target="#editRecord" data-id="{{$level->id}}" data-parent_level="{{$level->parent_level}}" data-commission_percentage="{{$level->commission_percentage}}">
                                        <i class="fa fa-edit"> </i> Edit
                                    </button>
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

<!-- Edit Record Modal -->
<div class="modal fade" id="editRecord" tabindex="-1" aria-labelledby="editRecord" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Edit Record</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.commission-levels-update') }}" method="post" id="editRecordForm">
                    @csrf
                    <input type="text" name="id" id="edit_id" hidden>

                    <div class="row mb-2">
                        <div class="col">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h4><label for="exampleInputEmail1" class="form-label">Parent Affiliate Level</label></h4>
                                    <input type="text" class="form-control" name="parent_level" id="edit_parent_level" disabled required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h4><label for="exampleInputEmail1" class="form-label">Commsion Percentage of Order Amount</label></h4>
                                    <input type="number" class="form-control" name="commission_percentage" id="edit_commission_percentage" required>
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
            var parent_level = button.data('parent_level');
            if(parent_level == 1){
                parent_level = 'Parent Affiliate Level 1';
            }else if(parent_level == 2){
                parent_level = 'Parent Affiliate Level 2';
            }else if(parent_level == 3){
                parent_level = 'Parent Affiliate Level 3';
            }
            var commission_percentage = button.data('commission_percentage');
            
            $('#edit_parent_level').val(parent_level);
            $('#edit_id').val(id);
            $('#edit_commission_percentage').val(commission_percentage);
        });
    });
</script>
@endsection