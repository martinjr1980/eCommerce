<?php

	class Item extends CI_Model
	{
		public function getItems()
		{
			$query = 'SELECT * FROM items ORDER BY created_at DESC';
			return $this->db->query($query)->result_array();
		}

		public function addProduct($data)
		{
			$query = 'INSERT INTO items (name, description, price, url, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())';
			$values = array($data['name'], $data['description'], $data['price'], "/assets/images/thumbnails/uploads/{$data['file_name']}");
			return $this->db->query($query, $values);
		}

		public function removeProduct($id)
		{
			$query = "DELETE FROM items WHERE id = {$id}";
			return $this->db->query($query);
		}

	}
