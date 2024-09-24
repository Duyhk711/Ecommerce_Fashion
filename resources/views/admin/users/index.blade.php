@extends('layouts.backend')

@section('content')
     <!-- Hero -->
     <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Responsive</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <!-- END Hero -->
        <!-- Page Content -->
        <div class="content">
            <!-- Full Table -->
            <div class="block block-rounded">
              <div class="block-header block-header-default">
                <h3 class="block-title">Full Table</h3>
                <div class="block-options">
                  <button type="button" class="btn-block-option">
                    <i class="si si-settings"></i>
                  </button>
                </div>
              </div>
              <div class="block-content">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 100px;">
                          <i class="far fa-user"></i>
                        </th>
                        <th>Name</th>
                        <th style="width: 30%;">Email</th>
                        <th style="width: 15%;">Access</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">
                          <img class="img-avatar img-avatar48" src="{{asset('admin/media/avatars/avatar3.jpg')}}" alt="">
                        </td>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">Alice Moore</a>
                        </td>
                        <td>client1<em class="text-muted">@example.com</em></td>
                        <td>
                          <span class="badge bg-danger">Disabled</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show" href="{{route('admin.users.show')}}">
                              <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          <img class="img-avatar img-avatar48" src="{{asset('admin/media/avatars/avatar4.jpg')}}" alt="">
                        </td>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">Carol White</a>
                        </td>
                        <td>client2<em class="text-muted">@example.com</em></td>
                        <td>
                          <span class="badge bg-info">Business</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show" href="{{route('admin.users.show')}}">
                              <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          <img class="img-avatar img-avatar48" src="{{asset('admin/media/avatars/avatar5.jpg')}}" alt="">
                        </td>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">Megan Fuller</a>
                        </td>
                        <td>client3<em class="text-muted">@example.com</em></td>
                        <td>
                          <span class="badge bg-danger">Disabled</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show" href="{{route('admin.users.show')}}">
                              <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          <img class="img-avatar img-avatar48" src="{{asset('admin/media/avatars/avatar8.jpg')}}" alt="">
                        </td>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">Marie Duncan</a>
                        </td>
                        <td>client4<em class="text-muted">@example.com</em></td>
                        <td>
                          <span class="badge bg-danger">Disabled</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show" href="{{route('admin.users.show')}}">
                              <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          <img class="img-avatar img-avatar48" src="{{asset('admin/media/avatars/avatar4.jpg')}}" alt="">
                        </td>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">Lisa Jenkins</a>
                        </td>
                        <td>client5<em class="text-muted">@example.com</em></td>
                        <td>
                          <span class="badge bg-warning">Trial</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show" href="{{route('admin.users.show')}}">
                              <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- END Full Table -->

          </div>
          <!-- END Page Content -->
@endsection
