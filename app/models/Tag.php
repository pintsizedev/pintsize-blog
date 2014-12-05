<?php
/**
 * Created by PhpStorm.
 * User: dan
 * Date: 21/10/14
 * Time: 22:01
 */

class Tag extends Eloquent {

    protected $table = 'tags';

    protected function posts()
    {
        return $this->belongsToMany('Post', 'post_tag');
    }

    public function getId()
    {
        return $this->id();
    }

    protected $fillable = array('name');

    public function getTags()
    {
        return Tag::All();
    }
}