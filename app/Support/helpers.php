<?php

use Illuminate\Support\Str;

function redirectAccordingToRequest($request,$responseStatus)
{
    if($responseStatus == 'success'){
        $message = 'تمت العمليه بنجاح';
    }else{
        $message = 'فشلت العمليه ';
    }
    if($request->has('create')){
        $routeName = Str::replace('store','index',$request->route()->getName());
        return redirect()->route( $routeName)->with($responseStatus,$message);
    }else{
        return redirect()->back()->with($responseStatus,$message);

    }
}

?>
