<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use App\Models\Planilla;
use App\Models\PlanillaDetalle;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PlanillaExport implements FromView
{
    protected $planilla;
    protected $p;
    public function __construct($detail=null, $pla=null)
    {
        $this->planilla=$detail;
        $this->p=$pla;
    }
    public function view(): View {
        $planilla=$this->planilla;
        $p=$this->p;
        return view("planilla.excel",compact("planilla","p"));
    }
    
}
