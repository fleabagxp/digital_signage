<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function displayImage() 
    {
        return $this->HasOne('App\DisplayImage');
    }
}
