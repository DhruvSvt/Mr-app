@extends('admin.layouts.app', ['title' => 'Edit Dr.' . $doctor->name])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Edit Dr. {{ $doctor->name }} Profile <i class="nav-icon i-Doctor"></i></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title mb-3">Edit</div>
                            <form action="{{ route('doctor.update', $doctor->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" placeholder="Enter name" name="name"
                                            value="{{ $doctor->name }}">
                                        @error('name')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter email" name="email" value="{{ $doctor->email }}">
                                        @error('email')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" id="phone" placeholder="Enter phone" name="phn_no"
                                            value="{{ $doctor->phn_no }}">
                                        @error('phn_no')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="speciality_id">Select Speciality Name</label>
                                        <select class="form-control" name="speciality_id">
                                            <option value="{{ $doctor->speciality_id }}" selected>
                                                {{ $doctor->speciality->name }}</option>
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
                                            <option value="{{ $doctor->area_id }}" selected>{{ $doctor->area->area_name }}
                                            </option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        @if ($doctor->image)
                                            <img class="my-2"
                                                src="{{ asset('storage/images/doctors/' . $doctor->image) }}"
                                                style="width: 100px; height: 85px; object-fit: cover;">
                                        @else
                                            <span>No image found!</span>
                                        @endif
                                        <input type="file" name="image" class="form-control">
                                        @error('image')
                                            <p class="text-danger text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <?php
                                    $longitudes = array_values(json_decode($doctor->longitude, true));
                                    $latitudes = array_values(json_decode($doctor->latitude, true));
                                    $titles = array_values(json_decode($doctor->title, true));
                                    $addresses = array_values(json_decode($doctor->addresses, true));
                                    $key = 0;
                                    ?>
                                    <div class="col-md-12 customarea0">
                                        @foreach ($longitudes as $key => $item)
                                            <div class="row customarea{{ $key }}">
                                                <div class="col-md-2 form-group mb-3">
                                                    <label for="longitude">Longitude</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter your Longitude" min="0"
                                                        name="longitude[]" value="{{ $longitudes[$key] }}">
                                                    @error('longitude[]')
                                                        <p class="text-danger text-sm">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2 form-group mb-3">
                                                    <label for="location">Latitude</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter your Latitude" min="0"
                                                        name="latitude[]" value="{{ $latitudes[$key] }}">
                                                    @error('latitude[]')
                                                        <p class="text-danger text-sm">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 form-group mb-3">
                                                    <label for="location">Title</label>
                                                    <input type="text" class="form-control" placeholder="Enter title"
                                                        name="title[]" value="{{ $titles[$key] }}">
                                                    @error('title[]')
                                                        <p class="text-danger text-sm">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 form-group mb-3">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter the Address" name="addresses[]"
                                                        value="{{ $addresses[$key] }}">
                                                    @error('addresses[]')
                                                        <p class="text-danger text-sm">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                @if ($loop->first)
                                                    <div class="col-md-2 my-auto">
                                                        <button type="button" id="addcustom_area"
                                                            class="btn btn-warning float-right">+</button>
                                                    </div>
                                                @else
                                                    <div class="col-md-2 my-auto">
                                                        <button type="button"
                                                            class="btn btn-danger btn_remove_area float-right"
                                                            data-id="{{ $key }}">X</button>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>


                                    <div class="col-md-12">
                                        <div class="row" id="custom_area_container"></div>
                                    </div>


                                    <div class="col-md-12">
                                        <button class="btn btn-primary float-right">Update</button>
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
            var k = {{ count($longitudes) }}; // Initialize k with the count of existing items
            $(document).ready(function() {
                $('#addcustom_area').click(function() {
                    $('#custom_area_container').append(`<div class="col-md-12 customarea` + k + `">
                    <div class="row">
                        <div class="col-md-2 form-group mb-3">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control" placeholder="Enter your Longitude" min="0" name="longitude[]">
                            @error('longitude[]')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-2 form-group mb-3">
                            <label for="location">Latitude</label>
                            <input type="text" class="form-control" placeholder="Enter your Latitude" min="0" name="latitude[]">
                            @error('latitude[]')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <label for="location">Title</label>
                            <input type="text" class="form-control" placeholder="Enter title" name="title[]">
                            @error('title[]')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" placeholder="Enter the Address" name="addresses[]">
                            @error('addresses[]')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-2 my-auto">
                            <button type="button" class="btn btn-danger btn_remove_area float-right" data-id="` + k + `">X</button>
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
