<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewVoucherMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $voucher;

    public function __construct($customer, $voucher)
    {
        $this->customer = $customer;
        $this->voucher = $voucher;
    }

    public function build()
    {
        return $this->view('client.mail.voucher')
                    ->subject('Thông báo Voucher mới')
                    ->with([
                        'customer' => $this->customer,
                        'voucher' => $this->voucher,
                    ]);
    }

}

