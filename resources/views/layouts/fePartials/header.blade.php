<!-- Loader Start -->
<div id="preloader">
    <div id="status">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
</div>
<!-- Loader End -->
<!-- Start Navbar -->
<nav id="topnav" class="w-screen py-2 defaultscroll is-sticky nav-sticky">
    <div class="container">
        <!-- Logo container-->
        <a class="logo" href="{{ route('homepage') }}">
            <img src="{{ asset('images/logo.png') }}" class="h-24 dark:inline-block" alt="" />
        </a>

        <!--button Start-->
        <ul class="mt-4 list-none buy-button">
            <li class="inline mb-0">
                <div class="inline-block text-end">
                    <p>
                        بِسْمِ اللّٰهِ اَلْرَّحْمَاْن الْرَّحِيْمِ
                    </p>
                    <p>
                        وَ صَلَّي اللهُ عَلَيْكَ يَا وَلِي الْعَصْرِ عَدْرِكْنَا
                    </p>
                </div>
            </li>
        </ul>
        <!-- button End-->
    </div>
    <!--end container-->
</nav>
<!--end header-->
<!-- End Navbar -->

@push('scripts')
    <script>
        function toggleMenu() {
            document.getElementById("isToggle").classList.toggle("open");
            var isOpen = document.getElementById("navigation");
            if (isOpen.style.display === "block") {
                isOpen.style.display = "none";
            } else {
                isOpen.style.display = "block";
            }
        }
    </script>

    <script>
        function changeLanguage(lang) {
            window.location = '{{ url('change-language') }}/' + lang;
        }
    </script>
@endpush
