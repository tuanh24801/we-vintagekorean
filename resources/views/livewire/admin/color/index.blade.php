<div class="row">
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="storeColorModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm màu sắc</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeColor">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Tên màu</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name')
                                <span class="error text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Mã màu</label>
                            <input type="text" wire:model.defer="code" class="form-control">
                            @error('code')
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

    <div wire:ignore.self class="modal fade" id="deleteColorModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="deleteColor">
                    <div class="modal-body">
                        <label for="">Bạn có muốn xóa mã màu này ? </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Xóa</button>
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
                    Danh sách màu sắc
                    <button class="btn btn-sm btn-primary float-end text-white" data-bs-toggle="modal"
                        data-bs-target="#storeColorModal">
                        Thêm màu sắc
                    </button>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bodered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên màu sắc</th>
                            <th>Mãu màu</th>
                            <th>Trạng thái <br><small>click để thay đổi trạng thái</small></th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($colors as $color)
                            <tr>
                                <th>{{ $color->id }}</th>
                                <th>{{ $color->name }}</th>
                                <th>{{ $color->code }}</th>
                                <th>
                                    @if ($color->status == 0)
                                        <button class="btn btn-info"><b>Hiện</b></button>
                                    @else
                                        <button class="btn btn-danger"><b>Ẩn</b></button>
                                    @endif
                                </th>
                                <th>
                                    <button class="btn btn-success text-white">Sửa</button>
                                    <button class="btn btn-danger text-white">Xóa</button>
                                </th>
                            </tr>

                        @empty
                            <tr>
                                <th colspan="5">No record</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $colors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#storeColorModal').modal('hide');
            // $('#UpdateBrandModal').modal('hide');
            $('#deleteColorModal').modal('hide');
        });
    </script>
@endpush
