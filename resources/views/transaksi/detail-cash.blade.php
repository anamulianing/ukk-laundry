<div class="card-body border-top">
  <div class="row">
    <div class="col-3">

      <div class="form-group">
        <label>Tanggal</label>
        <span class="col"> :
          {{ date('d/m/Y H:i:s', strtotime($transaksi->tgl)) }}
        </span>
      </div>

      <div class="form-group">
        <label>Batas Waktu</label>
        <span> :
          {{ date('d/m/Y H:i:s', strtotime($transaksi->batas_waktu)) }}
        </span>
      </div>

      <div class="form-group">
        <label>Status</label>
        <span> :
          {{ ucwords($transaksi->status) }}
        </span>
      </div>

      <div class="form-group">
        <label>Status Bayar</label>
        <span> :
          {{ ucwords( str_replace('_',' ',$transaksi->dibayar)) }}
        </span>
      </div>
      
      @if ($transaksi->status == 'diambil')
        <div class="form-group">
          <label>Tanggal Diambil</label>
          <span> :
            {{ date('d/m/Y H:i:s', strtotime($transaksi->tgl_diambil)) }}
          </span>
        </div>
      @endif
      
      @if ($transaksi->dibayar == 'dibayar')
        <div class="form-group">
          <label>Tanggal Bayar</label>
          <span> :
            {{ date('d/m/Y H:i:s', strtotime($transaksi->tgl_bayar)) }}
          </span>
        </div>
      @endif
    </div>

    <div class="col-4"></div>

    <div class="col">

      <div class="form-group">
        <label>Total</label>
        <span> :
          {{  number_format($transaksi->sub_total,0,',','.') }}
        </span>
      </div>

      <div class="form-group">
        <label>Diskon</label>
        <span> :
          {{  number_format($transaksi->diskon,0,',','.') }}
        </span>
      </div>

      <div class="form-group">
        <label>Biaya Tambahan</label>
        <span> :
          {{  number_format($transaksi->biaya_tambahan,0,',','.') }}
        </span>
      </div>

      <div class="form-group">
        <label>Pajak (10%)</label>
        <span> :
          {{  number_format($transaksi->pajak,0,',','.') }}
        </span>
      </div>

      <div class="form-group">
        <label>Total Bayar</label>
        <span> :
          {{  number_format($transaksi->total_bayar,0,',','.') }}
        </span>
      </div>

      <div class="form-group">
        <label>Uang Tunai</label>
        <span> :
          {{  number_format($transaksi->cash,0,',','.') }}
        </span>
      </div>

      <div class="form-group">
        <label>Kembalian</label>
        <span> :
          {{  number_format($transaksi->kembalian,0,',','.') }}
        </span>
      </div>

      <div class="form-group row">
        <div class="col form-inline">
          <a href="{{ route('transaksi.index') }}" class="btn btn-default mr-2">Kembali</a>

          <div class="dropdown">
            @if ($transaksi->status != 'diambil' )
              <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Pilih Status
                Menjadi</button>
              <div class="dropdown-menu">
                @if ($transaksi->status == 'baru')
                  <a href="{{ route('transaksi.status',['transaksi'=>$transaksi->id, 'status'=>'proses']) }}" class="dropdown-item">Proses</a>
                  <a href="{{ route('transaksi.status',['transaksi'=>$transaksi->id, 'status'=>'batal']) }}" class="dropdown-item">Batalkan</a>
                @elseif($transaksi->status == 'proses')
                  <a href="{{ route('transaksi.status',['transaksi'=>$transaksi->id, 'status'=>'selesai']) }}" class="dropdown-item">Selesai</a>
                @elseif($transaksi->status == 'selesai')
                  <a href="{{ route('transaksi.status',['transaksi'=>$transaksi->id, 'status'=>'diambil']) }}" class="dropdown-item">Diambil</a>
                @endif
              </div>
            @endif
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

