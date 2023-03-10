<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
// use App\Helper\ImageUrl;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $users = User::join('outlets', 'outlets.id', 'users.outlet_id')
            ->when($search, function ($query, $search) {
                return $query->where('users.nama', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            })
            ->select(
                'users.id as id',
                'users.nama as nama',
                'username',
                // 'foto',
                'role',
                'outlets.nama as outlet',
            )
            ->orderBy('id','desc')
            ->paginate(25);

        // $users->map(function ($row)
        // {
        //     $row->foto = asset("img/{$row->foto}");
        // });

        if ($search) {
            $users->appends(['search' => $search]);
        }

        return view('user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets = Outlet::select('id as value', 'nama as option')->get();

        return view('user.create', [
            'outlets' => $outlets
        ]);
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
            'nama'=>'required|between:3,50',
            'username'=>'required|alpha_dash|between:3,50|unique:users',
            'foto'=>'nullable|image|mimes:png,jpg,jpeg|dimensions:min_width=200,min_height=200',
            'role'=>'required|in:admin,kasir,owner',
            'outlet_id'=>'required|exists:outlets,id',
            'password'=>'required|between:8,50|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{4,}$/|confirmed',
        ], [], [
            'outlet_id' => 'Outlet'
        ]);

        // $folder = 'img';
        // if (!file_exists($folder)) {
        //     mkdir($folder, 0777, true);
        // }
        // $file = $request->file('foto');
        // $ext = $file->getClientOriginalExtension();
        // $filename = date('Ymdhis').'.'.$ext;
        // $img = Image::make($file);
        // $img->fit(300,300);
        // $img->save($folder.'/'.$filename);

        $request->merge([
            'password'=>bcrypt($request->password),
            // 'foto'=>$filename,
        ]);

        User::create($request->all());
        LogActivity::add('menambah User');


        return redirect()->route('user.index')
            ->with('message', 'success store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // $user->foto = asset("img/{$user->foto}");

        $outlets = Outlet::select('id as value', 'nama as option')->get();

        return view('user.edit', [
            'user'=>$user,
            'outlets' => $outlets
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama'=>'required|between:3,50',
            'username'=>'required|alpha_dash|between:3,50|unique:users,username,'.$user->id,
            'foto'=>'nullable|image|mimes:png,jpg,jpeg|dimensions:min_width=200,min_height=200',
            'role'=>'required|in:admin,kasir,owner',
            'outlet_id'=>'required|exists:outlets,id',
            'password'=>'nullable|between:8,50|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{4,}$/|confirmed',
        ], [], [
            'outlet_id' => 'Outlet'
        ]);

        // if ($request->foto) {
        //     $folder = 'img';
        //     $foto_lama = "{$folder}/{$user->foto}";

        //     if (file_exists($foto_lama)) {
        //         unlink($foto_lama);
        //     }

        //     $file = $request->file('foto');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = date('Ymdhis').'.'.$ext;
        //     $img = Image::make($file);
        //     $img->fit(300,200);
        //     $img->save($folder.'/'.$filename);

        //     $request->merge([
        //         'foto'=>$filename,
        //     ]);
        // }

        if($request->password) {
            $request->merge([
                'password' => bcrypt($request->password),
            ]);
            $user->update($request->all());
        } else {
            $user->update($request->except('password'));
        }

        LogActivity::add('mengupdate User');


        return redirect()->route('user.index')
            ->with('message', 'success update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // if ( $user->foto ){
        //     $file = 'img/'.$user->foto;
            
        //     if (file_exists($file)) {
        //         unlink($file);
        //     }
        // }

        $user->delete();
        LogActivity::add('menghapus User');

        return back()->with('message', 'success delete');
    }
}
