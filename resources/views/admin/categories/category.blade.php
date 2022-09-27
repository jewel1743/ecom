@extends('master.admin-master.master')
    @section('title')
        Categories
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
                  <h1 class="m-0">Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
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
              <h3 class="card-title">All Categories</h3>
              <a href="{{ route('add-edit-category') }}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-success">Add Category</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="sections" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Parent Category</th>
                  <th>Section</th>
                  <th>Url</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->parentCategory ? $category->parentCategory->category_name : 'Root'}}</td>
                        <td>{{ $category->section->name }}</td>
                        <td>{{ $category->url }}</td>
                        <td>
                            @if ($category->status == 1)
                            <a class="categoryUpdateStatus" href="javascript:void(0);" id="category-{{ $category->id }}" category_id="{{ $category->id }}"><i class="fa fa-toggle-on"></i></a>
                            @else
                            <a class="categoryUpdateStatus text-danger" href="javascript:void(0);" id="category-{{ $category->id }}" category_id="{{ $category->id }}"><i class="fa fa-toggle-off"></i></a>
                        @endif
                        </td>
                        <td>
                              <a href="{{ route('add-edit-category', ['id' => $category->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                              @if ($category->parent_id == 0)
                                <a href="javascript:void(0)" record="category" recordId="{{ $category->id }}" class="btn btn-danger btn-sm {{ $category->parent_id == 0 ? 'disabled' : 'confirmDelete' }}"><i class="fa fa-trash"></i></a>
                               @else
                                <a href="javascript:void(0)" record="category" recordId="{{ $category->id }}" class="btn btn-danger btn-sm confirmDelete"><i class="fa fa-trash"></i></a>
                              @endif
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
        $(document).on("click", ".categoryUpdateStatus", function(){
        var category_id= $(this).attr("category_id");
        $.ajax({
            type: 'post',
            url: "{{ route('update-category-status')}}",
            data: {category_id:category_id},
            success: function(resp){
                if(resp.status == 1){
                    $('#category-'+category_id).html('<a class="categoryUpdateStatus" href="javascript:void(0);"><i class="fa fa-toggle-on"></i></a>');
                }else{
                    $('#category-'+category_id).html('<a class="categoryUpdateStatus" href="javascript:void(0);"><i class="fa fa-toggle-off"></i></a>');
                }
            },
            error: function(error){

            }
        });
    });

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

