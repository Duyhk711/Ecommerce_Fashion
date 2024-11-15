@extends('client.my-account')
@section('css')
    <style>
        .btn-delete {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .btn-delete:focus {
            outline: none;
        }

        .btn-delete i {
            color: red;
        }

        p,
        .color {
            color: #88837f;
        }

        th {
            font-weight: normal;
            text-transform: none;
        }
    </style>
@endsection
@section('my-wishlist')
    <div class="">
        <div class="orders-card mt-0 h-100">
            <div class="top-sec d-flex-justify-center justify-content-between mb-4">
                <h2 class="mb-0">Sản phẩm yêu thích</h2>
            </div>

            <div class="table-bottom-brd table-responsive">
                <table class="table align-middle text-center order-table">
                    <thead>
                        <tr class="table-head text-nowrap">
                            <th scope="col" class="color" style="width: 5%;">#</th>
                            <th scope="col" class="color" style="width: 40%;">Sản phẩm</th>
                            <th scope="col" class="color" style="width: 20%;">Đơn giá</th>
                            <th scope="col" class="color" style="width: 20%;">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($favorites as $favorite)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <img class="blur-up lazyload me-2"
                                            data-src="{{Storage::url($favorite->product->img_thumbnail) }}"
                                            src="{{Storage::url($favorite->product->img_thumbnail) }}"
                                            width="50" alt="{{ $favorite->product->name }}"
                                            title="{{ $favorite->product->name }}" />
                                        </div>

                                        <div>
                                            <a href="{{route('productDetail', $favorite->product->slug)}}" style="font-weight: 500;">{{ $favorite->product->name }}</a>
                                        </div>
                                    </div>
                                </td>

                                <!-- Hiển thị giá sản phẩm -->
                                <td>
                                    <span class="price-sale">{{ number_format($favorite->product->price_sale, 3, '.', 0) }}₫</span>
                                </td>

                                <!-- Nút xóa sản phẩm yêu thích -->
                                <td>
                                    <form method="POST" action="{{ route('wishlist.remove', $favorite->product->id) }}"
                                        class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" data-bs-toggle="tooltip" title="Xoá">
                                            <i class="icon anm anm-times-r"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Không có sản phẩm yêu thích.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $favorites->links() }}
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const deleteBtns = document.querySelectorAll('.form-delete');

    for (const btn of deleteBtns) {
        btn.querySelector('.btn-delete').addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Xóa sản phẩm này khỏi danh sách yêu thích?",
                text: "Nếu xóa bạn sẽ không thể khôi phục!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = this.closest('.form-delete');
                    const actionUrl = form.getAttribute('action');

                    fetch(actionUrl, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            form.closest('tr').remove();
                            Swal.fire({
                                title: 'Thành công!',
                                text: data.message,
                                icon: 'success'
                            });
                        } else {
                            Swal.fire({
                                title: 'Lỗi!',
                                text: 'Có lỗi xảy ra, vui lòng thử lại.',
                                icon: 'error'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    }
});

    </script>
@endsection
