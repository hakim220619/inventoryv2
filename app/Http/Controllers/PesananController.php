<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    function view()
    {
        $data['title'] = "Pesanan";
        $data['jenis_bale'] = db::select("select jenis_bale from bahan_baku group by jenis_bale ");

        return view('backend.pesanan.view', $data);
    }
    function riwayatPesanan()
    {
        $data['title'] = "Riwayat Pesanan";
        $data['transaksi'] = DB::table("transaksi")->orderBy('created_at', "desc")->get();
        return view('backend.pesanan.riwayat', $data);
    }
    public function load_data()
    {
        $request = Request();
        // dd(isset($request->limit));
        if (isset($request->jenis_bale) && isset($request->limit)) {
            $data = DB::table('product')->where('jenis_bale', $request->jenis_bale)->limit($request->limit)->get();
        } elseif (isset($request->jenis_bale)) {
            $data = DB::table('product')->where('jenis_bale', $request->jenis_bale)->get();
        } else {
            $data = DB::table('product')->get();
        }
        // dd($data);

        echo json_encode($data);
    }
    public function cart()
    {
        $data = DB::table('cart')->where('user_id', request()->user()->id)->get();
        echo json_encode($data);
    }
    public function add_orders(request $request)
    {
        try {
            DB::table('product')->where('id', $request->id)->delete();
            // dd($request->all());
            DB::table('cart')->insert([
                'kode' => $request->kode,
                'user_id' => request()->user()->id,
                'jenis_bale' => $request->jenis_bale,
                'no_bale' => $request->kode . rand(0000, 9999),
                'gross' => $request->gross,
                'berat' => $request->berat,
                'created_at' => now(),

            ]);
            return response()->json([
                'success' => true,
                'msg'     => "Berhasil"
            ]);
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }

    public function addProductAll(Request $request)
    {
        // dd($request->long);

        for ($i = 0; $i < $request->long; $i++) {


            // dd($request->data[$i]);
            $getProduct = DB::table('product')->where('id', $request->data[$i])->first();

            DB::table('cart')->insert([
                'kode' => $getProduct->kode,
                'user_id' => request()->user()->id,
                'jenis_bale' => $getProduct->jenis_bale,
                'no_bale' => $getProduct->kode . rand(0000, 9999),
                'gross' => $getProduct->gross,
                'berat' => $getProduct->berat,
                'created_at' => now(),

            ]);

            DB::table('product')->where('id', $request->data[$i])->delete();
        }

        return response()->json([
            'success' => true,
            'msg'     => "Berhasil"
        ]);
    }
    public function batalProductAll(Request $request)
    {
        // dd($request->all());

        for ($i = 0; $i < $request->long; $i++) {


            // dd($request->data[$i]);
            $getProduct = DB::table('cart')->where('id', $request->data[$i])->first();

            DB::table('product')->insert([
                'kode' => $getProduct->kode,
                'user_id' => request()->user()->id,
                'jenis_bale' => $getProduct->jenis_bale,
                'no_bale' => $getProduct->kode . rand(0000, 9999),
                'gross' => $getProduct->gross,
                'berat' => $getProduct->berat,
                'status' => "Ready",
                'created_at' => now(),

            ]);

            DB::table('cart')->where('id', $request->data[$i])->delete();
        }

        return response()->json([
            'success' => true,
            'msg'     => "Berhasil"
        ]);
    }
    public function rejected(request $request)
    {
        try {
            DB::table('cart')->where('id', $request->id)->delete();
            // dd($request->all());
            DB::table('product')->insert([
                'kode' => $request->kode,
                'user_id' => request()->user()->id,
                'jenis_bale' => $request->jenis_bale,
                'no_bale' => $request->kode,
                'gross' => $request->gross,
                'berat' => $request->berat,
                'status' => "Ready",
                'updated_at' => now(),

            ]);

            return response()->json([
                'success' => true,
                'msg'     => "Berhasil"
            ]);
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
    function transaksi(Request $request)
    {
        try {
            $data = DB::table('cart')->where('user_id', request()->user()->id)->get();
            // dd($data[0]);
            if ($data[0] == "") {
                return response()->json([
                    'success' => false,
                    'msg'     => "Data Kosong"
                ]);
            } else {


                foreach ($data as $da) {
                    DB::table('transaksi')->insert([
                        'no_transaksi' => $request->no_transaksi,
                        'user_id' => request()->user()->id,
                        'kode' => $da->kode,
                        'jenis_bale' => $da->jenis_bale,
                        'no_bale' => $da->kode . rand(0000, 9999),
                        'gross' => $da->gross,
                        'berat' => $da->berat,
                        'status' => "APPROVAL",
                        'tujuan' => $request->tujuan,
                        'created_at' => now(),

                    ]);
                    DB::table('cart')->where('user_id', request()->user()->id)->delete();
                }

                return response()->json([
                    'success' => true,
                    'msg'     => "Berhasil"
                ]);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
