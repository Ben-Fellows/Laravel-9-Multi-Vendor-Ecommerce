@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">All Inactive Vendors</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Inactive Vendors</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">All Sub Categories</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Vendor ID</th>
              <th>Vendor Store Name</th>
              <th>Vendor Username</th>
              <th>Vendor Email</th>
              <th>Vendor Join Date</th>
              <th>Vendor Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($inactiveVendors as $key => $inactiveVendor)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $inactiveVendor->name }}</td>
              <td>{{ $inactiveVendor->username }}</td>
              <td>{{ $inactiveVendor->email }}</td>
              <td>{{ $inactiveVendor->vendor_join }}</td>
              <td><span class="btn btn-secondary">{{ $inactiveVendor->status }}</span></td>
              <td>
                <a href="" class="btn btn-info">Vendor Details</a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Sub Category Number</th>
              <th>Category Name</th>
              <th>Sub Category Image</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
    
@endsection