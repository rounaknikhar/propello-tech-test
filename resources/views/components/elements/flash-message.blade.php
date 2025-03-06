@if (session()->has('success') || session()->has('error'))
    <div class="fixed top-[60px] right-0 mr-2" id="toastContainer">
        @if (session()->has('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm" role="success">
                <p>{{ session('success') }}</p>
            </div>
        @elseif (session()->has('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-sm" role="error">
                <p>{{ session('error') }}</p>
            </div>
        @endif
    </div>
@endif

{{-- Custom script to handle auto hide the toast message --}}
<script type="text/javascript">
    // Auto hide the toast message after 3 seconds.
    const toastTimeout = setTimeout(autoHideToast, 3000);

    function autoHideToast() {
        document.getElementById("toastContainer").style.visibility = "hidden"
    }
</script>
