@extends('admin.layouts.app', ['title' => 'Doctor ' . $doctor->name])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Doctors Details <i class="nav-icon i-Checked-User"></i></h1>
            </div>

            <div class="border-top"></div>
            <div class="container mt-24">
                <div class="mt-2">
                    <img src="{{ asset('storage/images/doctors/' . $doctor->image) }}"
                        style="width: 125px; height: 100px; object-fit: cover;">
                </div>
                <div class="mt-2">
                    Name : {{ $doctor->name }}
                </div>
                <div class="mt-2">
                    Email : {{ $doctor->email }}
                </div>
                <div class="mt-2">
                    Phone : {{ $doctor->phn_no }}
                </div>
                <div class="mt-2">
                    Speciality Name : {{ $doctor->speciality->name ?? '-' }}
                </div>
                <div class="mt-2">
                    Area Name : {{ $doctor->area->area_name ?? '-' }}
                </div>
            </div>

        </div>

        @include('admin.inc.footer');
    </div>
@endsection

@section('script')
    @include('admin.inc.status', ['var_id' => 'doctorId', 'model' => 'Doctor'])
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
