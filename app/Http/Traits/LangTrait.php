<?php


namespace App\Http\Traits;



trait LangTrait
{


    # To Use This lang function

    # 1- call namespace -- use App\Http\Traits\LangTrait; --
    # 2- call -- use LangTrait; --
    # 3- call -- 'name' => $this->{$this->lang($request, 'name')} --


    public function lang($request,$pro){
        $acceptLanguageHeader = $request->header('Accept-Language');
        $property = $pro . '_' . $acceptLanguageHeader;
        return $property;
    }
}

