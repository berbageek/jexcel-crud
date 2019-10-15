<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mobil\Store;
use App\Mobil;

class MobilController extends Controller
{
    public function index()
    {
        $items = Mobil::all(['nama', 'harga']);

        return view('mobil.index', compact('items'));
    }

    public function create()
    {
        return view('mobil.create');
    }

    public function store(Store $request)
    {
        $data = $request->get('data');
        $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);

        foreach ($data as $row) {
            $mobil = new Mobil();
            $mobil->nama = $row[0];
            $mobil->harga = $formatter->parseCurrency($row[1], $curr);
            $mobil->save();
        }

        return redirect()->back()->withSuccess(sprintf("Berhasil menyimpan %d data mobil", count($data)));
    }
}
