<?php

namespace App\Http\Controllers\BackEnd;
use App\Models\Skill;
use App\Http\Requests\BackEnd\Skills\Store;


class Skills extends BackEndController
{
   
    public function __construct(Skill $model){

        parent::__construct($model);
    }

    public function store(Store $request){

     
        $this->model->create($request->all());
   
       return redirect()->route('skills.index');
   
   }
   
   
   
   public function update($id, Store $request){
   
   
       $row = $this->model->FindOrFail($id);
   
       $row->update($request->all());
   
       return redirect()->route('skills.edit',['id'=>$row->id]);
   
   
   }
}
