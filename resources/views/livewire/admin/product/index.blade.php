<div class="row">
    @include('livewire.admin.product.modal-form')
    {{-- table --}}
    <div class="col-md-12">
        <div class="card">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card-header">
                <h4>
                    Danh sách sản phẩm
                    <a href="{{ url('we-admin/products/create') }}" class="btn btn-sm btn-primary float-end text-white"> Thêm mới sản phẩm </a>
                </h4>
                <p>Lưu ý: Không nên xóa sản phẩm những sản phẩm hết hàng chỉ nên ẩn</p>
            </div>
            <style>
                .table td img {
                    width: 180px;
                    height: auto;
                    border-radius: 0%;
                }
            </style>
            <div class="card-body">
                <table class="table table-striped table-bodered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Màu sắc</th>
                            <th>Giá bán</th>
                            <th>Trạng thái</th>
                            <th>Ảnh</th>
                            <th>Chỉnh sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <ul>
                                    @foreach ($product->colors as $productColor)
                                        <li>{{ $productColor->name }}</li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @if ($product->selling_price != 0)
                                        (<s>{{ $product->original_price }}đ</s>) <br><br> {{ $product->selling_price }}đ
                                    @else
                                        {{ $product->original_price }}đ
                                    @endif
                                </td>
                                <td>
                                    @if ($product->status == '0')
                                        <button class="btn btn-success btn-sm text-white" wire:click="changeStatus({{ $product->id }})">Hiện bán</button><br>
                                        <small>click để ẩn sản phẩm</small>
                                    @else
                                        <button class="btn btn-info btn-sm text-white" wire:click="changeStatus({{ $product->id }})" >Đã ẩn</button><br>
                                        <small>click để mở bán sản phẩm</small>

                                    @endif
                                </td>
                                <td>
                                    @foreach ($product->images as $productImage)
                                        <img src="{{ asset($productImage->image) }}" alt="" style="width: 100px;height:auto;">
                                        {{-- {{ $productImage->image }} --}}
                                    @endforeach
                                </td>
                                <td> <a href="{{ url('we-admin/products/'.$product->id.'/edit') }}"class="btn btn-primary">Sửa</a> </td>
                                <td> <button class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteProductModal" wire:click="deleteProduct({{ $product->id  }})">Xóa</button> </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="5">No record</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteProductModal').modal('hide');
        });
    </script>
@endpush
