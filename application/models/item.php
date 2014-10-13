<?php

	class Item extends CI_Model
	{
		public function getItems()
		{
			$query = 'SELECT * FROM items';
			return $this->db->query($query)->result_array();
		}
	}
