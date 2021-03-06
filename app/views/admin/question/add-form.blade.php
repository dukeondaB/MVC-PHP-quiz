@extends('layouts.client.main')
@section('content')
    <div class="container">
        <form class="form1" action="" method="post">
            <h3 style="margin-bottom: 35px;">Thêm question</h3>
            <div class="mb-3">
                <label for="">Quiz</label>
                <select class="form-control" name="quiz_id">
                    @foreach ($quizs as $sub)
                        <option value="{{ $sub->id }}">{{ $sub->name }} - {{ $sub->subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="">Question</label>
                <input class="form-control" type="text" name="name">
            </div>
            <h3 class="g-3">Đáp án &nbsp;<button type="button" id="new_answer" class="btn btn-success">Thêm đáp
                    án</button></h3>
            <table style="width: 90%; margin: auto;">
                <thead>
                    <th style="width: 80%;">Câu trả lời</th>
                    <th style="padding-left: 20px;">Đáp án đúng</th>
                </thead>
                <tbody id="answer_list">
                    <tr>
                        <td><input type="text" class="form-control" name="answer[]" /></td>
                        <td style="padding: 10px 0 0 20px;"><input onchange="correctAnswerChange(this)" type="checkbox"
                                value="1" id="check" class="form-control-input" style="width: 25px; height: 25px;"
                                name="is_correct" /></td>
                    </tr>
                </tbody>
            </table>
    </div>
    <input type="hidden" name="correct" id="correct_answer" />

    <div>
        <button class="btn btn-primary" type="submit">Lưu</button>
    </div>
    </form>
    </div>
@endsection

@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    let options = {
        backdrop: false,
        keyboard: true
    }
    var addQuestions = new bootstrap.Modal(document.getElementById('addQuestions'), options)
    $("#openModal").click(function() {
        addQuestions.show();
    })

    $("#new_answer").click(function() {
        $("tbody#answer_list").append(`
        <tr>
            <td><input type="text" class="form-control" name="answer[]"  /></td>
            <td style="padding: 10px 0 0 20px;"><input type="checkbox" onchange="correctAnswerChange(this)" value="1" id="check" class="form-control-input" style="width: 25px; height: 25px;" name="is_correct" /></td>
        </tr>`);
    })

    function correctAnswerChange(el) {
        var listCheckBox = $("tbody#answer_list").find('input[type="checkbox"]').prop('checked', false);
        $(el).prop('checked', true);
        $(listCheckBox).each(function(index, el) {
            if($(el).is(':checked')){
                $('#correct_answer').val(index);
                // console.log(el);
                console.log(index);
            }

        })
    }
</script>
@endsection
