@extends('master.admin-master.master')

@section('title')
    Products
@endsection

@section('admin-css')
    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('/')}}admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('body')
<section class="content">
   <div class="container-fluid">
       <div class="content-header">
           <div class="container-fluid">
             <div class="row mb-2">
               <div class="col-sm-6">
                 <h1 class="m-0">Products</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                   <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                   <li class="breadcrumb-item active">Products</li>
                 </ol>
               </div><!-- /.col -->
             </div><!-- /.row -->
           </div><!-- /.container-fluid -->
         </div>

     <div class="row">
       <div class="col-12">
         <div class="card">
            @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4>{{ Session::get('message') }}</h4>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
           <div class="card-header">
             <h3 class="card-title">All Products</h3>
             <a class="btn btn-success" href="{{ route('add-edit-product') }}" style="max-width: 120px; display:inline-block; float: right;">Add Product</a>
           </div>
           <!-- /.card-header -->
           <div class="card-body">
             <table id="products" class="table table-bordered table-striped">
               <thead>
               <tr>
                 <th>SL</th>
                 <th>Product Name</th>
                 <th>Product Price</th>
                 <th>Product Category</th>
                 <th>Section</th>
                 <th>Image</th>
                 <th>Status</th>
                 <th>Action</th>
               </tr>
               </thead>
               <tbody>
                   @foreach ($products as $product)
                   <tr>
                       <td>{{ $loop->iteration }}</td>
                       <td>{{ $product->product_name }}</td>
                       <td>{{ $product->product_price }}</td>
                       <td>{{ $product->category->category_name }}</td>
                       <td>{{ $product->section->name }}</td>
                       <td>
                            @if (!empty($product->main_image))
                                 <img src="{{ asset('images/product-image/small/'.$product->main_image) }}" alt="" height="120" width="120">
                                 @else
                                 <img src="{{ asset('images/product-image/dummy-image.png') }}" alt="" height="120" width="120">
                            @endif
                       </td>
                       <td>
                           @if ($product->status == 1)
                           <a class="productUpdateStatus" href="javascript:void(0);" id="product-{{ $product->id }}" product_id="{{ $product->id }}">Active</a>
                           @else
                           <a class="productUpdateStatus text-danger" href="javascript:void(0);" id="product-{{ $product->id }}" product_id="{{ $product->id }}">Inactive</a>
                       @endif
                       </td>
                       <td>
                             <a title="add/edit attribute" href="{{ route('product-attribute', ['id' => $product->id]) }}"><i class="fas fa-plus text-info"></i></a>
                             <a title="add/edit images" href="{{ route('product-images', ['id' => $product->id]) }}"><i class="fas fa-plus-circle text-primary"></i></a>
                             <a title="view details" href="{{ route('admin-product-details', ['id' => $product->id]) }}"><i class="fa fa-book text-warning"></i></a>
                             <a title="edit" href="{{ route('add-edit-product', ['id' => $product->id]) }}"><i class="fa fa-edit text-success"></i></a>
                             <a title="delete" class="confirmDelete" href="javascript:void(0);" record="product" recordId="{{ $product->id }}"><i class="fa fa-trash text-danger"></i></a>
                       </td>
                     </tr>
                   @endforeach
               </tbody>
             </table>
           </div>
           <!-- /.card-body -->
         </div>
         <!-- /.card -->
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
 </section>
@endsection

@section('admin-js')
<script src="{{asset('/')}}admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('/')}}admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('/')}}admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script>
    $(function () {
    $("#products").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
  </script>

<script>
    $('.productUpdateStatus').click(function(){
        var status= $(this).text();
        var productId= $(this).attr("product_id");
        $.ajax({
            type: 'post',
            url: "{{ route('update-product-status')}}",
            data: {status:status, productId:productId},
            success: function(resp){
                if(resp.status == 1){
                    $('#product-'+productId).html('<a class="productUpdateStatus" href="javascript:void(0);">Active</a>');
                }else{
                    $('#product-'+productId).html('<a class="productUpdateStatus text-danger" href="javascript:void(0);">Inactive</a>');
                }
            },
            error: function(error){

            }
        });
    });
  </script>
  <script>
     $(".confirmDelete").click(function(){
        var record= $(this).attr("record");
        var recordId= $(this).attr("recordId");
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
        })
    });
  </script>
@endsection
