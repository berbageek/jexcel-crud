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

        foreach ($data as $row) {
            Mobil::create($row);
        }

        return redirect()->back()->withSuccess(sprintf("Berhasil menyimpan %d data mobil", count($data)));
    }
}
