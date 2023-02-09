<?php

namespace App\Http\Controllers;

use App\Models\Alumna;
use Illuminate\Http\Request;

/**
 * Class AlumnaController
 * @package App\Http\Controllers
 */
class AlumnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:ver-alumna|crear-alumna|editar-alumna|borrar-alumna')->only('index');
         $this->middleware('permission:crear-alumna', ['only' => ['create','store']]);
         $this->middleware('permission:editar-alumna', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-alumna', ['only' => ['destroy']]);
    }
    public function index()
    {
        $alumnas = Alumna::paginate();

        return view('alumna.index', compact('alumnas'))
            ->with('i', (request()->input('page', 1) - 1) * $alumnas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'dni' => 'required',
            'fechaNacimiento' => 'required',
            'Apellidos' => 'required',
            'Nombres' => 'required',
        ]);

        Alumna::create($request->all());

        return redirect()->route('alumnas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumna = Alumna::find($id);

        return view('alumna.show', compact('alumna'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumna $alumna)
    {
        return view('alumna.edit', compact('alumna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Alumna $alumna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumna $alumna)
    {
        request()->validate([
            'dni' => 'required',
            'fechaNacimiento' => 'required',
            'Apellidos' => 'required',
            'Nombres' => 'required',
        ]);


        $alumna->update($request->all());

        return redirect()->route('alumnas.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $alumna = Alumna::find($id)->delete();

        return redirect()->route('alumnas.index');
    }
}
