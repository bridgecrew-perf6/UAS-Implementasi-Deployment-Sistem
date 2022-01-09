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
        <h3 align="center">Tambah Data Customer Baru 1</h3>
    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                          <form action="insertCustomer2" method='post' class="form-group">

                            <!-- <div action='insertCustomer' method='post' class="form-group"> -->
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                              <label>Nama</label>
                              <input type="text" id="nama" name="nama" class="form-control select2bs4" style="width: 100%;">
                              
                              <label>Alamat</label>
                              <input type="text" id="alamat" name="alamat" class="form-control select2bs4" style="width: 100%;">
                              
                              <label>Provinsi</label>
                              <select name="provinsidd" class="form-control" id="provinsidd">
                                <option> - Pilih Provinsi - </option>
                                @foreach ( $provinsi as $prov )
                                <option value="{{ $prov->id_provinsi }}">{{ $prov->nama_provinsi }}</option>
                                @endforeach
                              </select>
                              
                              <label>Kota</label>
                              <select name="kotadd" class="form-control" id="kotadd">
                                <option> - Pilih Kota - </option>
                               
                                
                              </select>
                              
                              <label>Kecamatan</label>
                              <select name="kecamatandd" class="form-control" id="kecamatandd">
                                <option> - Pilih Kecamatan - </option>
                                
                              </select>
                              
                              <label>Kelurahan</label>
                              <select name="kelurahandd" class="form-control" id="kelurahandd">
                                <option> - Pilih Kelurahan - </option>
                                
                              </select>
                              
                              <label>kodepos</label>
                              <select name="kodeposdd" class="form-control" id="kodeposdd">
                                <option> - Pilih Kodepos - </option>
                                
                              </select>
                              <div>
                              <label>Foto</label>
                              </div>
                              <div class="col-md-6">
                              <div id="result2" style="border-style: solid; width:320px; height: 240px; text-align: center;">
                              <p class='warna'>Take your picture</p>
                              </div>
                                  <input type="hidden" name="imagecam" id="imagecam">
                                  <br>
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                      Ambil Foto
                                  </button>
                                  <button type="submit" value="Simpan" class="btn btn-default">Simpan</button> 
                          </div>
                          </form>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
                            <script>
                              Webcam.set
                              ({
                                width: 320,
                                height: 240,
                                image_format: 'png',
                                png_quality: 70
                              });
                              Webcam.attach('#my_camera'); 
                                function take_picture() {
                                Webcam.snap(function(data_uri) {
                                  $('#imagecam').val(data_uri);
                                    document.getElementById('result1').innerHTML = '<img src="' + data_uri +'"/>';
                                    document.getElementById('result2').innerHTML = '<img src="' + data_uri +'"/>';
                                });
                                }
                                document.getElementById('btn').addEventListener('click', take_picture);    
                          </script>
                              
                          </div>
                        </div>
                    </div>   
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                      <div>
                    
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ambil Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="my_camera"></div>
            <div id="result1"></div>
              <div>
                <button id="btn" name="btn" class="btn btn-info">Ambil Gambar</button>
              </div>            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Simpan Foto</button>
      </div>
    </div>
  </div>
</div>

@section('script')
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  
<script type="text/javascript">
$(document).ready(function(){
 
  $("#provinsidd").change(function(){
    var prov_id=$("#provinsidd").val();
    $.ajax({
      type:"get",
      url:"findKota",
      data:"prov_id="+prov_id,
      success:function(data){
        for(var i=0;i<data.length;i++){
          $('#kotadd').append('<option value="'+data[i].id_kota+'">'+data[i].nama_kota+'</option>');
        } 
      }
      });
  });

  $("#kotadd").change(function(){
    var kota_id=$("#kotadd").val();
    $.ajax({
      type:"get",
      url:"findKecamatan",
      data:"kota_id="+kota_id,
      success:function(data){
        for(var i=0;i<data.length;i++){
          $('#kecamatandd').append('<option value="'+data[i].id_kecamatan+'">'+data[i].nama_kecamatan+'</option>');
        } 
      }
      });
  });

  $("#kecamatandd").change(function(){
    var kec_id=$("#kecamatandd").val();
    $.ajax({
      type:"get",
      url:"findKelurahan",
      data:"kec_id="+kec_id,
      success:function(data){
        for(var i=0;i<data.length;i++){
          $('#kelurahandd').append('<option value="'+data[i].id_kelurahan+'">'+data[i].nama_kelurahan+'</option>');
        } 
      }
      });
  });

  $("#kelurahandd").change(function(){
    var kel_id=$("#kelurahandd").val();
    $.ajax({
      type:"get",
      url:"findKodepos",
      data:"kel_id="+kel_id,
      success:function(data){
        for(var i=0;i<data.length;i++){
          $('#kodeposdd').append('<option value="'+data[i].id_kelurahan+'">'+data[i].kodepos+'</option>');
        } 
      }
      });
  });
});
</script>
@endsection
</html>