@extends('layouts.backend')

@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
  <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
          <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách Bình luận</h1>
          <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                      <a href="#" style="color: inherit;">Products</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Danh sách Bình luận/li>
              </ol>
          </nav>
      </div>
  </div>
</div>
<!-- END Hero -->

<div class="content">
  
  <!-- Dynamic Table Full -->
  <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h3 class="block-title">Danh sách Bình luận</h3>
          <div class="block-options">
              <div class="block-options-item">
                //Thêm 
                  <a href="{{route('admin.comments.create')}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Add">
                      <i class="fa fa-plus"></i>
                  </a>
              </div>
          </div>
      </div>
      <div class="block-content block-content-full">
          <!-- Table with data -->
          <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
              <thead>
                  <tr >
                      <th style="text-align: center;" class="text-center" style="width: 100px;">ID</th>
                      <th style="text-align: center;" class="d-none d-sm-table-cell text-center">Người dùng</th>
                      <th style="text-align: center;" class="d-none d-md-table-cell">Sản phẩm</th>
                      <!-- <th style="text-align: center;" class="d-none d-md-table-cell">Tiêu đề</th> -->
                      <th style="text-align: center;" class="d-none d-md-table-cell">Bình luận</th>
                      <th style="text-align: center;">Đánh giá</th>
                      <!-- <th class="d-none d-sm-table-cell text-end">Value</th> -->
                      <th style="text-align: center;" class="text-center">Actions</th>
                  </tr>
              </thead>   
              <tbody>
                @foreach( $comments as $comment)
                  <tr>
                      <td class="text-center fs-sm">
                         {{$comment->id}}
                      </td>
                      <td class="d-none d-sm-table-cell text-center fs-sm">{{$comment->user->name}}</td>
                      <td class="d-none d-md-table-cell fs-sm" style="text-align: center;">
                          <a class="fw-semibold" href="#">{{$comment->product->name}}</a>
                      </td>
                      <!-- <td style="text-align: center;">
                          <span  class="badge bg-success">{{$comment->title}}</span>
                      </td> -->
                      <td  style="text-align: center;">
                          <strong>{{$comment->comment}}</strong>
                      </td>
                       <td  style="text-align: center;">
                          <strong>{{$comment->rating}}</strong>
                      </td>
                      <td class="text-center fs-sm">
                          <div class="btn-group">
                              <!-- VIEW -->
                              <!-- <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                                  <i class="fa fa-fw fa-eye"></i>
                              </a> -->
                              <!-- DELETE -->
                               <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="post">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-sm btn-alt-secondary">
                                            <i class="fa fa-fw fa-times text-danger"></i>
                                        </button>
                               </form>
                             
                          </div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
  <!-- END Dynamic Table Full -->
</div>

@endsection
@section('js')
  <!-- jQuery (required for DataTables plugin) -->
  <script src="{{ asset('admin/js/lib/jquery.min.js') }}"></script>

  <!-- Page JS Plugins -->
  <script src="{{ asset('admin/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>

  <!-- Page JS Code -->
  @vite(['resources/js/pages/datatables.js'])
@endsection