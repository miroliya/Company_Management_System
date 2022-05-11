@extends('backend.layout.layout')
@section('title')
    Leaves
@endsection
@section('css')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Leaves</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Leave List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">

            <div class="container-fluid">
                @include('backend.layout.alert')
                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-header">

                                <h3 class="card-title">Leave List</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" id="leave_search" name="title"
                                            class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                    <a href="javascript:void(0)" id="create-new-leave" class="btn btn-md bg-gradient-primary"
                                        style="float:right">Add Leave</a>
                                </div>

                            </div>
                            <!-- /.card-header -->

                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Leave Type</th>
                                            <th>Leave Date From Date</th>
                                            <th>Leave Date From To</th>
                                            <th>Leave Reason:</th>
                                            <th>Leave Is Approved</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_crud">
                                        @foreach ($leave as $singleData)
                                            <tr id="table_id_{{ $singleData->id }}">
                                                <td>{{ $singleData->id }}</td>
                                                <td>{{ $singleData->leave_type }}</td>
                                                <td>{{ $singleData->date_from }}</td>
                                                <td>{{ $singleData->date_to }}</td>
                                                <td>{{ $singleData->reason }}</td>
                                                <td>{{ $singleData->is_approved == 0 ? "Rejected" : "Approved"}}</td>
                                                <td>{{ $singleData->status == 0 ? "Inactive" : "Active"}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="javascript:void(0)" id="edit-leave"
                                                            data-id="{{ $singleData->id }}" class="btn btn-primary">
                                                            Edit
                                                        </a>
                                                        <a href="javascript:void(0)" id="delete-leave"
                                                            data-id="{{ $singleData->id }}" class="btn btn-danger">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>


            </div><!-- /.container-fluid -->
        </section>

        <form id="dataForm" name="dataForm" enctype="multipart/form-data">
            <div class="modal fade" id="exampleModalScrollable" style="display: none; width: 100%" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="width: 156%;">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalScrollableTitle"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="data_id" id="data_id">
                            <div class="form-group col-md-12">
                                <label>Leave Type: </label>
                                <select class="form-control" id="leave_type" name="leave_type" required>
                                    <option value="Privilege Leave">Privilege Leave</option>
                                    <option value="Earned Leave">Earned Leave</option>
                                    <option value="Casual Leave">Casual Leave</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Maternity Leave">Maternity Leave</option>
                                    <option value="Compensatory Off">Compensatory Off</option>
                                    <option value="Marriage Leave">Marriage Leave</option>
                                    <option value="Paternity Leave">Paternity Leave</option>
                                    <option value="Bereavement Leave">Bereavement Leave</option>
                                    <option value="Loss of Pay">Loss of Pay</option>
                                    <option value="Leave Without Pay">Leave Without Pay</option>
                                </select>
                            </div>
                        
                            <div class="form-group col-md-12">
                                <label>Leave Date From: </label>
                                <input type="date" placeholder="Date From" class="form-control" id="date_from"
                                    name="date_from" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Leave Date To: </label>
                                <input type="date" placeholder="Date To" class="form-control" id="date_to"
                                    name="date_to" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Leave Reason </label>
                                <textarea class="form-control" name="reason" placeholder="Leave Reason" cols="30" rows="5" id="reason" required></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Is_Approved: </label>
                                <select class="form-control" id="is_approved" name="is_approved" required>
                                    <option value="0">Rejected</option>
                                    <option value="1">Approved</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Event Status: </label>
                                <select class="form-control" id="leave_status" name="status" required>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </form>
    @endsection

    @section('js')
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#blog_image').change(function() {

                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#image_preview_container').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });



                /*  When user click add user button */
                $('#create-new-leave').click(function() {
                    $('#btn-save').val("create-leave");
                    $('#data_id').val("");
                    $('#dataForm').trigger("reset");
                    $('#exampleModalScrollableTitle').html("Add Leave");
                    $('#btn-save').html("Save");
                    $('#exampleModalScrollable').modal('show');
                    $('#password').attr('required', true);
                    $('#leave_status').val(1);
                });

                /* When click edit user */
                $('body').on('click', '#edit-leave', function() {
                    var data_id = $(this).data('id');
                    $.get(`/leave/${data_id}/edit/`, function(data) {
                        $('#exampleModalScrollableTitle').html("Edit Leave Information");
                        $('#btn-save').html("Update");
                        $('#btn-save').val("edit-leave");
                        $('#exampleModalScrollable').modal('show');
                        $('#data_id').val(data.id);
                        $('#leave_type').val(data.leave_type);
                        $('#date_from').val(data.date_from);
                        $('#date_to').val(data.date_to);
                        $('#reason').val(data.reason);
                        $('#is_approved').val(data.is_approved);
                        $('#leave_status').val(data.status);
                    })
                });

                //delete user login
                $('body').on('click', '#delete-leave', function() {
                    var data_id = $(this).data("id");

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                            cancelButton: 'btn btn-outline-danger ml-1'
                        },
                        buttonsStyling: false
                    }).then(function(result) {
                        if (result.value) {

                            $.ajax({
                                type: "DELETE",
                                url: "{{ url('/leave') }}" + '/' +
                                    data_id,
                                success: function(data) {
                                    $("#table_id_" + data_id).remove();
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'You Data Deleted Successfully!',
                                        icon: 'success',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                        buttonsStyling: false
                                    });

                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                }
                            });

                        } else if (result.dismiss === Swal.DismissReason.cancel) {

                            Swal.fire({
                                title: 'Cancel!',
                                text: ' Your Data Safe!',
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false
                            });

                        }
                    });



                });

            });

            $('#dataForm').on('submit', function(event) {
                event.preventDefault();
                var id = $('#table_id_').val();
                if (id) {
                    var method = 'update';
                    var url = "{{ route('leave.store') }}";
                } else {
                    var method = 'add';
                    var url = "{{ route('leave.store') }}";
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var actionType = $('#btn-save').val();
                $('#btn-save').html('Sending..');

                $.ajax({
                    url: url,
                    type: "POST",
                    data: new FormData(this),
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        console.log(data.image);
                        let spare = data.image;
                        var datavalue = '<tr id="table_id_' +
                            data.id + '"><td>' +
                            data.id + '</td><td>' +
                            data.leave_type + '</td><td>' + 
                            data.date_from + '</td><td>' +
                            data.date_to + '</td><td>' +
                            data.reason + '</td><td>' +
                            `${data.is_approved == 0 ? 'Rejected' : 'Approved' }` + '</td><td>' +
                            `${data.status == 0 ? 'Inactive' : 'Active' }` + '</td>';


                        datavalue += '<td><div class="btn-group" role="group" aria-label="Basic example">';

                        datavalue += ' <a href="javascript:void(0)" id="edit-leave" data-id="' +
                            data.id +
                            '" class="btn btn-primary waves-effect waves-float waves-light">Edit</a>';


                        datavalue += '<a href="javascript:void(0)" id="delete-leave" data-id="' +
                            data.id +
                            '" class="btn btn-danger waves-effect waves-float waves-light" >Delete</a>';

                        datavalue += '</div></td></tr>';


                        if (actionType == "create-leave") {
                            $('#data_crud').prepend(datavalue);
                        } else {
                            $("#table_id_" + data.id).replaceWith(datavalue);
                        }


                        $('#dataForm').trigger("reset");
                        $('#exampleModalScrollable').modal('hide');
                        $('#btn-save').html('Save Changes');
                        $('#btn-save').html('Save');
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your Data Saved Successfully!',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#btn-save').html('Save');
                        $('#dataForm').trigger("reset");
                        $('#exampleModalScrollable').modal('hide');
                        Swal.fire({
                            title: 'Error!',
                            text: 'Somthing went wrong,please try again.',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                });
            });

            $('#leave_search').keyup(function() {
                var query = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('admin.leave.search') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#data_crud').html(data);
                    }
                });

            });
        </script>
    @endsection
