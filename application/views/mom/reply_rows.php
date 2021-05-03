<?php

foreach ($replies as $reply_info) {
    $this->load->view("mom/reply_row", array("reply_info" => $reply_info));
} 