<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Quiz extends Model{
    protected $table = 'quizs';

    protected $fillable = [
        'name', 'subject_id', 'duration_minutes', 'start_time', 'end_time','status', 'is_shuffle'
    ];

    public $timestamps = false;

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

    public function getQuestions(){
        return Question::where('quiz_id',$this->id)->get();
    }
}
?>