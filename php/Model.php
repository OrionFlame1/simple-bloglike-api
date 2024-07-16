<?php
    class Model {
        private $db;
    
        private $params;
    
        public function __construct($db, $params) {
            $this->db = $db;
            $this->params = $params;
        }
    
        public function getPosts($db) {
            $results = $db->query(
                "SELECT h.id, h.title, h.content, h.posted_at, u.username 
                FROM homework h 
                JOIN users u ON h.user_id = u.id 
                ORDER BY posted_at DESC;"
            )->fetch_all();

            foreach($results as $result) {
                $data[] = [
                    "id" => $result[0],
                    "title" => $result[1],
                    "content" => $result[2],
                    "posted_at" => $result[3],
                    "username" => $result[4]
                ];
            }

            return $data ?? [];
        }
        
        public function getPost($db, $params) {
            $results = $db->query(
                "SELECT h.id, h.title, h.content, h.posted_at, u.username 
                FROM homework h 
                JOIN users u ON h.user_id = u.id 
                WHERE h.id = {$params['post_id']};"
            )->fetch_assoc();
    
            if($results) {
                $comments = $this->getCommentsByPostID($db, $params);
                $results['comments'] = $comments;
                return $results;
            }

            return [];
        }
    
        public function getCommentsByPostID($db, $params) {
            $results = $db->query(
                "SELECT u.username, c.content, c.posted_at 
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                WHERE c.homework_id = {$params['post_id']}
                ORDER BY posted_at DESC"
            )->fetch_all();

            foreach($results as $result) {
                $data[] = [
                    'username' => $result[0],
                    'content' => $result[1],
                    'posted_at' => $result[2]
                ];
            }

            return $data ?? [];
        }
    
        public function addPost($db, $params) {
            $query = $db->query(
                "INSERT INTO homework SET 
                user_id = {$params['user_id']}, 
                title = \"{$params['title']}\", 
                content = \"{$params['content']}\",
                posted_at = NOW()"
            );
    
            return;
        }
    
        public function addComment($db, $params) {
            $query = $db->query(
                "INSERT INTO comments SET
                content = \"{$params['content']}\",
                homework_id = {$params['post_id']},
                user_id = {$params['user_id']},
                posted_at = NOW()"
            );
    
            return;
        }
    
        public function login($db, $params) {
            // checking for empty fields
            if(empty($params['username'])) {
                return ['error' => 'Username field can\'t be empty'];
            }
    
            if(empty($params['password'])) {
                return ['error' => 'Password field can\'t be empty'];
            }
    
            // check if username exists
            $query = $db->query(
                "SELECT * FROM users
                 WHERE username = '{$params['username']}'"
            );
    
            if($query->num_rows == 0) {
                return ['error' => 'Username not found'];
            }
    
            // check if password is correct
            $query = $db->query(
                "SELECT id, username FROM users 
                WHERE username = '{$params['username']}'
                AND password = '{$params['password']}'"
            );
    
            if($query->num_rows == 0) {
                return ['error' => 'Wrong password'];
            }
            
            return ['success' => true, 'data' => $query->fetch_assoc()];
        }
    
        public function register($db, $params) {
            // checking for empty fields
            if(empty($params['email'])) {
                return ['error' => 'Email field can\'t be empty'];
            }
            if(empty($params['username'])) {
                return ['error' => 'Username field can\'t be empty'];
            }
            if(empty($params['password'])) {
                return ['error' => 'Password field can\'t be empty'];
            }
    
            // check if username or email exists already
            $query = $db->query(
                "SELECT * FROM users
                 WHERE username = '{$params['username']}' OR email = '{$params['email']}'"
            );
    
            if($query->num_rows != 0) {
                return ['error' => 'Username or Email already registered'];
            }
    
            $query = $db->query(
                "INSERT INTO users SET
                username = \"{$params['username']}\",
                email = \"{$params['email']}\",
                password = \"{$params['password']}\""
            );
            
            $query = $db->query(
                "SELECT id, username, email FROM users
                 WHERE username = '{$params['username']}' OR email = '{$params['email']}'"
            );
    
            if($query->num_rows != 0) {
                return ["success" => true, "data" => $query->fetch_assoc()];
            }
            
            return ["error" => "Registering failed"];
        }
    }

    
?>