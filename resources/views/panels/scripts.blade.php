<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>
@yield('vendor-script')

<!-- BEG IN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>
<script src="{{ asset('js/scripts/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/scripts/jquery/jquery-confirm.js') }}"></script>
<script src="{{ asset('js/scripts/jquery/jquery-validate.min.js') }}"></script>
<script src="{{ asset('js/scripts/tables/jquery.dataTables.js') }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-tinymce.min.js')) }}"></script>
<script src="{{ asset('js/scripts/custom.js') }}"></script>
@include('panels.custom-js')
@stack('js')

@if($configData['blankPage'] === false)
<script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif

<!-- BEGIN: Page JS-->
@yield('page-script')

<!-- CDN JS-->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
