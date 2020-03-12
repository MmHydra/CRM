<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    protected $table = 'Proxy';

    // public function getFormatProxy($id)
    // {
    //     $currentProxy = Proxy::select()->where('id', $id)->get();
    // }
}
