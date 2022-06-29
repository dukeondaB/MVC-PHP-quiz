@extends('layouts.client.main')
@section('content')
    <div class="container-fluid">
        <h2>{{$quiz->name}}</h2>
        <p>Thời gian: {{$quiz->duration_minutes}} phút</p>
        <hr>
        <form action="" method="POST">
            @foreach ($questions as $item)
            <fieldset>
                <legend>Câu hỏi {{$loop->iteration}}: {{$item->name}}</legend>
                <ul>
                    @foreach ($item->getAnswers as $ans)
                        <li> 
                            <input type="radio" name="question_{{$item->id}}" id="{{$ans->id}}" value="{{$ans->id}}">
                            <label for="{{$ans->id}}">{{$ans->content}}</label>
                        </li>
                    @endforeach
                </ul>
            </fieldset>    
            @endforeach
            <button type="submit">Nộp bài</button>
        </form>
    </div>
@endsection
