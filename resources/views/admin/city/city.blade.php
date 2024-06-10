@extends('admin.layouts.app', ['title' => 'City'])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>City <i class="nav-icon fa-solid fa-city"></i></h1>
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
                            <h5 class="modal-title" id="verifyModalContent_title">Create City</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('city.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="city_name" class="col-form-label">City Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control" name="city_name" required>
                                    @error('city_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="state_name" class="col-form-label">State Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control" name="state_name" required>
                                    @error('state_name')
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
                @include('admin.inc.search')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">City Name</th>
                            <th scope="col">State Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cities as $key => $city)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $city->city_name ?? '-' }}</td>
                                <td>{{ $city->state_name ?? '-' }}</td>
                                <td>
                                    <label class="switch switch-success mr-3">

                                        <input type="checkbox" class="form-check-input custom-switch"
                                            id="customSwitchsizemd{{ $city->id }}" data-id="{{ $city->id }}"
                                            name="status" {{ $city->status === 1 ? 'checked' : 'Unchecked' }}>
                                        <span class="slider"></span>

                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success edit-city-btn" data-toggle="modal"
                                        data-target="#editModalContent" data-city-id="{{ $city->id }}">
                                        <i class="nav-icon i-Pen-2"></i>
                                    </button>
                                    <div class="modal fade" id="editModalContent" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalContent" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalContent_title">Edit City</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('city.update', $city->id) }}" id="editForm"
                                                        method="POST" data-route="{{ route('city.update', ':id') }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="city_name" class="col-form-label">City
                                                                Name</label>
                                                            <input type="text" class="form-control" name="city_name"
                                                                required>
                                                            @error('city_name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="state_name" class="col-form-label">State
                                                                Name</label>
                                                            <input type="text" class="form-control" name="state_name"
                                                                required>
                                                            @error('state_name')
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
                @include('admin.inc.paginate', [
                    'model' => $cities,
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
    @include('admin.inc.status', ['var_id' => 'cityId', 'model' => 'City'])
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
