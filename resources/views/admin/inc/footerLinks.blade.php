<script src="{{ config('app.url') }}/assets/js/common-bundle-script.js"></script>
<script src="{{ config('app.url') }}/assets/js/vendor/echarts.min.js"></script>
<script src="{{ config('app.url') }}/assets/js/es5/echart.options.min.js"></script>
<script src="{{ config('app.url') }}/assets/js/es5/dashboard.v1.script.js"></script>
<script src="{{ config('app.url') }}/assets/js/script.js"></script>
<script src="{{ config('app.url') }}/assets/js/sidebar.large.script.js"></script>
<script src="{{ config('app.url') }}/assets/js/customizer.script.js"></script>

<!-- Toaster Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>

  @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
  @endif
  @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
  @endif
  @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
  @endif
  @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
  @endif
</script>
