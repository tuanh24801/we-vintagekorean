<div class="row">
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="storeProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm tài khoản</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeProduct">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Tên tài khoản</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name')
                                <span class="error text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" wire:model.defer="email" class="form-control">
                            @error('email')
                                <span class="error text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Mật khẩu</label>
                            <input type="password" wire:model.defer="password" class="form-control">
                            @error('password')
                                <span class="error text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Quyền</label>
                            <select wire:model.defer="role_as" class="form-control">
                                <option value="1">Admin</option>
                                <option value="0">Người dùng</option>
                            </select>
                            @error('role_as')
                                <span class="error text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="deleteAccount">
                    <div class="modal-body">
                        <label for="">Bạn có muốn xóa tài khoản này ? </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card-header">
                <h4>
                    Danh sách sản phẩm
                    <button class="btn btn-sm btn-primary float-end text-white" data-bs-toggle="modal"
                        data-bs-target="#storeProductModal">
                        Thêm sản phẩm
                    </button>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bodered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên tài khoản</th>
                            <th>Email</th>
                            <th>Quyền truy cập</th>
                            <th>Xóa tài khoản</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products = [] as $product)
                            <tr>

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
            // $('#UpdateBrandModal').modal('hide');
            $('#deleteProductModal').modal('hide');
        });
    </script>
@endpush
