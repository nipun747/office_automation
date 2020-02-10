<?php
function formatDate($date = '', $format = 'Y-m-d'){
    if($date == '' || $date == null)
        return;

    return date($format,strtotime($date));
}
>