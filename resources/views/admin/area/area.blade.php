@extends('admin.layouts.app', ['title' => 'Area'])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Area <i class="nav-icon fa-solid fa-chart-area"></i></h1>
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
                            <h5 class="modal-title" id="verifyModalContent_title">Create Area</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('area.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="area_name" class="col-form-label">Area Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control" name="area_name" required>
                                    @error('area_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pincode" class="col-form-label">Pincode</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control" name="pincode" required maxlength="6">
                                    @error('pincode')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Select City</label><span class="text-danger">*</span>
                                    <select class="form-control" name="city_id" required>
                                        <option disabled selected>Select City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
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
                            <th scope="col">Area Name</th>
                            <th scope="col">Pincode</th>
                            <th scope="col">City Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($areas as $key => $area)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $area->area_name ?? '-' }}</td>
                                <td>{{ $area->pincode ?? '-' }}</td>
                                <td>{{ $area->city->city_name ?? '-' }}</td>
                                <td>
                                    <label class="switch switch-success mr-3">

                                        <input type="checkbox" class="form-check-input custom-switch"
                                            id="customSwitchsizemd{{ $area->id }}" data-id="{{ $area->id }}"
                                            name="status" {{ $area->status === 1 ? 'checked' : 'Unchecked' }}>
                                        <span class="slider"></span>

                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success edit-area-btn" data-toggle="modal"
                                        data-target="#editModalContent" data-area-id="{{ $area->id }}">
                                        <i class="nav-icon i-Pen-2"></i>
                                    </button>
                                    <div class="modal fade" id="editModalContent" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalContent" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalContent_title">Edit Area</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('area.update', $area->id) }}" id="editForm"
                                                        method="POST" data-route="{{ route('area.update', ':id') }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="area_name" class="col-form-label">Area
                                                                Name</label>
                                                            <input type="text" class="form-control" name="area_name"
                                                                required>
                                                            @error('area_name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pincode" class="col-form-label">Pincode</label>
                                                            <input type="text" class="form-control" name="pincode"
                                                                required>
                                                            @error('pincode')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="picker1">Select City</label><span
                                                                class="text-danger">*</span>
                                                            <select class="form-control" name="city_id" required>
                                                                <option value="{{ $area->city_id }}" selected>
                                                                    {{ $area->city->city_name }}</option>
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}">
                                                                        {{ $city->city_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('city_id')
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
                            <td colspan="6" class="text-center">
                                <h3 class="font-weight-600">No Data Found !!</h3>
                            </td>
                        @endforelse
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination float-left">
                        Showing {{ $areas->firstItem() }} to {{ $areas->lastItem() }} of {{ $areas->total() }} entries
                    </ul>
                    <ul class="pagination float-right">
                        {{ $areas->appends(['keyword' => request()->keyword, 'rows' => $rows])->links() }}
                    </ul>
                </nav>
            </div>
            <!-- ============= Table End ============= -->

        </div>

        @include('admin.inc.footer')<br>
    </div>
@endsection

@section('script')
    @include('admin.inc.status', ['var_id' => 'areaId', 'model' => 'Area'])
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
