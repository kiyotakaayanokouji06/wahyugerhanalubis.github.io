@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
        <div class= "col-md-12">
            <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"> Kembali </i></a>
        </div>
        <div class="col-md-12 mt-2" >
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ ('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Check out</li>
             </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                @if(!empty($pesanan))
                <h3><i class="fa fa-shopping-cart"></i>Check Out</h3>
                <p align="right">Tanggal Pesan : {{ $pesanan->tanggal }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pesanan_detail as $pesanan_detail)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $pesanan_detail->user->nama_barang }}</td>
                                <td>{{ $pesanan_detail->jumlah }} barang</td>
                                <td align="left">Rp. {{ number_format($pesanan_detail->barang->harga) }}</td>
                                <td align="left">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}</td>
                                <td>
                                   <!-- <form action="{{ url('/check_out'.'/'. $pesanan_detail->id) }}" method="get">
                                        @csrf
                                        {{ method_field('DELETE') }} -->
                                        <!-- <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form> -->
                                    <a href="/check_out/{{ $pesanan_detail->id }}"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right"><strong>Total Harga :</strong></td>
                                <td><strong>Rp. {{ number_format($pesanan_detail->sum('jumlah_harga')) }}</strong></td>
                                <td>
                                    <a href="{{ url('konfirmasi-check_out') }}" class="btn btn-success" onclick="return confirm('Anda yakin akan Check Out ?');"><i class="fa fa-shopping</i></button> Check Out
                                    ><i class="fa fa-shopping-cart"></i> Check Out </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

@endsection