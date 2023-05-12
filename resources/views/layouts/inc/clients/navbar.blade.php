<nav class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="{{ route('home') }}">
            <img src="{{ asset('clients/images/logos/vintage-korean-logo-png.png') }}" alt="site icon">
            {{-- <span class="text-uppercase fw-lighter ms-2">Attire</span> --}}
        </a>

        <div class="order-lg-2 nav-btns">
            <button type="button" class="position-relative cart" style="border:none;">
                <i class="fa fa-shopping-cart" wire:click="clickCart" style="padding: 7px;"></i>
                <span
                    class="position-absolute top-0 start-100 translate-middle badge bg-primary">{{ Cart::count() }}</span>
                {{-- cart --}}
                <div class="header__cart-wrap" id="header__cart-wrap" style="display: {{ $display }};">
                    <div class="header__cart-list" id="header__cart-list" style="display: {{ $display }};">
                        <!-- Has cart -->
                        <p class="header__cart-heading">
                            Sản phẩm đã thêm
                            <a class="float-end destroyCart_" style="font-size: 12px; margin-right: 20px;"
                                wire:click="destroyCart">Xóa giỏ
                                hàng</a>
                        </p>
                        <ul class="header__cart-list-item" id="list_item_cart">
                            <div class="float-start" style="margin-left: 10px; margin-top:5px;">Tổng tiền: <b>{{ Cart::total(0, '', ',') }}₫</b></div><br><hr>
                            @forelse ($allCart as $cartItem)
                                {{-- <hr class="hr_cart"> --}}
                                <li class="header__cart-item">
                                    <img src="{{ asset($cartItem->options->image) }}" alt="anh san pham"
                                        class="header__cart-item-img" />
                                    <div class="header__cart-item-info">
                                        <div class="header__cart-item-head">
                                            <h5 class="header__cart-item-name">
                                                {{ $cartItem->name }}
                                            </h5>
                                            <div class="header__cart-item-price-wrap">
                                                <span class="header__cart-item-price">
                                                    {{ number_format($cartItem->price, 0, '', ',') }}₫</span>
                                            </div>
                                        </div>
                                        <div class="header__cart-item-body action_">
                                            <span class="header__cart-item-desc"><small>Đầm vin 2023</small></span>
                                            <div class="header__cart-item-remove">
                                                @php
                                                    $rowId = $cartItem->name;
                                                @endphp
                                                <input type="hidden" class="rowId" value="{{ $cartItem->rowId }}">
                                                <input type="hidden" class="qty" value="{{ $cartItem->qty }}">
                                                <a class="header__cart-item-increment increaseItem"
                                                    wire:click="openCart">+</a>
                                                <span class="header__cart-item-qnt">{{ $cartItem->qty }}</span>
                                                <a class="header__cart-item-uncrement uncreaseItem"
                                                    wire:click="openCart">-</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <hr>
                            @empty
                                <p class="p-5">Giỏ hàng trống</p>
                            @endforelse

                        </ul>
                        {{-- {{ $name }} --}}
                        <a class="header__cart-view btn btn-sm btn-primary closecart_" wire:click="closeCart">Đóng</a>
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.increaseItem', function() {
                let rowId = $(this).closest('.action_').find('.rowId').val();
                let qty = $(this).closest('.action_').find('.qty').val();
                let data = {
                    'rowId': rowId,
                    'qty': qty++,
                };
                $.ajax({
                    type: "POST",
                    url: "/products/updateCart/" + rowId + "/" + qty,
                    data: data,
                    success: function(response) {
                        // thành công
                    }
                });
            });

            $(document).on('click', '.uncreaseItem', function() {
                let rowId = $(this).closest('.action_').find('.rowId').val();
                let qty = $(this).closest('.action_').find('.qty').val();
                let data = {
                    'rowId': rowId,
                    'qty': qty--,
                };
                $.ajax({
                    type: "POST",
                    url: "/products/updateCart/" + rowId + "/" + qty,
                    data: data,
                    success: function(response) {
                        // thành công
                    }
                });
            });
        });
    </script>
@endpush
