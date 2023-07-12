<?php
    namespace App\Filters;

    class ByStatus {
        public function handle($request,\Closure $next)
        {
            $builder = $next($request);
            $query = request()->query('status');
            // dd(request()->query('status'));
            if($query != null){
                return $builder->where('status',$query);
            }
            return $builder;
        }
    }
?>