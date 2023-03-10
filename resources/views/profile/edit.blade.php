@extends('layouts.main',['title'=>'Profile'])

@section('content')
    <x-content :title="[
      'name'=>'Ubah Profile',
      'icon'=>'fas fa-user'
    ]" >

    <div class="row">
      <div class="col-lg-4 col-md-6">
        @if (session('message') == 'success update')
          <x-alert-success type="update" />
        @endif

        <form class="card card-indigo" method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
          
          <div class="card-header">
          </div>

          <div class="card-body">
            @csrf
            <x-input label="Nama" name="nama" :value="$user->nama" />

            <x-input label="Username" name="username" :value="$user->username" disabled />

            <p class="text-muted mt-5">
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
          
          <div class="card-footer ">
            <x-btn-update />
          </div>

        </form>
      </div>
    </div>
  </x-content>
@endsection