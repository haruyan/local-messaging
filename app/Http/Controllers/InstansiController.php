<?php

namespace App\Http\Controllers;

use App\Traits\Sample;
use App\Models\{Instansi};
use Illuminate\Http\Request;

class InstansiController extends Controller
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
            $instances = Instansi::all();
            return view('admin.instansi.index', compact('menu', 'notification', 'instances'));
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
        Instansi::create($request->all());
        return redirect()->route('instansi.index');
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
            $instance = Instansi::findOrFail($id);
            return view('admin.instansi.edit', compact('menu', 'notification', 'instances'));
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
        $instansi = Instansi::findOrFail($id);
        $instansi->update($request->all());
        return redirect('instansi');
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
            $instance = Instansi::findOrFail($id);
            $instance->delete();
            return redirect()->route('instansi.index');
        }
        return view('error');
    }
}
