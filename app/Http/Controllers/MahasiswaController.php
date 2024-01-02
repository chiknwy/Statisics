<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mahasiswa;

class MahasiswaController extends Controller
{
    //READ
    public function create (){
        return view("user.create");
    }
    public function update($id)
{
    $mahasiswa = Mahasiswa::find($id);
    return view('user.update', ['mahasiswa' => $mahasiswa]);
}
    public function index (){
        $mahasiswa = mahasiswa::all();
        return view("user.index", ['mahasiswa' => $mahasiswa] );
    }

    //DELETE
    public function destroy($id)
    {
    $mahasiswa = Mahasiswa::findOrFail($id);
    $mahasiswa->delete();

    return redirect()->route('user.index')->with('success', 'Mahasiswa deleted successfully');
    }

    //UPDATEskor
    public function updateMahasiswa(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->skor1 = $request->skor1;
        $mahasiswa->skor2 = $request->skor2;
        $mahasiswa->skor3 = $request->skor3;
        $mahasiswa->skor4 = $request->skor4;
        $mahasiswa->skor5 = $request->skor5;
        $mahasiswa->skor6 = $request->skor6;
        $mahasiswa->skor7 = $request->skor7;
        $mahasiswa->skor8 = $request->skor8;
        $mahasiswa->skor9 = $request->skor9;
        $mahasiswa->skor10 = $request->skor10;
        $mahasiswa->save();

        return redirect()->route('user.index')->with('success', 'Mahasiswa updated successfully');
    }

    //CREATE
    public function store (Request $request) {
        $data = $request->validate([
            'skor1' => ['required', 'numeric'],
            'skor2' => ['required', 'numeric'],
            'skor3' => ['required', 'numeric'],
            'skor4' => ['required', 'numeric'],
            'skor5' => ['required', 'numeric'],
            'skor6' => ['required', 'numeric'],
            'skor7' => ['required', 'numeric'],
            'skor8' => ['required', 'numeric'],
            'skor9' => ['required', 'numeric'],
            'skor10' => ['required', 'numeric'],
        ]);

    mahasiswa::create($data);

        return redirect(route('user.index'))->with('success','');
    }

    
    
}