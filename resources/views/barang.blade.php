<html>
@extends('admin/admin')

@include('admin/sidebar')

@section('content')

<section class="content">
            <div class="container-fluid">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Barang</h3>
                        <div class="card-tools">
                        </div>
                    </div>
                    <br>
                    <div class="card-tools">
                        <a href="/cetak_barcode" class="nav-link">
                        <td>
                        <a href="#" id="ctk" disable button type="button" class="btn btn-primary" style="margin-left: 25px" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-file"></i> Cetak Barcode </a>
                        </td>
                        </a>
                    </div>
                    <br>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="head-cb">
                                </th>
                              <th>ID Barang</th>
                              <th>Nama Barang</th>
                              <th>Barcode</th>
                              <th>TimeStamp</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($barang as $data)
                            <tr>
                            <td>
                            <input type="checkbox"  class="cb-child" value="{{$data->id_barang}}">
                            </td>
                                <td>{{ $data->id_barang }}</td>
                                <td>{{ $data->nama_barang }}</td>
                                <td style="text-align: left">
                                    {!! \DNS1D::getBarcodeHTML($data -> id_barang,'C39',1,33) !!}
                                    {{ $data -> id_barang }} <br>
                                    {{$data->nama_barang}}
                                </td>
                                <td>{{ $data->timestamp_barang }}</td>
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
<div class="modal fade" id="exampleModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title"> Pilih Kolom dan Baris</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <form action="" method="">
                    @csrf
                    <div class="my-3 form-group">
                        <label>Column</label>
                        <input type="number" id="row1" name="row1" min="1" max="5" value="1" class="form-control num-whitout-style" placeholder="1-8">
                    </div>
                    <div class="my-3 form-group">
                        <label>Row</label>
                        <input type="number" id="col1" name="col1" min="1" max="5" value="1" class="form-control num-whitout-style" placeholder="1-5">
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer"> -->
                <button type="button" onclick="printPDF()" class="btn btn-primary"><i class="fa fa-file" ></i></button>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
@endsection 
<script>
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    })
</script>

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script>
    let check=0;
    $(function () {
        $("#example2").DataTable({
            "responsive": true,
            "autoWidth": false,
            // "pageLength": 100,
            // "lengthMenu": [[10,25,50], [10,25,50]],
            // "bLengthChange" : true,
            // "bFilter": true,
            // "bServerSide": true,
            // "order":[[ 1, "desc"]]
        });  
    });
    
    $("#head-cb").on('click',function(){
        var isChecked = $("#head-cb").prop('checked')
        $(".cb-child").prop('checked',isChecked)
        $("#ctk").prop('disabled',!isChecked)
    });
    
    $("#example2 tbody").on('click','.cb-child',function(){
        if($(this).prop('checked')!=true){
            $("#head-cb").prop('checked',false)
        }
            let allcb = $("#example2 tbody .cb-child:checked")
            let ctk_status = allcb.length>0
            $("#ctk").prop('disabled',!ctk_status)
    });

    function cetak(){
        let cb_terpilih = $("#example2 tbody .cb-child:checked")
        let allid = []
        $.each(cb_terpilih,function(index,elm){
            allid.push(elm.value)
        });
        
        $.ajax({
            url:"{{url('')}}/cetak_barcode",
            method:"post",
            data:{ids:allid},
            
            success:function(data){
                console.log(data)
            }
        });
    }
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    function printPDF() {
        var row =  Number(document.getElementById("row1").value);
        var col =  Number(document.getElementById("col1").value);
        console.log(row);
        console.log(col);
        let all_cb = $("#example2 tbody .cb-child:checked")
        let all_id = []
        $.each(all_cb, function(index, elm){
                all_id.push(elm.value)
            })
        console.log(all_id)
        $.ajax({
            type:"POST",
            url:"{{url('')}}/cetak_barcode2",
            data:{ids:all_id,row:row,col:col},
            success: function(data) {
            console.log(all_id)
            console.log(data)
            }   
        })
    }
</script>
@endsection
</html>