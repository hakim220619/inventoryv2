<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class BahanBakuController extends Controller
{
    function view()
    {
        
        $data['title'] = "Bahan Baku";
        $data['bBaku'] = DB::table('bahan_baku')->get();
        return view('backend.bahanBaku.view', $data);
    }
    function addBahanBaku()
    {
        $data['title'] = "Tambah Bahan Baku";
        return view('backend.bahanBaku.add', $data);
    }
    function addProses(Request $request)
    {
        try {
            $data = [
                'kode' => $request->kode,
                'jenis_bale' => $request->jenis_bale,
                'brand' => $request->brand,
                'stock' => $request->stock,
                'created_at' => now(),
            ];

            DB::table('bahan_baku')->insert($data);
            Alert::success('Bahan successfully added.');
            return redirect('BahanBaku');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
    public function editProses(Request  $request)
    {
        $data = [
            'kode' => $request->kode,
            'jenis_bale' => $request->jenis_bale,
            'brand' => $request->brand,
            'stock' => $request->stock,
            'updated_at' => now(),
        ];
        DB::table('bahan_baku')->where('id', $request->id)->update($data);
        Alert::success('Bahan successfully updated.');
        return redirect('BahanBaku');
    }

    public function delete($id)
    {
        try {
            DB::table('bahan_baku')->where('id', $id)->delete();
            return redirect()->route('BahanBaku');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
    public function deleteProduct($id)
    {
        try {
            // dd($id);
            DB::table('product')->where('id', $id)->delete();
            return redirect()->route('BahanBaku');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
