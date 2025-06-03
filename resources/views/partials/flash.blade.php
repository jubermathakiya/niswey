<script>

    //success flash
    @if(session('success'))
        successToast("{{ session('success') }}")
    @endif

    //error flash
    @if(session('error'))

        errorToast("{{ session('error') }}")
    @endif

    //info flash
    @if(session('info'))

        infoToast("{{ session('info') }}")
    @endif

    //warning flash
    @if(session('warning'))

        warningToast("{{ session('warning') }}")
    @endif

</script>
