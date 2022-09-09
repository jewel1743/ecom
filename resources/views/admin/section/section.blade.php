@extends('master.admin-master.master')

@section('title')
    Catelouge
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
                  <h1 class="m-0">Catelouge</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Catelouge</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Sections</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="sections" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $section->name }}</td>
                        <td>
                            @if ($section->status == 1)
                            <a class="sectionUpdateStatus" href="javascript:void(0);" id="section-{{ $section->id }}" section_id="{{ $section->id }}">Active</a>
                            @else
                            <a class="sectionUpdateStatus text-danger" href="javascript:void(0);" id="section-{{ $section->id }}" section_id="{{ $section->id }}">Inactive</a>
                        @endif
                        </td>
                        <td>
                              <a href="" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                              <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
    <script src="{{ asset('/') }}admin/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('/') }}admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('/') }}admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Page specific script -->
<script>
    $(function () {
      $("#sections").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
  <script>
    $('.sectionUpdateStatus').click(function(){
        var status= $(this).text();
        var section_id= $(this).attr("section_id");
        $.ajax({
            type: 'post',
            url: "{{ route('update-section-status')}}",
            data: {status:status, section_id:section_id},
            success: function(resp){
                if(resp.status == 1){
                    $('#section-'+section_id).html('<a class="sectionUpdateStatus" href="javascript:void(0);">Active</a>');
                }else{
                    $('#section-'+section_id).html('<a class="sectionUpdateStatus text-danger" href="javascript:void(0);">Inactive</a>');
                }
            },
            error: function(error){

            }
        });
    });
  </script>
 @endsection
