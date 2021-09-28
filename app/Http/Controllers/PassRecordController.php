<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PassRecord;

use function PHPSTORM_META\type;

class PassRecordController extends Controller
{
    //
    public function index(){
        return auth()->user()->passwords;
    }

    public function getFilteredPasswords(){

        $keyword = request('keyword');
        $filters = request('filter');
        $filter = '';

        if($filters == ''){
            $filter = "name like '%".$keyword."%'
            or handle like '%".$keyword."%'
            or password like '%".$keyword."%'
            or note like '%".$keyword."%'";
        }else{
            $first = true;
            foreach($filters as $f){
                if(!$first){
                    $filter = $filter.' or';
                }else{
                    $first = false;
                }
                $filter = $filter.' '.$f." like '%".$keyword."%'";
            }
        }
        
        return PassRecord::where('user_id','=',auth()->user()->id)->whereRaw($filter)->get();

    }
}
