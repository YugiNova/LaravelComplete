<?php 
    namespace App\Filters;

    class ByKeyword{
        public function handle($request, \Closure $next)
        {
            
            $builder = $next($request);
            
            if(request()->query('keyword')){
                return $builder->where('name','like','%'.request()->query('keyword').'%');
            }
            
            return $builder;
        } 
    }
?>