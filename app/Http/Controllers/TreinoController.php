<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreinoRequest;
use App\Http\Requests\UpdateTreinoRequest;
use App\Models\Exercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Treino;
use Symfony\Component\HttpFoundation\Response;


class TreinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('treino_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $treinos = Treino::all();

        return view('treinos.index', compact('treinos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('treino_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('treinos.create', ['exercicios' => Exercicio::all(), ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreinoRequest $request)
    {
        $data = $request->validated();

        $treino = Treino::create($data);

        $treino->exercicios()->sync($this->mapExercicios($data['exercicios']));

        return redirect()->route('treinos.index');
    }

    private function mapExercicios($exercicios)
    {
        return collect($exercicios)->map(function ($i) {
            return ['serie' => $i];
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Treino $treino)
    {
        abort_if(Gate::denies('treino_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('treinos.show', compact('treino'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Treino $treino)
    {
        abort_if(Gate::denies('treino_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $treino->load('exercicios');

        $exercicios = Exercicio::get()->map(function($exercicio) use ($treino) {
            $exercicio->value = data_get($treino->exercicios->firstWhere('id', $exercicio->id), 'pivot.serie') ?? null;
            return $exercicio;
        });

        return view('treinos.edit', [
            'exercicios' => $exercicios,
            'treino' => $treino,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTreinoRequest $request, Treino $treino)
    {

        $data = $request->validated();

        $treino->update($data);

        $treino->exercicios()->sync($this->mapExercicios($data['exercicios']));

        return redirect()->route('treinos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treino $treino)
    {
        abort_if(Gate::denies('treino_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $treino->delete();

        return redirect()->route('treinos.index');
    }
}
