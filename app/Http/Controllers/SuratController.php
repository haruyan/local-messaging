<?php

namespace App\Http\Controllers;

use App\Traits\Sample;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Surat;
use App\Models\Instansi;
use App\Models\TipeSurat;
use App\Models\Penerima;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    use Sample;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $menu = $this->printThis();
        // $user = Auth()->User();
        // $letter = Surat::with('penerima', 'penerima.instansi')->get();
        // $instances = Instansi::all();
        // $types = TipeSurat::all();
        // return view('surat.index', compact('letter', 'instances', 'types', 'menu'));
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function save(Request $request, $id)
    {
        $request->validate([
            'nomor_surat'  =>  'required',
            'tanggal_surat'  =>  'required',
            'penerima_id'  =>  'required|exists:instansi,id',
            'body'  =>  'required|file|mimes:pdf,doc,docx',
        ]);
        
        $tipesurat_id = $id;
        $fileName = str_replace("=","",base64_encode($request->nomor_surat)) . '.' . request()->body->getClientOriginalExtension();
        
        if(!$request->body->move(storage_path('app/public/surat'), $fileName)){
            return array('error' => 'Gagal upload file');
        } else {
            $surat = new Surat();
            $surat->pengirim_id = Auth()->User()->instansi_id;
            $surat->type_surat_id = $tipesurat_id;
            $surat->nomor_surat = $request->nomor_surat;
            $surat->tanggal_surat = $request->tanggal_surat;
            $surat->body = "storage/surat/".$fileName;
            $surat->save();

            $instansi = $request->get('penerima_id');
            $selected_instansi = [];
            
            foreach($instansi as $item){
                $selected_instansi[]=[
                    'surat_id' => $surat->id,
                    'penerima_id' => $item,
                    'status' => 'terkirim'
                ];
            }
            Penerima::insert($selected_instansi);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pass_id = $id;
        $menu = $this->printThis()['menu'];
        $notification = $this->printThis()['data'];
        $user = Auth()->User();
        $tipeSurat = TipeSurat::where("id","=",$pass_id)->get()->first();
        $letter = Surat::with('tipesurat', 'penerima.instansi')
            ->where("type_surat_id","=",$pass_id)
            ->orderBy('updated_at','desc')
            ->get();
        $instances = Instansi::all();
        
        $accessed = TipeSurat::where('id', $pass_id)->get()->first()->instansi_id;
        $accessor = $user->instansi_id;
        if($accessed == $accessor){
            return view('surat.show', compact('pass_id', 'menu', 'notification', 'user', 'tipeSurat', 'letter', 'instances'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function detail($id)
    {
        $current = Auth()->user()->instansi_id;
        $menu = $this->printThis()['menu'];
        $notification = $this->printThis()['data'];
        $letter = Surat::with('pengirim', 'tipesurat', 'penerima.instansi')->where("id","=",$id)->get()->first();
        // return response()->json($letter->penerima);

        if($current != $letter->pengirim_id){
            $isPenerima = false;
            foreach ($letter->penerima as $p => $penerima) {
                if($penerima->penerima_id != $current){
                    $isPenerima = false;
                }
                else if($penerima->penerima_id == $current){
                    $isPenerima = true;
                    // dd($penerima->penerima_id);
                    break;
                }
            } 
            if($isPenerima){
                $status = Penerima::where('surat_id', $letter->id)->update(['status'=>'terbaca']);     
            }else{
                return redirect()->route('dashboard');
            }
            // if ($letter->pengirim_id != $current){//dia penerima
            //     // dd('terbaca');
            //     $status = Penerima::where('surat_id', $letter->id)->update(['status'=>'terbaca']);
            // }
        } 
        // else if($current == )
        


        $extend = explode('.', $letter->body);
        $extension = $extend[sizeof($extend)-1];
    	return view('surat.detail', compact('menu', 'notification','letter', 'extension'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = $this->printThis()['menu'];
        $notification = $this->printThis()['data'];
        $surat = Surat::with('pengirim', 'tipesurat', 'penerima.instansi')
            ->where('id', $id)
            ->get()
            ->first();
        if($surat->penerima[0]->status != "terkirim"){
            return redirect()->route('dashboard');
        }
        $saved_instansi = [];
        foreach($surat->penerima as $p){
            $saved_instansi[]=$p->instansi->id;
        }
        
        $instances = Instansi::all();
        return view('surat.edit', compact('menu', 'notification', 'surat', 'saved_instansi', 'instances'));
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
        $datasurat = Surat::where('id','=', $id)->get()->first();
        
        if (!$request->body) {
            $request->validate([
                'nomor_surat'  =>  'required',
                'tanggal_surat'  =>  'required',
                'penerima_id'  =>  'required|exists:instansi,id',
            ]);
        } else {
            $request->validate([
                'nomor_surat'  =>  'required',
                'tanggal_surat'  =>  'required',
                'penerima_id'  =>  'required|exists:instansi,id',
                'body'  =>  'file|mimes:pdf,doc,docx',
            ]);
            $fileName = str_replace("=","",base64_encode($request->nomor_surat.time())) . '.' . request()->body->getClientOriginalExtension();
        }
        
        $surat = Surat::findOrFail($id);
        $surat->pengirim_id = Auth()->User()->instansi_id;
        $surat->type_surat_id = $datasurat->type_surat_id;
        $surat->nomor_surat = $request->nomor_surat;
        $surat->tanggal_surat = $request->tanggal_surat;
        if($request->hasFile('body')){ 
            if (is_file($surat->body)) {
                try {
                    unlink($datasurat->body);
                } catch(\Exception $e) {
                    
                }
                $request->body->move(storage_path('app/public/surat'), $fileName);
                $surat->body = "storage/surat/".$fileName;
            }
        }else {
            $surat->body = $datasurat->body;
        }
        $surat->save();
        
        $penerima = Penerima::where('surat_id','=',$surat->id)->delete();
        // $penerima = Penerima::where('surat_id',$surat->id)->get()->delete();
        $instansi = $request->get('penerima_id');
        $selected_instansi = [];
        foreach($instansi as $item){
            $selected_instansi[]=[
                'surat_id' => $surat->id,
                'penerima_id' => $item,
                'status' => 'terkirim'
            ];
        }
        Penerima::insert($selected_instansi);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $myFile = $surat->body;
        if (is_file($myFile)) {
            unlink($myFile);
        }
        $surat->delete();
        return back();
        // return redirect()->route('surat.index');
    }

}
