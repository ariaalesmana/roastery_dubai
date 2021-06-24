<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\KonfirmasiOrderEmail;
use Mail;

class KonfirmasiOrderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $vendor;
    protected $order;
    protected $group;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $vendor = $this->vendor;
        $order = $this->order;
        $group = $this->group;
        $email = new KonfirmasiOrderEmail($vendor, $order, $group);
        Mail::to($this->order->customer->email)->send($email);
    }
}
