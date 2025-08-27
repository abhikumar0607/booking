<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowItWork extends Model
{
    protected $table = 'how_it_works';
    protected $fillable = [
        'title','description','image','button_text','button_link',
        'section1_title','section1_desc',
        'section2_title','section2_desc',
        'section3_title','section3_desc',
        'section4_title','section4_desc',
        'status'
    ];  
}
