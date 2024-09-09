@extends('layouts.backend')

@section('content')
     <!-- Page Content -->
     <div class="content">
        <!-- Quick Overview -->
        <div class="row items-push">
          <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="be_pages_ecom_orders.html">
              <div class="block-content py-5">
                <div class="fs-3 fw-semibold text-primary mb-1">78</div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Pending
                </p>
              </div>
            </a>
          </div>
          <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="fs-3 fw-semibold mb-1">126</div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Today
                </p>
              </div>
            </a>
          </div>
          <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="fs-3 fw-semibold mb-1">350</div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Yesterday
                </p>
              </div>
            </a>
          </div>
          <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="fs-3 fw-semibold mb-1">89.752</div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  This Month
                </p>
              </div>
            </a>
          </div>
        </div>
        <!-- END Quick Overview -->

        <!-- All Orders -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">All Orders</h3>
            <div class="block-options">
              <div class="dropdown">
                <button type="button" class="btn btn-alt-secondary" id="dropdown-ecom-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filters
                  <i class="fa fa-angle-down ms-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters">
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    Pending..
                    <span class="badge bg-primary rounded-pill">78</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    Processing
                    <span class="badge bg-black-50 rounded-pill">12</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    For Delivery
                    <span class="badge bg-black-50 rounded-pill">20</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    Canceled
                    <span class="badge bg-black-50 rounded-pill">5</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    Delivered
                    <span class="badge bg-black-50 rounded-pill">280</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    All
                    <span class="badge bg-black-50 rounded-pill">19k</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="block-content bg-body-dark">
            <!-- Search Form -->
            <form action="be_pages_ecom_orders.html" method="POST" onsubmit="return false;">
              <div class="mb-4">
                <input type="text" class="form-control form-control-alt" id="dm-ecom-orders-search" name="dm-ecom-orders-search" placeholder="Search all orders..">
              </div>
            </form>
            <!-- END Search Form -->
          </div>
          <div class="block-content">
            <!-- All Orders Table -->
            <div class="table-responsive">
              <table class="table table-borderless table-striped table-vcenter fs-sm">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 100px;">ID</th>
                    <th class="d-none d-sm-table-cell text-center">Submitted</th>
                    <th>Status</th>
                    <th class="d-none d-xl-table-cell">Customer</th>
                    <th class="d-none d-xl-table-cell text-center">Products</th>
                    <th class="d-none d-sm-table-cell text-end">Value</th>
                    <th class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019265</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">26/11/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-warning">Processing</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Susan Day</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">7</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$1160,82</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="{{route('admin.order.show')}}">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019264</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">08/08/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-danger">Canceled</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Amanda Powell</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">4</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$850,74</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019263</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">14/02/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-success">Delivered</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Megan Fuller</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">3</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$27,23</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019262</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">26/06/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-success">Delivered</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Amanda Powell</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">5</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$2197,73</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019261</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">03/03/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-success">Delivered</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Jose Parker</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">4</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$2424,46</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019260</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">27/07/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-danger">Canceled</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Jose Wagner</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">2</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$359,23</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019259</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">21/12/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-success">Delivered</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Ryan Flores</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">8</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$418,11</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019258</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">25/10/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-danger">Canceled</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Melissa Rice</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">6</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$1872,30</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019257</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">02/09/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-danger">Canceled</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Jack Greene</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">1</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$2333,83</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019256</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">15/01/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-info">For delivery</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Adam McCoy</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">2</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$2219,69</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019255</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">22/08/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-success">Delivered</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Albert Ray</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">4</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$1290,97</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019254</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">20/02/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-warning">Processing</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Sara Fields</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">3</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$1313,35</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019253</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">09/03/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-warning">Processing</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Carol White</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">4</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$2287,13</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019252</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">03/12/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-warning">Processing</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Carol Ray</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">2</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$2079,98</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019251</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">02/01/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-warning">Processing</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Jack Estrada</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">5</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$2035,52</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019250</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">17/04/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-danger">Canceled</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Amber Harvey</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">4</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$2232,30</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019249</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">07/02/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-danger">Canceled</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Scott Young</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">3</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$1380,79</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019248</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">06/05/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-danger">Canceled</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Carol Ray</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">6</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$1359,20</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">
                        <strong>ORD.019247</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center">04/09/2020</td>
                    <td class="fs-base">
                      <span class="badge rounded-pill bg-danger">Canceled</span>
                    </td>
                    <td class="d-none d-xl-table-cell">
                      <a class="fw-semibold" href="be_pages_ecom_customer.html">Jack Estrada</a>
                    </td>
                    <td class="d-none d-xl-table-cell text-center">
                      <a class="fw-semibold" href="be_pages_ecom_order.html">6</a>
                    </td>
                    <td class="d-none d-sm-table-cell text-end">
                      <strong>$2252,67</strong>
                    </td>
                    <td class="text-center fs-base">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_order.html">
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
            <!-- END All Orders Table -->

            <!-- Pagination -->
            <nav aria-label="Photos Search Navigation">
              <ul class="pagination justify-content-end mt-2">
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-label="Previous">
                    Prev
                  </a>
                </li>
                <li class="page-item active">
                  <a class="page-link" href="javascript:void(0)">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)">2</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)">3</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)">4</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)" aria-label="Next">
                    Next
                  </a>
                </li>
              </ul>
            </nav>
            <!-- END Pagination -->
          </div>
        </div>
        <!-- END All Orders -->
      </div>
      <!-- END Page Content -->
@endsection