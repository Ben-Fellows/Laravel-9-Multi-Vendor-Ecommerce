@extends('vendor.vendor_dashboard');
@section('vendor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Profile</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ (!empty($vendorData->photo)) ? url('upload/vendor_images/'.$vendorData->photo):url('upload/vendor_images/no_image.jpg') }}" alt="Vendor" class="rounded-circle p-1 bg-secondary" width="150" height="150" style="object-fit: cover;">
                                <div class="mt-3">
                                    <h4>{{ $vendorData->name }}</h4>
                                    <p class="text-secondary mb-1">{{ $vendorData->email }}</p>
                                    <p class="text-muted font-size-sm">{{ $vendorData->address }}</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('vendor.profile.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{ $vendorData->username }}" disabled />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{ $vendorData->name }}" name="name" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" class="form-control" value="{{ $vendorData->email }}" name="email" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{ $vendorData->phone }}" name="phone" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{ $vendorData->address }}" name="address" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                  <div class="col-sm-3">
                                      <h6 class="mb-0">Vendor Date Joined</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <select name="vendor_join" value="" class="form-select mb-3" aria-label="Default select example">
                                      <option value="2023" {{ $vendorData->vendor_join == 2023 ? "selected" : '' }}>2023</option>
                                      <option value="2024" {{ $vendorData->vendor_join == 2024 ? "selected" : '' }}>2024</option>
                                      <option value="2025" {{ $vendorData->vendor_join == 2025 ? "selected" : '' }}>2025</option>
                                      <option value="2026" {{ $vendorData->vendor_join == 2026 ? "selected" : '' }}>2026</option>
                                      <option value="2027" {{ $vendorData->vendor_join == 2027 ? "selected" : '' }}>2027</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Bio</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea name="vendor_bio" class="form-control" id="inputAddress2" placeholder="Vendor Bio.." rows="3">{{ $vendorData->vendor_bio }}</textarea>
                                </div>
                            </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Photo</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" class="form-control" id="image" name="photo" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage" src="{{ (!empty($vendorData->photo)) ? url('upload/vendor_images/'.$vendorData->photo):url('upload/vendor_images/no_image.jpg') }}" alt="Vendor" style="width: 120px; height: 100px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4 mt-4" value="Save Changes" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection

