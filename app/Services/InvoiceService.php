<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\InvoiceInterface;
use App\Models\Invoice;

class InvoiceService extends AbstractService implements InvoiceInterface
{
    public function __construct(Invoice $invoice)
    {
        parent::__construct($invoice);
    }
}
