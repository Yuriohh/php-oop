<?php

namespace App\Support;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    private array|string $to = [];
    private string $from;
    private string $fromName;
    private string $template = '';
    private array $templateData = [];
    private string $subject;
    private string $message;
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = env('MAIL_HOST');
        $this->mail->SMTPAuth = true;
        $this->mail->Username = env('MAIL_USER');
        $this->mail->Password = env('MAIL_PASS');
        $this->mail->Port = env('MAIL_PORT');
    }

    public function from(string $name, string $fromName = ''): Email
    {
        $this->from = $name;
        $this->fromName = $fromName;

        return $this;
    }

    public function to(array|string $to): Email
    {
        $this->to = $to;

        return $this;
    }

    public function template(string $template, array $templateData): Email
    {
        $this->template = $template;
        $this->templateData = $templateData;

        return $this;
    }

    public function subject(string $subject): Email
    {
        $this->subject = $subject;

        return $this;
    }

    public function message(string $message): Email
    {
        $this->message = $message;
        return $this;
    }

    private function checkAddress()
    {
        if (is_array($this->to)) {
            foreach ($this->to as $to) {
                $this->mail->addAddress($to);
            }
        }

        if (is_string($this->to)) {
            $this->mail->addAddress($this->to);
        }
    }

    private function sendWithTemplate()
    {
        $file = '../app/Views/email/' . $this->template . '.html';

        if (!file_exists($file)) {
            throw new \Exception("O template {$this->template} não existe");
        }

        $template = file_get_contents($file);

        $this->templateData['message'] = $this->message;

        foreach ($this->templateData as $key => $value) {
            $dataTemplate["@{$key}"] = $value;
        }

        return str_replace(array_keys($dataTemplate), array_values($dataTemplate), $template);
    }

    public function send()
    {
        $this->mail->setFrom($this->from, $this->fromName);
        $this->checkAddress();

        $this->mail->isHTML(true);
        $this->mail->Subject = $this->subject;
        $this->mail->Body = empty($this->template) ? $this->message : $this->sendWithTemplate();
        $this->mail->AltBody = $this->message;

        return $this->mail->send();
    }
}
