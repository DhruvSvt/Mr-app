@extends('admin.layouts.app', ['title' => 'Create Chemist'])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Create Chemist <i class="nav-icon i-Medicine-2"></i></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title mb-3">Create</div>
                            <form action="{{ route('chemist.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" placeholder="Enter name" name="name">
                                        @error('name')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter email" name="email">
                                        @error('email')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="speciality_id">Select Speciality Name</label>
                                        <select class="form-control" name="speciality_id">
                                            <option value="0" selected disabled>Choose Speciality</option>
                                            @foreach ($specialities as $speciality)
                                                <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('speciality_id')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="picker1">Select Area Name</label>
                                        <select class="form-control" name="area_id">
                                            <option value="0" selected disabled>Choose Area</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" class="form-control" placeholder="Enter Contact Person Name"
                                            name="contact_person">
                                        @error('contact_person')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="location">Choose Photo</label>
                                        <input type="file" name="image" class="form-control">
                                        @error('image')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 border-bottom mb-2 customarea0">
                                        <div class="row">
                                            <div class="col-md-3 form-group mb-3">
                                                <label for="longitude">Longitude</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter your Longitude" min="0" name="longitude[]">
                                                @error('longitude[]')
                                                    <p class="text-danger text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 form-group mb-3 ">
                                                <label for="location">Latitude</label>
                                                <input type="text" class="form-control" placeholder="Enter your Latitude"
                                                    min="0" name="latitude[]">
                                                @error('latitude[]')
                                                    <p class="text-danger text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 form-group mb-3 ">
                                                <label for="location">Title</label>
                                                <input type="text" class="form-control" placeholder="Enter title"
                                                    name="title[]">
                                                @error('title[]')
                                                    <p class="text-danger text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-2 my-auto">
                                                <button type="button" id="addcustom_area"
                                                    class="btn btn-warning float-right">+</button>
                                            </div>
                                            <div class="col-md-5 form-group mb-3">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" placeholder="Enter the Address"
                                                    name="addresses[]">
                                                @error('addresses[]')
                                                    <p class="text-danger text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-5 form-group mb-3">
                                                <label for="phone">Phone</label>
                                                <input class="form-control" id="phone" placeholder="Enter phone"
                                                    name="phn_no[]">
                                                @error('phn_no[]')
                                                    <p class="text-danger text-sm">{{ $message }}</p>
                                                @enderror
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

            @include('admin.inc.footer')<br>
        </div>
    @endsection
    @section('script')
        <script>
            var k = 1;
            $(document).ready(function() {
                $('#addcustom_area').click(function() {
                    $('#custom_area_container').append(`<div class="col-md-12 border-bottom mb-2 customarea` +
                        k +
                        `">
                            <div class="row">
                                <div class="col-md-3 form-group mb-3 ">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control"
                                        placeholder="Enter your Longitude"  min="0"
                                        name="longitude[]">
                                    @error('longitude[]')
                                        <p class="text-danger text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3 form-group mb-3 ">
                                    <label for="location">Latitude</label>
                                    <input type="text" class="form-control" placeholder="Enter your Latitude"
                                         min="0" name="latitude[]">
                                    @error('latitude[]')
                                        <p class="text-danger text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group mb-3 ">
                                    <label for="location">Title</label>
                                    <input type="text" class="form-control" placeholder="Enter title"
                                        name="title[]">
                                    @error('title[]')
                                        <p class="text-danger text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-2 my-auto">
                                    <button type="button" class="btn btn-danger btn_remove_area float-right" data-id="` +
                        k + `">X</button>
                                </div>
                                <div class="col-md-5 form-group mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" placeholder="Enter the Address"
                                        name="addresses[]">
                                    @error('addresses[]')
                                        <p class="text-danger text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                 <div class="col-md-5 form-group mb-3">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" id="phone" placeholder="Enter phone"
                                        name="phn_no[]">
                                    @error('phn_no[]')
                                        <p class="text-danger text-sm">{{ $message }}</p>
                                    @enderror
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
