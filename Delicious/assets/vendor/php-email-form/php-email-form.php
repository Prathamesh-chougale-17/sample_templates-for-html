<?php
class PHP_Email_Form {
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $smtp;
    public $ajax;

    public function add_message($value, $label, $width = 12) {
        return "<div style='width: {$width}%;'><strong>{$label}:</strong> {$value}</div>";
    }

    public function send() {
        if ($this->ajax) {
            header('Content-Type: application/json');

            if ($this->validate()) {
                $success = $this->send_email();
                if ($success) {
                    echo json_encode(array('status' => 'success', 'message' => 'Message sent successfully'));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Message could not be sent'));
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid form data'));
            }
        } else {
            return $this->send_email() ? 'Message sent successfully' : 'Message could not be sent';
        }
    }

    private function send_email() {
        $headers = "From: {$this->from_name} <{$this->from_email}>" . "\r\n";
        $message = $this->build_message();

        if ($this->smtp) {
            // Use SMTP to send email
            return mail($this->to, $this->subject, $message, $headers);
        } else {
            // Use PHP's built-in mail function
            return mail($this->to, $this->subject, $message, $headers);
        }
    }

    private function build_message() {
        $message = '<div>';
        $message .= "<h2>{$this->subject}</h2>";

        // Add form fields to the message
        $message .= $this->add_message($this->from_name, 'Name');
        $message .= $this->add_message($this->from_email, 'Email');
        // ... Add other form fields

        $message .= '</div>';
        return $message;
    }

    private function validate() {
        // Perform form data validation here
        // Return true if data is valid, false otherwise
        // You should implement your own validation logic
        return true;
    }
}
?>
