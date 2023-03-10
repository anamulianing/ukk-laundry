@extends('layouts.main',['title'=>'Member'])
@section('content')
<x-content :title="[
    'name'=>'Member',
    'icon'=>'fas fa-users'
    ]">
    @if (session('message') == 'success store')
    <x-alert-success />
    @endif

    @if (session('message') == 'success update')
    <x-alert-success type="update" />
    @endif

    @if (session('message') == 'success delete')
    <x-alert-success type="delete" />
    @endif

    <div class="card card-outline card-indigo">
        <div class="card-header form-inline">
            <x-btn-add href="{{ route('member.create') }}" />
            <x-search />
        </div>
        
        <div class="card-body p-0">
            {{-- <div class="row">
                    @foreach ( $members as $member )
                    <div class="col-9 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                Member
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col">
                                        <h2 class="lead"><b>{{ $member->nama }}</b></h2>
                                        <p class="text-muted text-sm">Jenis Kelamin: {{ $member->jenis_kelamin }} </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span> Alamat: {{ $member->alamat }}</li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                                Telepon: {{ $member->tlp }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-left">
                                    <x-edit href="{{ route('member.edit',['member'=>$member->id]) }}" />

                                    <x-delete data-url="{{ route('member.destroy',['member'=>$member->id]) }}" />
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
                        <th>L/P</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = $members->firstItem()
                    ?>
                    @foreach ( $members as $member )
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $member->nama }}</td>
                            <td>{{ $member->jenis_kelamin }}</td>
                            <td>{{ $member->tlp }}</td>
                            <td>{{ $member->alamat }}</td>
                            <td class="text-right">
                                <x-edit href="{{ route('member.edit',['member'=>$member->id]) }}" />

                                <x-delete data-url="{{ route('member.destroy',['member'=>$member->id]) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $members->links('page') }}
        </div>
    </div>
    </x-content>
@endsection

@push('modal')
<x-modal-delete />
@endpush