@extends('admin.layouts.app', ['title' => 'Product'])
@section('section')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Product <i class="nav-icon fa-solid fa-capsules"></i></h1>
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
                            <h5 class="modal-title" id="verifyModalContent_title">Create Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('product.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Product Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control" name="name" required>
                                    @error('name')
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
                            <th scope="col">Product Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $key => $product)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $product->name ?? '-' }}</td>
                                <td>
                                    <label class="switch switch-success mr-3">

                                        <input type="checkbox" class="form-check-input custom-switch"
                                            id="customSwitchsizemd{{ $product->id }}" data-id="{{ $product->id }}"
                                            name="status" {{ $product->status === 1 ? 'checked' : 'Unchecked' }}>
                                        <span class="slider"></span>

                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success edit-product-btn" data-toggle="modal"
                                        data-target="#editModalContent" data-product-id="{{ $product->id }}">
                                        <i class="nav-icon i-Pen-2"></i>
                                    </button>
                                    <div class="modal fade" id="editModalContent" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalContent" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalContent_title">Edit Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('product.update', $product->id) }}"
                                                        id="editForm" method="POST"
                                                        data-route="{{ route('product.update', ':id') }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="name" class="col-form-label">Product
                                                                Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                required>
                                                            @error('name')
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
                            <td colspan="4" class="text-center">
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
    @include('admin.inc.status', ['var_id' => 'productId', 'model' => 'Product'])
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
