<?php
    namespace App\Filters;

    class ByMinMax {
        public function handle($request,\Closure $next)
        {
            $builder = $next($request);
            $query = [request()->query('amount_start'),request()->query('amount_end')];
            
            if($query[0] != null && $query[1] != null){
                // dd($query);
                return $builder->whereBetween('price',$query);
            }
            return $builder;
        }
    }
?>