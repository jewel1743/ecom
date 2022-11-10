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
                 <h1 class="m-0">Orders</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                   <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                   <li class="breadcrumb-item active">Orders</li>
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
             <h3 class="card-title">All Orders</h3>
           </div>
           <!-- /.card-header -->
           <div class="card-body">
             <table id="orders" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Payment Method</th>
                    <th>Grand Total</th>
                    <th>Order Date</th>
                    <th>Order Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order['id'] }}</td>
                    <td>
                        @foreach ($order['orders_products'] as $product)
                            {{ $product['product_code'] }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($order['orders_products'] as $product)
                            {{ $product['product_name'] }} <br>
                        @endforeach
                    </td>
                    <td>{{ $order['payment_method'] }}</td>

                    <td>{{ $order['grand_total'] }} TK</td>
                    <td>{{ date('d-m-Y',strtotime($order['created_at'] ))}}</td>
                    <td><a href="{{ route('admin-order-details',['order_id' => $order['id']]) }}">Order Details</a></td>
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
    $("#orders").DataTable({
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
    $('.featureProductStatus').click(function(){
        var productId= $(this).attr("product_id");
        $.ajax({
            type: 'post',
            url: "{{ route('update-feature-product-status')}}",
            data: {productId:productId},
            success: function(resp){
                if(resp.status == 'Yes'){
                    $('#featureProduct-'+productId).html('<a class="featureProductStatus" href="javascript:void(0);"><i class="fa fa-toggle-on"></i></a>');
                }else{
                    $('#featureProduct-'+productId).html('<a class="featureProductStatus" href="javascript:void(0);"><i class="fa fa-toggle-off"></i></a>');
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
