<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $checkoutDataMail)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        

        return new Envelope(
            subject: 'Order Success Mail',
            
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $checkOutInfo = Session::get('checkout');

        $productsTakenId = [];
        foreach ($checkOutInfo['product_taken'] as $product) {
            $productsTakenId[] = $product['id'];
        }
        $products = Product::whereIn('id', $productsTakenId)->get()->keyBy('id');

        return new Content(
            view: 'mail.order_success_mail',
            with: ['orderData' => $this->checkoutDataMail, 'checkoutInfo'=>$checkOutInfo,'products' => $products],

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
