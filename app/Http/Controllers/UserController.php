<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(10);

        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'email'             => 'required|unique:users,email',
            'password'          => 'required',
            'password_confirm'  => 'required|same:password',
            'is_admin'          => 'nullable'
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $arrayData = array(
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'is_admin'  => $request->is_admin
        );

        $data = User::create($arrayData);

        return redirect()->route('user.index')->with('success','Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'email'             => 'required|unique:users,email,'.$user->id,
            'password'          => 'sometimes',
            'password_confirm'  => 'sometimes|same:password',
            'is_admin'          => 'nullable'
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        if($request->has('password'))
        {
            $arrayData = array(
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'is_admin'  => $request->is_admin
            );
    
            $user->update($arrayData); 
        } else {

            $arrayData = array(
                'name'      => $request->name,
                'email'     => $request->email,
                'is_admin'  => $request->is_admin
            );

            $user->update($arrayData);
        }

        return redirect()->route('user.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('error','Data Berhasil di Hapus!');
    }
}
