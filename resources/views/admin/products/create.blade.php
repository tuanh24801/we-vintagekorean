@extends('layouts.admin')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Thêm mới sản phẩm
                    <a href="{{ url('we-admin/products') }}" class="btn btn-sm btn-danger float-end text-white"> Trở lại </a>
                </h4>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="mb-3">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="">Select Color</label>
                        <div class="row">
                            @forelse ($colors = [] as $color)
                                <div class="col-md-3">
                                    <div class="p-2 border">
                                        Color: <input type="checkbox" name="colors[{{ $color->id }}]" value={{ $color->id }}/> {{ $color->name }}
                                        <br>
                                        Quantity: <input type="number" name="quantitys[{{ $color->id }}]" class="form-control">
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">No colors Found</div>
                            @endforelse
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Mô tả</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="">Giá gốc</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="">Giá bán</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="">Ảnh sản phẩm</label>
                        <input type="file" multiple class="form-control" name="image[]">
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
