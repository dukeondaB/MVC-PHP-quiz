<?php
use eftec\bladeone\BladeOne;
function view($view, $data = []){
    // tham số thứ 1: đường dẫn đến thư mục chứa các file view
    // tham số thứ 2: nơi chứa các file đã được biên dịch sang 
    // code PHP thuần
    // tham số thứ 3: trạng thái sử dụng (có báo lỗi)
    $blade = new BladeOne('./app/views', './storage',
                                BladeOne::MODE_DEBUG);
    echo $blade->run($view, $data);
}
?>