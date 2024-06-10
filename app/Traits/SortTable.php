<?php

namespace App\Traits;


trait SortTable
{



    public function handle_sort_type($request , $filed  ){
        // lấy trên url
        $sort_type = $request->input($filed);



        $follows = [ 'asc', 'desc'];

        if (isset($sort_type) && in_array($sort_type ,  $follows )){
            if ( $sort_type == 'desc'){
                $sort_type = 'asc';
            } else {
                $sort_type = 'desc';
            }
        } else {
            $sort_type = 'asc';
        }

        return $sort_type;
    }

    public function handle_sort_by($request , $filed  ){
        $sort_by = '';

        if(isset($sort_by)){
            $sort_by = $request->input($filed) ;
        }

        return  $sort_by;

    }
}

?>
