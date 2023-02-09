<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Madre;

class MadreController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-madre|crear-madre|editar-madre|borrar-madre')->only('index');
         $this->middleware('permission:crear-madre', ['only' => ['create','store']]);
         $this->middleware('permission:editar-madre', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-madre', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $madres = Madre::paginate(5);
         return view('madre.index',compact('madres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('madre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(str_contains($request, '?') == true){
            $madres = Madre::paginate(5);
            return view('madre.index',compact('madres'));
        }else{
            request()->validate([
                'dni' => 'required',
                'Apellidos' => 'required',
                'Nombres' => 'required',
            ]);

            Madre::create($request->all());

            return redirect()->route('madres.index');

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
    public function edit(Madre $madre)
    {
        return view('madres.editar',compact('madre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Madre $madre)
    {
        request()->validate([
            'dni' => 'required',
            'Apellidos' => 'required',
            'Nombres' => 'required',
        ]);

        $madre->update($request->all());

        return redirect()->route('madres.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Madre $madre)
    {
        $madre->delete();

        return redirect()->route('madres.index');
    }
}
