<?php
    namespace App\Filters;

    class ByStatus {
        public function handle($request,\Closure $next)
        {
            $builder = $next($request);
            // dd(request()->query('status'));
            if(request()->query('status')){
                $builder = $builder->where('status',request()->query('status'));
                
                return $builder;
            }
            
            return $builder;
        }
    }
?>