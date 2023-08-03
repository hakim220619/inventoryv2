<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    function view()
    {
        $data['title'] = "Users";
        $data['status'] = ['ON', 'OFF'];
        // dd($data['status']);
        $data['users'] = DB::table('users')->where('role', 2)->get();
        return view('backend.users.view', $data);
    }
    function addUsers()
    {
        $data['title'] = "Tambah Users";
        return view('backend.users.add', $data);
    }
    function addProses(Request $request)
    {
        try {
            $getImage = DB::table('users')->where('email', $request->email)->first();
            if (isset($getImage->email) == true) {
                Alert::error('Email Already Registered.');
                return Redirect::back()->withInput();
            }

            $image = $request->file('image');
            // dd($getImage->image);
            $filename = $image->getClientOriginalName();
            $image->move(public_path('storage/images/users'), $filename);
            $data = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'role' => 2,
                'image' => $request->file('image')->getClientOriginalName(),
                'status' => $request->status,
                'remember_token' => base64_encode($request->email),
                'created_at' => now(),
            ];

            DB::table('users')->insert($data);
            Alert::success('Users successfully added.');
            return redirect('users');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
    public function editProses(Request  $request)
    {
        if ($request->has('image') != null) {
            $getImage = DB::table('users')->where('id', $request->id)->first();
            $file_path = public_path() . '/storage/images/users/' . $getImage->image;
            File::delete($file_path);
            $image = $request->file('image');
            // dd($getImage->image);
            $filename = $image->getClientOriginalName();
            $image->move(public_path('storage/images/users'), $filename);
            $data = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $request->file('image')->getClientOriginalName(),
                'status' => $request->status,
                'updated_at' => now()
            ];
        } else {
            $data = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => $request->status,
                'updated_at' => now()
            ];
        }

        // dd($data);
        DB::table('users')->where('id', $request->id)->update($data);
        Alert::success('Users successfully updated.');
        return redirect('users');
    }
    function changePassword(Request $request)
    {
        DB::table('users')->where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        Alert::success('Users successfully updated.');
        return redirect('users');
    }
    public function delete($id)
    {
        try {
            // dd($id);
            $getImage = DB::table('users')->where('id', $id)->first();
            $file_path = public_path() . '/storage/images/users/' . $getImage->image;
            File::delete($file_path);
            DB::table('users')->where('id', $id)->delete();
            // Alert::success('Category was successful deleted!');
            return redirect()->route('users');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
