<script>
    // Ajax Request
    $(document).ready(function() {
        $(document).on('change', '.custom-switch', function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let varId = $(this).data('id');
            let model = '{{  $model }}';
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/admin/status", // Corrected this line
                data: {
                    '_token': '{{ csrf_token() }}',
                    'status': status,
                    'var_id': varId,
                    'model':model
                },
                success: function(data) {
                    if (data.status === 'on') {
                        toastr.success(data.message);
                    }
                    if (data.status === 'off') {
                        toastr.warning(data.message);
                    }
                },
                error: function(data) {
                    toastr.error(
                        'An error occurred while processing your request please try again later !!'
                    );
                }
            });
        });
    });
</script>
