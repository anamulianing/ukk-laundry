<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
    }

    .invoice {
      width: 70mm;
    }

    table {
      width: 100%;
    }

    .center {
      text-align: center;
    }

    .right {
      text-align: right;
    }

    hr {
      border-top: 1px solid #8c8b8b;
    }

    .name{
      margin-left: 8%;
    } 
  </style>
</head>
<body onload="javascript:window.print()">
  <div class="invoice">
    <tr>
      <td>
        <img src="/adminlte/dist/img/logo2.png" class="img-circle" style="opacity: .8; width: 2.5rem; margin-bottom: -15px;">
      </td>
      <td>
        <h3 class="name"  style="display: inline;">{{ $outlet->nama }}</h3>
      </td>
    </tr>
    <p>
      {{ $outlet->alamat }} <br> 
      Telp : {{ $outlet->tlp }}
    </p>
    <hr>
    <p>
      Kode Transaksi : {{ $transaksi->kode_invoice }} <br>
      Kasir : {{ $user->nama }} <br>
      Pelanggan : {{ $member->nama }} <br>
      Tanggal : {{ date('d/m/Y H:i:s', strtotime($transaksi->tgl)) }} <br>
    </p>
    
    <hr>

    <table>
      @foreach ($items as $item)
        <tr>
          <td>{{ $item->qty }} {{ $item->nama_paket }} x {{ number_format($item->harga,0,',','.') }} <br> 
            @if ($item->diskon)
            ({{ $item->diskon }}%) <br>
            @endif
            <small>Ket : {{ $item->keterangan }}</small>
          </td>
          <td class="right">
            @if ($item->diskon != null)
                {{ number_format($item->sub_total) }}
            @else
              {{ number_format($item->sub_total) }}
            @endif
          </td>
        </tr>
      @endforeach
    </table>

    <hr>
    
    <p class="right">
      Sub Total : Rp. {{ number_format($transaksi->sub_total,0,',','.') }} <br>
      Diskon : Rp. {{ number_format($transaksi->diskon,0,',','.') }} <br>
      Biaya Tambahan : Rp. {{ number_format($transaksi->biaya_tambahan,0,',','.') }} <br>
      Pajak PPN(10%) : Rp. {{ number_format($transaksi->pajak,0,',','.') }} <br>
      Total : Rp. {{ number_format($transaksi->total_bayar,0,',','.') }} <br>
      @if ($transaksi->dibayar == 'dibayar')
        Tunai : Rp. {{ number_format($transaksi->cash,0,',','.') }} <br>
        Kembalian : Rp. {{ number_format($transaksi->kembalian,0,',','.') }} <br>
      @endif
    </p>

    @if ($transaksi->dibayar == 'dibayar')
        <h3 class="center">Terima Kasih</h3>
    @endif

  </div>
</body>
</html>