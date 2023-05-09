@extends('layouts.client')
@section('content')
    {{-- products --}}
    <div class = "container">
        <div class = "row g-0">
            <div class = "d-flex flex-wrap mt-5 filter-button-group">
                <button type = "button" class = "btn m-2 text-dark active-filter-btn" data-filter = "*">Trang sản phẩm VINTAGEKOREAN</button>
                <button type = "button" class = "btn m-2 text-dark active-filter-btn" data-filter = "*">Đầm vintage korean 2023</button>
            </div>
            <p>#sản phẩm mới nhất</p>

            <style>
                .btn-sm{
                    padding: 10px 20px;
                    font-size: 11px;
                    border-radius: 10px;
                }
            </style>
            {{-- <div class="search_">
                <form action="">
                    <input type="text" class="form-control mb-3" placeholder="tên sản phẩm">
                    <input type="submit" class="btn btn-primary">
                </form>
            </div> --}}
            <div class = "collection-list mt-0 row gx-0 gy-3">

                @forelse ($products as $product)
                    <div class = "col-md-6 col-lg-4 col-xl-3 p-2 best product_">
                        {{-- <form action=""> --}}
                            <div class = "collection-img position-relative">
                                <input type="hidden" class="product_id" value="{{ $product->id }}">
                                @foreach ($product->images as $productImage)
                                    <img src = "{{ asset($productImage->image) }}" class = "w-100" style="width: 80px; height: 470px;">
                                @endforeach

                                <span class = "position-absolute bg-primary text-white d-flex align-items-center justify-content-center">sale</span>
                            </div>
                            <div class = "mt-2">
                                <p class = "text-capitalize my-1 ms-2">{{ $product->name }}</p>
                                <span class = "fw-bold ms-2">{{ $product->selling_price }} vnđ</span>
                                <div class = "rating d-flex justify-content-around">
                                    <button class="btn btn-sm mt-2 addToCart" >Thêm vào giỏ hàng</button>
                                    <button class="btn btn-sm mt-2 pay">Mua ngay</button>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                @empty
                    <div class = "col-md-12">
                        <h3 class = "text-center">Không có sản phẩm nào</h3>
                    </div>
                @endforelse
                <p class = "mt-3"></p>
                <div class="paginate">
                    {{ $products->render() }}
                </div>
            </div>
        </div>
    </div>
    {{-- end-products --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $(document).on('click', '.addToCart', function(){
                let product_id = $(this).closest('.product_').find('.product_id').val();
                let data = {
                    'product_id' : product_id,
                };
                $.ajax({
                    type: "POST",
                    url: "/products/addCart/"+product_id,
                    data: data,
                    success: function(response){
                        window.location.reload();
                    }
                });
            });
            $(document).on('click', '.pay', function(){
                let product_id = $(this).closest('.product_').find('.product_id').val();
                let data = {
                    'product_id' : product_id,
                };
                $.ajax({
                    type: "POST",
                    url: "/products/addCart/"+product_id,
                    data: data,
                    success: function(response){
                        window.location.href = '/cart';
                    }
                });
            });
        });

        $(window).on("load", function (e) {
            var $grid = $('.collection-list').isotope({
                filter: "*"
            });
        });
    </script>
@endpush
