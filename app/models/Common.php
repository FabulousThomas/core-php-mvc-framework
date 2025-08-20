<?php
class Common
{
    protected $db;

    public function __construct()
    {
        $this->db = new MySQL;
    }

    // INSERT
    public function insert($query, $params = [])
    {
        $this->db->query($query);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }
        return $this->db->execute();
    }

    // SELECT SINGLE
    public function selectSingle($query, $params = [])
    {
        $this->db->query($query);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }
        return $this->db->singleSet();
    }

    // SELECT ALL
    public function select($query, $params = [])
    {
        $this->db->query($query);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }
        return $this->db->resultSet();
    }

    // UPDATE
    public function update($query, $params = [])
    {
        $this->db->query($query);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }
        return $this->db->execute();
    }

    // DELETE
    public function delete($query, $params = [])
    {
        $this->db->query($query);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }
        return $this->db->execute();
    }
}
