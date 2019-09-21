<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('data')->get();

        return view('data/list',['data' => $data]);
    }

    public function create(){
        return view('data/create');
    }
    public function create_proses(Request $request){

        $this->validate($request, [
            "nama" => "required|min:6",
            "email" => "required|email",
            "tanggallahir" => "required",
            "notlp" => "required",
            "gender" => "required",
            "foto" => "image|mimes:jpg,png,jpeg"
            ]);

        $nama = $request->input('nama');;
        $email = $request->input('email');
        $tanggallahir = $request->input('tanggallahir');
        $notlp = $request->input('notlp');
        $gender = $request->input('gender');

        $nama_file = preg_replace('/\s+/', '_', $request->input('nama'))."-".date("YmdHis");
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");


        //upload gambar
        if (!empty($request->file('foto'))) {
            $foto = $request->file('foto');
            $nama_foto = "foto-".$nama_file.".".$foto->getClientOriginalExtension();

            $destinationPath = 'uploads/image';
            $foto->move($destinationPath, $nama_foto);
        }else{
            $nama_foto = "Belum Input Foto";
        }
        //upload txt
        $isi_txt = $nama.",".$email.",".$tanggallahir.",".$notlp.",".$gender.",".$nama_foto;
        $my_file = 'uploads/txt/'.$nama_file.'.txt';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
        $data = $isi_txt;
        fwrite($handle, $data);

        //upload database
        DB::table('data')->insert([
            'nama_file' => $nama_file,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]);

        
        return redirect('data/')->with('success', '<div id="notifications" class="alert alert-success"><h5> <span class=" fa fa-check" ></span>Data berhasil ditambahkan, Terimakasih telah mengisi form.</h5></div>');
    }

    public function delete($nama_file)
    {
        //ambil txt
        $my_file = "uploads/txt/".$nama_file.".txt";
        $handle = fopen($my_file, 'r');
        $data = fread($handle,filesize($my_file));
        $split_data = explode(",", $data);
        $foto = $split_data[4];

        unlink($my_file); //delete txt

        if($foto != "Belum Input Foto" ){
            unlink("uploads/image/".$foto);
        }
        
        DB::table('data')->where('nama_file',$nama_file)->delete();

        return redirect('data/')->with('success', '<div id="notifications" class="alert alert-success"><h5> <span class=" fa fa-check" ></span>Data berhasil dihapus.</h5></div>');
    }

    public function detail($nama_file){

        $data = DB::table('data')->where('nama_file',$nama_file)->first();

        if (empty($data->nama_file)) {return response()->view('errors.404', [], 404);}

        $my_file = "uploads/txt/".$nama_file.".txt";
        $handle = fopen($my_file, 'r');
        $data_txt = fread($handle,filesize($my_file));
        $split_data = explode(",", $data_txt);

        $nama_file = $nama_file;
        $nama = $split_data[0];
        $email = $split_data[1];
        $tanggallahir = $split_data[2];
        $notlp = $split_data[3];
        $gender = $split_data[4];
        $foto = $split_data[5];
        $created_at = $data->created_at;
        $updated_at = $data->updated_at;

        if ($foto == 'Belum Input Foto') {
            $foto = "default.png"; 
        }

        return view('data/detail',compact('nama_file','nama','email','tanggallahir','notlp','gender','foto','created_at', 'updated_at'));
    }


    public function update($nama_file){

        $data = DB::table('data')->where('nama_file',$nama_file)->first();

        if (empty($data->nama_file)) {return response()->view('errors.404', [], 404);}

        $my_file = "uploads/txt/".$nama_file.".txt";
        $handle = fopen($my_file, 'r');
        $data_txt = fread($handle,filesize($my_file));
        $split_data = explode(",", $data_txt);

        $nama_file = $nama_file;
        $nama = $split_data[0];
        $email = $split_data[1];
        $tanggallahir = $split_data[2];
        $notlp = $split_data[3];
        $gender = $split_data[4];
        $foto = $split_data[5];
        $created_at = $data->created_at;
        $updated_at = $data->updated_at;

        if ($foto == 'Belum Input Foto') {
            $foto = "default.png"; 
        }

        return view('data/update',compact('nama_file','nama','email','tanggallahir','notlp','gender','foto','created_at', 'updated_at'));
    }    

    public function update_proses(Request $request){
        $this->validate($request, [
            "nama" => "required|min:6",
            "email" => "required|email",
            "tanggallahir" => "required",
            "notlp" => "required",
            "gender" => "required",
            "foto" => "image|mimes:jpg,png,jpeg"
            ]);

        $nama_file = $request->input('nama_file');
        $nama = $request->input('nama');
        $email = $request->input('email');
        $tanggallahir = $request->input('tanggallahir');
        $notlp = $request->input('notlp');
        $gender = $request->input('gender');
        $foto_temp = $request->input('foto_temp');

        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        unlink("uploads/txt/".$nama_file.".txt"); //delete txt


        //upload gambar
        if (!empty($request->file('foto'))) {
            $foto = $request->file('foto');
            $nama_foto = "foto-".$nama_file.".".$foto->getClientOriginalExtension();

            $destinationPath = 'uploads/image';
            $foto->move($destinationPath, $nama_foto);
        }elseif($foto_temp != "default.png"  ){
            $nama_foto = $foto_temp;
        }else{
            $nama_foto = 'default.png';
        }
        //upload txt
        $isi_txt = $nama.",".$email.",".$tanggallahir.",".$notlp.",".$gender.",".$nama_foto;
        $my_file = 'uploads/txt/'.$nama_file.'.txt';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
        $data = $isi_txt;
        fwrite($handle, $data);

        //upload database
        DB::table('data')->where('nama_file',$request->nama_file)->update([
            'updated_at' => date("Y-m-d H:i:s")
            ]);

        
        return redirect('data/')->with('success', '<div id="notifications" class="alert alert-success"><h5> <span class=" fa fa-check" ></span>Data berhasil diupdate, Terimakasih telah mengisi form.</h5></div>');

    }
}
