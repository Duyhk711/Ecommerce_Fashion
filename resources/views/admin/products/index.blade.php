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
          <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách Sản Phẩm</h1>
          <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                      <a href="#" style="color: inherit;">Products</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Danh sách Sản Phẩm</li>
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
          <h3 class="block-title">Danh sách Sản Phẩm</h3>
          <div class="block-options">
              <div class="block-options-item">
                  <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Add">
                      <i class="fa fa-plus"></i>
                  </a>
              </div>
          </div>
      </div>
      <div class="block-content block-content-full">
          <!-- Table with data -->
          <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
              <thead>
                  <tr>
                      <th class="text-center" style="width: 100px;">ID</th>
                      <th class="d-none d-sm-table-cell text-center">Added</th>
                      <th class="d-none d-md-table-cell">Product</th>
                      <th>Status</th>
                      <th class="d-none d-sm-table-cell text-end">Value</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td class="text-center fs-sm">
                          <a class="fw-semibold" href="#">
                              <strong>PID.036535</strong>
                          </a>
                      </td>
                      <td class="d-none d-sm-table-cell text-center fs-sm">02/04/2019</td>
                      <td class="d-none d-md-table-cell fs-sm">
                          <a class="fw-semibold" href="#">Product #35</a>
                      </td>
                      <td>
                          <span class="badge bg-success">Available</span>
                      </td>
                      <td class="text-end d-none d-sm-table-cell fs-sm">
                          <strong>$70,00</strong>
                      </td>
                      <td class="text-center fs-sm">
                          <div class="btn-group">
                              <!-- VIEW -->
                              <a href="#" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                                  <i class="fa fa-fw fa-eye"></i>
                              </a>
                              <!-- DELETE -->
                              <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                                  <i class="fa fa-fw fa-times text-danger"></i>
                              </a>
                          </div>
                      </td>
                  </tr>
                  <tr>
                      <td class="text-center fs-sm">
                          <a class="fw-semibold" href="#">
                              <strong>PID.036534</strong>
                          </a>
                      </td>
                      <td class="d-none d-sm-table-cell text-center fs-sm">11/02/2019</td>
                      <td class="d-none d-md-table-cell fs-sm">
                          <a class="fw-semibold" href="#">Product #34</a>
                      </td>
                      <td>
                          <span class="badge bg-success">Available</span>
                      </td>
                      <td class="text-end d-none d-sm-table-cell fs-sm">
                          <strong>$65,00</strong>
                      </td>
                      <td class="text-center fs-sm">
                          <div class="btn-group">
                              <a href="#" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                                  <i class="fa fa-fw fa-eye"></i>
                              </a>
                              <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                                  <i class="fa fa-fw fa-times text-danger"></i>
                              </a>
                          </div>
                      </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036528</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">07/01/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #28</a>
                    </td>
                    <td>
                      <span class="badge bg-danger">Out of Stock</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$19,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036527</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">19/05/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #27</a>
                    </td>
                    <td>
                      <span class="badge bg-danger">Out of Stock</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$60,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036526</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">11/03/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #26</a>
                    </td>
                    <td>
                      <span class="badge bg-danger">Out of Stock</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$20,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036525</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">24/05/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #25</a>
                    </td>
                    <td>
                      <span class="badge bg-success">Available</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$43,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036524</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">11/09/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #24</a>
                    </td>
                    <td>
                      <span class="badge bg-danger">Out of Stock</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$71,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036523</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">04/12/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #23</a>
                    </td>
                    <td>
                      <span class="badge bg-danger">Out of Stock</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$61,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036522</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">26/04/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #22</a>
                    </td>
                    <td>
                      <span class="badge bg-danger">Out of Stock</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$74,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036521</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">06/08/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #21</a>
                    </td>
                    <td>
                      <span class="badge bg-success">Available</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$92,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036520</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">18/11/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #20</a>
                    </td>
                    <td>
                      <span class="badge bg-danger">Out of Stock</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$47,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036519</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">26/07/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #19</a>
                    </td>
                    <td>
                      <span class="badge bg-danger">Out of Stock</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$76,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036518</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">11/02/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #18</a>
                    </td>
                    <td>
                      <span class="badge bg-danger">Out of Stock</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$85,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        <strong>PID.036517</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">16/12/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #17</a>
                    </td>
                    <td>
                      <span class="badge bg-success">Available</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$46,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
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