<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
        function view()
        {
                $data['title'] = "Dashboard";
                $data['admin'] = DB::table('users')->where('role', 1)->count();
                $data['supadmin'] = DB::table('users')->where('role', 3)->count();
                $data['users'] = DB::table('users')->where('role', 2)->count();
                $data['allusers'] = DB::table('users')->count();
                // dd(date('H:i:s'));
                $data['percantageAdmin'] = DB::select("Select 
                Count(id) * 100.0 / ((Select Count(id) From users) * 1.0) as progres
                From users WHERE created_at >= '" . date('Y-m') . "01 00:00:00' AND created_at < '2023-06-26 " . date('H:i:s') . "' AND role = 1");
                $data['percantageUser'] = DB::select("Select 
                Count(id) * 100.0 / ((Select Count(id) From users) * 1.0) as progres
                From users WHERE created_at >= '" . date('Y-m') . "01 00:00:00' AND created_at < '2023-06-26 " . date('H:i:s') . "' AND role = 2");
                $data['percantageSuAdmin'] = DB::select("Select 
                Count(id) * 100.0 / ((Select Count(id) From users) * 1.0) as progres
                From users WHERE created_at >= '" . date('Y-m') . "01 00:00:00' AND created_at < '2023-06-26 " . date('H:i:s') . "' AND role = 3");
                $data['percantageAllUser'] = DB::select("Select 
                Count(id) * 100.0 / ((Select Count(id) From users) * 1.0) as progres
                From users WHERE created_at >= '" . date('Y-m') . "01 00:00:00' AND created_at < '2023-06-26 " . date('H:i:s') . "'");

                $data['approvedOrders'] = DB::select("SELECT t.*, COUNT(t.no_transaksi) as total FROM transaksi t WHERE t.status = 'APPROVAL' GROUP BY t.no_transaksi");
                return view('backend.dashboard.view', $data);
        }
        public function load_data()
        {
                $request = Request();
                // dd($request->all());
                $data = DB::select("select * from transaksi where no_transaksi = '$request->no_transaksi' and status = 'APPROVAL'");
                echo json_encode($data);
        }
        public function load_delivered()
        {
                $request = Request();
                // dd($request->all());
                $data = DB::select("SELECT t.*, COUNT(t.no_transaksi) as total FROM transaksi t WHERE t.status = 'DELIVERED' GROUP BY t.no_transaksi");
                echo json_encode($data);
        }
        public function wishlist()
        {
                $data = DB::select("select * from wishlist where status = 'Pending'");
                echo json_encode($data);
        }
        function sendDelivered(Request $request)
        {
                DB::table('transaksi')->where('no_transaksi', $request->no_transaksi)->update(['status' => "DELIVERED"]);
                return response()->json([
                        'success' => true,
                        'msg'     => "Pesanan Delivered"
                ]);
        }
}
