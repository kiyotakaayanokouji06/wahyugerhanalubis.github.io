<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\Pesanandetail;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index($id)
    {
        $barang = Barang::where('id', $id)->first();

        return view('pesan.index', compact('barang'));
    }

    public function pesan(Request $request, $id)
    {
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi apakah melebih stok
        if($request->jumlah_pesan > $barang->stok)
        {
            return redirect('pesan/', $id);
        }

        //cek validasi
        $cek_pesanan = pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();

        //simpan ke database pesanan
        if(empty($cek_pesanan))
        {
            $pesanan = new pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->save();
        }

        //simpan ke database pesanan detail
        $pesanan_baru = pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
       
        //cek pesanan detail
        $cek_pesanan_detail = pesanandetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail = new pesanandetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga*$request->jumlah_pesan;
            $pesanan_detail->save();
        }else
        {
            $pesanan_detail = pesanandetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah*$request->jumlah_pesan;
        
            //harga sekarang
            $harga_pesanan_detail_baru = $barang->harga*$request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        //jumlah total
        $pesanan = pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$barang->harga*$request->jumlah_pesan;
        $pesanan->update();

        return redirect('/check_out');

    }

    public function check_out()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        if(!empty($pesanan))
        {
            $pesanan_detail = Pesanandetail::where('pesanan_id', $pesanan->id)->get();
        }
        
        // dd($pesanan_detail);
        return view('pesan.check_out', compact('pesanan','pesanan_detail'));

    }

    public function delete($id)
    {
        //$pesanan_detail = Pesanandetail::where('id', $id)->delete();
        // $pesanan->jumlah_harga = $pesanan->jumlah_harga+$pesanan_detail->jumlah_harga;
        // $pesanan->update();

        // $pesanan_detail;

        // Alert::error('Pesanan Sukses Dihapus', 'Hapus');
         //return redirect('/check_out');
         $pesanan_detail = Pesanandetail::findOrFail($id);
         $pesanan_detail->delete();
         return redirect()->back(); 
    }

    public function konfirmasi()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        //$pesanan->status = 1;
        //$pesanan->update();

        $pesanan_detail = Pesanandetail::where('pesanan_id', $pesanan->id)->get();
        foreach ($pesanan_detail as $pesanan_detail) {
            $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok = $barang->stok-$pesanan_detail->jumlah;
            $barang->update();    
        }
        
        

        return redirect('/check_out'); 

    

    }
}
