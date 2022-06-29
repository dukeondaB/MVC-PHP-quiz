<?php
namespace App\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;

class QuestionController{
    public function index($id = null){

        if(isset($id)){
            $question = Question::where('quiz_id',$id)->get();
            $quiz = Quiz::find($id);
        }
        return view('admin.question.index',[
            'question'=>$question,
            'quiz'=>$quiz
        ]);
    }

    public function showAllQuestion(){
       $questions = Question::all();
       return view('admin.question.indexQuestion',[
           'questions'=>$questions
       ]);
    }

    public function addForm(){
        $quizs = Quiz::all();
        return view('admin.question.add-form',[
            'quizs'=>$quizs
        ]);
    }

 

    public function saveAdd($id)
    {
        $id = array_slice(explode('/', $_GET['url']), -1)[0];
        $answer = $_POST['answer'];
        $question = new Question();
        $question->name = $_POST['name'];
        $question->quiz_id = $id;
        $question->save();

        for ($i=0; $i < count($answer); $i++) { 
            $ans = new Answer();
            $ans->content = $answer[$i];
            $ans->question_id = $question->id;
            $ans->is_correct = $_POST['correct'] == $i ? 1:0;
            $ans->save();
        }
        header('location: '.BASE_URL. 'quiz/addQuestion/' . $id);
        die;
        
    }

    public function editForm($id){
        
    }

    public function saveEdit($id)
    {
     
    }

    public function remove($id){
        Question::destroy($id);
        header('location:'.BASE_URL.'question');
        die;
    }
}
?>