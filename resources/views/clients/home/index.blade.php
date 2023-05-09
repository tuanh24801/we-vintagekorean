@extends('layouts.client')
@section('content')
    @include('layouts.inc.clients.slide_banner')
    {{-- products --}}
    <div class = "container">
        <div class = "row g-0">
            <div class = "d-flex flex-wrap mt-5 filter-button-group">
                <button type = "button" class = "btn m-2 text-dark active-filter-btn" data-filter = "*">Đầm vintage korean 2023</button>
                <a href="{{ url('products') }}" class = "btn m-2">Xem tất cả</a>
            </div>
            <p>#sản phẩm mới nhất</p>
            <style>
                .btn-sm{
                    padding: 10px 20px;
                    font-size: 11px;
                    border-radius: 10px;
                }
            </style>
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
                                <p class = "text-capitalize my-1 ms-2">Đầm vintage 2023 {{ $product->name }}</p>
                                <span class = "fw-bold ms-2">Giá bán: {{ number_format($product->selling_price, 0, '', ',') }} ₫</span>
                                <div class="description">
                                    <p class = "text-capitalize my-1 ms-2" style="font-size: 12px;">#{{ $product->description }}</p>
                                </div>
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

    {{-- posts --}}
    <section id = "blogs" class = "py-5">
        <div class = "container">
            <div class = "title ms-4 py-5">
                <h2 class = "position-relative d-inline-block ">Bài viết</h2>
            </div>

            <div class = "row g-3">
                <div class = "card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                    <img src = "{{ asset('clients/images/posts/331153080_214040541174093_6736435852795208342_n.jpg') }}" alt = "">
                    <div class = "card-body px-0">
                        <h4 class = "card-title">Xu hướng đầm vin 2023</h4>
                        <p class = "card-text mt-3 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet aspernatur repudiandae nostrum dolorem molestias odio. Sit fugit adipisci omnis quia itaque ratione iusto sapiente reiciendis, numquam officiis aliquid ipsam fuga.</p>
                        <p class = "card-text">
                            <small class = "text-muted">
                                <span class = "fw-bold">Author: </span>John Doe
                            </small>
                        </p>
                        <a href = "#" class = "btn">Đọc tiếp</a>
                    </div>
                </div>

                <div class = "card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                    <img src = "{{ asset('clients/images/posts/331153080_214040541174093_6736435852795208342_n.jpg') }}" alt = "">
                    <div class = "card-body px-0">
                        <h4 class = "card-title">Lorem ipsum, dolor sit amet consectetur adipisicing</h4>
                        <p class = "card-text mt-3 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet aspernatur repudiandae nostrum dolorem molestias odio. Sit fugit adipisci omnis quia itaque ratione iusto sapiente reiciendis, numquam officiis aliquid ipsam fuga.</p>
                        <p class = "card-text">
                            <small class = "text-muted">
                                <span class = "fw-bold">Author: </span>John Doe
                            </small>
                        </p>
                        <a href = "#" class = "btn">Read More</a>
                    </div>
                </div>

                <div class = "card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                    <img src = "{{ asset('clients/images/posts/331153080_214040541174093_6736435852795208342_n.jpg') }}" alt = "">
                    <div class = "card-body px-0">
                        <h4 class = "card-title">Lorem ipsum, dolor sit amet consectetur adipisicing</h4>
                        <p class = "card-text mt-3 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet aspernatur repudiandae nostrum dolorem molestias odio. Sit fugit adipisci omnis quia itaque ratione iusto sapiente reiciendis, numquam officiis aliquid ipsam fuga.</p>
                        <p class = "card-text">
                            <small class = "text-muted">
                                <span class = "fw-bold">Author: </span>John Doe
                            </small>
                        </p>
                        <a href = "#" class = "btn">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- end-posts --}}
{{-- </section> --}}

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
