<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\HargaDiskon;
use App\Models\Outlet;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pakets = Paket::join('outlets', 'outlets.id', 'pakets.outlet_id')
            ->when($search, function ($query, $search) {
                return $query->where('nama_paket', 'like', "%{$search}%");
            })
            ->select(
                'pakets.id as id',
                'nama_paket',
                'harga',
                'harga_diskon',
                'diskon',
                'jenis',
                'outlets.nama as outlet',
            )
            ->orderBy('id', 'desc')
            ->paginate(25);

        if ($search) {
            $pakets->appends(['search' => $search]);
        }

        $jenis = [
            'kiloan' => 'Kiloan',
            'kaos' => 'T-Shirt/Kaos',
            'bed_cover' => 'Bed Cover',
            'selimut' => 'Selimut',
            'lain' => 'Lainnya',
        ];

        $pakets->map(function ($row) use ($jenis) {
            $row->jenis        = $jenis[$row->jenis];
            $row->harga        = number_format($row->harga, 0, ',', '.');
            $row->harga_diskon = number_format($row->harga_diskon, 0, ',', '.');
            return $row;
        });

        return view('paket.index', [
            'pakets' => $pakets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets = Outlet::select('id as value', 'nama as option')->get();

        return view('paket.create', [
            'outlets' => $outlets
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|max:100',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'jenis' => 'required|in:kiloan,bed_cover,kaos,selimut,lain',
            'outlet_id' => 'required|exists:outlets,id',
        ], [], [
                'outlet_id' => 'Outlet'
            ]);

        $harga        = $request->harga;
        $diskon       = $request->diskon;
        $harga_diskon = $harga * (100 - $diskon) / 100;

        Paket::create([
            'nama_paket' => $request->nama_paket,
            'harga' => $harga,
            'diskon' => $diskon,
            'harga_diskon' => $harga_diskon,
            'jenis' => $request->jenis,
            'outlet_id' => $request->outlet_id,
        ]);
        LogActivity::add('menambah Paket');

        return redirect()->route('paket.index')
            ->with('message', 'success store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(Paket $paket)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        $outlets = Outlet::select('id as value', 'nama as option')->get();

        return view('paket.edit', [
            'paket' => $paket,
            'outlets' => $outlets
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        $request->validate([
            'nama_paket' => 'required|max:100',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'jenis' => 'required|in:kiloan,bed_cover,kaos,selimut,lain',
            'outlet_id' => 'required|exists:outlets,id',
        ], [], [
                'outlet_id' => 'Outlet'
            ]);

        $harga        = $request->harga;
        $diskon       = $request->diskon;
        $harga_diskon = $harga * (100 - $diskon) / 100;

        $paket->update([
            'nama_paket' => $request->nama_paket,
            'harga' => $harga,
            'diskon' => $diskon,
            'harga_diskon' => $harga_diskon,
            'jenis' => $request->jenis,
            'outlet_id' => $request->outlet_id,
        ]);
        LogActivity::add('mengupdate Paket');

        return redirect()->route('paket.index')
            ->with('message', 'success store');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();
        LogActivity::add('menghapus Paket');

        return back()->with('message', 'success delete');
    }
}