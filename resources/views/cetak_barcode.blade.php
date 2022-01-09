<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        .text-center {
            text-align: center;
            
        }
        td{
            padding: 20px;

        }
        @page {margin: 0px;}
        body {margin: 0px;}
        
    </style>
</head>
<body>
    <table   >
        <tr>
            @foreach ($barang as $data)
            <td>
                {!! \DNS1D::getBarcodeHTML($data -> id_barang,'C39',1,33) !!}
                {{ $data -> id_barang }} <br>
                {{$data->nama_barang}}
            </td>
                @if ($no++ % 4 == 0)
                    </tr><tr>
                @endif
            @endforeach
        </tr>
    </table>
</body>
</html>
