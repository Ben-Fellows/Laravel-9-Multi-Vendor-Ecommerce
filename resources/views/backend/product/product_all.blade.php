@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Products</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">All Products</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        <a href="{{ route('create.products') }}" class="btn btn-primary">Create Product</a>
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
  <h6 class="mb-0 text-uppercase">All Products</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Product Number</th>
              <th>Product Name</th>
              <th>Product Image</th>
              <th>Product Price</th>
              <th>Product Quantity</th>
              <th>Product Discount</th>
              <th>Product Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $key => $product)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $product->product_name}}</td>
              <td><img src="{{ asset($product->product_thumbnail) }}" style="width: 70px; height: 40px;" alt="Category image"></td>
              <td>
                <a href="{{ route('edit.category', $category->id) }}" class="btn btn-secondary">Edit</a>
                <a href="{{ route('delete.category', $category->id) }}" class="btn btn-danger" id="delete">Delete</a>
              </td>
              <td>{{ $product->product_price}}</td>
              <td>{{ $product->product_quantity}}</td>
              <td>{{ $product->discount_price}}</td>
              <td>{{ $product->status}}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Product Number</th>
              <th>Product Name</th>
              <th>Product Image</th>
              <th>Product Price</th>
              <th>Product Quantity</th>
              <th>Product Discount</th>
              <th>Product Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
    
@endsection