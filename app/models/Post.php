<?php
/**
 * Created by PhpStorm.
 * User: dan
 * Date: 21/10/14
 * Time: 20:52
 */

class Post extends Eloquent {

    protected $table = 'posts';

    protected $primaryKey = 'permalink';

    protected function formatDate()
    {
        return('dS F Y');
    }

    protected function user()
    {
        return $this->belongsTo('User');
    }

    protected function comments()
    {
        return $this->hasMany('comments');
    }

    protected function tags()
    {
        return $this->belongsToMany('Tag', 'post_tag');
    }

    protected $fillable = array('title', 'content', 'permalink', 'user_id');

    public function createPost($data)
    {
        if (!(isset($data['title'])|isset($data['content'])|isset($data['permalink']))) {
            return array('status' => false, 'message' => "You didn't fill in all required sections!");
        }
        elseif ($this::checkExists($data['permalink'])) {
            return array('status' => false, 'message' => "Permalink already exists, oops.");
        }
        else {
            $post = new Post;
            $post->title = $data['title'];
            $post->content = $data['content'];
            $post->permalink = $data['permalink'];
            $post->user_id = Auth::user()->getId();

            if(isset($data['tags'])) {
                $tags = explode(",", $data['tags']);
                foreach($tags as $tagName) {
                    $tag = Tag::firstOrCreate(array('name' => strtolower(trim($tagName))));
                    $post->tags()->attach($tag);
                }
            }
            $post->push();
            return array('status' => true, 'message' => "Post successfully created!");
        }
    }

    public function getPosts()
    {
        $posts = $this::orderBy('created_at', 'desc')->paginate(5);
        return $posts;
    }

    public function checkExists($permalink)
    {
        if(is_null($this::find($permalink))) {
            return false;
        }
        else {
            return true;
        }
    }

    public function searchPosts($criteria)
    {
        $returnArray = array();
        $posts = $this::orderBy('created_at', 'desc')->get();
        $tag = Tag::where('name', '=', strtolower($criteria))->first();
        if(isset($tag)) {
            $tagId = $tag->id;
            foreach ($posts as $index => $post) {
                $tags = $post->tags;
                if($tags->contains($tagId)) {
                    array_push($returnArray, $post);
                    unset($posts[$index]);
                }
            }
        }
        return $returnArray;
    }

    public function paginateResults($results)
    {
        $paginatedArray = Paginator::make($results, count($results), 5);
        return $paginatedArray;
    }

    public function getPostByPermalink($permalink)
    {
        $data['post'] = $this::where('permalink', '=', $permalink)->firstOrFail();
        $data['comments'] = Comment::where('post_id', '=', $data['post']->id)->get();

        return $data;
    }

}