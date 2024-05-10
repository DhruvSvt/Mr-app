@extends('admin.layouts.app', ['title' => 'Create Doctor'])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Create Doctor <i class="nav-icon i-Doctor"></i></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title mb-3">Create</div>
                            <form>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" placeholder="Enter your name">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter email">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" id="phone" placeholder="Enter phone">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="speciality_id">Select Speciality Name</label>
                                        <select class="form-control">
                                            <option>Option 1</option>
                                            <option>Option 1</option>
                                            <option>Option 1</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="picker1">Select Area Name</label>
                                        <select class="form-control">
                                            <option>Option 1</option>
                                            <option>Option 1</option>
                                            <option>Option 1</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="location">Choose Photo</label>
                                        <input type="file" class="form-control">
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <button type="button" id="addcustom_area"
                                            class="btn btn-warning float-right">+</button>
                                    </div>
                                    <div class="col-md-12 customarea0">
                                        <div class="row">
                                            <div class="col-md-5 form-group mb-3 ">
                                                <label for="location">Location</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter your location">
                                            </div>
                                            <div class="col-md-5 form-group mb-3">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" placeholder="Enter your Address">
                                            </div>
                                            <div class="col-md-2 my-auto">
                                                <button type="button" class="btn btn-danger btn_remove_area float-right"
                                                    data-id="0">X</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row" id="custom_area_container"></div>
                                    </div>


                                    <div class="col-md-12">
                                        <button class="btn btn-primary float-right">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.inc.footer');
        </div>
    @endsection
    @section('script')
        <script>
            var k = 1;
            $(document).ready(function() {
                $('#addcustom_area').click(function() {
                    $('#custom_area_container').append(`<div class="col-md-12 customarea` + k +
                        `">
                            <div class="row">
                                <div class="col-md-5 form-group mb-3 ">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" placeholder="Enter your location">
                                </div>
                                <div class="col-md-5 form-group mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" placeholder="Enter your Address">
                                </div>
                                <div class="col-md-2 my-auto">
                                    <button type="button" class="btn btn-danger btn_remove_area float-right" data-id="` +
                        k + `">X</button>
                                </div>
                            </div>
                        </div>`);
                    k++;
                });

                $(document).on('click', '.btn_remove_area', function() {
                    var button_id = $(this).data("id");
                    $('.customarea' + button_id).remove();
                });
            });
        </script>
    @endsection
