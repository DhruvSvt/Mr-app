@extends('admin.layouts.app', ['title' => 'Chemist Details'])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Chemist Details <i class="nav-icon i-Shop"></i></h1>
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
                            <th scope="col">Chemist Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Speciality</th>
                            <th scope="col">Area</th>
                            <th scope="col">Contact Person</th>
                            <th scope="col">View More</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($chemists as $key => $chemist)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    @if ($chemist->image)
                                        <img src="{{ asset('storage/images/chemists/' . $chemist->image) }}"
                                            style="width: 100px; height: 85px; object-fit: cover;">
                                    @else
                                        <span>No image found!</span>
                                    @endif
                                </td>
                                <td>{{ $chemist->name ?? '-' }}</td>
                                <td>{{ $chemist->email ?? '-' }}</td>
                                <td>{{ $chemist->speciality->name ?? '-' }}</td>
                                <td>{{ $chemist->area->area_name ?? '-' }}</td>
                                <td>{{ $chemist->contact_person ?? '-' }}</td>
                                <td><a href="{{ route('chemist.show', $chemist->id) }}" class="btn btn-success">View
                                        More</a>
                                </td>
                                <td>
                                    <label class="switch switch-success mr-3">

                                        <input type="checkbox" class="form-check-input custom-switch"
                                            id="customSwitchsizemd{{ $chemist->id }}" data-id="{{ $chemist->id }}"
                                            name="status" {{ $chemist->status === 1 ? 'checked' : 'Unchecked' }}>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="{{ route('chemist.edit', $chemist->id) }}">
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
                    'model' => $chemists,
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
    @include('admin.inc.status', ['var_id' => 'chemistId', 'model' => 'Chemist'])
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
