<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Answer extends Model{
    protected $table = 'answers';
    public $timestamps = false;

    public function question(){
        return $this->belongsTo(Question::class,'question_id','id');
    }
}
?>