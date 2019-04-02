<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DisplayImage extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function display() 
    {
        return $this->BelongsTo('App\Display', 'display_id');
    }
}