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
                    <button class="btn btn-sm btn-primary float-end text-white" data-bs-toggle="modal"
                        data-bs-target="#storeProductModal" wire:click = "resetInput">
                        Thêm sản phẩm
                    </button>
                </h4>
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
                                    <img src="{{ asset('storage/product_images/') }}/{{ $product->image }}" alt="{{ $product->slug }}" style="width: 80px;">
                                </td>
                                <td> <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateProductModal" wire:click="editProduct({{ $product->id  }})">Sửa</button> </td>
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
            $('#storeProductModal').modal('hide');
            $('#deleteProductModal').modal('hide');
            $('#updateProductModal').modal('hide');
            $('#editImage').modal('hide');
        });
    </script>
@endpush
