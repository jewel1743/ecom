@extends('master.admin-master.master')

    @section('title')
        Add Attributes
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
                <h1>Attributes</h1>
              </div>
              <div class="col-md-12">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">Attributes</li>
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
                <h3 class="card-title">Attributes</h3>

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
              <form action="{{ route('product-attribute', ['id' => $productData->id]) }}" method="POST">
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
                  <div class="field_wrapper">
                    <div>
                        <input id="size" style="max-width: 120px;" type="text" name="size[]" value="" placeholder="Size" required />
                        <input id="sku" style="max-width: 120px;" type="text" name="sku[]" value="" placeholder="SKU" required />
                        <input id="price" style="max-width: 120px;" type="text" name="price[]" value="" placeholder="Price" required />
                        <input id="stock" style="max-width: 120px;" type="text" name="stock[]" value="" placeholder="Stock" required />
                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                    </div>
                </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <div class="card-footer">
                    <button type="submit" class="btn btn-success">Add Attribute</button>
              </div>
            </form>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>
        <form action="{{ route('update-attribute') }}" method="POST">
          @csrf
          <div class="col-md-12 mx-auto">
            <div class="card my-5">
                <div class="card-header">
                    <h4 class="text-center">Product All Attributes</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SIZE</th>
                            <th>SKU</th>
                            <th>PRICE</th>
                            <th>STOCK</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($productData->attributes as $attribute)
                        <input type="hidden" name="attributeId[]" value="{{ $attribute->id }}">
                        <tr>
                            <td>
                                <input type="text" name="size[]"  value="{{ $attribute->size }}" required>
                            </td>
                            <td>
                                <input type="text" name="sku[]"  value="{{ $attribute->sku }}" required>
                            </td>
                            <td>
                                <input type="number" name="price[]"  value="{{ $attribute->price }}" required>
                            </td>
                            <td>
                                <input type="number" name="stock[]"  value="{{ $attribute->stock }}" required>
                            </td>
                            <td>
                                @if ($attribute->status == 1)
                                     <a class="updateAttributeStatus" id="attribute-{{ $attribute->id }}" attribute_id="{{ $attribute->id }}" href="javascript:void(0);">Enable</a>
                                     @else
                                     <a class="updateAttributeStatus text-danger" id="attribute-{{ $attribute->id }}" attribute_id="{{ $attribute->id }}" href="javascript:void(0);">Disable</a>
                                @endif
                            </td>
                            <td>
                                <a class="confirmDelete" record="product-attribute" recordId="{{ $attribute->id }}" href="javascript:void(0);">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">Update Attribute</button>
                </div>
            </div>

         </div>
        </div>
      </form>
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
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div style="margin-top:5px;"><input style="max-width:120px;" type="text" name="size[]" placeholder="Size" />&nbsp;<input style="max-width:120px;" type="text" name="sku[]" placeholder="SKU"/>&nbsp;<input style="max-width:120px;" type="text" name="price[]" placeholder="Price"/>&nbsp;<input style="max-width:120px;" type="text" name="stock[]" placeholder="Stock"/>&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    </script>
    <script>
        $('.updateAttributeStatus').click(function(){
            var status = $(this).text();
            var attributeId= $(this).attr("attribute_id");
            $.ajax({
                type: 'post',
                url: "{{ route('update-attribute-status') }}",
                data: {status:status, attributeId:attributeId},
                success: function(resp){
                    if(resp.status == 1){
                        $('#attribute-'+attributeId).html('<a class="updateAttributeStatus"  href="javascript:void(0);">Enable</a>');
                    }else{
                        $('#attribute-'+attributeId).html('<a class="updateAttributeStatus text-danger"  href="javascript:void(0);">Disable</a>');
                    }
                },
                error: function(e){

                }
            });
        });
    </script>
    @endsection


