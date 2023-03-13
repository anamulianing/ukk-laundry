@extends('layouts.main',['title'=>'Member'])

@section('content')
    <x-content :title="[
      'name'=>'Member',
      'icon'=>'fas fa-users'
    ]">

      <div class="row">
        <div class="col-md-6">

          <form class="card card-indigo" method="POST" action="{{ route('member.store') }}">
            <div class="card-header">
              <h3 class="card-title">Buat Member</h3>
            </div>

            <div class="card-body">
              @csrf
              <x-input label="Nama" name="nama" autofocus />
              <x-select label="Jenis Kelamin" name="jenis_kelamin" :data-option="[
                ['value'=>'L','option'=>'Laki-laki'],
                ['value'=>'P','option'=>'Perempuan'],
              ]" />
              
              <x-input label="Telepon" name="tlp" />
              <x-textarea label="Alamat" name="alamat" />
            </div>

            <div class="card-footer">
              <x-btn-submit />
            </div>
          </form>

        </div>
      </div>

    </x-content>
@endsection