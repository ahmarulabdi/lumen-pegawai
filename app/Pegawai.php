<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{

    protected $table = 'pegawai';
    protected $fillable = ['nama_pegawai','tgl_lahir','keterangan','jabatan_id'];
    public $timestamps = false;

    public function jabatan(){
        return $this->belongsTo('\App\Jabatan');
    }

}
