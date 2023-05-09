@extends('layouts.admin')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Sửa sản phẩm
                    <a href="{{ url('we-admin/products') }}" class="btn btn-sm btn-danger float-end text-white"> Trở lại </a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('we-admin/products/' . $product->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name') ? old('name') : $product->name }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Chọn màu sản phẩm</label>
                        <div class="row">
                            @forelse ($colors  as $color)
                                <div class="col-md-3">
                                    <div class="p-5 border">
                                        <input type="checkbox" name="colors[{{ $color->id }}]" value={{ $color->id }}
                                            @if (!is_null(old('colors'))) @foreach (old('colors') as $color_id)
                                                {{ $color->id == $color_id ? 'checked="checked"' : '' }}
                                            @endforeach
                                        @else
                                            @foreach ($product->colors as $product_color)
                                                {{ $color->id == $product_color->id ? 'checked="checked"' : '' }}
                                            @endforeach @endif />
                                        {{ $color->name }}
                                        <br>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">Không tìm thấy mã màu</div>
                            @endforelse
                        </div>
                        @error('colors')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Mô tả</label>
                        <input type="text" class="form-control" name="description" value="{{ old('description') ? old('description') : $product->description }}">
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Giá gốc</label>
                        <input type="text" class="form-control" name="original_price"
                            value="{{ old('original_price') ? old('original_price') : $product->original_price }}">
                        @error('original_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Giá bán</label>
                        <input type="text" class="form-control" name="selling_price" value="{{ old('selling_price') ? old('selling_price') : $product->selling_price }}">
                        @error('selling_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Ảnh sản phẩm</label>
                        <input type="file" multiple class="form-control" name="image" id="image"><br>
                        <img src="
                            @isset($product->images)
                                @foreach ($product->images as $productImages)
                                    {{ asset($productImages->image) }}
                                @endforeach
                            @endisset
                        "
                            id="preview-image-before-upload" style="width: 180px;"/>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary text-white fw-b">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function(e) {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
