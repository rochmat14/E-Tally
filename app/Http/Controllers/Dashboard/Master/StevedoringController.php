<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use App\Model\Stevedoring;
use Illuminate\Http\Request;

class StevedoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $controller = 'stevendoring';
    private $title = 'Stevendoring';

    public function index()
    {
        //
        $controller = $this->controller;

        $title = $this->title;
        
        $stevedoring = Stevedoring::all();

        return view ('backend.stevedoring.index', compact('stevedoring', 'controller', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $controller = $this->controller;

        $title = $this->controller;
        

        return view('backend.stevedoring.create', compact('controller', 'title'));
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
        $nama_perusahaan = $request->nama_perusahaan;
        $telp = $request->telp;
        $alamat = $request->alamat;
        $email = $request->email;
        
        $data = new Stevedoring;

        $data->nama_perusahaan = $nama_perusahaan;
        $data->telp = $telp;
        $data->alamat = $alamat;
        $data->email = $email;
        $data->status = 1;

        $data->save();

        return redirect('/dashboard/stevedoring');
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
        $controller = $this->controller;

        $title = $this->controller;
        
        $stevedoring = Stevedoring::find($id);

        // menampilkan view yaitu file edit pada folder admin
        return view('backend.stevedoring.edit', compact('stevedoring', 'controller', 'title'));
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
        
        $nama_perusahaan = $request->nama_perusahaan;
        $telp = $request->telp;
        $alamat = $request->alamat;
        $email = $request->email;
        
        $data = Stevedoring::find($id);

        $data->nama_perusahaan = $nama_perusahaan;
        $data->telp = $telp;
        $data->alamat = $alamat;
        $data->email = $email;

        $data->save();

        return redirect('/dashboard/stevedoring');
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

        $data = Stevedoring::find($id);

        $data->status = 0;

        $data->save();

        return redirect('/dashboard/stevedoring');
    }
}
