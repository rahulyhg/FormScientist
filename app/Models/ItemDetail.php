<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Item Detail Model
 * @author  Yifan Wu
 * @package Model
 */
class ItemDetail extends Model
{

    protected $table = 'items_detail';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'item_id',
        'item_text',
        'item_type',
    ];



    public function addText($item_id, $item_text, $item_type = 'text')
    {

        try {
            $this->create([
                'item_id' => $item_id,
                'item_text' => $item_text,
                'item_type' => $item_type
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateText($id, $item_text, $item_type = 'text')
    {
        try {
            $this->where('id', $id)->update([
                'item_text' => $item_text,
                'item_type' => $item_type
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function delText($id){
        try {
            $this->where('id',$id)->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}