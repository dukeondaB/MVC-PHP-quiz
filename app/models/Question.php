<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Question extends Model{
    protected $table = 'questions';

    public $timestamps = false;
    public function quiz(){
        return $this->belongsTo(Quiz::class,'quiz_id','id');
    }

    public function getAnswers(){
        // return Answer::where('question_id', $this->id)->get();
        return $this->hasMany(Answer::class,'question_id','id');
    }
}
?>