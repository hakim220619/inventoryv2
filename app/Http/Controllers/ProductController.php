<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    function view()
    {
        $data['title'] = "Product";
        $data['product'] = DB::table('product')->where('status', 'Ready')->get();
        return view('backend.product.view', $data);
    }
    function add()
    {
        $data['title'] = "Add Product";
        return view('backend.product.add', $data);
    }
    public function load_data()
    {
        $data = DB::table('bahan_baku')->get();
        echo json_encode($data);
    }
    public function listProduct()
    {
        $data = DB::table('product')->where('status', 'Pending')->where('user_id',  request()->user()->id)->get();
        echo json_encode($data);
    }
    public function add_orders(request $request)
    {
        // dd($request->all());
        try {
            DB::table('product')->insert([
                'kode' => $request->kode,
                'user_id' => request()->user()->id,
                'jenis_bale' => $request->jenis_bale,
                'no_bale' => $request->kode . rand(2, 50),
                'gross' => $request->gross,
                'berat' => $request->berat,
                'status' => "Pending",
                'created_at' => now(),

            ]);
            DB::table('bahan_baku')->where('kode', $request->kode)->update(['stock' => $request->stock + 1]);

            $this->load_data();
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
    function sendDataProduct()
    {
        try {
            $data = DB::table('product')->where('user_id', request()->user()->id)->update([
                'status' => "Ready",
                'created_at' => now(),

            ]);
            $this->listProduct();
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
            'gross' => $request->gross,
            'berat' => $request->berat,
            'updated_at' => now(),
        ];
        DB::table('product')->where('id', $request->id)->update($data);
        Alert::success('Product successfully updated.');
        return redirect('product');
    }
    public function delete($id)
    {
        try {
            DB::table('product')->where('id', $id)->delete();
            return redirect()->route('product');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
