<?php

namespace App\Http\Controllers;

use App\Traits\Sample;
use App\Models\Instansi;
use App\Models\TipeSurat;
use Illuminate\Http\Request;

class TypeSuratController extends Controller
{
    use Sample;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        if(Auth()->User()->role == 'admin')
        {
            $menu = $this->printThis()['menu'];
            $notification = $this->printThis()['data'];
            $tipe = TipeSurat::with('instansi')->get();
            $instansi = Instansi::all();
            return view('admin.type-surat.index', compact('menu', 'notification', 'tipe', 'instansi'));
        }
        return view('error');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama'  =>  'required',
            'instansi_id'  =>  'required|exists:instansi,id',
            'icon'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $fileName = str_replace("=","",base64_encode($request->nama)) . '.' . request()->icon->getClientOriginalExtension();
        
        if(!$request->icon->move(storage_path('app/public/icon'), $fileName)){
            return array('error' => 'Gagal upload icon');
        } else {
            $tipe = new TipeSurat();
            $tipe->nama = $request->nama;
            $tipe->instansi_id = $request->instansi_id;
            $tipe->icon = "storage/icon/".$fileName;
            $tipe->save();
        }

        return redirect()->route('tipe-surat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth()->User()->role == 'admin')
        {
            $menu = $this->printThis()['menu'];
            $notification = $this->printThis()['data'];
            $tipe = TipeSurat::findOrFail($id);
            $instansi = Instansi::all();
            return view('admin.type-surat.edit', compact('menu', 'notification', 'tipe', 'instansi'));
        }
        return view('error');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipeicon = TipeSurat::where("id","=",$id)->get()->first()->icon;

        if (!$request->icon) {
            $request->validate([
                'nama'      =>  'required',
                'instansi_id'  =>  'required|exists:instansi,id',
            ]);
        } else {
            $request->validate([
                'nama'  =>  'required',
                'instansi_id'  =>  'required|exists:instansi,id',
                'icon'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $fileName = str_replace("=","",base64_encode($request->nama.time())) . '.' . request()->icon->getClientOriginalExtension();
        }

        $tipe = TipeSurat::findOrFail($id);
        $tipe->nama = $request->nama;
        $tipe->instansi_id = $request->instansi_id;
        if($request->hasFile('icon')){ 
            if (is_file($tipe->icon)) {
                try {
                    unlink($tipeicon);
                } catch(\Exception $e) {
                    
                }
                $request->icon->move(storage_path('app/public/icon'), $fileName);
                $tipe->icon = "storage/icon/".$fileName;
            }
        }else {
            $tipe->icon = $tipeicon;
        }
        $tipe->save();

        return redirect('tipe-surat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth()->User()->role == 'admin')
        {
            $tipe = TipeSurat::findOrFail($id);
            if (is_file($tipe->icon)) {
                unlink($tipe->icon);
            }
            $tipe->delete();
            return redirect()->route('tipe-surat.index');
        }
        return view('error');
    }
}
