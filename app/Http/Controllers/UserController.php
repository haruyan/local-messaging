<?php

namespace App\Http\Controllers;

use App\Traits\Sample;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Instansi;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
            $users = User::with('instansi')->get();
            $instansi = Instansi::all();
            return view('admin.user.index',compact('menu', 'notification', 'users','instansi'));
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
            'email'  =>  'required|unique:users,email',
            'username'  =>  'required|unique:users,username',
            'role'  =>  'required',
            'no_hp'  =>  'required',
            'instansi'  =>  'required|exists:instansi,id',
            'password'  =>  'required|confirmed',
            'profile_pict'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $fileName = str_replace("=","",base64_encode($request->nama)) . '.' . request()->profile_pict->getClientOriginalExtension();

        if(!$request->profile_pict->move(storage_path('app/public/profile'), $fileName)){
            return array('error' => 'Gagal upload foto');
        } else {
            $user = new User();
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->instansi_id  = $request->instansi;
            $user->no_hp  = $request->no_hp;
            $user->role = $request->role;
            $user->profile_pict = "storage/profile/".$fileName;;
            $user->save();
        }
        

        return response()->json($user);
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

    public function profile()
    {
        if(Auth()->User()->role != 'admin')
        {
            $menu = $this->printThis()['menu'];
            $notification = $this->printThis()['data'];
            $user = User::with('instansi')->where('id',Auth()->user()->id)->get()->first();
            return view('admin.user.profile',compact('menu', 'notification', 'user'));
        }
        return redirect(route('dashboard'));
        
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
            $user = User::findOrFail($id);
            $instansi = Instansi::all();

            return view('admin.user.edit',compact('menu', 'notification', 'user','instansi'));
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
        $userPict = User::where("id","=",$id)->get()->first()->profile_pict;
        // return response()->json($userPict);

        if(Auth()->user()->role == 'admin'){
            if (!$request->profile_pict) {
                $request->validate([
                    'nama'      =>  'required',
                    'email'     =>  'required|unique:users,email,'.$id,
                    'username'  =>  'required|unique:users,username,'.$id,
                    'role'      =>  'required',
                    'no_hp'     =>  'required',
                    'instansi'  =>  'required|exists:instansi,id',
                    'password'  =>  'confirmed',
                ]);
            } else {
                $request->validate([
                    'nama'      =>  'required',
                    'email'     =>  'required|unique:users,email,'.$id,
                    'username'  =>  'required|unique:users,username,'.$id,
                    'role'      =>  'required',
                    'no_hp'     =>  'required',
                    'instansi'  =>  'required|exists:instansi,id',
                    'password'  =>  'confirmed',
                    'profile_pict'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $fileName = str_replace("=","",base64_encode($request->nama.time())) . '.' . request()->profile_pict->getClientOriginalExtension();
            }
    
            // return response()->json($userPict);
    
            $user = User::findOrFail($id);
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->instansi_id  = $request->instansi;
            $user->no_hp  = $request->no_hp;
            $user->role = $request->role;
            if($request->password) $user->password = bcrypt($request->password);
            if($request->hasFile('profile_pict')){ 
                if (is_file($user->profile_pict)) {
                    try {
                        unlink($userPict);
                    } catch(\Exception $e) {
                        
                    }
                }
                $request->profile_pict->move(storage_path('app/public/profile'), $fileName);
                $user->profile_pict = "storage/profile/".$fileName;
            }else {
                $user->profile_pict = $userPict;
            }
            $user->save();
    
            return redirect(route('users.index'));
        } else {
            if (!$request->profile_pict) {
                $request->validate([
                    'nama'      =>  'required',
                    'email'     =>  'required|unique:users,email,'.$id,
                    'username'  =>  'required|unique:users,username,'.$id,
                    'no_hp'     =>  'required',
                    'password'  =>  'confirmed',
                ]);
            } else {
                $request->validate([
                    'nama'      =>  'required',
                    'email'     =>  'required|unique:users,email,'.$id,
                    'username'  =>  'required|unique:users,username,'.$id,
                    'no_hp'     =>  'required',
                    'password'  =>  'confirmed',
                    'profile_pict'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $fileName = str_replace("=","",base64_encode($request->nama.time())) . '.' . request()->profile_pict->getClientOriginalExtension();
            }
    
            // return response()->json($userPict);
    
            $user = User::findOrFail($id);
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->no_hp  = $request->no_hp;
            if($request->password) $user->password = bcrypt($request->password);
            if($request->hasFile('profile_pict')){ 
                if (is_file($user->profile_pict)) {
                    try {
                        unlink($userPict);
                    } catch(\Exception $e) {
                        
                    }
                }
                    $request->profile_pict->move(storage_path('app/public/profile'), $fileName);
                    $user->profile_pict = "storage/profile/".$fileName;
            }else {
                $user->profile_pict = $userPict;
            }
            $user->save();
    
            return redirect(route('users.profile'));
        }
        
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
            $user = User::findOrFail($id);
            if (is_file($user->profile_pict)) {
                unlink($user->profile_pict);
            }
            $user->delete();
            return redirect(route('users.index'));
        }
        return view('error');
    }
}
