<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\DataCust;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Kabkot;
use App\Models\Provinsi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataCustImport;


class Customer extends Controller
{
    public function home(){
        $data = array(
            'menu' => 'home',
            'submenu' => ''
        );
        return view('home', $data);
    }

    public function Customer(){
        $data = array(
            'menu' => 'customer',
            'submenu' => '',
            'customer' => $customer
        );
        return view('customer', $data);
    }

    public function indexCustomer(){
        $customer = DB::table('customer')
        ->join('tbl_kelurahan', 'tbl_kelurahan.id_kelurahan', '=', 'customer.id_kelurahan')
        ->get();
        $data = array(
            'menu' => 'home',
            'submenu' => 'customer',
            'customer' => $customer
        );
        return view('customer', $data);
    }

    // public function tambahCustomer(){
    //     $provinsi = DB::table('tbl_provinsi')->get();
    //     $kota = DB::table('tbl_kabkot')->get();
    //     $kecamatan = DB::table('tbl_kecamatan')->get();
    //     $kelurahan = DB::table('tbl_kelurahan')->get();
    //     $kodepos = DB::table('tbl_kelurahan')->get();
    //     $data = array(
    //         'menu' => 'home',
    //         'submenu' => '',
    //         'provinsi' => $provinsi,
    //         'kota' => $kota,
    //         'kecamatan' => $kecamatan,
    //         'kelurahan' => $kelurahan,
    //         'kodepos' => $kodepos
    //     );

        
    //     return view('tambah_customer', $data);
    // }

    public function insertCustomer(Request $post){
        DB::table('customer')->insert([
            'id_customer' => $post->id_customer,
            'nama' => $post->nama,
            'alamat' => $post->alamat,
            'foto' => $post->imagecam,
            // 'file_path' => $post->file-path,
            'id_kelurahan' => $post->kelurahandd
        ]);

        return redirect('/data_customer1');
    }

    public function insertCustomer2(Request $post){
        $imagecam = str_replace('data:image/png;base64,', '', $post->imagecam);
        $imagecam = str_replace(' ', '+', $imagecam);
        $imageName = $post->nama.time(). '.png';
        Storage::disk('local')->put($imageName, base64_decode($imagecam));
        DB::table('customer')->insert([
            'id_customer' => $post->id_customer,
            'nama' => $post->nama,
            'alamat' => $post->alamat,
            'foto' => $post->imagecam,
            'file_path' => $imageName,
            'id_kelurahan' => $post->kelurahandd
        ]);
        return redirect('/data_customer1');
    }
    public function importexcel (Request $request){
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('data_customer1', $namafile);
        Excel::import(new DataCustImport, public_path('/data_customer1/'.$namafile));
        return \redirect()->back();
    }

}
