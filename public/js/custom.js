// ------------------------------- City Script -------------------------------
$(document).ready(function () {
    $('.edit-city-btn').click(function () {
        var cityId = $(this).data('city-id');
        var route = $('#editForm').data('route').replace(':id', cityId);

        $.ajax({
            url: '/admin/city/' + cityId + '/edit',
            type: 'GET',
            success: function (response) {
                $('#editForm').attr('action', route);

                $('#editModalContent').find('input[name="city_name"]').val(response
                    .city_name);
                $('#editModalContent').find('input[name="state_name"]').val(response
                    .state_name);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

// ------------------------------- Area Script -------------------------------
$(document).ready(function () {
    $('.edit-area-btn').click(function () {
        var areaId = $(this).data('area-id');
        var route = $('#editForm').data('route').replace(':id', areaId);

        $.ajax({
            url: '/admin/area/' + areaId + '/edit',
            type: 'GET',
            success: function (response) {
                $('#editForm').attr('action', route);

                $('#editModalContent').find('input[name="area_name"]').val(response
                    .area_name);
                $('#editModalContent').find('input[name="pincode"]').val(response
                    .pincode);
                $('#editModalContent').find('input[name="city_id"]').val(response
                    .city_id);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

// ------------------------------- Product Script -------------------------------
$(document).ready(function () {
    $('.edit-product-btn').click(function () {
        var productId = $(this).data('product-id');
        var route = $('#editForm').data('route').replace(':id', productId);

        $.ajax({
            url: '/admin/product/' + productId + '/edit',
            type: 'GET',
            success: function (response) {
                $('#editForm').attr('action', route);

                $('#editModalContent').find('input[name="name"]').val(response.name);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

// ------------------------------- Strength Script ------------------------------
$(document).ready(function () {
    $('.edit-strength-btn').click(function () {
        var strengthId = $(this).data('strength-id');
        var route = $('#editForm').data('route').replace(':id', strengthId);
        $.ajax({
            url: '/admin/strength/' + strengthId + '/edit',
            type: 'GET',
            success: function (response) {
                $('#editForm').attr('action', route);

                $('#editModalContent').find('input[name="name"]').val(response
                    .name);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
// ------------------------------- Speciality Script -------------------------------
$(document).ready(function () {
    $('.edit-speciality-btn').click(function () {
        var specialityId = $(this).data('speciality-id');
        var route = $('#editForm').data('route').replace(':id', specialityId);
        $.ajax({
            url: '/admin/speciality/' + specialityId + '/edit',
            type: 'GET',
            success: function (response) {
                $('#editForm').attr('action', route);

                $('#editModalContent').find('input[name="name"]').val(response
                    .name);
                $('#editModalContent').find('input[name="specialized_in"]').val(response
                    .specialized_in);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
