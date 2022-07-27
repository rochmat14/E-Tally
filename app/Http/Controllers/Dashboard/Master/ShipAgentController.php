<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ShipAgent;

class ShipAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $controller = 'ship_agent';
    private $title = 'Shiagent Data';

    public function index()
    {
        //
        $ship_agent = ShipAgent::select('id', 'nama_perusahaan', 'telp', 'alamat', 'email')->orderBy("id", "Desc")->get();

        $controller = $this->controller;

        $title = $this->controller;

        return view ('backend.ship_agent.index', compact('ship_agent','controller', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $controller = $this->controller;

        $title = $this->controller;

        return view('backend.ship_agent.create', compact('controller', 'title'));
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
        $telp = $request->get('telp');
        $alamat = $request->get('alamat');
        $email = $request->get('email');
        
        $data = new ShipAgent;

        $data->nama_perusahaan = $nama_perusahaan;
        $data->telp = $telp;
        $data->alamat = $alamat;
        $data->email = $email;

        $data->save();

        return redirect('/dashboard/ship-agent');
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
        $ship_agent = ShipAgent::all();

        $controller = $this->controller;

        $title = $this->controller;
        
        $ship_agent = ShipAgent::find($id);

        return view('backend.ship_agent.edit', compact('ship_agent', 'controller', 'title'));
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
        $nama_perusahaan = $request->get('nama_perusahaan');
        $telp = $request->get('telp');
        $alamat = $request->get('alamat');
        $email = $request->get('email');
        
        $data = ShipAgent::find($id);

        $data->nama_perusahaan = $nama_perusahaan;
        $data->telp = $telp;
        $data->alamat = $alamat;
        $data->email = $email;

        $data->save();

        return redirect('/dashboard/ship-agent');
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
        ShipAgent::find($id)->delete();

        return redirect('/dashboard/ship-agent');
    }
}
