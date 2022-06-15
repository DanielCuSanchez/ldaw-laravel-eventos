<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Categoria;
use App\Models\eventos_categorias;
use App\Models\Usuario;
use App\Models\usuarios_eventos_crean;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::orderBy('id', 'asc')->get();
        $eventos = Evento::orderBy('id', 'asc')->get();

        if (auth()->user()->role === 'admin') {
            return view("dashboard.events", ["eventos" => $eventos]);
        } else {
            return view("home", ["eventos" => $eventos, "categorias" => $categorias]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    public function attendance(Request $request, $eventoId)
    {
        $userId = auth()->user()->id;
        $eventoRegistro = usuarios_eventos_crean::where('id_usuario', '=', $userId)
            ->where('id_evento', '=', $eventoId)
            ->get();

        print($eventoRegistro[0]);

        $eventos = Evento::orderBy('nombre_evento', 'asc')->get();
        if (auth()->user()->role === 'admin') {
            return view("dashboard.events", ["eventos" => $eventos]);
        } else {
            return view("home", ["eventos" => $eventos]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evento = Evento::where('id_evento', '=', $id)
            ->limit(1)
            ->get();

        $usuarios = Usuario::join(
            'usuarios_eventos_creans',
            'usuarios_eventos_creans.id_usuario',
            '=', 'usuarios.id_usuario')
            ->where('id_evento', '=', $id)
            ->where('usuarios_eventos_creans.esta_activo', 1)
            ->select('usuarios.nombre', 'usuarios.id_usuario', 'usuarios_eventos_creans.id_evento')
            ->get();

        $data = [
            "evento" => $evento[0],
            "usuarios" => $usuarios
        ];

        return view("events.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evento = Evento::find($id);

        return view("dashboard.event", ["evento" => $evento]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evento = Evento::find($id);
        $evento->delete();
        return redirect()->route('dashboard-events.index')->with('success', 'Eliminado');
    }

    public function search(){
        $search_text = $_GET['query'];
        $categorias = Categoria::orderBy('id', 'asc')->get();
        $eventos = Evento::where('nombre_evento', 'LIKE', '%'.$search_text.'%')->get();

        return view('events.search', ["eventos" => $eventos, "categorias" => $categorias]);
    }

    public function category(){
        //$search_var = $_GET['category'];

        $categorias = Categoria::orderBy('id', 'asc')->get();

        $eventos = Evento::whereHas('categorias', function($q){
            $q->where('categoria_id', '=', $_GET['category']);
        })->get();

        return view('events.category', ["eventos" => $eventos, "categorias" => $categorias]);
    }

}
