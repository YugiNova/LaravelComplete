<?php 
    namespace App\Filters;

    class Sort{
        public function handle($request, \Closure $next)
        {
            $buidler = $next($request);
            $query = request()->query('sort');

            if(!is_null($query)){
                $sortBy = ['id','desc'];
                switch($query){
                    case 1:
                        $sortBy = ['price','asc'];
                        break;
                    case 2:
                        $sortBy = ['price','desc'];
                        break;
                    default: $sortBy = ['id', 'desc'];
                }
                // dd($query);
                return $buidler->orderBy($sortBy[0],$sortBy[1]);
            }
            return $buidler;
        }
    }
?>