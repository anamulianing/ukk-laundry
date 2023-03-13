@extends('layouts.main',['title'=>'Paket'])

@section('content')
    <x-content :title="[
      'name'=>'Paket',
      'icon'=>'fas fa-store-alt'
    ]">

      <div class="row">
        <div class="col-md-6">

          <form class="card card-indigo" method="POST" action="{{ route('paket.update',['paket'=>$paket->id]) }}">
            <div class="card-header">
              <h3 class="card-title">Edit Paket</h3>
            </div>

            <div class="card-body">
              @csrf
              @method('PUT')
              <x-input label="Nama Paket" name="nama_paket" :value="$paket->nama_paket" autofocus />
              <div class="row">
                <div class="col-6">
                  <x-input label="Harga" name="harga" id="harga" :value="$paket->harga" type="number" min="0" />
                </div>
                <div class="col-6">
                  <x-input label="Diskon(%)" name="diskon" id="diskon" :value="$paket->diskon" type="number" />
                </div>
              </div>
              <div class="text-muted">
                <label for="total">Harga setelah diskon :</label>
                <span id="total"></span>
              </div>
              <x-select label="Jenis" name="jenis" :data-option="[
                ['value'=>'kiloan','option'=>'Kiloan'],
                ['value'=>'kaos','option'=>'T-Shirt/Kaos'],
                ['value'=>'bed_cover','option'=>'Bed Cover'],
                ['value'=>'selimut','option'=>'Selimut'],
                ['value'=>'lain','option'=>'Lainnya'],
              ]" :value="$paket->jenis" />
              <x-select label="Outlet" name="outlet_id" :data-option="$outlets" :value="$paket->outlet_id" />
            </div>

            <div class="card-footer">
              <x-btn-update />

              
            </div>
          </form>

        </div>
      </div>

    </x-content>
@endsection
@push('js')
    <script>
      $(document).ready(function () {
        const harga = document.getElementById('harga');
        const diskon = document.getElementById('diskon');
        const harga_diskon = document.getElementById('harga_diskon');
  
        function kalkulasiTotal() {
          const th = harga.value;             //total harga
          const dp = diskon.value / 100;      //diskon persen
          const dh = th - (th * dp);               //harga diskon

          if (dh < 0) {
            $('#harga_diskon').value;
            alert('Diskon tidak boleh melebihi harga.');
            $('button[type="submit"]').attr('disabled', true);
            return;
          }
          $('#harga_diskon').value;
          $('button[type="submit"]').attr('disabled', false);

          harga_diskon.innerText = `Rp. ${dh.toLocaleString()}`;
        }

        harga.addEventListener('input',kalkulasiTotal);
        diskon.addEventListener('input',kalkulasiTotal);
        kalkulasiTotal();
      })

    </script>
@endpush