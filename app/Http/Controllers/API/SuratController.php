<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\TipeSurat;
use App\Models\Penerima;
use App\Http\Controllers\Controller;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "ok";
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
        $inboxUnread = Penerima::with('surat.pengirim')
            ->where([
                        ['penerima_id', $id],
                        ['status', 'terkirim']
                    ])
            ->get();
        $allInbox = Penerima::with('surat.pengirim')
                        ->where('penerima_id', $id  )
                        ->orderBy('id', 'DESC')
                        ->get();

        $data = array(
            'unread' => $inboxUnread,
            'all' => $allInbox,
        );
        return response()->json($data);
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

    public function scrolling($id = 0, $limit = 10, $offset = 0)
    {
        $surat = Penerima::with('surat.pengirim')
            ->where('penerima_id', $id  )
            ->orderBy('id', 'DESC')
            ->take($limit)
            ->skip($offset)
            ->get();
        
        return response()->json($surat);
    }
}
