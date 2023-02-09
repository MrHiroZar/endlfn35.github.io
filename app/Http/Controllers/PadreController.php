<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Padre;

class PadreController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-padre|crear-padre|editar-padre|borrar-padre')->only('index');
         $this->middleware('permission:crear-padre', ['only' => ['create','store']]);
         $this->middleware('permission:editar-padre', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-padre', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $padres = Padre::paginate(5);
         return view('padres.index',compact('padres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('padres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request == null){
            return redirect()->route('padres.index');
        }else{
        Padre::create($request->all());

        return redirect()->route('padres.index');
        }
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
    public function edit(Padre $padre)
    {
        return view('padres.editar',compact('padre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Padre $padre)
    {
        request()->validate([
            'dni' => 'required',
            'Apellidos' => 'required',
            'Nombres' => 'required',
        ]);

        $padre->update($request->all());

        return redirect()->route('padres.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Padre $padre)
    {
        $padre->delete();

        return redirect()->route('padres.index');
    }
}
