<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use App\Model\Vassel;
use Illuminate\Http\Request;

class VasselController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $controller = 'vassel';
    private $title = 'Vassel';

    
    public function index()
    {
        $controller = $this->controller;

        $title = $this->controller;
        
        $vassel = Vassel::all();

        return view ('backend.vassel.index', compact('vassel', 'controller', 'title'));
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

        return view('backend.vassel.create', compact('controller', 'title'));
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
        $nama_kapal = $request->nama_kapal;
        $gt = $request->gt;
        $loa = $request->loa;
        
        if($request->hasFile('photo')) {
            
            $file      = $request->file('photo');
            $filenameOri  = $file->getClientOriginalName();
            $picture   = 'images/vassel/' . date('His') . '-' . $filenameOri;
            $filename   = date('His') . '-' . $filenameOri;
            $file->move(public_path('images/vassel/'), $picture);

            $data = new Vassel;

            $data->nama_kapal = $nama_kapal;
            $data->gt = $gt;
            $data->loa = $loa;
            $data->photo = $filename;
            $data->status = 1;
    
            $data->save();
        } else {
            $data = new Vassel;

            $data->nama_kapal = $nama_kapal;
            $data->gt = $gt;
            $data->loa = $loa;

            $data->save();
        }

        return redirect('/dashboard/vassel');
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
        
        $vassel = Vassel::find($id);

        // menampilkan view yaitu file edit pada folder admin
        return view('backend.vassel.edit', compact('vassel', 'controller', 'title'));
        // return $vassel;

        // $Vassel = Vassel::find($id);
        // return response()->json($Vassel);
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
        $nama_kapal = $request->nama_kapal;
        $gt = $request->gt;
        $loa = $request->loa;
        
        if($request->hasFile('photo')) {
            
            $file      = $request->file('photo');
            $filenameOri  = $file->getClientOriginalName();
            $picture   = 'images/vassel/' . date('His') . '-' . $filenameOri;
            $filename   = date('His') . '-' . $filenameOri;
            $file->move(public_path('images/vassel/'), $picture);

            $data = Vassel::find($id);

            $data->nama_kapal = $nama_kapal;
            $data->gt = $gt;
            $data->loa = $loa;
            $data->photo = $filename;
    
            $data->save();

            $checkFile =  public_path().'/images/vassel/'.$request->photo_value;

            if(file_exists($checkFile)) {

                @unlink($checkFile);

            } else {
                return "kosong";
            }
        } else {
            $data = Vassel::find($id);

            $data->nama_kapal = $nama_kapal;
            $data->gt = $gt;
            $data->loa = $loa;

            $data->save();
        }

        return redirect('/dashboard/vassel');
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
        $data = Vassel::find($id);

        $data->status = 0;

        $data->save();

        return redirect('/dashboard/vassel');
        
    }
}
