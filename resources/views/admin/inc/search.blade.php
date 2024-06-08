@php
    $row = $_GET['rows'] ?? '25';
@endphp
<div class="card mt-1 mb-3 mx-2">
    <div class="card-body">
        <form action="?" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <input type="search" class="form-control" name="keyword" placeholder="Enter relevant keyword.."
                        value="{{ $_GET['keyword'] ?? '' }}">
                </div>
                <div class="col-md-1 mt-3 mt-md-0">
                    <button type="submit" class="btn btn-gray-800 btn-block">Search</button>
                </div>
                <div class="col-md-2 mt-3 mt-md-0">
                    <select class="form-control" name="rows" onchange="this.form.submit()">
                        <option value="1" {{ $row == '1' ? 'selected' : false }}>1
                        </option>
                        <option value="2" {{ $row == '2' ? 'selected' : false }}>2
                        </option>
                        <option value="3" {{ $row == '3' ? 'selected' : false }}>3
                        </option>
                        <option value="4" {{ $row == '4' ? 'selected' : false }}>4
                        </option>
                        <option value="500" {{ $row == '500' ? 'selected' : false }}>500
                        </option>
                        <option value="all" {{ $row == 'all' ? 'selected' : false }}>All
                        </option>
                    </select> entries per page
                </div>
            </div>
        </form>
    </div>
</div>
