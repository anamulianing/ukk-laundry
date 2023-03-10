@extends('layouts.main',['title'=>'Dashboard'])

@section('content')
    <x-content :title="[
      'name'=>'Dashboard',
      'icon'=>'fas fa-home',
    ]">

    <div class="row">

        @can('admin-kasir')
            <x-box :data-box="[
                'label'=>'Transaksi',
                'background'=>'bg-primary',
                'value'=>$transaksi->jumlah,
                'icon'=>'fas fa-cash-register',
                'href'=>route('transaksi.index')
                ]" />

            <x-box :data-box="[
                'label'=>'Member',
                'background'=>'bg-success',
                'value'=>$member->jumlah,
                'icon'=>'fas fa-users',
                'href'=>route('member.index')
            ]" />
        @endcan

        @can('admin')
            <x-box :data-box="[
                'label'=>'Outlet',
                'background'=>'bg-purple',
                'value'=>$outlet->jumlah,
                'icon'=>'fas fa-store-alt',
                'href'=>route('outlet.index')
            ]" />
            
            <x-box :data-box="[
                'label'=>'User',
                'background'=>'bg-fuchsia',
                'value'=>$user->jumlah,
                'icon'=>'fas fa-user',
                'href'=>route('user.index')
            ]" />
            
            <x-box :data-box="[
                'label'=>'Paket',
                'background'=>'bg-secondary',
                'value'=>$paket->jumlah,
                'icon'=>'fas fa-cubes',
                'href'=>route('paket.index')
            ]" />
            
            @php
                $data = \App\Models\LogActivity::select('id')->get()->count('id');
            @endphp
            
            <x-box :data-box="[
                'label'=>'Log Activity',
                'background'=>'bg-danger',
                'value'=>$data,
                'icon'=>'fas fa-shoe-prints',
                'href'=>route('log')
            ]" />
        @endcan
    </div>
    <div class="card">
        <div class="card-body">
            <div class="chart">
                <canvas id="chartTransaksi" ></canvas>
            </div>
        </div>
    </div>
</x-content>
@endsection

@push('js')
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        var ctx = document.getElementById('chartTransaksi').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($label) ?>,
                datasets: [{
                    label: "Pendapatan",
                    data: <?= json_encode($jumlah) ?>,
                    borderWidth: 1,
                    backgroundColor: 'rgba(23,160,205,.5)',
                    borderColor: 'rgba(23,160,205,1)'
                }]
            },
        });
    </script>
@endpush