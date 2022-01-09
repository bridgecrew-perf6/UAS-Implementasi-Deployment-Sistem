<html>
@extends('admin/admin')

@include('admin/sidebar')


@section('content')
 <div class="card">
       <!--  <div class="card-header">
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div> -->
     <!--    <div class="card-body">
          Selamat Datang
        </div>
        /.card-body
        <div class="card-footer">
          Footer
        </div> -->
        <!-- /.card-footer-->
      </div>
<div class="card">
    <div class="card-body">
        <h1 align="center">Data Customer</h1>
    </div>
    <div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                        Import Excell
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Pilih File</h4>
                            </div>
                            <form action="/importexcel" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body">
                                 <div class="form-group">
                                    <input type="file" name="file" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </=>
                            </div>
                        </div>
                        </div>
                    </div>
    <div class="card-body">
        <table class="table table-bordered" border="2" align="center">
                            <thead>
                            <tr>
                              <th>ID Customer</th>
                              <th>Nama</th>
                              <th>Alamat</th>
                              <th>Kelurahan</th>
                              <th>Foto</th>
                              <th>Filepath</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer as $data)
                            <tr>
                                <td>{{ $data->id_customer }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->nama_kelurahan }}</td>
                                <td>  <img src="{{ $data->foto }}" style=" "></td>
                                <td> <img src="{{ asset('/storage/'.$data->file_path) }}" style="width: 100px; height: 100px"></td>
                                <!-- <td>{{ $data->file_path }}</td> -->
                               <!--  {{-- @if($data->foto == null )
                                    <td><img src="{{ asset('/storage/'$data->file_path) }}" alt=""></td>
                                    @else --}}
                                    <td><img src="{{ $data->foto }}" alt=""></td>
                                {{-- @endif --}} -->
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
</html> 