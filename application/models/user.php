<?php

	class User extends CI_Model
	{
		public function addUser($user)
		{
			$query = 'INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())';
			$values = array($user['first_name'], $user['last_name'], $user['email'], $user['password']);  //use ? for input values to escape them and avoid SQL Injection!
			return $this->db->query($query, $values);
		}

		public function confirmUser($user)
		{
			$query = 'SELECT * FROM users WHERE email = ?';
			return $this->db->query($query, $user['email'])->row_array();
		}

		public function getUser($user)
		{
			$query = 'SELECT * FROM users WHERE email = ? AND password = ?';
			$values = array($user['email'], $user['password']);
			return $this->db->query($query, $values)->row_array();
		}

		public function addVisit($user)
		{
			$visits = $user['visits'] + 1;
			$query = 'UPDATE users SET visits = ? WHERE id = ?';
			$values = array($visits, $user['id']);
			return $this->db->query($query, $values);
		}
	}
