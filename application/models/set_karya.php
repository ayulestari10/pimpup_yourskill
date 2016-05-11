<?php  

class Set_karya extends CI_Model{

	var $galerry_path;
	var $galerry_path_url;
	var $detail_url;

	public function __construct() {
		parent::__construct();

		$this->galerry_path = realpath(APPPATH .'../img_karya');
		$this->galerry_path_url = base_url().'img_karya/';
		$this->detail_url = base_url().'index.php/site/detail/';
	}

	function get_db(){
		 $q = $this->db->query("SELECT * FROM input_karya");

		 //while($q->num_rows() == 1){
		 	foreach($q->result() as $row){
		 		$data[] = $row;
		 	}
		// }
		 return $data;
	}

	function get_img(){
		$query = $this->db->query("SELECT img_karya FROM input_karya");

		foreach ($query->result() as $row){
			$data[] = $row;
		}

		return $data;
	}

	function validate(){
		$query = $this->db->query("SELECT * FROM user WHERE username='".$this->input->post('username')."' AND password='".md5($this->input->post('password'))."' LIMIT 1");

		$baris = $query->num_rows();

		if($baris ==1){
			foreach ($query->result() as $row) {
				$role = $row->role;
			}
			$this->session->set_userdata('role', $role);
			return true;
		}
	}

	function create_member(){- 
		$is_member = $this->input->post('member');
		if ($is_member) {
			$role = "member";
		} else {
			$role = "admin";
		}

		$data = array(
			'username' 		=> $this->input->post('username'),
			'email' 		=> $this->input->post('email'),
			'password' 		=> md5($this->input->post('password')),
			'role'			=> $role
		);

		$insert= $this->db->insert('user', $data);
		return $insert;
	}

	function add_input($data){
		$this->db->query('INSERT INTO input_karya(nama,jurusan,nama_karya,kategori_karya,jenis_karya,img_karya,url_karya,detail_karya) VALUES ("'.$this->input->post("nama").'", "'.$this->input->post("jurusan").'","'.$this->input->post("nama_karya").'","'.$this->input->post("kategori_karya").'","'.$this->input->post("jenis_karya").'", "'.$this->input->post("img_karya").'","'.$this->input->post("url_karya").'","'.$this->db->escape($this->input->post("detail_karya")).'")');

		$data_terakhir = $this->db->query('SELECT * FROM input_karya ORDER BY id_karya DESC LIMIT 1');
		foreach ($data_terakhir->result() as $row) {
			$id_karya = $row->id_karya;
		}

		$this->do_upload($id_karya);

		$this->db->query("UPDATE input_karya SET img_karya='".$id_karya.".png' WHERE id_karya=".$id_karya);
		return;
	}

	function do_upload($id){

		$config = array (
			'file_name' => $id . '.png',
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->galerry_path,
			'max_size' => 2000
		);

		$this->load->library('upload', $config);
		$this->upload->do_upload();	
		$image_data= $this->upload->data();

		$config = array (
			'source_image' => $image_data['full_path'],
			'new_image' => $this->galerry_path.'/carousel',
			'maintain_ratio' => true,
			'width' => 1024,
			'height' => 700,
		);

		$this->load->library('image_lib', $config);
		$this->image_lib -> resize(); 
	
	}

	function get_images(){
		$files = scandir($this->galerry_path);
		$files = array_diff($files, array('.','..','thumbs'));

		$images = array();
		foreach ($files as $file){
			$images[] = array (
				'url' => $this->galerry_path_url . $file,
				'thumb_url' => $this->galerry_path_url . 'thumbs/'. $file
			);
		}
		return $images;
	}

	function detail_id(){
		$query = $this->db->query("SELECT * FROM input_karya WHERE id_karya='index.php/site/tampilan/'". $this->uri->segment(3));	
		return $query->result();
	
	}

	public function get_data($id) {
		$query = $this->db->query("SELECT * FROM input_karya WHERE id_karya=".$id." LIMIT 1");
		return $query->result();
	}

	public function update(){
		$id_karya = $this->input->post('id_karya');
		$nama = $this->input->post('nama');
		$jurusan = $this->input->post('jurusan');
		$nama_karya = $this->input->post('nama_karya');
		$kategori_karya = $this->input->post('kategori_karya');
		$jenis_karya = $this->input->post('jenis_karya');
		$detail_karya = $this->input->post('detail_karya');
	
		$this->db->query("UPDATE input_karya SET nama='".$nama."', jurusan='".$jurusan."', nama_karya='".$nama_karya."', kategori_karya='".$kategori_karya."', jenis_karya='".$jenis_karya."', detail_karya='".$detail_karya."' WHERE id_karya=".$id_karya);
	}

}

?>