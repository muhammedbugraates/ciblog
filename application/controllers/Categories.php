<?php
	class Categories extends CI_Controller {
		public function index(){
			$data['title'] = 'Categories';

			$data['categories'] = $this->category_model->get_categories_with_count();

			$this->load->view('templates/header');
			$this->load->view('categories/index', $data);
			$this->load->view('templates/footer');
		}

		public function create(){
			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['title'] = 'Create Category';

			$this->form_validation->set_rules('name', 'Name', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('categories/create', $data);
				$this->load->view('templates/footer');
			}else{
				$this->category_model->create_category();

				// Set message
				$this->session->set_flashdata('category_created', 'Your category has been created');

				redirect('categories');
			}
		}

		public function posts($id, $offset = 0){
			// Pagination Config
			$config['base_url'] = base_url() . 'categories/posts/' . $id;
			$config['total_rows'] = $this->category_model->get_category_count($id);
			$config['per_page'] = 3;
			$config['uri_segment'] = 4;
			$config['attributes'] = array('class' => 'page-link');

			// Bootstrap Config
			$config['full_tag_open'] = '<ul class="pagination">';
		    $config['full_tag_close'] = '</ul>';
		    $config['num_tag_open'] = '<li class="page-item">';
		    $config['num_tag_close'] = '</li>';
		    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		    $config['cur_tag_close'] = '</a></li>';
		    $config['prev_tag_open'] = '<li class="page-item">';
		    $config['prev_tag_close'] = '</li>';
		    $config['first_tag_open'] = '<li class="page-item">';
		    $config['first_tag_close'] = '</li>';
		    $config['last_tag_open'] = '<li class="page-item">';
		    $config['last_tag_close'] = '</li>';
			
			// Init Pagination
			$this->pagination->initialize($config);

			$data['title'] = $this->category_model->get_category($id)->name;
			$data['posts'] = $this->post_model->get_posts_by_category($id, $config['per_page'], $offset);

			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
		}

		public function delete($id){
			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			// Check user owner - category_id
			if(!$this->category_model->check_user_owner_category($id)){
				redirect('categories');
			}

			$this->category_model->delete_category($id);

			// Set message
			$this->session->set_flashdata('category_deleted', 'Your category has been deleted');

			redirect('categories');
		}
	}