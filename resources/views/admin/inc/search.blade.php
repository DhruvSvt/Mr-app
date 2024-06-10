@php
    $row = $_GET['rows'] ?? '25';
@endphp
<div class="card mt-1 mb-3 mx-2">
    <div class="card-body">
        <form action="?" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <input type="search" class="form-control" name="keyword" placeholder="Enter relevant keyword.."
                        value="{{ request()->keyword ?? '' }}">
                </div>
                <div class="col-md-1 mt-3 mt-md-0">
                    <button type="submit" class="btn btn-gray-800 btn-block">Search</button>
                </div>
                <div class="col-md-7 mt-3 mt-md-0">
                    <div style="max-width: 100px;float: right;">
                        <select class="form-control text-center" name="rows" onchange="this.form.submit()">
                            <option value="25" {{ $row == '25' ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $row == '50' ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $row == '100' ? 'selected' : '' }}>100</option>
                            <option value="250" {{ $row == '250' ? 'selected' : '' }}>250</option>
                            <option value="500" {{ $row == '500' ? 'selected' : '' }}>500</option>
                            <option value="all" {{ $row == 'all' ? 'selected' : '' }}>All</option>
                        </select> entries per page
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
