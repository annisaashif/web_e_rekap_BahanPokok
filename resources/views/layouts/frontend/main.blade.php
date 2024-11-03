<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>e-Rekap BaPok</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('layouts.frontend.css')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        @include('layouts.frontend.navbar')

        @include('layouts.frontend.notifikasi')

        @yield('konten')

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <footer>
                <div class="footer-container">
                    <div class="footer-content">
                        <p>&copy; 2024 Dinas Perindustrian dan Perdagangan Sumatera Barat. Semua hak dilindungi.</p>
                        <p>
                            Alamat: Jl. Jenderal Sudirman No. 51, Padang, Sumatera Barat 25127<br>
                            Telepon: (0751) 123456<br>
                            Email: info@disperindagsumbar.go.id
                        </p>

                        <p>
                            <a href="https://www.disperindagsumbar.go.id/privacy-policy">Kebijakan Privasi</a> |
                            <a href="https://www.disperindagsumbar.go.id/terms-of-service">Syarat dan Ketentuan</a> |
                            <a href="https://www.disperindagsumbar.go.id/contact">Kontak Kami</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    @include('layouts.frontend.js')

</body>

</html>
