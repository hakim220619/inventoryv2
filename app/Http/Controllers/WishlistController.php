<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class WishlistController extends Controller
{
    function view()
    {
        $data['title'] = "Wishlist";
        $data['wishlist'] = DB::select("select w.*, u.full_name from wishlist w, users u where w.user_id=u.id");
        $data['jenis_bale'] = db::select("select jenis_bale from bahan_baku group by jenis_bale ");
        return view('backend.wishlist.view', $data);
    }
    function addProses(Request $request)
    {
        DB::table('wishlist')->insert(['user_id' => request()->user()->id, 'status' => 'Pending', 'jumlah' => $request->jumlah, 'jenis' => $request->jenis]);
        Alert::success('Wishlist successfully added.');
        return redirect('wishlist');
    }
}
