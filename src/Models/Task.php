<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Task
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllTasks()
    {
        $stmt = $this->db->query('SELECT * FROM tasks ORDER BY created_at DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createTask($title)
    {
        $stmt = $this->db->prepare('INSERT INTO tasks (title) VALUES (?)');
        return $stmt->execute([$title]);
    }

    public function toggleTask($id)
    {
        $stmt = $this->db->prepare('UPDATE tasks SET completed = NOT completed WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function deleteTask($id)
    {
        $stmt = $this->db->prepare('DELETE FROM tasks WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
