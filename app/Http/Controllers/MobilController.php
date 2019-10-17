<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mobil\Store;
use App\Mobil;
use Illuminate\Support\Facades\DB;

class MobilController extends Controller
{
    public function index()
    {
        $items = Mobil::all(['nama', 'harga']);

        return view('mobil.index', compact('items'));
    }

    public function create()
    {
        $items = Mobil::orderBy('posisi')->get(['id', 'nama', 'harga']);

        return view('mobil.create', compact('items'));
    }

    public function store(Store $request)
    {
        $data = $request->get('data');

        DB::transaction(function () use ($data) {
            $ids = collect($data)->pluck('id');
            if (!empty($ids)) {
                Mobil::whereNotIn('id', $ids)->delete();
            }

            foreach ($data as $row) {
                if ($row['id']) {
                    Mobil::whereId($row['id'])->update($row);
                } else {
                    Mobil::create($row);
                }
            }
        });

        if ($request->expectsJson()) {
            sleep(1);
            $items = Mobil::orderBy('posisi')
                ->get(['id', 'nama', 'harga'])
                ->transform(function ($item) {
                    return array_values($item->toArray());
                });

            return response()->json($items);
        }

        return redirect()->back()->withSuccess(sprintf("Berhasil menyimpan %d data mobil", count($data)));
    }
}
