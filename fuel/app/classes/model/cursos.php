<?php

namespace Model;
use DB;

class Cursos extends \Model {
	
    public static function get($where = null)
    {
    	$q = DB::select()
    		-> from('actividades')
            -> order_by('orden','asc');
    		//-> cached(1000);
        
        if(null !== $where) $q-> where($where);
        
        return $q -> execute()
    		      -> as_array();
    }

    public static function exists($slug = null)
    {
        $result = DB::select(DB::expr('COUNT(*) AS count'))
                        -> from('actividades_ampliada')
                        -> where('slug',$slug)
                        -> execute();

        return $result[0]['count'] == 1;
    }

    public static function getAmpliada($slug)
    {
        $q = DB::select()
            -> from('actividades_ampliada')
            -> join('actividades','inner')
            -> on('actividades.slug','=','actividades_ampliada.slug')
            -> where('actividades.slug',$slug)
            //-> cached(1000)
            -> execute()
            -> as_array();

        return $q[0];
    }

}
