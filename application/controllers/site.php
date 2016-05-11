<?php  

class Site extends CI_Controller{
	function index(){
		$username = $this->session->userdata('username');
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role	= $this->session->userdata('role');

		//echo $username . " " . $is_logged_in . " " . $role;
		//exit;

		if(isset($username, $is_logged_in, $role)){
			if($role == 'member'){
				$this->load->model('set_karya');
				$data = array(
				'title' 	=> 'Input Karya',
				'content' 	=> 'input_karya'
				);
			//	echo "<h1>sdfjh world!!!!</h1>";
			} else{
				$this->load->model('set_karya');
				$data = array(
					'title' 	=> 'Admin Area',
					'content' 	=> 'admin_area'
				);
			//	echo "<h1>ioerjiog!!!!</h1>";
				//$this->inputk();
			}
		}else{
			//echo "<h1>Hello world!!!!</h1>";

				$this->load->model('set_karya');
				if($this->input->post('upload')){
					$this->set_karya->do_upload();
				}

				$this->load->library('pagination');
				$this->load->library('table');

				$config['base_url'] = 'http://karyailkom.azurewebsites.net/index.php/site/tampilan'; 
				$config['total_rows'] = $this->db->query("SELECT *FROM input_karya")->num_rows();
				if ($config['total_rows'] > 5) {
					$config['total_rows'] = $config['total_rows'] - 5;
				}
				$config['per_page'] = 8;
				$config['num_links'] = 20;
				$config['full_tag_open'] = '<div><ul class="pagination pagination-small pagination-centered">';
				$config['full_tag_close'] = '</ul></div>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";


				$this->pagination->initialize($config); 
				
				$data['records'] = $this->db->get('input_karya', $config['per_page'], $this->uri->segment(3));
				$data['pagination'] = $this->pagination->create_links();
				$data['table'] = $this->table->generate($data['records']);
				$data['images'] =  $this->set_karya->get_images();
				$data['page_data'] = $this->uri->segment(3);
				if (!isset($data['page_data'])) {
					$data['page_data'] = 0;
				} 

				$data['title'] = 'Karya Ilkom';
				$data['content'] = 'tampilan';
			}
			$this->load->view('includes/template',$data);
	}

	function inputk(){
		$this->load->model('set_karya');

		$data = array(
			'title' 		=> 'Input Karya',
			'content' 		=> 'input_karya'
		);
		$this->load->view('includes/template', $data);
	}

	function validate_credentials(){
		$this->load->model('set_karya');
		$query = $this->set_karya->validate();

		if($query)
		{
			$data= array(
				'username' => $this->input->post('username'),
				'is_logged_in' => true,
				'role'	=> $this->session->userdata('role')
			);

			$this->session->set_userdata($data);
			redirect('index.php/site/members_area');
		}
		else{
			$this->index();
		}
	}

	function create_member(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_rules('role', 'member', 'trim|required');

		if($this->form_validation->run()== TRUE){
			$this->signup();
		}
		else{
			$this->load->model('set_karya');
			if($query = $this->set_karya->create_member()){
				$this->index();	
			}
			else{
				echo 'apalah';
			}
		}
	}

	private function signup(){
		$this->load->model('set_karya');
		$this->set_karya->create_member();		
	}

	function members_area(){
		$username = $this->session->userdata('username');
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(isset($username, $is_logged_in)){
			$this->index();	
		}else{
			echo "please sign in first!";
		}
			 
	}

	function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('is_logged_in');
		$this->index();
	}

	function detail(){
		$this->load->model('set_karya');

		$data = array(
			'title' 		=> 'Detail Karya',
			'content' 		=> 'detail2',
			'url' 			=> $this->db->query("SELECT * FROM input_karya WHERE id_karya=".$this->uri->segment(3))
		);
		$this->load->view('includes/template', $data);
	}
	
	function tampilan(){
		$this->load->model('set_karya');
		if($this->input->post('upload')){
			$this->set_karya->do_upload();
		}

		$this->load->library('pagination');
		$this->load->library('table');

		$config['base_url'] = 'http://karyailkom.azurewebsites.net/index.php/site/tampilan'; 
		$config['total_rows'] = $this->db->query("SELECT *FROM input_karya")->num_rows();
		if ($config['total_rows'] > 5) {
			$config['total_rows'] = $config['total_rows'] - 5;
		}
		$config['per_page'] = 8;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div><ul class="pagination pagination-small pagination-centered">';
		$config['full_tag_close'] = '</ul></div>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";


		$this->pagination->initialize($config); 
		
		$data['records'] = $this->db->get('input_karya', $config['per_page'], $this->uri->segment(3));
		$data['pagination'] = $this->pagination->create_links();
		$data['table'] = $this->table->generate($data['records']);
		$data['images'] =  $this->set_karya->get_images();
		$data['page_data'] = $this->uri->segment(3);
		if (!isset($data['page_data'])) {
			$data['page_data'] = 0;
		} 

		$data['title'] = 'Karya Ilkom';
		$data['content'] = 'tampilan';
		$this->load->view('includes/template',$data);

	}

	function create(){
		$this->load->model('set_karya');
		$data = array (
			'nama' 			=> $this->input->post('nama'),
			'jurusan' 		=> $this->input->post('jurusan'),
			'nama_karya' 	=> $this->input->post('nama_karya'),
			'jenis_karya' 	=> $this->input->post('jenis_karya'),
			'img_karya' 	=> $this->input->post('userfile'),
			'detail_karya' 	=> $this->input->post('detail_karya')
		);
		$this->set_karya->add_input($data);
		$this->index();
	}

	public function delete() {
		$id_karya = $this->uri->segment(3);
		$this->db->query("DELETE FROM input_karya WHERE id_karya=".$id_karya);
		$this->index();
	}

	public function edit(){
		$id_karya = $this->uri->segment(3);
		$this->load->model('set_karya');
		$data_karya = $this->set_karya->get_data($id_karya);
		
		$data = array(
			'title' 	=> 'Edit Karya',
			'content' => 'edit_karya',
			'data_karya' => $data_karya					
		);
		$this->load->view('includes/template',$data);		
	}

	public function update() {
		$this->load->model('set_karya');
		$this->set_karya->update();
		$this->index();
	}
}
