<?php

/**
 * PHP Email Form Validation - v3.5
 * Default PHP Email Form Script for contact forms, developed by BootstrapMade.com.
 * For more info and support: https://bootstrapmade.com/php-email-form/
 */

class PHP_Email_Form
{
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $message;
    public $ajax = false;
    public $smtp = false;

    public function add_message($text, $type = 'message', $size = 1)
    {
        switch ($type) {
            case 'info':
            case 'warning':
            case 'danger':
            case 'success':
                $this->message .= '<div class="alert alert-' . $type . ' role="alert">';
                break;
            default:
                $this->message .= '<div>';
                break;
        }
        $this->message .= str_repeat('<small>', $size) . $text . str_repeat('</small>', $size) . '</div>';
    }

    public function send()
    {
        $this->setup_headers();
        $this->setup_body();

        // Send email
        if (mail($this->to, $this->subject, $this->message, $this->headers)) {
            return 'Message sent!';
        } else {
            return 'Failed to send message. Please try again later.';
        }
    }

    private function setup_headers()
    {
        $this->headers = 'From: ' . $this->from_name . ' <' . $this->from_email . '>' . PHP_EOL;
        $this->headers .= 'Reply-To: ' . $this->from_email . PHP_EOL;
        $this->headers .= 'X-Mailer: PHP/' . phpversion();
    }

    private function setup_body()
    {
        $this->message = wordwrap($this->message, 70, "\r\n");
    }
}

?>