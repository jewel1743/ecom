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
                   <li class="breadcrumb-item "><a href="{{ route('admin-orders') }}">Orders</a></li>
                 </ol>
               </div><!-- /.col -->
             </div><!-- /.row -->
           </div><!-- /.container-fluid -->
         </div>
         <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Order Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <tr>
                            <th colspan="2"><strong> Order Details</strong></th>
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td>{{ $ordersDetails->created_at->format('d-M-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Order Status</td>
                            <td>{{ $ordersDetails->order_status }}</td>
                        </tr>
                        <tr>
                            <td>Order Total</td>
                            <td>TK. {{ $ordersDetails->grand_total }}</td>
                        </tr>
                        <tr>
                            <td>Shipping Charge</td>
                            <td>{{ $ordersDetails->shipping_charge}}</td>
                        </tr>
                        <tr>
                            <td>Coupon Code</td>
                            <td>{{ $ordersDetails->coupon_code }}</td>
                        </tr>
                        <tr>
                            <td>Coupon Amount</td>
                            <td>
                                @if (!empty($coupon))
                                    @if ($coupon->amount_type == 'percentage')
                                    {{ $ordersDetails->coupon_amount }} %
                                    @else
                                        TK. {{ $ordersDetails->coupon_amount }}
                                    @endif
                                @else
                                    {{ $ordersDetails->coupon_amount }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td>{{ $ordersDetails->payment_method }}</td>
                        </tr>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.card -->

                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Condensed Full Width Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Task</th>
                            <th>Progress</th>
                            <th style="width: 40px">Label</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1.</td>
                            <td>Update software</td>
                            <td>
                              <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-danger">55%</span></td>
                          </tr>
                          <tr>
                            <td>2.</td>
                            <td>Clean database</td>
                            <td>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-warning" style="width: 70%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-warning">70%</span></td>
                          </tr>
                          <tr>
                            <td>3.</td>
                            <td>Cron job running</td>
                            <td>
                              <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar bg-primary" style="width: 30%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-primary">30%</span></td>
                          </tr>
                          <tr>
                            <td>4.</td>
                            <td>Fix and squish bugs</td>
                            <td>
                              <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar bg-success" style="width: 90%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-success">90%</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Simple Full Width Table</h3>

                      <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                          <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Task</th>
                            <th>Progress</th>
                            <th style="width: 40px">Label</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1.</td>
                            <td>Update software</td>
                            <td>
                              <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-danger">55%</span></td>
                          </tr>
                          <tr>
                            <td>2.</td>
                            <td>Clean database</td>
                            <td>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-warning" style="width: 70%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-warning">70%</span></td>
                          </tr>
                          <tr>
                            <td>3.</td>
                            <td>Cron job running</td>
                            <td>
                              <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar bg-primary" style="width: 30%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-primary">30%</span></td>
                          </tr>
                          <tr>
                            <td>4.</td>
                            <td>Fix and squish bugs</td>
                            <td>
                              <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar bg-success" style="width: 90%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-success">90%</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Striped Full Width Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Task</th>
                            <th>Progress</th>
                            <th style="width: 40px">Label</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1.</td>
                            <td>Update software</td>
                            <td>
                              <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-danger">55%</span></td>
                          </tr>
                          <tr>
                            <td>2.</td>
                            <td>Clean database</td>
                            <td>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-warning" style="width: 70%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-warning">70%</span></td>
                          </tr>
                          <tr>
                            <td>3.</td>
                            <td>Cron job running</td>
                            <td>
                              <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar bg-primary" style="width: 30%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-primary">30%</span></td>
                          </tr>
                          <tr>
                            <td>4.</td>
                            <td>Fix and squish bugs</td>
                            <td>
                              <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar bg-success" style="width: 90%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-success">90%</span></td>
                          </tr>
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
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Responsive Hover Table</h3>

                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Reason</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>183</td>
                            <td>John Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-success">Approved</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>219</td>
                            <td>Alexander Pierce</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-warning">Pending</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>657</td>
                            <td>Bob Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-primary">Approved</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>175</td>
                            <td>Mike Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-danger">Denied</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
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
