<?php

namespace stackexchange\model;

use stackexchange\core\Model;

class Thread extends Model
{
    private $table = "thread";

    public function __construct()
    {
        $this->author = "";
        $this->author_email = "";
        $this->topic = "";
        $this->content = "";
    }

    public function getAll()
    {
        $query = "SELECT t.*, count(a.id) answer FROM thread t left JOIN answer a on t.id=a.thread_id group by t.id";

        return $this->getQueryResult($query);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM thread WHERE id=" . $id;

        return $this->getQueryResult($query)[0];
    }

    public function search($q)
    {
        $query = "SELECT t.*, count(a.id) answer"
                    . " FROM thread t left JOIN answer a on t.id=a.thread_id"
                    . " WHERE (t.topic LIKE \"%$q%\") OR (t.content LIKE \"%$q%\")"
                    . " group by t.id";

        return $this->getQueryResult($query);
    }

    public function insert($author, $authorEmail, $topic, $content)
    {
        $query = "INSERT INTO thread"
                    . " (`author`, `author_email`, `topic`, `content`)"
                    . " VALUES ('" . $author . "', '" . $authorEmail . "', '" . $topic . "', '" . $content . "')";

        $this->executeQuery($query);
    }

    public function update($id, $author, $authorEmail, $topic, $content)
    {
        $query = "UPDATE thread SET"
                    . " `author`='$author',"
                    . " `author_email`='$authorEmail',"
                    . " `topic`='$topic',"
                    . " `content`='$content'"
                    . " WHERE id='$id'";

        $this->executeQuery($query);
    }

    public function deleteById($id)
    {
        $query = "DELETE FROM thread WHERE id='$id'";

        $this->executeQuery($query);
    }

    public function upvote($id)
    {
        $query = "SELECT vote FROM thread WHERE id='$id'";
        $vote = $this->getQueryResult($query)[0]["vote"];
        $vote++;

        $query = "UPDATE thread SET vote='$vote' WHERE id='$id'";
        return $this->executeQuery($query);
    }

    public function downvote($id)
    {
        $query = "SELECT vote FROM thread WHERE id='$id'";
        $vote = $this->getQueryResult($query)[0]["vote"];
        $vote--;

        $query = "UPDATE thread SET vote='$vote' WHERE id='$id'";
        return $this->executeQuery($query);
    }
}