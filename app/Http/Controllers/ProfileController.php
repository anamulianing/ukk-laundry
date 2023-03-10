<?php

namespace App\Http\Controllers;

use Auth;
// use App\Helper\ImageUrl;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        
        return view('profile.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        // $user->foto = ImageUrl::get('images/foto/',$user->foto);

        $request->validate([
            'nama' => 'required|between:3,100',
            'foto'=>'nullable|image|mimes:png,jpg,jpeg|dimensions:min_width=200,min_height=200',
            'password'=>'nullable|min:8|max:100|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{4,}$/|confirmed',
        ], [], [
                'nama_user' => 'Nama',
                // 'foto_user' => 'Foto'
            ]);

            // if ( $user->foto && $request->foto ){
            //     $file = '/images/foto/'.$user->foto;
    
            //     if (file_exists($file)) {
            //         unlink($file);
            //     }
            // }
    
            // if ($request->foto){
            //     $ext = $request->foto->getClientOriginalExtension();
            //     $filename = rand(9,999).'_'.time().'.'.$ext;
            //     $request->foto->move('/images/foto/',$filename);
            // }

        if ($request->password) {
            $request->merge([
                'password' => bcrypt($request->password),
            ]);
            $user->update($request->all());
        } else {
            $user->update($request->only('nama'));
        }

        LogActivity::add('mengubah Profile');

        return back()->with('message', 'success update');

    }
}
