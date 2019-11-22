<!-- General JS Scripts -->
<script src="{{ asset('general.js') }}"></script>

<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('plugin.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

{{-- Function Log Out --}}
<script>
    let btnLogout = $('#btnLogout');
    btnLogout.click(function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{ url('logout') }}',
            method: 'post',
            data: $(this).serialize(),
            success: function (response) {
                if (response === 'success') {
                    window.location.reload();
                } else {
                    console.log(response);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Gagal Logout',
                        text: 'Silahkan coba lagi atau hubungi WAVE Solusi Indonesia',
                    });
                }
            },
            error: function (response) {
                console.log(response);
                Swal.fire({
                    icon: 'error',
                    title: 'System Error!',
                    text: 'Silahkan hubungi WAVE Solusi Indonesia',
                });
            }
        });
    });
</script>