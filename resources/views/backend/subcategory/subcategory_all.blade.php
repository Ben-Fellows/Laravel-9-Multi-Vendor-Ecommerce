@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">All Sub Categories</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">All Sub Categories</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        <a href="{{ route('create.subcategory') }}" class="btn btn-primary">Create Sub Category</a>
        <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
          <a class="dropdown-item" href="javascript:;">Another action</a>
          <a class="dropdown-item" href="javascript:;">Something else here</a>
          <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
        </div>
      </div>
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
              <th>Sub Category Number</th>
              <th>Category Name</th>
              <th>Sub Category Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($subcategories as $key => $subcategory)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $subcategory['category']['category_name']  }}</td>
              <td>{{ $subcategory->subcategory_name }}</td>
              <td>
                <a href="{{ route('edit.subcategory', $subcategory->id) }}" class="btn btn-secondary">Edit</a>
                <a href="{{ route('delete.subcategory', $subcategory->id) }}" class="btn btn-danger" id="delete">Delete</a>
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