<?php
namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Subject;

class SubjectController{
    public function index(){
        $subjects = Subject::all();
        return view('admin.mon-hoc.index', ['subjects' => $subjects]);       
    }

    public function addForm(){
        return view('admin.mon-hoc.add-form');
    }

    public function editForm($id){
        $model = Subject::where('id', $id)->first();
        if(!$model){
            header('location: ' . BASE_URL . 'mon-hoc');
            die;
        }
        return view('admin.mon-hoc.edit-form', [
            'model' => $model
        ]);
    }

    public function saveAdd(){
       Subject::create($_POST);

        header('location: ' . BASE_URL . 'mon-hoc');
        die;
    }

    public function saveEdit($id){
        $subject = Subject::find($id);
        $subject->name = $_POST['name'];
        $subject->save();
        header('location: ' . BASE_URL . 'mon-hoc');
        die;
    }

    public function remove($id){
     
        Subject::destroy($id);

        header('location: ' . BASE_URL . 'mon-hoc');
        die;
    }
}
?>