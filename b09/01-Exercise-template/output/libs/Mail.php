<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
class Mail extends PHPMailer
{
    function __construct($config)
    {
        //Setting
        $this->isSMTP();
        $this->Host = 'smtp.gmail.com';
        $this->SMTPAuth = true;
        $this->Username = $config['email'];
        $this->Password = $config['password'];
        $this->Port = 587;
        $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->CharSet = ('utf-8');
    }
    function sendMail($sender, $receiver)
    {
        try {


            //Thiết lập địa chỉ gửi
            $this->setFrom($sender['email'], $sender['name']);
            $this->addAddress($receiver['email']);
            $this->addBCC('dclam2306@gmail.com');
            $this->Subject = 'ZendVn xác nhận thông tin liên hệ';
            $this->isHTML(true);
            $xhtml = '';
            $xhtml .= '<ul style="list-style:inside;">ZendVn xác nhận thông tin liên hệ của bạn gồm :';
            foreach ($receiver as $key => $value) {
                $xhtml .= '<li><b>' . ucfirst($key) . ':</b> ' . $value . ' </li>';
            }
            $xhtml .=  '</ul>';
            $this->Body = $xhtml;
            $this->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
