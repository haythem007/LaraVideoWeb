<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class BackEndController extends Controller
{
    protected $model;

    public function __construct(Model $model){

        $this->model = $model;
    }

      public function index()
    {
        $rows = $this->model;
        $with = $this->with();
        if(!empty($with)){
            $rows = $rows->with($with);
        }
        $rows = $rows->paginate(10);
        $mduleName = $this->pluralModelName();
        $sModuleName = $this->getModelName();
        $routeName = $this->getClassNameFromModel();
        $pageTitle = "Control ".$mduleName;
        $pagesDes = "Here you can add / edit / delete " .$mduleName;
        return view('back-end.' . $this->getClassNameFromModel() . '.index', compact(
            'rows',
            'pageTitle',
            'mduleName',
            'sModuleName',
            'routeName',
            'pagesDes',
         
        ));
    }


    public function create(){

        $mduleName = $this->getModelName();
        $pageTitle =  $mduleName." Create";
        $pagesDes = " here you can Create ".$mduleName;
        $folderName = $this->getClassNameFromModel();
        $routeName = $folderName;
        $append = $this->append();

        return view('back-end.'.$this->getClassNameFromModel().'.create',compact('pageTitle',
        'mduleName',
        'folderName',
        'routeName',
        'pagesDes',))->with($append);

    }


    public function destroy($id){

        $this->model->FindOrFail($id)->delete($id);
        return view('back-end.'.$this->getClassNameFromModel().'.index');



    }


    public function edit($id){
        $row =  $this->model->FindOrFail($id);
        $mduleName = $this->getModelName();
        $pageTitle =  $mduleName." Edit";
        $pagesDes = " here you can Edit ".$mduleName;
        $folderName = $this->getClassNameFromModel();
        $routeName = $folderName;
        $append = $this->append();
        return view('back-end.'.$this->getClassNameFromModel().'.edit',
                compact('row',
                'pageTitle',
                'mduleName',
                'folderName',
                'routeName',
                'pagesDes',))->with($append);

    }

    //protected function filter($rows){

     //   return $rows;
    //}

    protected function with(){

        return [];
    }

    protected function append(){

        return [];
    }
    protected function getClassNameFromModel()
    {
        return strtolower($this->pluralModelName());
    }
    protected function pluralModelName(){
        return str_plural($this->getModelName());
    }
    protected function getModelName(){
        return class_basename($this->model);
    }
}
