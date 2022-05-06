@extends('backend.layout.layout')
@section('title')
    Employees
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
                        <h1 class="m-0">Employees</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee list</li>
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

                                <h3 class="card-title">Employees list</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" id="title" name="title"
                                            class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                    <a href="javascript:void(0)" id="create-new-user" class="btn btn-md bg-gradient-primary"
                                        style="float:right">Add Employee</a>
                                </div>

                            </div>
                            <!-- /.card-header -->

                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_crud">
                                        @foreach ($employee as $singleData)
                                            <tr id="table_id_{{ $singleData->id }}">
                                                <td>{{ $singleData->id }}</td>
                                                <td>{{ $singleData->name }}</td>
                                                <td> <img style="width: 50px;" src="{{ url('./image/' . $singleData->image )}} "/></td>
                                                <td>{{ $singleData->phone }}</td>
                                                <td>{{ $singleData->gender == 0 ? "Male" : "Female" }}</td>
                                                <td>{{ round($singleData->age) }}</td>
                                                <td>{{ $singleData->user_status == 0 ? "Inactive" : "Active"}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="javascript:void(0)" id="edit-user"
                                                            data-id="{{ $singleData->id }}" class="btn btn-primary">
                                                            Edit
                                                        </a>
                                                        <a href="javascript:void(0)" id="delete-user"
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
                                <label>User Name: </label>
                                <input type="text" placeholder="Enter Employee User Name" class="form-control"
                                    id="user_name" name="name" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="form-group col-md-6">
                                    <label>First Name: </label>
                                    <input type="text" placeholder="Enter Employee First Name" class="form-control"
                                        id="first_name" name="first_name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name: </label>
                                    <input type="text" placeholder="Enter Employee Last Name" class="form-control"
                                        id="last_name" name="last_name" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Image: </label>
                                <input type="file" placeholder="Enter Employee Image" class="form-control"
                                    id="image" name="image">
                            </div>
                            <div class="d-flex justify-content-between">
                            <div class="form-group col-md-6">
                                <label>Employee Email: </label>
                                <input type="text" placeholder="Enter Employee Email" class="form-control"
                                    id="employee_email" name="email" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Employee Password: </label>
                                <input type="password" placeholder="Enter Employee Password" class="form-control"
                                    id="password" name="password">
                            </div>
                            </div>

                            <div class="d-flex justify-content-between">
                            <div class="form-group col-md-6">
                                <label>Employee Phone: </label>
                                <input type="number" placeholder="Enter Customer Phone" class="form-control"
                                    id="employee_phone" name="phone" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Employee Address: </label>
                                <input type="text" placeholder="Enter Employee Address" class="form-control"
                                    id="employee_address" name="address" required>
                            </div>
                            </div>

                            <div class="d-flex justify-content-between">
                            <div class="form-group col-md-6">
                                <label>Employee Age: </label>
                                <input type="number" placeholder="Enter Employee Age" class="form-control"
                                    id="employee_age" name="age" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gender: </label>
                                <select class="form-control" id="employee_gender" name="gender" required>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                            </div>
                        
                            <div class="form-group col-md-12">
                                <label>Employee DOB: </label>
                                <input type="date" placeholder="Enter Employee DOB" class="form-control" id="employee_dob"
                                    name="dob" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Status: </label>
                                <select class="form-control" id="employee_status" name="user_status" required>
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
                $('#create-new-user').click(function() {
                    $('#btn-save').val("create-user");
                    $('#data_id').val("");
                    $('#dataForm').trigger("reset");
                    $('#exampleModalScrollableTitle').html("Add New Employee");
                    $('#btn-save').html("Save");
                    $('#exampleModalScrollable').modal('show');
                    $('#password').attr('required', true);
                    $('#employee_status').val(1);
                });

                /* When click edit user */
                $('body').on('click', '#edit-user', function() {
                    var data_id = $(this).data('id');
                    $.get(`/employee/${data_id}/edit/`, function(data) {
                        $('#exampleModalScrollableTitle').html("Edit Employee Information");
                        $('#btn-save').html("Update");
                        $('#btn-save').val("edit-user");
                        $('#exampleModalScrollable').modal('show');
                        $('#data_id').val(data.id);
                        $('#user_name').val(data.name);
                        $('#first_name').val(data.first_name);
                        $('#last_name').val(data.last_name);
                        $('#employee_email').val(data.email);
                        $('#employee_phone').val(data.phone);
                        $('#employee_age').val(data.age);
                        $('#employee_address').val(data.address);
                        $('#employee_gender').val(data.gender);
                        $('#employee_dob').val(data.dob);
                        $('#employee_status').val(data.user_status);
                        $('#image').val(data.image);
                    })
                });




                //delete user login
                $('body').on('click', '#delete-user', function() {
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
                                url: "{{ url('/employee') }}" + '/' +
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
                    var url = "{{ route('employee.store') }}";
                } else {
                    var method = 'add';
                    var url = "{{ route('employee.store') }}";
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
                            data.name + '</td><td>' + 
                            `<img style="width: 50px;" src="{{ url('/image/` + spare + `' )}} "/>` 
                            + '</td><td>' +
                            data.phone + '</td><td>' +
                            `${data.gender == 0 ? 'Male' : 'Female' }` + '</td><td>' +
                            data.age + '</td><td>' +
                            `${data.user_status == 0 ? 'Inactive' : 'Active' }` + '</td>';


                        datavalue += '<td><div class="btn-group" role="group" aria-label="Basic example">';

                        datavalue += ' <a href="javascript:void(0)" id="edit-user" data-id="' +
                            data.id +
                            '" class="btn btn-primary waves-effect waves-float waves-light">Edit</a>';


                        datavalue += '<a href="javascript:void(0)" id="delete-user" data-id="' +
                            data.id +
                            '" class="btn btn-danger waves-effect waves-float waves-light" >Delete</a>';

                        datavalue += '</div></td></tr>';


                        if (actionType == "create-user") {
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

            $('#title').keyup(function() {
                var query = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('admin.employee.search') }}",
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
