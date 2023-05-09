
<nav class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="{{ route('home') }}">
            <img src="{{ asset('clients/images/logos/vintage-korean-logo-png.png') }}" alt="site icon">
            {{-- <span class="text-uppercase fw-lighter ms-2">Attire</span> --}}
        </a>

        <div class="order-lg-2 nav-btns">
            <button type="button" class="btn position-relative cart opencart_">
                <i class="fa fa-shopping-cart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">{{ Cart::count(); }}</span>
                {{-- cart --}}
                <div class="header__cart-wrap" id="header__cart-wrap">
                    <div class="header__cart-list" id="header__cart-list">
                        <!-- Has cart -->
                        <p class="header__cart-heading">
                            Sản phẩm đã thêm
                            <a href="{{ url('products/destroyCart') }}" class="float-end destroyCart_" style="font-size: 12px; margin-right: 20px;">Xóa giỏ hàng</a>
                        </p>

                        <ul class="header__cart-list-item">
                            @forelse ($allCart as $cartItem)
                            {{-- <hr class="hr_cart"> --}}
                                <li class="header__cart-item">
                                    <img src="{{ asset($cartItem->options->image) }}"
                                        alt="anh san pham" class="header__cart-item-img" />
                                    <div class="header__cart-item-info">
                                        <div class="header__cart-item-head">
                                            <h5 class="header__cart-item-name">
                                                {{ $cartItem->name }}
                                            </h5>
                                            <div class="header__cart-item-price-wrap">
                                                <span class="header__cart-item-price"> {{ number_format($cartItem->price, 0, '', ',') }}₫</span>
                                            </div>
                                        </div>
                                        <div class="header__cart-item-body">
                                            <span class="header__cart-item-desc"><small>Đầm vin 2023</small></span>
                                            <div class="header__cart-item-remove">
                                                @php
                                                    $add = $cartItem->qty + 1;
                                                    $remove = $cartItem->qty - 1;
                                                @endphp
                                                <a class="header__cart-item-increment" href="{{ url('products/updateCart/'.$cartItem->rowId.'/'.$add) }}">+</a>
                                                <span class="header__cart-item-qnt">{{ $cartItem->qty }}</span>
                                                <a class="header__cart-item-uncrement" href="{{ url('products/updateCart/'.$cartItem->rowId.'/'.$remove) }}">-</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                @empty
                                    <p class="p-5">Giỏ hàng trống</p>
                                @endforelse
                                <div class="float-end">Tổng tiền: {{ Cart::total(0, '', ','); }}₫</div>
                        </ul>
                        <a class="header__cart-view btn btn-sm btn-primary closecart_">Đóng</a>
                        <a href="{{ url('cart') }}" class="header__cart-view btn btn-sm btn-primary">Thanh toán</a>
                    </div>
                </div>
                {{-- cart --}}
            </button>
            <button type="button" class="btn position-relative ">
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
                    <a class="nav-link text-dark" href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-dark" href="{{ url('products') }}">Sản phẩm</a>
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

@push('scripts')
    <script>
        var toggleCart = false;
        $('.opencart_').click(function(){
            // toggleCart = !toggleCart;
            setTimeout(() => {
                $('.header__cart-wrap').css('display','block');
                $('.header__cart-list').css('display','block');
            }, 30);
            // alert('Close');
        });
        $('.closecart_').click(function(){
           setTimeout(() => {
            $('.header__cart-wrap', window.parent.document).css('display','none');
            $('.header__cart-list', window.parent.document).css('display','none');
           }, 100);
        });
    </script>
@endpush
