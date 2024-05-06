@extends('admin.layouts.app', ['title' => 'Speciality'])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Speciality <i class="nav-icon fa fa-medkit"></i></h1>
            </div>

            <div class="border-top"></div>

            <!-- ============= Create Modal Start ============= -->
            <button type="button" class="btn btn-info my-3 float-right" data-toggle="modal"
                data-target="#verifyModalContent">Create</button>

            <div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog"
                aria-labelledby="verifyModalContent" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">Create Speciality</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('speciality.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Speciality Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control" name="name" required>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="specialized_in" class="col-form-label">Speciality In</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control" name="specialized_in" required>
                                    @error('specialized_in')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success float-right">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============= Create Modal End ============= -->

            <!-- ============= Table Start ============= -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Speciality Name</th>
                            <th scope="col">Specialized In</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($specialities as $key => $speciality)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $speciality->name ?? '-' }}</td>
                                <td>{{ $speciality->specialized_in ?? '-' }}</td>
                                <td>
                                    <label class="switch switch-success mr-3">

                                        <input type="checkbox" class="form-check-input custom-switch"
                                            id="customSwitchsizemd{{ $speciality->id }}" data-id="{{ $speciality->id }}"
                                            name="status" {{ $speciality->status === 1 ? 'checked' : 'Unchecked' }}>
                                        <span class="slider"></span>

                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success edit-speciality-btn" data-toggle="modal"
                                        data-target="#editModalContent" data-speciality-id="{{ $speciality->id }}">
                                        <i class="nav-icon i-Pen-2"></i>
                                    </button>
                                    <div class="modal fade" id="editModalContent" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalContent" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalContent_title">Edit Speciality</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('speciality.update', $speciality->id) }}"
                                                        id="editForm" method="POST"
                                                        data-route="{{ route('speciality.update', ':id') }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="name" class="col-form-label">Speciality
                                                                Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                required>
                                                            @error('name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="specialized_in" class="col-form-label">Speciality
                                                                In</label><span class="text-danger">*</span>
                                                            <input type="text" class="form-control"
                                                                name="specialized_in" required>
                                                            @error('specialized_in')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-success float-right">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td colspan="5" class="text-center">
                                <h3 class="font-weight-600">No Data Found !!</h3>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- ============= Table End ============= -->

        </div>

        @include('admin.inc.footer');
    </div>
@endsection

@section('script')
    @include('admin.inc.status', ['var_id' => 'specialityId', 'model' => 'Speciality'])
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
