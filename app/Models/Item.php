<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Item Model
 * @author  Yifan Wu
 * @package Model
 */
class Item extends Model
{

    protected $table = 'items';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'description',
    ];

    public function addItem($user_id,$name,$description){
        return $this->create([
            'user_id'       => $user_id,
            'name'          => $name,
            'description'   => $description
        ]);
    }

    public function updateItem($id,$name,$description)
    {
        $this->where('id',$id)->update([
            '$name' => $name,
            'description' => $description
        ]);
    }

    public function delItem($id){
        $this->where('id',$id)->delete();
    }

}