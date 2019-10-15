<?php

namespace App\Http\Controllers;

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

    public function store()
    {

    }
}
