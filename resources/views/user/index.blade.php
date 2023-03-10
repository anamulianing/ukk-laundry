@extends('layouts.main',['title'=>'User'])
@section('content')
<x-content :title="[
    'name'=>'User',
    'icon'=>'fas fa-user'
    ]">
    @if (session('message') == 'success store')
    <x-alert-success/>
    @endif

    @if (session('message') == 'success update')
    <x-alert-success type="update"/>
    @endif

    @if (session('message') == 'success delete')
    <x-alert-success type="delete"/>
    @endif

    <div class="card card-outline card-indigo">
        <div class="card-header form-inline">
            <x-btn-add href="{{ route('user.create') }}"/>
            <x-search/>
        </div>
        <div class="card-body p-0">
            
            {{-- <div class="row">
                    @foreach ( $users as $user )
                    <div class="col-9 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                User
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col">
                                        <h2 class="lead"><b>{{ $user->nama }}</b></h2>
                                        <p class="text-muted text-sm">Username: {{ $user->username }} </p>
                                        <p class="text-muted text-sm">Role: {{ $user->role }} </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small">
                                                <span class="fa-li">
                                                    <i class="fas fa-store-alt"></i>
                                                </span>
                                                Outlet: {{ $user->outlet }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{ $user->foto }}" alt="user-avatar" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <x-edit href="{{ route('user.edit',['user'=>$user->id]) }}" />

                                    <x-delete data-url="{{ route('user.destroy',['user'=>$user->id]) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> --}}
            
            <table class="table table-hover table-head-fixed table-striped m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Outlet</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                      $no = $users->firstItem()
                      ?>
                    @foreach ( $users as $user )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->outlet }}</td>
                        <td class="text-right">
                            <x-edit href="{{ route('user.edit',['user'=>$user->id]) }}"/>
                            
                            <x-delete data-url="{{ route('user.destroy',['user'=>$user->id]) }}" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $users->links('page') }}
        </div>
    </div>
</x-content>
@endsection

@push('modal')
    <x-modal-delete />
@endpush