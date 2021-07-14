<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExercicioRequest;
use App\Http\Requests\UpdateExercicioRequest;
use App\Models\Exercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ExercicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('exercicio_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exercicios = Exercicio::all();

        return view('exercicios.index', compact('exercicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('exercicio_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('exercicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExercicioRequest $request)
    {
        Exercicio::create($request->validated());

        return redirect()->route('exercicios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exercicio $exercicio)
    {
        abort_if(Gate::denies('exercicio_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('exercicios.show', compact('exercicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercicio $exercicio)
    {
        abort_if(Gate::denies('exercicio_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('exercicios.edit', compact('exercicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExercicioRequest $request, Exercicio $exercicio)
    {
        $exercicio->update($request->validated());

        return redirect()->route('exercicios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercicio $exercicio)
    {
        abort_if(Gate::denies('exercicio_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exercicio->delete();

        return redirect()->route('exercicios.index');

    }
}
