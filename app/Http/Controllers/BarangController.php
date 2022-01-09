<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Barang;
use PDF;
use Dompdf\Dompdf;




class BarangController extends Controller
{
    public function indexBarang()
    {
        $barang = DB::table('barang')->get();
        $data = array(
            'menu' => 'barang',
            'submenu' => '',
            'barang' => $barang
        );
        return view('barang', $data);
    }
    public function cetak_barcode(Request $request)
    {
        $no = 1;
    	//$barang = baarang::all();
        $barang = Barang::whereIn('id_barang', $request->ids)->get();
        $data = array(
            'menu' => 'barang',
            'submenu' => '',
            'barang' => $barang,
            'no' => $no
            
        );
    	$pdf = PDF::loadview('cetak_barcode',['barang'=>$barang], $data);
        $pdf->setPaper('A3', 'landscape');
    	return $pdf->download('barang-pdf.pdf');
    }

    public function findBarang(Request $request)
    {
        $data = Barang::select('id_barang', 'nama')
        ->where('id_barang',$request->scan_id)
        ->get();
        return response()->json($data);
    }

    public function cetak_barcode2(Request $request)
    {
        $dataa=$request->id_barang;
        $datab=explode(",", $dataa);
        $barang=DB::table('barang')->whereIn('id_barang', $datab)->get();
        $row= $request->row;
        $col= $request->col;
        $panjang=(($row-1)*5)+($col-1);
        $no = 1;
        $x = 1;
    	//$barang = baarang::all();
        $barang = Barang::whereIn('id_barang', $request->ids)->get();
        $data = array(
            'menu' => 'barang',
            'submenu' => '',
            'barang' => $barang,
            'no' => $no,
            'row'=> $row,
            'col'=> $col,
            'x'=> $x,
            'panjang'=> $panjang
            
            
        );
        $customPaper = array(0, 0, 1000, 1000);
        return PDF::loadView('cetak_barcode', $data)->setPaper($customPaper)->stream('cetak-barcode-checkbox.pdf');
    }
    public function Scanner()
    {
        return view('scanner');
    }

}