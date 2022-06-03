<?php

namespace App\Http\Controllers;

use App\Models\Laboral;
use Illuminate\Http\Request;

class LaboralController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('laborales_index'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $laborales= Laboral::where('estado',0)->select("id","nombres", "hora_entrada", "hora_salida","horas_ordinarias", "horas_extras")->get();

        return view('laborales/index')->with('laborales', $laborales);
    }
}
