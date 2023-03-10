@extends('layouts.report',['title'=>'Laporan Harian'])

@section('content')
  <div class="container-fluid">
    <h3 class="text-center mt-2">
      <img src="/adminlte/dist/img/logo2.png" class="img-circle" style="opacity: .8; width: 2cm; margin-bottom: 4px;" alt="">
      {{ $outlet->nama }}
    </h3>
    <p class="text-center">
      {{ $outlet->alamat }}
      <br>Telp :  {{ $outlet->tlp }}
    </p>
    <div class="row">
      <div class="col-6 text-left">
        <h5>Judul : Laporan Harian</h5> <br>
      </div>
      <div class="col-6 text-right" style="margin-top: 8px">
        <h5>
          Tanggal : {{ date('d F Y', strtotime(request()->tanggal)) }} <br><br>
        </h5>
      </div>
    </div>

    <table class="table table-sm table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pelanggan</th>
          <th>Waktu</th>
          <th>Nama Kasir</th>
          <th>Pendapatan</th>
        </tr>
      </thead>
      <tbody>
        @php
          $no = 1;
        @endphp

        @foreach ($data as $row)
        <tr>
          <td>{{ $no++ }}.</td>
          <td>{{ $row->nama }}</td>
          <td>{{ date('d/m/Y H:i:s', strtotime($row->tgl)) }}</td>
          <td>{{ $row->kasir }}</td>
          <td>{{ number_format($row->total_bayar,0,',','.') }}</td>
        </tr>
        @endforeach
        <tfoot>
          <tr class="border-bottom">
            <th colspan="4" class="text-center">Total</th>
            <th>{{ number_format($data->sum('total_bayar'),0,',','.') }}</th>
          </tr>
        </tfoot>
      </tbody>
    </table>
  </div>
@endsection