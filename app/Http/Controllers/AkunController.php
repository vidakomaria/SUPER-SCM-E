<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('akun.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =[
            'nama'      => 'required',
            'email'     => 'required|email:rfc|unique:users',
            'tmptLahir' => 'required',
            'tglLahir'  => 'required',
            'noTelp'    => 'required',
            'alamat'    => 'required',
            'username'  => 'required|unique:users',
            'password'  => 'required',
            'role'      => 'required',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['noTelp'] = "+62" . $request->noTelp;
        $validatedData['password'] = bcrypt($request->password);

//        dd($validatedData);
        User::create($validatedData);

        return redirect('akun')->with('success','Akun berhasil dibuat');
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
        return view('akun.show',[
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        return view('akun.edit',[
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
//        $no = Str::of($request->noTelp)->remove(0);
//        $validatedData['noTelp']    =$request->noTelp;
        $validatedData['password'] = bcrypt($request->password);
//        dd($validatedData);
        User::where('id',$id)
            ->update($validatedData);

        return redirect('/supplier/akun/' . auth()->user()->id)->with('success','Profil berhasil diubah');
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
