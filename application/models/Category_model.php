<?php
	class Category_model extends CI_Model {
		public function __construct(){
			$this->load->database();
		}

		public function create_category(){
			$data = array(
				'name' => $this->input->post('name'),
				'user_id' => $this->session->userdata('user_id')
			);

			return $this->db->insert('categories', $data);
		}

		public function get_categories(){
			$this->db->order_by('name');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function get_category($id){
			$query = $this->db->get_where('categories', array('id' => $id));
			return $query->row();
		}

		public function get_category_count($category_id){
			$this->db->order_by('posts.id', 'DESC');
			$this->db->join('categories', 'categories.id = posts.category_id');
			$query = $this->db->get_where('posts', array('category_id' => $category_id));
			return $query->num_rows();
		}

		public function get_categories_with_count(){
			$this->db->select('categories.*, COUNT(posts.id) as count');
			$this->db->join('categories', 'posts.category_id = categories.id', 'right');
			$this->db->group_by('categories.id'); 
			// $this->db->order_by('categories.name');

			// Alternative feature order by count
			$this->db->order_by('count', 'desc');

			$query = $this->db->get_where('posts');
			return $query->result_array();
		}

		public function delete_category($id){
			$this->db->where('id', $id);
			$this->db->delete('categories');
			return true;
		}

		public function check_user_owner_category($id){
			// Validate
			$this->db->where('id', $id);
			$this->db->where('user_id', $this->session->userdata('user_id'));
			$result = $this->db->get('categories');

			if($result->num_rows() == 1){
				return true;
			}else{
				return false;
			}
		}
	}