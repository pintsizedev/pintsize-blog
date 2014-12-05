<?php
/**
 * Created by PhpStorm.
 * User: dan
 * Date: 21/10/14
 * Time: 21:11
 */

class Comment extends Eloquent {

    protected $table = 'comments';

    public function post()
    {
        return $this->belongsTo('Post');
    }

    protected $fillable = array('post_id', 'username', 'content');

    public function addComment($data, $postId)
    {
        if(!isset($data['username'])|!isset($data['content'])) {
            return array('status' => false, 'message' => "You didn't fill in all required sections!");
        }
        else {
            $comment = new Comment;
            $comment->post_id = $postId;
            $comment->username = $data['username'];
            $comment->content = $data['content'];
            $comment->save();
            return array('status' => true, 'message' => "Comment successfully added");
        }
    }
}