<html>
@extends('admin/admin')
@include('admin/sidebar')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ZXing for JS">
  <zxing-scanner [tryHarder]="true" [formats]="formats" (scanSuccess)="onScanSuccessHandler($event)"></zxing-scanner>
</head>
@section('content')
<body>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <!-- Scan Kunjungan Toko -->
        <!-- <small>Control panel</small> -->
      </h1><br><br>

      <div class="row">
                <div class="col-12 col-md-6 col-lg-6 col-sm-12">
                    <section class="container" id="demo-content">
                        <h1 class="title">Scan Barcode Toko Disini</h1>

                        <div>
                            <a class="btn btn-primary" id="startButton">Start</a>
                            <a class="btn btn-info" id="resetButton">Reset</a>
                        </div>
                            <br>
                        <div>
                            <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
                        </div>

                        <div id="sourceSelectPanel" style="display:none">
                            <label for="sourceSelect">Change video source:</label>
                            <select class="form-control" id="sourceSelect" style="max-width:400px">
                            </select>
                        </div>

                        <label>Result:</label>
                        <code class="form-control" style="width:400px" name="result" id="result"></code>
                        <br>
                        <input href="findToko" class="btn btn-primary" type="button" id="find_toko" name="find_toko" value="Details"><br>

                    </section>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-sm-12">
                    
                  <div class="card-body">
                        <!-- Lokasi Toko -->
                        <div class="form-group">
                            <label>Nama Toko</label>
                            <input type="text" class="form-control" id="nama_toko" name="nama_toko" placeholder="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Accuracy</label>
                            <input type="text" class="form-control" id="accuracy" name="accuracy" placeholder="" readonly>
                        </div>
                      <!-- Lokasi Sekarang -->
                        <label>Lokasi Anda Sekarang</label>
                        <div class="form-group">
                            <label for="">Latitude</label>
                            <input type="text" class="form-control" id="latitude_now" name="latitude_now" placeholder="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control" id="longitude_now" name="longitude_now" placeholder="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Accuracy</label>
                            <input type="text" class="form-control" id="accuracy_now" name="accuracy_now" placeholder="" readonly>
                        </div>
                        <p id="demo"></p>
                            
                            <button type="submit" class="btn btn-primary" onclick="konfirmasi()">Submit</button><br><br>
                
              </div>
          </div>
          </div>
          </div>
        
    </section>

</body>
<!-- Kamera -->
<!-- GetLocation -->
<script>
  var lat1 = document.getElementById("latitude");
  var lon1 = document.getElementById("longitude");
  var acc1 = document.getElementById("accuracy");
  var lat2 = document.getElementById("latitude_now");
  var lon2 = document.getElementById("longitude_now");
  var acc2 = document.getElementById("accuracy_now");
    var x = document.getElementById("demo");
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(showPosition);
          // konfirmasi();
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }


    function showPosition(position) {
    lat2.value = position.coords.latitude;
    lon2.value= position.coords.longitude;
    acc2.value= position.coords.accuracy;
    }

    function konfirmasi( ){
      var lat1 = document.getElementById("latitude").value;
      var lon1 = document.getElementById("longitude").value;
      var acc1 = Number(document.getElementById("accuracy").value);
      var lat2 = document.getElementById("latitude_now").value;
      var lon2 = document.getElementById("longitude_now").value;
      var acc2 = Number(document.getElementById("accuracy_now").value);
      var rac = Number((acc1+acc2)/2);
      var b = Number(getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2)*1000);
      console.log(acc1);
      console.log(lat1);
      console.log(lon1);
      console.log(acc2);
      console.log(lat2);
      console.log(lon2);
      console.log(rac);
      console.log(b);
      if (b <= rac) {
        alert("Anda Berada Dalam Jangkauan");
      } else {
        alert("Anda Berada Di luar Jangkauan");
      }
    }

    function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
      var R = 6371; // Radius of the earth in km
      var dLat = deg2rad(lat2-lat1); // deg2rad below
      var dLon = deg2rad(lon2-lon1);
      var a =
      Math.sin(dLat/2) * Math.sin(dLat/2) +
      Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
      Math.sin(dLon/2) * Math.sin(dLon/2)
      ;
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
      var d = R * c; // Distance in km
      return d;
    }
    function deg2rad(deg) {
      return deg * (Math.PI/180)
    }

</script>

<!-- Kamera -->
<script type="text/javascript" src="https://unpkg.com/@zxing/library@0.18.3-dev.7656630/umd/index.js"></script>
  <script type="text/javascript">
    window.addEventListener('load', function () {
      let selectedDeviceId;
      const codeReader = new ZXing.BrowserMultiFormatReader()
      console.log('ZXing code reader initialized')
      codeReader.listVideoInputDevices()
        .then((videoInputDevices) => {
          const sourceSelect = document.getElementById('sourceSelect')
          selectedDeviceId = videoInputDevices[0].deviceId
          if (videoInputDevices.length >= 1) {
            videoInputDevices.forEach((element) => {
              const sourceOption = document.createElement('option')
              sourceOption.text = element.label
              sourceOption.value = element.deviceId
              sourceSelect.appendChild(sourceOption)
            })

            sourceSelect.onchange = () => {
              selectedDeviceId = sourceSelect.value;
            };

            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
            sourceSelectPanel.style.display = 'block'
          }

          document.getElementById('startButton').addEventListener('click', () => {
            codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
              if (result) {
                console.log(result)
                document.getElementById('result').textContent = result.text
                const audio = new Audio('assets/dc.mp3');
                audio.play();
                // AJAX FIND RESULT
                var id_toko = document.getElementById('result').innerHTML;
                console.log(id_toko);
                $.ajax({
                  type:"get",
                  url:"findToko",
                  data:"tk_id="+id_toko,
                  success: function(data){
                    
                    for(var i=0;i<data.length;i++){
                      document.getElementById("nama_toko").value = data[i].nama_toko;
                      document.getElementById("longitude").value = data[i].longitude;
                      document.getElementById("latitude").value = data[i].latitude;
                      document.getElementById("accuracy").value = data[i].accuracy;
                    }
                  }
                });
                codeReader.reset();
                getLocation();
                
              }
              if (err && !(err instanceof ZXing.NotFoundException)) {
                console.error(err)
                document.getElementById('result').textContent = err
              }
            })
            console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
          })

          document.getElementById('resetButton').addEventListener('click', () => {
            codeReader.reset()
            document.getElementById('result').textContent = '';
            console.log('Reset.')
          })

        })
        .catch((err) => {
          console.error(err)
        })
    })
  </script>

@endsection
</html>