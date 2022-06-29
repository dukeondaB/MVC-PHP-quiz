<?php
namespace App\Controllers;

use App\Models\Subject;

class HomeController{
    
    public function index(){
        $order = isset($_GET['order']) ? $_GET['order'] : 1;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

        $query = Subject::where('name', 'like', "%$keyword%");

        if($order == 1){
            $subjects = $query->orderBy('name')->get();
        }else{
            $subjects = $query->orderByDesc('name')->get();   
        }
        return view('home.homepage', [
            'dsMonhoc' => $subjects
        ]);
        
        // $this->render('home.homepage', compact('subjects'));
    }
}
?>