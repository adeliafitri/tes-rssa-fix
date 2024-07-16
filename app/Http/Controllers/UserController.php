<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserProfile::join('user', 'userprofile.fk_user_id', 'user.id')
        ->join('provinsi', 'userprofile.fk_provinsi_id', 'provinsi.id')
        ->join('kota', 'userprofile.fk_kota_id', 'kota.id')
        ->join('kecamatan', 'userprofile.fk_kecamatan_id', 'kecamatan.id')
        ->get();

        return response()->json(['status' => 'success', 'message' => 'Data user berhasil ditampilkan', 'data' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:8',
            'status_user' => 'required',
            'fk_tipeuser_id' => 'required|exists:tipeuser,id',
            'nama_userprofile' => 'required|string',
            'alamat_userprofile' => 'required',
            'status_userprofile' => 'required',
            'fk_provinsi_id' => 'required',
            'fk_kota_id' => 'required',
            'fk_kecamatan_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()->first(),
            ], 422);
        }

        try {
            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'status_user' => $request->status_user,
                'fk_tipeuser_id' => $request->fk_tipeuser_id,
            ]);

            $user_id = $user->id;
            UserProfile::create([
                'nama_userprofile' => $request->nama_userprofile,
                'alamat_userprofile' => $request->alamat_userprofile,
                'status_userprofile' => $request->status_userprofile,
                'fk_user_id' => $user_id,
                'fk_provinsi_id' => $request->fk_provinsi_id,
                'fk_kota_id' => $request->fk_kota_id,
                'fk_kecamatan_id' => $request->fk_kecamatan_id,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Data user berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Data user gagal ditambahkan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return response()->json(['status' => 'success', 'message' => 'Data user berhasil ditampilkan', 'data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
