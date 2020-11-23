<?php

namespace App\Mail;



use App\Api\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ComprovanteEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $pedido;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$this->from('als2009f@gmail.com');
        $this->subject('Comprovante de venda');
        $this->to($this->pedido->cliente->email);
        $numItem = 1;
        $total = 0;
        foreach($this->pedido->items as $prod){
            $total += $prod->quantidade*$prod->valor_vendido;
        }

        return $this->from('als2009f@gmail.com')
                    ->view('pdf')
                    ->with(['pedido' => $this->pedido,'numItem' => $numItem,'total'=> $total]);
    }
}
