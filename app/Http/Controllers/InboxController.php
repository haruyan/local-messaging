<?php

namespace App\Http\Controllers;

use App\Traits\Sample;
use App\Models\User;
use App\Models\Surat;
use App\Models\Instansi;
use App\Models\TipeSurat;
use App\Models\Penerima;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    use Sample;

    public function inbox()
    {
        $menu = $this->printThis()['menu'];
        $notification = $this->printThis()['data'];
        $inbox = Penerima::with('surat.pengirim', 'surat.tipesurat')
            ->where('penerima_id', Auth()->User()->instansi_id)
            ->orderBy('id', 'DESC')
            ->get();
    	return view('surat.inbox', compact('menu', 'notification', 'inbox'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
