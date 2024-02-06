<?php

namespace App\Controllers;

use App\Support\Email;
use App\Support\Flash;
use App\Support\Validate;

class ContactController extends Controller
{
    public function index()
    {
        return $this->view('contact', ['title' => 'Contact']);
    }

    public function send()
    {
        $validate = new Validate();
        $validated = $validate->validate([
            'email' => 'email|required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if (!$validated) {
            return redirect('/contact');
        }

        $email = new Email();
        $sent = $email->from($validated['email'], 'Yuriohh')
            ->to('yuriohh@teste.com')
            ->message($validated['message'])
            ->template('contact', ['name' => 'Yuriohh'])
            ->subject($validated['subject'])
            ->send();

        if ($sent) {
            Flash::set('sent_success', 'Mail sent successed');
            return redirect('/contact');
        }

        Flash::set('sent_error', 'Mail failed');
        return redirect('/contact');
    }
}
