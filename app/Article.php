<?php

namespace App;

use \Jenssegers\Mongodb\Eloquent\Model;

class Article extends Model
{
    protected $connection = 'mongodb';

    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];
}
