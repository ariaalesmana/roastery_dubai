<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderEmailCustomer extends Mailable
{
    use Queueable, SerializesModels;
    protected $vendor;
    protected $order;
    protected $group;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vendor, $order, $group)
    {
        $this->vendor = $vendor;
        $this->order = $order;
        $this->group = $group;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['vendor'] = $this->vendor;
        $data['order'] = $this->order;
        $data['group'] = $this->group;

        return $this
            ->from($address = $data['group']->email)
            ->view('Email.email_order_customer', $data)
            ->subject('e-Catalogue - Pemesanan Produk');
    }
}
