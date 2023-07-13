<?php

class PostModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getPosts() {
        $this->db->query('SELECT *, posts.id AS postID FROM posts
                      INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at');
        return $this->db->resSet();
    }

    public function getUserFromPostId($id) {
        $this->db->query('SELECT user_id FROM posts WHERE posts.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->resSingle()->user_id;
    }

    public function getPost($id) {
        $this->db->query('SELECT *, posts.id AS postID FROM posts
                      INNER JOIN users ON posts.user_id = users.id WHERE posts.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->resSingle();
    }

    public function createPost($data) {
        $this->db->query('INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        return $this->db->execute();
    }

    public function editPost($data) {
        $this->db->query('UPDATE posts SET title = :title, body = :body  WHERE id = :post_id');
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        return $this->db->execute();
    }

    public function deletePost($id) {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
