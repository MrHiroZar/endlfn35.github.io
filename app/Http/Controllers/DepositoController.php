<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Deposito;

class DepositoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-deposito|crear-deposito|editar-deposito|borrar-deposito')->only('index');
         $this->middleware('permission:crear-deposito', ['only' => ['create','store']]);
         $this->middleware('permission:editar-deposito', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-deposito', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depositos = Deposito::paginate(5);
         return view('depositos.index',compact('depositos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('depositos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'fecha' => 'required',
            'ejecutante' => 'required',
            'DNI' => 'required',
            'monto' => 'required',
        ]);

        Deposito::create($request->all());

        return redirect()->route('depositos.index');
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
    public function edit(Deposito $deposito)
    {
        return view('depositos.editar',compact('deposito'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposito $deposito)
    {
        request()->validate([
            'fecha' => 'required',
            'ejecutante' => 'required',
            'DNI' => 'required',
            'monto' => 'required',
        ]);

        $deposito->update($request->all());

        return redirect()->route('depositos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposito $deposito)
    {
        $deposito->delete();

        return redirect()->route('depositos.index');
    }
}
