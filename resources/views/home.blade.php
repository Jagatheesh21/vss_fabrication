@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pb-3">
            <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-primary text-white p-3 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-primary">{{$users}}</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Users</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-primary text-white p-3 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-primary">{{$operations}}</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Operations</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-info text-white p-3 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-info">{{$raw_materials}}</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Raw Materials </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-primary text-white p-3 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-star"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-primary">{{$child_part_numbers}}</div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Child Part Numbers</div>
                    </div>
                  </div>
                </div>
              </div>
              
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header">Stock Report As On {{ date('d-m-Y') }}</div>
          <div class="card-body">
            <div class="row">
              <div class="table-responsive table-hovered table-striped">
                  <table class="table border mb-0">
                    <thead class="table-light fw-semibold">
                      <tr class="align-middle">
                        <th>SNo.</th>
                        <th>Raw Material Type</th>
                        <th>Raw Material</th>
                        <th>Stock</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($raw_material_list as $material)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$material->type->name}}</td>
                            <td>{{$material->name}}-{{$material->part_description}}</td>
                            <td>{{$material->stock()->inward_quantity??0.00}}</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      {{-- <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-header">Nesting</div>
          <div class="card-body">
            <div class="row">
              <div class="table-responsive table-hovered table-striped">
                  <table class="table border mb-0">
                    <thead class="table-light fw-semibold">
                      <tr class="align-middle">
                        <th>SNo.</th>
                        <th>Type</th>
                        <th>Name</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($nestings as $nesting)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$nesting->nesting->name}}</td>
                            <td>{{$nesting->type->name}}</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-header">User Activity Log</div>
            <div class="card-body">
              <div class="row">
                <div class="table-responsive">
                    <table class="table border mb-0">
                      <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                          <th class="text-center">
                            <svg class="icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                            </svg>
                          </th>
                          <th>User</th>
                          <th>Last Activity</th>
                          <th>Last Login IP </th>
                          <th>Last Activity At</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($user_lists as $user_list)
                        <tr class="align-middle">
                          <td class="text-center">
                            <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/default.png" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                          </td>
                          <td>
                            <div>{{$user_list->name}}</div>
                            <div class="small text-medium-emphasis"> Registered: {{$user_list->created_at}}</div>
                          </td>
                          <td>
                            <div>Part Number Creation </div>
                          </td>
                          <td>
                            <div> 192.168.1.1 </div>
                          </td>
                          
                          <td>
                            <div class="fw-semibold">10 sec ago</div>
                          </td>
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>         
        </div>
    </div>

    
  
@endsection