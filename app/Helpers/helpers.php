<?php

use Carbon\Carbon;
use Illuminate\Support\Arr;

/**
 * Write code on Method
 *
 * @return response()
 */

 if(! function_exists('promedio')){
    function promedio($clases) {
        if(count($clases->whereNotNull('calificacion'))){
            $suma = 0.0;
            foreach($clases->whereNotNull('calificacion') as $clase){
                $suma = $suma + $clase->calificacion;
            }
            return $suma/count($clases);
        }else{
            return 0;
        }
    }
}

if(! function_exists('currentSemestre')){
    function currentSemestre(){
        $y = Carbon::now()->year;
        $m = intval(Carbon::now()->month);

        if($m == 1){
            $semestre = "$y-1";
        }elseif($m>2 and $m<8){
            $semestre = "$y-2";
        }else{
            $y = Carbon::now()->year + 1;
            $semestre = "$y-1";
        }

        return $semestre;
    }
}

if(! function_exists('last5Sem')){
    function last5Sem(){
        $current_semestre = explode('-', currentSemestre());
        $year = intval($current_semestre[0]);
        $period = intval($current_semestre[1]);
        $semestres = [];

        while($year >= intval($current_semestre[0])-2){
            array_push($semestres, "$year-$period");
            if($period == 2){
                $period -= 1;
            }elseif($period == 1){
                $period += 1;
                $year -= 1;
            }

        }

        return $semestres;
    }
}

if(! function_exists('is_activo')){
    function is_activo($data){
        foreach($data as $item){
            if($item->semestre->nombre === currentSemestre()){
                return true;
                break;
            }
        }

        return false;
    }
}

if(! function_exists('status_m')){
    function status_m($estudiante){
        if(isset($estudiante->ingreso_m)){
            if(isset($estudiante->graduacion_m)){
                return 1;
            }elseif(isset($estudiante->baja_m)){
                return 2;
            }else{
                return 0;
            }
        }else{
            return -1;
        }
    }
}

if(! function_exists('status_d')){
    function status_d($estudiante){
        if(isset($estudiante->ingreso_d)){
            if(isset($estudiante->graduacion_d)){
                return 1;
            }elseif(isset($estudiante->baja_d)){
                return 2;
            }else{
                return 0;
            }
        }else{
            return -1;
        }
    }
}

?>
