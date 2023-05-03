<!-- Store Modal -->
<div wire:ignore.self class="modal fade" id="storeProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm sản phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="resetInput"></button>
            </div>
            <form wire:submit.prevent="storeProduct" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name')
                            <span class="error text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Mô tả</label>
                        <input type="text" wire:model.defer="description" class="form-control">
                        @error('description')
                            <span class="error text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Giá bán gốc</label>
                        <input type="number" wire:model.defer="original_price" class="form-control">
                        @error('original_price')
                            <span class="error text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Giá khuyến mại</label>
                        <input type="number" wire:model.defer="selling_price" class="form-control">
                        <span>*giá khuyến mại phải nhỏ hơn giá gốc</span>
                        @error('selling_price')
                            <span class="error text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Ảnh</label>
                        <input type="file" wire:model.defer="image" class="form-control">
                        @error('image')
                            <span class="error text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div wire:loading wire:target="image">Đang tải ảnh lên...</div>
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" style="width: 150px;">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetInput">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Update Modal -->
<div wire:ignore.self class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sửa thông tin sản phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="resetInput"></button>
            </div>
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateProduct" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name')
                                <span class="error text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Mô tả</label>
                            <input type="text" wire:model.defer="description" class="form-control">
                            @error('description')
                                <span class="error text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Giá bán gốc</label>
                            <input type="number" wire:model.defer="original_price" class="form-control">
                            @error('original_price')
                                <span class="error text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Giá khuyến mại</label>
                            <input type="number" wire:model.defer="selling_price" class="form-control">
                            <span>*giá khuyến mại phải nhỏ hơn giá gốc</span>
                            @error('selling_price')
                                <span class="error text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            @if ($image_)
                                <img src="{{ asset('storage/product_images/') }}/{{ $image_ }}"
                                    style="width: 80px;">
                            @endif
                        </div>
                        <button data-bs-toggle="modal" data-bs-target="#editImage"
                            wire:click="editImage({{ $product_id }})" class="btn btn-primary text-white">Đi đến sửa
                            ảnh</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            wire:click="resetInput">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit Image Modal -->
<div wire:ignore.self class="modal fade" id="editImage" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa ảnh</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateImage">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Ảnh</label>
                        <input type="file" wire:model.defer="image" class="form-control">
                        @error('image')
                            <span class="error text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div wire:loading wire:target="image">Đang tải ảnh lên...</div>
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" style="width: 150px;">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetInput">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyProduct">
                <div class="modal-body">
                    <label for="">Bạn có muốn xóa tài khoản này ? </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetInput">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
