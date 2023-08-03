<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class AplikasiController extends Controller
{
    function view()
    {
        $data['title'] = "Aplikasi";
        $data['aplikasi'] = DB::table('aplikasi')->first();
        return view('backend.aplikasi.view', $data);
    }
    public function editProses(Request  $request)
    {
        try {
            if ($request->has('image') != null) {
                $getImage = DB::table('aplikasi')->where('id', $request->id)->first();
                $file_path = public_path() . '/storage/images/users/' . $getImage->logo;
                File::delete($file_path);
                $image = $request->file('image');
                $filename = $image->getClientOriginalName();
                $image->move(public_path('storage/images/logo'), $filename);
                $data = [
                    'title' => $request->title,
                    'owner' => $request->owner,
                    'address' => $request->address,
                    'telephone' => $request->telephone,
                    'app_name' => $request->app_name,
                    'copy_right' => $request->copy_right,
                    'version' => $request->version,
                    'logo' => $request->file('image')->getClientOriginalName(),
                ];
            } else {
                $data = [
                    'title' => $request->title,
                    'owner' => $request->owner,
                    'address' => $request->address,
                    'telephone' => $request->telephone,
                    'app_name' => $request->app_name,
                    'copy_right' => $request->copy_right,
                    'version' => $request->version,
                ];
            }
            // dd($data);
            DB::table('aplikasi')->where('id', $request->id)->update($data);
            Alert::success('Successfully updated application!');
            return redirect()->route('aplikasi');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
