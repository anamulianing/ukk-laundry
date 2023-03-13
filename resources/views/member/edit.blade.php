@extends('layouts.main',['title'=>'Member'])

@section('content')
    <x-content :title="[
      'name'=>'Member',
      'icon'=>'fas fa-users'
    ]">

      <div class="row">
        <div class="col-md-6">

          <form class="card card-indigo" method="POST" action="{{ route('member.update',['member'=>$member->id]) }}">
            <div class="card-header">
              <h3 class="card-title">Edit Member</h3>
            </div>

            <div class="card-body">
              @csrf
              @method('PUT')
              <x-input label="Nama" name="nama" :value="$member->nama" autofocus />
              <x-select label="Jenis Kelamin" name="jenis_kelamin" :data-option="[
                ['value'=>'L','option'=>'Laki-laki'],
                ['value'=>'P','option'=>'Perempuan'],
              ]" :value="$member->jenis_kelamin" />
              
              <x-input label="Telepon" name="tlp" :value="$member->tlp" />
              <x-textarea label="Alamat" name="alamat" :value="$member->alamat" />
            </div>

            <div class="card-footer">
              <x-btn-update />
            </div>
          </form>

        </div>
      </div>

    </x-content>
@endsection