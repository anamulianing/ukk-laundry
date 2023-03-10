@extends('layouts.main',['title'=>'User'])

@section('content')
    <x-content :title="[
      'name'=>'User',
      'icon'=>'fas fa-user'
    ]">

      <div class="row">
        <div class="col-md-6">

          <form class="card card-indigo" method="POST" action="{{ route('user.update',['user'=>$user->id]) }}" :upload="true" enctype="multipart/form-data">
            <div class="card-header">
              <h3 class="card-title">Edit User</h3>
            </div>

            <div class="card-body">
              @csrf
              @method('PUT')
              <x-input label="Nama" name="nama" :value="$user->nama" />
              <x-input label="Username" name="username" :value="$user->username" />
              {{-- <div class="form-group">
                <img src="{{ $user->foto }}" class="img-fluid">
              </div>
              <x-input label="Foto Profile" type="file" name="foto" /> --}}
              <x-select label="Role" name="role" :data-option="[
                ['value'=>'kasir','option'=>'Kasir'],
                ['value'=>'owner','option'=>'Pemilik'],
                ['value'=>'admin','option'=>'Administrator'],
              ]" :value="$user->role" />
              <x-select label="Outlet" name="outlet_id" :data-option="$outlets" :value="$user->outlet_id" />
              
              <p class="text-muted">
                Kosongkan password apabila tidak ada perubahan
              </p>

              <p class="text-muted mt-5">
                Password Anda minimal terdiri dari :
              </p>
              <ul class="text-muted">
                <li>Minimal 8 karakter</li>
                <li>Mengandung 1 huruf kapital</li>
                <li>Mengandung 1 huruf kecil</li>
                <li>Mengandung 1 angka</li>
                <li>Mengandung 1 karakter khusus</li>
              </ul>
              
              <x-input label="Password" name="password" type="password" />
              <x-input label="Password Confirmation" name="password_confirmation" type="password" />
            </div>

            <div class="card-footer">
              <x-btn-update />
            </div>
          </form>

        </div>
      </div>

    </x-content>
@endsection