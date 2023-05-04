@extends('layouts.client')
@section('content')
<section id = "collection" class = "py-5">
    {{-- products --}}
    <div class = "container">
        <div class = "row g-0">
            <div class = "d-flex flex-wrap mt-5 filter-button-group">
                <button type = "button" class = "btn m-2 text-dark active-filter-btn" data-filter = "*">Đầm vintage korean 2023</button>
                <a href="" class = "btn m-2">Xem tất cả</a>
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
                    <div class = "col-md-6 col-lg-4 col-xl-3 p-2 best">
                        <div class = "collection-img position-relative">
                            <img src = "{{ asset('storage/product_images') }}/{{ $product->image }}" class = "w-100" style="width: 80px; height: 470px;">
                            <span class = "position-absolute bg-primary text-white d-flex align-items-center justify-content-center">sale</span>
                        </div>
                        <div class = "mt-2">
                            <p class = "text-capitalize my-1 ms-2">{{ $product->name }}</p>
                            <span class = "fw-bold ms-2">{{ $product->selling_price }} vnđ</span>
                            <div class = "rating d-flex justify-content-around">
                                <a href="" class="btn btn-sm mt-2">Thêm vào giỏ hàng</a>
                                <a href="" class="btn btn-sm mt-2">Liên hệ</a>
                            </div>
                        </div>
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
</section>

@endsection

@push('scripts')
    <script>
        $(window).on("load", function (e) {
            console.log('aaa');
            var $grid = $('.collection-list').isotope({
                filter: "*"
            });
        });

    </script>
@endpush
