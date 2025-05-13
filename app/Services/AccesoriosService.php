<?php

namespace App\Services;

use App\Enums\HttpStatusEnum;
use App\Services\Service;
use App\Http\Requests\Services\AccesoriosService as RulesRequest;
use App\Models\Accesorio;
use Illuminate\Support\Facades\Auth;

class AccesoriosService extends Service
{
    /**
     * Construct
     *
     * @return void
     */
    public function _construct()
    {
        //
    }

    /**
     * Retorna una lista de los recursos
     *
     * @param  array<\App\Http\Requests\Services\AccesoriosService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function index(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Index::class, $data, $validateData);
        $request = new RulesRequest\Index($data);

        $usuario = Auth::user();
        // $usuario = 1;

        $accesorios = Accesorio::whereHas('equipos.usuarios', function ($query) use ($usuario){
            $query->where('id_estacion', $usuario->id_estacion);
        })->with(['equipos'])
        ->orderBy('nombre', 'asc')
        ->get();

        return $accesorios;
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Http\Requests\Services\AccesoriosService\Store>  $data
     * @param  bool  $transactionExists
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function store(array $data, bool $transactionExists = false, bool $validateData = true)
    {
        $this->validate(RulesRequest\Store::class, $data, $validateData);
        $request = new RulesRequest\Store($data);

        $this->dbBeginTransaction($transactionExists);
        try {
            $accesorios= Accesorio::create([
            'nombre'                        =>$request->nombre,
            'imagen'                        =>$request->imagen,
            'marca'                         =>$request->marca,
            'modelo'                        =>$request->modelo,
            'detalle_descripcion'           =>$request->detalle_descripcion,
            'id_equipo'                     =>$request->id_equipo
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $accesorios;
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\AccesoriosService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function show(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Show::class, $data, $validateData);
        $request = new RulesRequest\Show($data);

        $accesorios = Accesorio::query()
        ->where('id','=',$request->id)
        ->first();
        if(!$accesorios){
            abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
        }

        return $accesorios;
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\AccesoriosService\Update>  $data
     * @param  bool  $transactionExists
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function update(array $data, bool $transactionExists = false, bool $validateData = true)
    {
        $this->validate(RulesRequest\Update::class, $data, $validateData);
        $request = new RulesRequest\Update($data);

        $this->dbBeginTransaction($transactionExists);
        try {
            $accesorios = Accesorio::query()
        ->where('id','=',$request->id)
        ->first();
        if(!$accesorios){
            abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
        }

            $accesorios->update([
            'nombre'                        =>$request->nombre,
            'imagen'                        =>$request->imagen,
            'marca'                         =>$request->marca,
            'modelo'                        =>$request->modelo,
            'detalle_descripcion'           =>$request->detalle_descripcion,
            'id_equipo'                     =>$request->id_equipo
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $accesorios;
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\AccesoriosService\Destroy>  $data
     * @param  bool  $transactionExists
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function destroy(array $data, bool $transactionExists = false, bool $validateData = true)
    {
        $this->validate(RulesRequest\Destroy::class, $data, $validateData);
        $request = new RulesRequest\Destroy($data);

        $this->dbBeginTransaction($transactionExists);
        try {
            $accesorios = Accesorio::query()
            ->where('id','=',$request->id)
            ->first();
            if(!$accesorios){
            abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
            }
            $accesorios->delete();

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $accesorios;
    }
}
