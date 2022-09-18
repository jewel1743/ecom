@extends('master.admin-master.master')

    @section('title')
        Add Images
    @endsection

    @section('admin-css')
        <link rel="stylesheet" href="{{ asset('/') }}admin/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="{{ asset('/') }}admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    @endsection

    @section('body')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-md-12">
                <h1>Product Images</h1>
              </div>
              <div class="col-md-12">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">Product-Images</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="card card-default">
                @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h4>{{ Session::get('message') }}</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                @if (Session::has('existValue'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4>{{ Session::get('existValue').Session::get('exist_message') }}</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
              <div class="card-header">
                <h3 class="card-title">Product Images</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              @if ($errors->any())
              <div class="alert alert-danger alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                 </ul>
            </div>
              @endif
              <!-- /.card-header -->
              <form action="{{ route('product-images', ['id' => $productData->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Name</label>&nbsp;
                        {{ $productData->product_name }}
                    </div>
                    <div class="form-group">
                        <label>Code</label>&nbsp;
                        {{ $productData->product_code }}
                    </div>
                    <div class="form-group">
                        <label>Color</label>&nbsp;
                        {{ $productData->product_color }}
                    </div>
                    <div class="form-group">
                        <label>Price</label>&nbsp;
                        {{ $productData->product_price }}
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">
                      <img src="{{ asset('images/product-image/small/'.$productData->main_image) }}" alt="" width="120" height="150">
                  </div>
                    <div>
                        <label for="images">Add Images</label>
                        <input id="images"  type="file" name="images[]" class="form-control-file" multiple  />
                        <div class="text-danger">
                            {{ Session::get('error_message') }}
                        </div>
                    </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <div class="card-footer">
                    <button type="submit" class="btn btn-success">Save Images</button>
              </div>
            </form>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>

          <div class="col-md-10 mx-auto">
            <div class="card my-5">
               @if (!count($subImage) == 0)  <!-- array te 1 er besi data asle !empty kaj korbe na karon tokon arry te 0 thake r 0 mane seta null o noy abr empty o noy tai  array empty condition count function diye krlm -->
                <div class="card-header">
                    <h4 class="text-center">Product All Sub Images</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($productData->subImages as $image)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                <img src="{{ asset('images/product-image/sub-images/'.$image->images) }}" alt="" height="120" width="120">
                            </td>

                            <td>
                                @if ($image->status == 1)
                                     <a class="updateImageStatus" id="image-{{ $image->id }}" image_id="{{ $image->id }}" href="javascript:void(0);">Active</a>
                                     @else
                                     <a class="updateImageStatus text-danger" id="image-{{ $image->id }}" image_id="{{ $image->id }}" href="javascript:void(0);">Inactive</a>
                                @endif
                            </td>
                            <td>
                                <a class="confirmDelete" record="product-sub-image" recordId="{{ $image->id }}" href="javascript:void(0);">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                    @else
                    <h4 class="text-center py-3">Sub image Empty,, This Product doesn't have any sub image.!!</h4>
                @endif
            </div>
         </div>
        </div>
    @endsection

    @section('admin-js')
    <script src="{{ asset('/') }}admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('/') }}admin/plugins/select2/js/select2.full.min.js"></script>
    {{-- file upload er por input fild er vitore file er name show er jonno --}}
    <script src="{{ asset('/') }}admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()

          //Initialize Select2 Elements
          $('.select2bs4').select2({
            theme: 'bootstrap4'
          })

        })
      </script>

      <script>
        //file upload er por input fild er vitore file er name show er jonno
        $(function () {
          bsCustomFileInput.init();
        });
        </script>
    <script>
    $('.confirmDelete').click(function(){
        var record= $(this).attr("record");
        var recordId= $(this).attr("recordId");

        //sweet alert
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {

            //delete er por akta window message er jnno
            // Swal.fire(
            // 'Deleted!',
            // 'Your file has been deleted.',
            // 'success',
            // )

                //url diye delete krte chaile avabe
            window.location.href="{{ url('/') }}/admin/delete-"+record+"/"+recordId;

        //    form diye delete krte chile
        //    $('#confirmDeleteForm').submit();

        }
        });
    });
    </script>

    <script>
        $('.updateImageStatus').click(function(){
            var status = $(this).text();
            var imageId= $(this).attr("image_id");
            $.ajax({
                type: 'post',
                url: "{{ route('update-image-status') }}",
                data: {status:status, imageId:imageId},
                success: function(resp){
                    if(resp.status == 1){
                        $('#image-'+imageId).html('<a class="updateImageStatus"  href="javascript:void(0);">Active</a>');
                    }else{
                        $('#image-'+imageId).html('<a class="updateImageStatus text-danger"  href="javascript:void(0);">Inactive</a>');
                    }
                },
                error: function(e){

                }
            });
        });
    </script>
    @endsection


