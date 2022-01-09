<!DOCTYPE html>
<html>
    <style>
        td {
            padding: 5px;
        }
        div {
            height: 68,03149606299213px;
            weight: 124,7244094488189px;
        }
        p{
            margin-top: -1px;
            font-size: 12;
        }
        br{
            margin-top: -100px;
        }
    </style>
<body>  
   
<table style>
    <tr>
    @foreach (range(0,$panjang) as $key)
        @if($x++ <= $panjang)
    <td style="text-align:center" width="100" height="40">
    </td>
        @if($no++ % 5 == 0)
    </tr>
    <tr> 
        @endif  
        @else
        @foreach ($barang as $data)
            <td>
                <center>
                    {!! \DNS1D::getBarcodeHTML($data -> id_barang,'C128') !!}
                    {{ $data -> nama_barang }}
                </center>
            </td>
        @if($no++ % 5 == 0)
    </tr>
        @endif
        @endforeach
        @endif
        @endforeach
</table>       
</body>
</html>