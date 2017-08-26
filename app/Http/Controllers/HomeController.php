<?php

namespace App\Http\Controllers;

use App\Daftar;
use App\Produk;
use App\Supplier;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        $produk = Daftar::where('nama_produk', '<>', 'null')->get();
        $data['supplier'] = $supplier;
        $data['produk'] = $produk;

        return view('home', $data);
    }

    public function getAllSupplier()
    {
        $supplier = Supplier::all();

        return response()->json($supplier);
    }

    public function getProduk($name) {
        $supplier = Produk::where('supplier', $name)->get();

        return response()->json($supplier);
    }

    public function addList(Request $request)
    {
        $add = new Daftar();
        $add->supplier = null;
        $add->nama_produk = null;
        $add->harga = null;
        $add->save();

        return response()->json($add);
    }

    public function editList($id)
    {
        $edit = Daftar::find($id);

        return response()->json($edit);
    }

    public function updateList(Request $request, $id)
    {
        $update = Daftar::find($id);
        $update->supplier = $request->supplier;
        $update->nama_produk = $request->nama;
        $update->harga = $request->harga;
        $update->save();

        return response()->json($update);
    }

    public function deleteList($id)
    {
        $delete = Daftar::find($id);
        $delete->delete();

        return response()->json($delete);
    }
}
