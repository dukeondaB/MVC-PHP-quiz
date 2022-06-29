@extends('layouts.client.main')
@section('page-head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <table class="table table-hover table-bordered" border="1" style="border-collapse: collapse">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Tên môn học</th>
                        <th>Tên quiz</th>
                        <th>Tên question</th>
                        <th><button id="openModal" class="btn btn-success">Tạo mới</button></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td >
                            {{ $item->quiz->subject->name }}
                        </td>
                        <td >{{ $item->quiz->name }}</td>
                        <td >
                            {{ $item->name }}
                        </td>
                        <td class="col-3">
                            <a href="" class="btn btn-primary">Sửa</a>
                            &nbsp;
                            <a href="{{ BASE_URL . 'question/remove/' . $item->id}}" class="btn btn-danger">Xóa</a>
                            &nbsp;
                            <a href="{{ BASE_URL . 'quiz/addQuestion/' . $item->quiz_id}}" class="btn btn-secondary">Xem chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addQuestions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Quiz</label>
                                    <textarea name="name" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea name="name" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                            <br>
                            <h3 class="g-3">Đáp án &nbsp;<button type="button" id="new_answer" class="btn btn-success">Thêm đáp án</button></h3>
                            <table style="width: 90%; margin: auto;">
                                <thead>
                                    <th style="width: 80%;">Câu trả lời</th>
                                    <th style="padding-left: 20px;">Đáp án đúng</th>
                                </thead>
                                <tbody id="answer_list">
                                    <tr>
                                        <td><input type="text" class="form-control" name="answer[]" /></td>
                                        <td style="padding: 10px 0 0 20px;"><input onchange="correctAnswerChange(this)" type="checkbox" value="1" id="check" class="form-control-input" style="width: 25px; height: 25px;" name="is_correct" /></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="correct" id="correct_answer" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
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


