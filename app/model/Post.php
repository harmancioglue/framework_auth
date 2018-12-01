<?php

class Post extends BaseModel
{
    public function getPosts(){

        $query = "SELECT u.name, p.id as postId, p.title,p.body ,p.created_at FROM users u INNER JOIN posts p ON p.user_id = u.id ORDER BY p.created_at DESC ";
        $this->db->query($query);
        $posts = $this->db->getResultSet();

        return $posts;
    }

    public function addPost($data){
        $query = "INSERT INTO posts(user_id,title,body,created_at) VALUES (:user_id,:title,:body,NOW())";
        $this->db->query($query);

        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);

        $res = $this->db->execute();

        return $res;
    }

    public function updatePost($data)
    {
        $query = "UPDATE posts SET title =:title,body= :body WHERE id= :id";
        $this->db->query($query);

        $this->db->bind(':id',$data['id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);

        $res = $this->db->execute();

        return $res;
    }

    public function getPost($id)
    {
        $query = "SELECT posts.*,users.name FROM posts INNER JOIN users ON users.id = posts.user_id WHERE posts.id = :id";
        $this->db->query($query);

        $this->db->bind(':id', $id);

        $result = $this->db->getResult();

        return $result;

    }

    public function deletePost($id){
        $query = "DELETE FROM posts WHERE id = :id";

        $this->db->query($query);
        $this->db->bind(':id',$id);

        $res = $this->db->execute();

        return $res;
    }

}