@extends('admin.layouts.app', ['title' => 'Dr. ' . $doctor->name])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Doctors Details <i class="nav-icon i-Checked-User"></i></h1>
            </div>

            <div class="border-top"></div>
            <div class="container mt-24">
                <div class="row col-12">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2 ">
                        <div class="mt-2">
                            <h5>Name : {{ $doctor->name }}</h5>
                        </div>
                        <div class="mt-2">
                            <h5>Email : {{ $doctor->email }}</h5>
                        </div>
                        <div class="mt-2">
                            <h5> Phone : {{ $doctor->phn_no }}</h5>
                        </div>
                        <div class="mt-2">
                            <h5>Speciality Name : {{ $doctor->speciality->name ?? '-' }}</h5>
                        </div>
                        <div class="mt-2">
                            <h5> Area Name : {{ $doctor->area->area_name ?? '-' }}</h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <img class="float-right" src="{{ asset('storage/images/doctors/' . $doctor->image) }}"
                            style="width: 15rem; height: auto; object-fit: cover;">
                    </div>
                </div>

                <?php
                $longitudes = array_values(json_decode($doctor->longitude, true));
                $latitudes = array_values(json_decode($doctor->latitude, true));
                $titles = array_values(json_decode($doctor->title, true));
                $addresses = array_values(json_decode($doctor->addresses, true));
                $key = 0;
                ?>
                @foreach ($longitudes as $key => $item)
                    <div class="row col-12 mt-3 border-bottom">
                        <div class="col-6">
                            <div>
                                <h5><strong>Title : {{ $titles[$key] }}</strong></h5>
                            </div>
                            <div>
                                <h5><strong>Address : {{ $addresses[$key] }}</strong></h5>
                            </div>
                        </div>
                        <div class="col-6 ">
                            @php
                                $url = $latitudes[$key] . ',' . $longitudes[$key];
                                $urlPath = "https://www.google.com/maps/search/?api=1&query=$url";
                            @endphp
                            <a class="float-right" href="{{ $urlPath }}" target="_blank"><button
                                    class="btn btn-primary">View On Map</button></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('admin.inc.footer');
    </div>
@endsection
