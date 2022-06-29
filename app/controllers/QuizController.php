<?php
namespace App\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\StudentQuiz;
use App\Models\StudentQuizDetail;
use App\Models\Subject;

class QuizController{
    public function index($id = null){

        if(isset($id)){
            $subjectQuizs = Quiz::where('subject_id',$id)->get();
        }else{
        $subjectQuizs = Quiz::all();
        }
        return view('admin.quiz.index',[
            'subjectQuizs'=>$subjectQuizs
        ]);
    }

    public function addForm(){
        $subjects = Subject::all();
        return view('admin.quiz.add-form',[
            'subjects' => $subjects
        ]);
    }

    public function saveAdd()
    {
        Quiz::create($_POST);
        header('location: '.BASE_URL .'quiz');
        die;
    }

    public function editForm($id){
        $quiz = Quiz::find($id);
        $sbj = Subject::all();
        $questions = Question::where('quiz_id', $quiz->id)->get();
        return view('admin.quiz.edit-form',[
            'quiz' => $quiz,
            'questions' => $questions,
            'sbj' => $sbj
        ]);
    }

    public function saveEdit($id)
    {
       $model= Quiz::find($id);
        $model->fill($_POST);
        $model->status = isset($_POST['status'])?$_POST['status']:0;
        $model->is_shuffle = isset($_POST['is_shuffle'])?$_POST['is_shuffle']:0;
        $model->save();
        header('location: '.BASE_URL .'quiz');
        die;
    }

    public function remove($id){
        $que = Question::where('quiz_id',$id)->get();
        foreach($que as $q){
            $ans = Answer::where('question_id',$q->id)->get();
            foreach($ans as $a){
                Answer::destroy($a->id);
            }
            Question::destroy($q->id);
        }
        Quiz::destroy($id);
        header('location: '.BASE_URL .'quiz');
        die;
    }

    public function lam_quiz($id){
        $quiz = Quiz::find($id);
        $questions = Question::where('quiz_id',$id)->get();
        return view('admin.question.lamBai', [
            'quiz'=>$quiz,
            'questions'=>$questions
        ]);
    }

    public function ketQua($id){
        $tongCauHoi = Question::where('quiz_id',$id)->get();
        $dsDapAnDaChon = $_POST;
        $diem = 0;
        $stdQuiz = new StudentQuiz();
        $stdQuiz->student_id = 5;
        $stdQuiz->quiz_id = $id;
        $stdQuiz->save();

        foreach ($dsDapAnDaChon as $question => $ans) {
            $questionId = ltrim($question, 'question_');
            $stQuizDetail = new StudentQuizDetail();
            $stQuizDetail->student_quiz_id = $stdQuiz->id;
            $stQuizDetail->question_id = $questionId;
            $stQuizDetail->answer_id = $ans;
            $stQuizDetail->save();
            $dapan = Answer::find($ans);
            if($dapan->is_correct == 1){
                $diem++;
            }
        }
        $stdQuiz->score = round($diem*10/count($tongCauHoi), 2);
        $stdQuiz->save();
        echo "Điểm của bạn là: " . $stdQuiz->score;
    }
}
