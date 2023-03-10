@extends('layouts.main',['title'=>'Outlet'])

@section('content')
    <x-content :title="[
      'name'=>'Outlet',
      'icon'=>'fas fa-store-alt'
    ]">

      <div class="row">
        <div class="col-md-6">

          <form class="card card-indigo" method="POST" action="{{ route('outlet.update',['outlet'=>$outlet->id]) }}">
            <div class="card-header">
              <h3 class="card-title">Edit Outlet</h3>
            </div>

            <div class="card-body">
              @csrf
              @method('PUT')
              <x-input label="Nama" name="nama" :value="$outlet->nama" />
              <x-input label="Telepon" name="tlp" :value="$outlet->tlp" />
              <x-textarea label="Alamat" name="alamat" :value="$outlet->alamat" />
            </div>

            <div class="card-footer">
              <x-btn-update />
            </div>
          </form>

        </div>
      </div>

    </x-content>
@endsection