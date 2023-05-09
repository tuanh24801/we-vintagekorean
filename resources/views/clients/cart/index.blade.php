@extends('layouts.client')
@section('content')
    <section id="collection" class="py-5">
        <div class="container">
            <h4>Giỏ hàng và thông tin thanh toán</h4>
            <a href="{{ url('/products') }}" style="text-decoration: none;">Tiếp tục mua hàng</a>
            <div class="row">
                <div class="col-8">
                    @forelse ($allCart as $cartItem)
                        <br>
                        <div class="card mb-3" style="max-width: 100%; border:none  ">
                            <div class="row g-15">
                                <div class="col-lg-4 col-md-6">
                                    <img src="{{ asset($cartItem->options->image) }}" class="img-fluid rounded-start"
                                        alt="..." style="max-width: 250px;">
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <div class="card-body">
                                        <h3 class="card-title"><b>{{ $cartItem->name }}</b></h3>
                                        <p class="card-text">Đầm vintage korean 2023</p>
                                        <p class="card-text">
                                            @php
                                                $add = $cartItem->qty + 1;
                                                $remove = $cartItem->qty - 1;
                                            @endphp
                                            Số lượng:
                                            <a class="header__cart-item-increment"
                                                href="{{ url('products/updateCart/' . $cartItem->rowId . '/' . $add) }}">+</a>
                                            <span class="header__cart-item-qnt">{{ $cartItem->qty }}</span>
                                            <a class="header__cart-item-uncrement"
                                                href="{{ url('products/updateCart/' . $cartItem->rowId . '/' . $remove) }}">-</a>
                                        </p>
                                        <p class="card-text">
                                            Đơn giá: <b>{{ number_format($cartItem->price , 0, '', ',') }} ₫</b> - (1 chiếc)
                                        </p>
                                        <p class="card-text">
                                            Tổng: <b>{{  number_format($cartItem->price * $cartItem->qty , 0, '', ',') }} ₫</b> - ({{ $cartItem->qty }} chiếc)
                                        </p>
                                        <p class="card-text"><a href="{{ url('cart/' . $cartItem->rowId) }}"
                                                class="btn btn-danger">Xóa khỏi giỏ hàng</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @empty
                        <h3 class="text-center p-5">Đơn hàng rỗng</h3>
                        <p class="text-center"><i>Chúc bạn mua sắm vui vẻ</i></p>
                    @endforelse
                    @if ($allCart->count() > 0)
                        <hr class="mt-5">
                        <a href="{{ url('products/destroyCart') }}" class="btn btn-primary">Xóa giỏ hàng</a>
                    @endif
                </div>
                @if ($allCart->count() > 0)
                <div class="col-4">
                    <p>Hóa đơn</p>
                    <hr>
                    @forelse ($allCart as $cartItem)
                        <p class="fw-b mt-3"><b>{{ $cartItem->name }} : {{ number_format($cartItem->price , 0, '', ',') }} * {{ $cartItem->qty }} </b>
                        </p>
                    @empty
                    @endforelse
                    <p class="mt-4 me-5"><b>Tổng tiền:</b></p>
                    <h5 class="text-danger"><b>{{ Cart::total(0, '', ',') }}</b> vnđ</h5>
                    <hr>
                    <div class="row">
                        <p>Nhập thông tin khách hàng</p>
                        <div class="mb-3">
                            <label for=""><b>Tên khách hàng</b></label>
                            <input type="text" name="user_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for=""><b>Số điện thoại</b></label>
                            <input type="text" name="user_phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for=""><b>Địa chỉ</b></label>
                            <input type="address" name="user_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for=""><b>Email</b></label>
                            <input type="email" name="user_email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <p>Vui lòng chọn hình thức thanh toán</p>
                        <a href="" class="btn btn-sm btn-primary ">Ship CODE</a>
                        <a href="" class="btn btn-sm btn-primary mt-3">Chuyển khoản ngân hàng</a>
                        <a href="" class="btn btn-sm btn-primary  mt-3">Ví điện tử Momo</a>
                        <hr class="mt-4">
                        <a href="" class="btn btn-sm btn-primary mt-2">Liên hệ hỗ trợ thanh toán</a>
                        <p class="text-center mt-1">Hotline: 0379452201</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
