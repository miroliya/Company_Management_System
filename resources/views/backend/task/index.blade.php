@extends('backend.layout.layout')
@section('title')
    Task
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
                        <h1 class="m-0">Task</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Task List</li>
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

                                <h3 class="card-title">Task List</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" id="task_search" name="title"
                                            class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                    @if (Auth::user()->user_permission != ',2')
                                    <a href="javascript:void(0)" id="create-new-task" class="btn btn-md bg-gradient-primary"
                                        style="float:right">Add Task</a>
                                    @endif
                                </div>

                            </div>
                            <!-- /.card-header -->

                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Start-Date</th>
                                            <th>End-Date</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            @if (Auth::user()->user_permission != ',2')
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody id="data_crud">
                                        @foreach ($task as $singleData)
                                            <tr id="table_id_{{ $singleData->id }}">
                                                <td>{{ $singleData->id }}</td>
                                                <td>{{ $singleData->title }}</td>
                                                <td>{{ $singleData->start_date }}</td>
                                                <td>{{ $singleData->end_date }}</td>
                                                <td>{{ $singleData->description }}</td>
                                                <td>{{ $singleData->user_status == 0 ? "Inactive" : "Active"}}</td>
                                                <td>
                                                    @if (Auth::user()->user_permission != ',2')
                                                    <div class="btn-group">
                                                        <a href="javascript:void(0)" id="edit-task"
                                                            data-id="{{ $singleData->id }}" class="btn btn-primary">
                                                            Edit
                                                        </a>
                                                        <a href="javascript:void(0)" id="delete-task"
                                                            data-id="{{ $singleData->id }}" class="btn btn-danger">
                                                            Delete
                                                        </a>
                                                    </div>
                                                    @endif
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
                                <label>Title: </label>
                                <input type="text" placeholder="Enter Task Title" class="form-control"
                                    id="task_title" name="title" required>
                            </div>
                        
                            <div class="form-group col-md-12">
                                <label>Task Start Date: </label>
                                <input type="date" placeholder="Enter Task Start Date" class="form-control" id="task_start_date"
                                    name="start_date" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Task End Date: </label>
                                <input type="date" placeholder="Enter Task End Date" class="form-control" id="task_end_date"
                                    name="end_date" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Task Description: </label>
                                <textarea class="form-control" name="description" placeholder="Enter Task Description" cols="30" rows="5" id="description" required></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Task Status: </label>
                                <select class="form-control" id="task_status" name="status" required>
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
                $('#create-new-task').click(function() {
                    $('#btn-save').val("create-task");
                    $('#data_id').val("");
                    $('#dataForm').trigger("reset");
                    $('#exampleModalScrollableTitle').html("Add New Task");
                    $('#btn-save').html("Save");
                    $('#exampleModalScrollable').modal('show');
                    $('#password').attr('required', true);
                    $('#task_status').val(1);
                });

                /* When click edit user */
                $('body').on('click', '#edit-task', function() {
                    var data_id = $(this).data('id');
                    $.get('/admin-dashboard/task-edit/' + data_id, function(data) {
                        $('#exampleModalScrollableTitle').html("Edit Task Information");
                        $('#btn-save').html("Update");
                        $('#btn-save').val("edit-task");
                        $('#exampleModalScrollable').modal('show');
                        $('#data_id').val(data.id);
                        $('#task_title').val(data.title);
                        $('#task_start_date').val(data.start_date);
                        $('#task_end_date').val(data.end_date);
                        $('#description').val(data.description);
                        $('#task_status').val(data.status);
                    })
                });




                //delete user login
                $('body').on('click', '#delete-task', function() {
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
                                url: "{{ url('/admin-dashboard/task-delete') }}" + '/' +
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
                    var url = "{{ route('admin.task.store') }}";
                } else {
                    var method = 'add';
                    var url = "{{ route('admin.task.store') }}";
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
                            data.id + '"><td >' +
                            data.id + '</td><td>' +
                            data.title + '</td><td>' + 
                            data.start_date + '</td><td>' +
                            data.end_date + '</td><td>' +
                            data.description + '</td><td>' +
                            `${data.status == 0 ? 'Inactive' : 'Active' }` + '</td>';


                        datavalue += '<td><div class="btn-group" role="group" aria-label="Basic example">';

                        datavalue += ' <a href="javascript:void(0)" id="edit-task" data-id="' +
                            data.id +
                            '" class="btn btn-primary waves-effect waves-float waves-light">Edit</a>';


                        datavalue += '<a href="javascript:void(0)" id="delete-task" data-id="' +
                            data.id +
                            '" class="btn btn-danger waves-effect waves-float waves-light" >Delete</a>';

                        datavalue += '</div></td></tr>';


                        if (actionType == "create-task") {
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

            $('#task_search').keyup(function() {
                var query = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('admin.task.search') }}",
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
