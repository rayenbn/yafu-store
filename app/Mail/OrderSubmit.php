<?php
namespace App\Mail;

use App\Cart;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Services\attributesPathService;
use App\User;

class OrderSubmit extends Mailable
{
    use SerializesModels;

    protected $invoiceNumber;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $queryProducts = Cart::where([['created_by', '=', (string)auth()->id()],['submited', '=', 0]]);
        $info = auth()->user();
        
        dispatch($exporter = new \App\Jobs\GenerateInvoicesXLSX(
            $queryProducts->get(),
            $this->data // send the user that is going to generate the invoice for
        ));
        
        $this->invoiceNumber = $exporter->getInvoiceNumber();

        $queryProducts->update(['invoice_number' => $this->invoiceNumber]);

        return $this
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->bcc(['rayen@pufflex.com'], 'Disposable cigarette factory')
            ->replyTo($this->data->email, $this->data->name)
            ->subject('AFStore Production Order Confirmation')
            ->with([
                'invoiceName' => (isset($info) && $info->invoice_name) ? $info->invoice_name : 'Non stated',
                // 'files'       => ($files->getRecentFiles() !== null) ? $files->getRecentFiles() : null,
                'clientName'       => $this->data->name ?? auth()->user()->name,
            ])
            ->attach($exporter->getPathInvoice(), [
                'as' => $this->invoiceNumber . '.xlsx',
                'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ])
            ->markdown('emails.orders.submit');
    }

    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }
}