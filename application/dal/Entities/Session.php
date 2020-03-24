<?php

namespace Dal\Entities;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    /***
     * No timestamps
     *
     * @var bool
     */
    public $timestamps = false;
}
