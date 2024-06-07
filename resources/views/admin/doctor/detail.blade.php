@extends('admin.layouts.app', ['title' => 'Dr. ' . $doctor->name])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb col-12">
                <div class="col-6">
                    <h1><u>Dr. {{ $doctor->name }} Profile <i class="nav-icon i-Checked-User"></i></u></h1>
                </div>
                <div class="col-6 float-left">
                    <a href="{{ URL::previous() }}" class="float-right">
                        <button class="btn btn-dark">Back</button>
                    </a>
                </div>
            </div>


            <div class="border-top"></div>
            <div class="container mt-24">
                <div class="row col-12 border-bottom">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2 ">
                        <div class="mt-3">
                            <h5><b>Name</b> : {{ $doctor->name }}</h5>
                        </div>
                        <div class="mt-3">
                            <h5><b>Email</b> : {{ $doctor->email }}</h5>
                        </div>
                        <div class="mt-3">
                            <h5><b>Speciality Name</b> : {{ $doctor->speciality->name ?? '-' }}</h5>
                        </div>
                        <div class="mt-3">
                            <h5><b> Area Name</b> : {{ $doctor->area->area_name ?? '-' }}</h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <img class="float-right border" src="{{ asset('storage/images/doctors/' . $doctor->image) }}"
                            style="width: 15rem; height: auto; object-fit: cover;">
                    </div>
                </div>

                <?php
                $longitudes = $doctor->longitude;
                $key = 0;
                ?>
                @foreach ($longitudes as $key => $item)
                    <div class="row col-12 mt-3 border-bottom">
                        <div class="col-6">
                            <div>
                                <h5><strong>Title</strong> : {{ $doctor->title[$key] ?? '-' }}</h5>
                            </div>
                            <div>
                                <h5><strong>Address</strong> : {{ $doctor->addresses[$key] ?? '-' }}</h5>
                            </div>
                            <div>
                                <h5><strong>Phone No</strong> : {{ $doctor->phn_no[$key] ?? '-' }}</h5>
                            </div>
                        </div>
                        <div class="col-6 ">
                            @php
                                $url = $doctor->latitude[$key] . ',' . $doctor->longitude[$key];
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
