<?php

namespace App\Http\Controllers\BackEnd;


use App\Http\Requests\BackEnd\Users\Store;
use App\Http\Requests\BackEnd\Users\Update;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class Users extends BackEndController
{


    public function __construct(User $model){

            parent::__construct($model);
    }



   // protected function filter($rows){
//
    //    if(request()->has('name') && request()->get('name')!=""){
//
   //         $rows = $rows->where('name',request()->get('name'));
     //   }
   //     return $rows;
   // }

   



 

    public function store(Store $request){

         $requestArray = $request->all();
         $requestArray['password'] = Hash::make( $requestArray['password'] );
         $this->model->create($requestArray);

        return redirect()->route('users.index');

    }

   

    public function update($id, Update $request){
        $row = User::FindOrFail($id);

        $requestArray= $request->all();

        if(isset($requestArray['password']) && $requestArray['password']!=""){

            $requestArray['password'] = Hash::make( $requestArray['password'] );

        }
        else{

            unset($requestArray['password']);
        }
        $row->update($requestArray);

        return redirect()->route('users.edit',['id'=>$row->id]);


    }

 
}
