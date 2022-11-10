@extends('master.admin-master.master')

@section('title')
    Coupons
@endsection
@section('admin-css')
<link rel="stylesheet" href="{{ asset('/') }}admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
          @if (Session::has('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4>{{ Session::get('message') }}</h4>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Coupons</h3>
              <a href="{{ route('add-edit-coupon') }}" class="btn btn-success float-right" style="max-width: 120px;">Add Coupon</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="coupons" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Coupon Code</th>
                  <th>Coupon Type</th>
                  <th>Amount</th>
                  <th>Amount Type</th>
                  <th>Expiry Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $coupon->coupon_code }}</td>
                        <td>{{ $coupon->coupon_type }}</td>
                        <td>
                            {{ $coupon->amount }}
                            @if ($coupon->amount_type == 'percentage')
                                %
                            @else
                                TK
                            @endif
                        </td>
                        <td>{{ $coupon->amount_type }}</td>
                        <td>{{ $coupon->expiry_date }}</td>
                        <td>
                            @if ($coupon->status == 1)
                            <a class="couponUpdateStatus" href="javascript:void(0);" id="coupon-{{ $coupon->id }}" coupon_id="{{ $coupon->id }}">Active</a>
                            @else
                            <a class="couponUpdateStatus text-danger" href="javascript:void(0);" id="coupon-{{ $coupon->id }}" coupon_id="{{ $coupon->id }}">Inactive</a>
                        @endif
                        </td>
                        <td>
                              <a href="{{ route('add-edit-coupon', ['id' => $coupon->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                              <a href="javascript:void(0);" class="confirmDelete btn btn-danger btn-sm" record="coupon" recordId="{{ $coupon->id }}"><i class="fa fa-trash"></i></a>
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
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/') }}admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
        $("#coupons").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

  <script>
    $('.couponUpdateStatus').click(function(){
        var status= $(this).text();
        var coupon_id= $(this).attr("coupon_id");
        $.ajax({
            type: 'post',
            url: "{{ route('update-coupon-status')}}",
            data: {status:status, coupon_id:coupon_id},
            success: function(resp){
                if(resp.status == 1){
                    $('#coupon-'+coupon_id).html('<a class="couponUpdateStatus" href="javascript:void(0);">Active</a>');
                }else{
                    $('#coupon-'+coupon_id).html('<a class="couponUpdateStatus text-danger" href="javascript:void(0);">Inactive</a>');
                }
            },
            error: function(error){

            }
        });
    });
  </script>
    <script>

        $(document).on("click", ".confirmDelete", function(){
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

                // Swal.fire(
                // 'Deleted!',
                // 'Your file has been deleted.',
                // 'success'
                // );

                window.location.href="{{ url('/admin') }}"+"/"+"delete-"+record+"/"+recordId;
            }
            });
        });
  </script>
 @endsection
