<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $fillable = [
        "invoice_number",
        "invoice_id",
        "due_date",
        "product",
        "section",
        "status",
        "status_value",
        "note",
        "user",
    ];
    use HasFactory;

}
