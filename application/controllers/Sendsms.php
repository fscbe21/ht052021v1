<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sendsms extends MY_Controller {

    function index(){
        $con = array();
        $con[] = 'enter mobile number';
        $message = "test message";
        $message = "Hi there, thank you for sending your first test message from Textlocal. See how you can send effective SMS campaigns here: https://tx.gl/r/2nGVj/";
        send_sms($con, $message);
    }
}
