<nav class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="index.html">
            <img src="{{ asset('clients/images/logos/vintage-korean-logo-png.png') }}" alt="site icon">
            {{-- <span class="text-uppercase fw-lighter ms-2">Attire</span> --}}
        </a>

        <div class="order-lg-2 nav-btns">
            <button type="button" class="btn position-relative">
                <i class="fa fa-shopping-cart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">5</span>
            </button>
            <button type="button" class="btn position-relative">
                <i class="fa fa-heart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">2</span>
            </button>
            <button type="button" class="btn position-relative">
                <i class="fa fa-search"></i>
            </button>
        </div>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-lg-1" id="navMenu">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-dark" href="#header">Trang chủ</a>
                </li>
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-dark" href="#collection">Sản phẩm</a>
                </li>

                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-dark" href="#special">Cộng tác viên</a>
                </li>

                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-dark" href="#blogs">Bài viết</a>
                </li>

                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-dark" href="#about">Về chúng tôi</a>
                </li>
                {{-- <li class="nav-item px-2 py-2 border-0">
                    <a class="nav-link text-uppercase text-dark" href="#popular">popular</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
