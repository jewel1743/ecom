@extends('master.admin-master.master')

@section('title')
    Fabrics
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
                  <h1 class="m-0">Fabrics</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Fabrics</li>
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
              <h3 class="card-title">All Fabrics</h3>
              <a href="{{ route('add-edit-fabric') }}" class="btn btn-success" style="max-width: 120px; display:inline-block; float: right;">Add fabric</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="fabrics" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($fabrics as $fabric)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $fabric->name }}</td>
                        <td>
                            @if ($fabric->status == 1)
                            <a class="fabricUpdateStatus" href="javascript:void(0);" id="fabric-{{ $fabric->id }}" fabric_id="{{ $fabric->id }}" style="font-size: 25px;"><i class="fa fa-toggle-on"></i></a>
                            @else
                            <a class="fabricUpdateStatus" href="javascript:void(0);" id="fabric-{{ $fabric->id }}" fabric_id="{{ $fabric->id }}" style="font-size: 25px;"><i class="fa fa-toggle-off"></i></a>
                        @endif
                        </td>
                        <td>
                              <a href="{{ route('add-edit-fabric', ['id' => $fabric->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                              <a class="confirmDelete btn btn-danger btn-sm" record="fabric" recordId="{{ $fabric->id }}" href="javascript:void(0);" ><i class="fa fa-trash"></i></a>
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
    <script src="{{ asset('/') }}admin/SweetAlert2.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
        $("#fabrics").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

  <script>

    $(document).on("click", ".fabricUpdateStatus", function(){
        var fabric_id= $(this).attr("fabric_id");
        $.ajax({
            type: 'post',
            url: "{{ route('update-fabric-status')}}",
            data: {fabric_id:fabric_id},
            success: function(resp){
                if(resp.status == 1){
                    $('#fabric-'+fabric_id).html('<a class="fabricUpdateStatus" href="javascript:void(0);" style="font-size: 25px;"><i class="fa fa-toggle-on"></i></a>');
                }else{
                    $('#fabric-'+fabric_id).html('<a class="fabricUpdateStatus" href="javascript:void(0);" style="font-size: 25px;"><i class="fa fa-toggle-off"></i></a>');
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
