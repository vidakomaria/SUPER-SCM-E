<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AkunSupplierController extends Controller
{
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
        $user = User::where('id',$id)->first();
        return view('suppliers.akun.show',[
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        return view('suppliers.akun.edit',[
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id',$id)->first();
        $rules =[
            'nama'      => 'required',
            'email'      => 'required',
            'tmptLahir' => 'required',
            'tglLahir'  => 'required',
            'noTelp'    => 'required',
            'alamat'    => 'required',
            'username'  => 'required',
            'password'  => 'required',
        ];
//
        if ($request->username != $user->username){
            $rules['username']= 'required|unique:users';
        };
        if ($request->email != $user->email){
            $rules['email']= 'required|email:rfc|unique:users';
        };

        $validatedData = $request->validate($rules);
        $no = Str::of($request->noTelp)->remove(0);
        dd($no);
        $validatedData['noTelp']    = "+62" . $request->noTelp;
        $validatedData['password'] = bcrypt($request->password);


        User::where('id',$id)
            ->update($validatedData);

        return redirect('/supplier/akun/' . auth()->user()->id)->with('success','Profil berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
