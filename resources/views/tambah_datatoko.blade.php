@extends('admin/admin')
@include('admin/sidebar')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
            </div>
        </div>
        
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Toko</h3>
                        <div class="card-tools"></div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="insertToko" method='post' class="form-group">
                                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                                    <form role= "form">
                                        <input type = "hidden" class = "form-control" id="barcode" name = "barcode" placeholder = "" disabled>
                                        
                                        <label>Nama Toko</label>
                                        <input type="text" id="nama_toko" name="nama_toko" class="form-control select2bs4" style="width: 100%;">
                              
                                        <label>Latitude</label>
                                        <input type="text" id="latitude" name="latitude" class="form-control select2bs4" style="width: 100%;" readonly>
                                        
                                        <label>Longitude</label>
                                        <input type="text" id="longitude" name="longitude" class="form-control select2bs4" style="width: 100%;" readonly>

                                        <label>Accuracy</label>
                                        <input type="text" id="accuracy" name="accuracy" class="form-control select2bs4" style="width: 100%;" readonly>

                                        <div class="card-footer">
                                            <button type="button" class="btn btn-primary" onclick="getLocation()">Geolocation</button> 
                                            <input type="submit" value="Submit" class="btn btn-primary">
                                        </div>
                                    </form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </section>
    </div>
</div>         




<script>
    var lat = document.getElementById("latitude");
    var long = document.getElementById("longitude");
    var acc = document.getElementById("accuracy");
    
    function getLocation() 
    {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(showPosition);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    
    function showPosition(position) 
    {
        lat.value=position.coords.latitude;
        long.value=position.coords.longitude;
        acc.value=position.coords.accuracy;
    }
</script>
@endsection
