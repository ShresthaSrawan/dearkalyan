<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    const ARTICLE = 1, IMAGE = 2, VIDEO = 3, GALLERY = 4;
}
