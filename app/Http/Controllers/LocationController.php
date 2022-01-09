<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Location;
//Use App\Http\Controllers\PDF;
Use PDF;

class LocationController extends Controller
{
    public function index()
    {
        $toko = DB::table('lokasi_toko')->get();
        $data = array(
            'menu' => 'home',
            'submenu' => 'toko',
            'toko' => $toko
        );
        return view('table_toko', $data);
    }

    public function toko_barcode($id)
    {
        $toko = DB::table('lokasi_toko')->where('barcode',$id)->get();
        $id_toko=$id;
        $pdf = PDF::loadview('/toko_barcode',['toko'=>$toko,'barcode'=>$id_toko])->setPaper('a4');
        return $pdf->stream();
    }

    public function indexToko()
    {
        $toko = DB::table('lokasi_toko')->get();
        $data = array(
            'menu' => 'home',
            'submenu' => 'toko',
            'toko' => $toko
        );
        return view('tambah_datatoko', $data);
    }

    public function insertToko(Request $post)
    {
        DB::table('lokasi_toko')->insert([
            'nama_toko' => $post->nama_toko,
            'latitude' => $post->latitude,
            'longitude' => $post->longitude,
            'accuracy' => $post->accuracy
        ]);

        return redirect('/table_toko');
    }

    public function titik_kunjungan(){
        return view('/titik_kunjungan');
    }
    public function data_qrcode($id){
        $toko = DB::table('lokasi_toko')->where('barcode',$id)->get();
        return json_encode($toko);
    }

    public function findToko(Request $request){
        $data = Location::select('barcode', 'nama_toko', 'latitude', 'longitude', 'accuracy')
        ->where('barcode', $request->tk_id)
        ->get();
        return response()->json($data);
    }

   
}