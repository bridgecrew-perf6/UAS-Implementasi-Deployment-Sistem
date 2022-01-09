<html>
@extends('admin/admin')
@include('admin/sidebar')
@section('content')

<section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Data Toko</h1>
                        <div class="card-tools">
                            </button>
                        </div>
                    </div>
                    <div class="card-tools">
                        <a href="/insertToko" class="nav-link">
                        <td>
                            <button type="button" class="btn btn-primary">Tambah Data Toko</button>
                        </td>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              <th>Barcode</th>
                              <th>ID Toko</th>
                              <th>Nama Toko</th>
                              <th>Latitude</th>
                              <th>Longitude</th>
                              <th>Accuracy</th>
                              <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($toko as $data)
                            <tr align ="center">
                                  <td>  <img src="data:image/png;base64,{!! \DNS1D::getBarcodePNG($data -> barcode,'C128') !!}" height="60" width="180"> </td
                                <br>
                                {{$data->barcode }}
                                </td>
                                <td>{{ $data->barcode }}</td>
                                <td>{{ $data->nama_toko }}</td>
                                <td>{{ $data->latitude }}</td>
                                <td>{{ $data->longitude }}</td>
                                <td>{{ $data->accuracy }}</td>
                                <td><a href="toko_barcode/{{$data->barcode}}"><button type="button" class="btn btn-info" onclick="alert()">Cetak Barcode</button></a></td>
                                <!-- <td><a href="#" class="btn btn-icon btn-success"><i class="fa fa-file"></i></a></td> -->
                            </tr>
                            @endforeach
                            </tbody>
                          </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>   
<!-- /.content-wrapper -->         
@endsection

@section('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function () {
    $('#barcode').DataTable();
    } );
    </script>
@endsection
</html>