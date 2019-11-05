<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function data()
    {
        $pegawai = DB::table('pegawai')
            ->join('jabatan', 'pegawai.jabatan_id', '=', 'jabatan.id')
            ->select([
                'pegawai.id',
                'pegawai.nama_pegawai',
                'pegawai.keterangan',
                'jabatan.id',
                'jabatan.nama_jabatan',
            ])
            ->get();


        return $this->jsonResponse($pegawai);
    }

    public function detail($id_pegawai)
    {
        $pegawai = [
            Pegawai::find($id_pegawai),
            Pegawai::find($id_pegawai)->jabatan
        ];

        return $this->jsonResponse($pegawai);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $post = $request->input();
            $pegawai = new Pegawai();
            $pegawai->fill([
                'nama_pegawai' => $post['nama_pegawai'],
                'tgl_lahir' => $post['tgl_lahir'],
                'keterangan' => $post['keterangan'],
                'jabatan_id' => $post['jabatan_id']
            ]);

            $resp = [];
            if ($pegawai->save()) {
                $resp = [
                    'data' => $pegawai,
                    'status' => true,
                    'message' => 'sukses update'
                ];
            } else {
                $resp = [
                    'data' => null,
                    'status' => false,
                    'message' => 'gagal update'
                ];
            }

            return $this->jsonResponse($resp);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $post = $request->input();
            $pegawai = Pegawai::find($id);
            $pegawai->fill([
                'nama_pegawai' => $post['nama_pegawai'],
                'tgl_lahir' => $post['tgl_lahir'],
                'keterangan' => $post['keterangan'],
                'jabatan_id' => $post['jabatan_id']
            ]);

            $resp = [];
            if ($pegawai->save()) {
                $resp = [
                    'data' => $pegawai,
                    'status' => true,
                    'message' => 'sukses update'
                ];
            } else {
                $resp = [
                    'data' => null,
                    'status' => false,
                    'message' => 'gagal update'
                ];
            }

            return $this->jsonResponse($resp);
        }
    }

    public function delete($id)
    {

            $pegawai = Pegawai::find($id);
            $resp = [];
            if ($pegawai->delete()) {
                $resp = [
                    'data' => null,
                    'status' => true,
                    'message' => 'sukses delete'
                ];
            } else {
                $resp = [
                    'data' => null,
                    'status' => false,
                    'message' => 'gagal delete'
                ];
            }

            return $this->jsonResponse($resp);

    }
}
