<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Item Model
 * @author  Yifan Wu
 * @package Model
 */
class Result extends Model
{
    protected $table = 'results';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'item_id',
        'detail_id',
        'text',
    ];
}