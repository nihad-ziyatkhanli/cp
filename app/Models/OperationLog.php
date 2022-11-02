<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{
    use HasFactory;

    protected $table = 'operation_logs';

    protected $fillable = [
        'table', 'operation', 'data', 'ip',
    ];
}
