@extends('admin.layouts.app', ['title' => 'Doctors Details'])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Doctors Details <i class="nav-icon i-Checked-User"></i></h1>
            </div>

            <div class="border-top"></div>

            <!-- ============= Table Start ============= -->
            <div class="table-responsive">
                @include('admin.inc.search')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">S no.</th>
                            <th scope="col">Image</th>
                            <th scope="col">Doctor Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Speciality</th>
                            <th scope="col">Area</th>
                            <th scope="col">View More</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($doctors as $key => $doctor)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    @if ($doctor->image)
                                        <img src="{{ asset('storage/images/doctors/' . $doctor->image) }}"
                                            style="width: 100px; height: 85px; object-fit: cover;">
                                    @else
                                        <span>No image found!</span>
                                    @endif
                                </td>
                                <td>{{ $doctor->name ?? '-' }}</td>
                                <td>{{ $doctor->email ?? '-' }}</td>
                                <td>{{ $doctor->speciality->name ?? '-' }}</td>
                                <td>{{ $doctor->area->area_name ?? '-' }}</td>
                                <td><a href="{{ route('doctor.show', $doctor->id) }}" class="btn btn-success">View More</a>
                                </td>
                                <td>
                                    <label class="switch switch-success mr-3">

                                        <input type="checkbox" class="form-check-input custom-switch"
                                            id="customSwitchsizemd{{ $doctor->id }}" data-id="{{ $doctor->id }}"
                                            name="status" {{ $doctor->status === 1 ? 'checked' : 'Unchecked' }}>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="{{ route('doctor.edit', $doctor->id) }}">
                                        <button type="button" class="btn btn-warning edit-area-btn">
                                            <i class="nav-icon i-Pen-2"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <td colspan="10" class="text-center">
                                <h3 class="font-weight-600">No Data Found !!</h3>
                            </td>
                        @endforelse
                    </tbody>
                </table>
                @include('admin.inc.paginate', [
                    'model' => $doctors,
                    'keyword' => request()->keyword,
                    'rows' => request()->rows,
                ])
            </div>
            <!-- ============= Table End ============= -->

        </div>

        @include('admin.inc.footer')<br>
    </div>
@endsection

@section('script')
    @include('admin.inc.status', ['var_id' => 'doctorId', 'model' => 'Doctor'])
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
