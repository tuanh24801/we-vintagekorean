
<div>
    @include('layouts.inc.clients.navbar')
    <div style="margin-top: 80px;"></div>
    <div class="container">
        <div class="row g-0">
            <div class="d-flex flex-wrap mt-5 filter-button-group">
                <button type="button" class="btn m-2 text-dark active-filter-btn" data-filter="*">Đầm vintage korean
                    2023</button>
                <button type="button" class="btn m-2 text-dark active-filter-btn" data-filter="*">Đầm vintage</button>

            </div>
            <p>#sản phẩm mới nhất</p>
            <style>
                .btn-sm {
                    padding: 10px 20px;
                    font-size: 11px;
                    border-radius: 10px;
                }
            </style>
            <div id="message_res"></div>

            <div class="collection-list mt-0 row gx-0 gy-3">
                @forelse ($products as $product)
                    <div class="col-md-6 col-lg-4 col-xl-3 p-2 best product_">
                        {{-- <form action=""> --}}
                        <div class="collection-img position-relative">

                            @foreach ($product->images as $productImage)
                                <img src="{{ asset($productImage->image) }}" class="w-100"
                                    style="width: 80px; height: 470px;">
                            @endforeach

                            <span
                                class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">sale</span>
                        </div>
                        <div class="mt-2">
                            <p class="text-capitalize my-1 ms-2">Đầm vintage 2023 {{ $product->name }}</p>
                            <span class="fw-bold ms-2">Giá bán:
                                {{ number_format($product->selling_price, 0, '', ',') }}
                                ₫</span>
                            <div class="description">
                                <p class="text-capitalize my-1 ms-2" style="font-size: 12px;">
                                    #{{ $product->description }}
                                </p>
                            </div>
                            <div class="rating d-flex justify-content-around">
                                <button class="btn btn-sm mt-2 opencart_" wire:click="addToCart({{ $product->id }})">Thêm vào giỏ hàng</button>
                                <button class="btn btn-sm mt-2 pay">Mua ngay</button>
                            </div>
                        </div>
                        {{-- </form> --}}
                    </div>
                @empty
                    <div class="col-md-12">
                        <h3 class="text-center">Không có sản phẩm nào</h3>
                    </div>
                @endforelse
                <p class="mt-3"></p>
                <div class="paginate mb-3">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>

</div>

@push('scriptps')
    {{-- <script>
        $('.opencart_').click(function(){
            $('.header__cart-wrap').css('display','block');
            $('.header__cart-list').css('display','block');
        });
    </script> --}}
@endpush


