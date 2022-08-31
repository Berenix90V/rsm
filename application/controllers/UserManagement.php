
<?php
class UserManagement extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this -> load -> view('login');
        
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
	}
    
    public function login() {
        $username = $_POST['name'];
        $password = $_POST['password'];
        $this -> load -> database();
        
        if (isset($username) && isset($password) && $username != '' && $password != '') {
            
            $query = $this -> db -> get_where('users', array('USR_usrname' => $username ));
            $count = count($query -> result());
            $result = $query -> result();
            if ($count > 0 && password_verify( $password, $result[0] -> USR_usrpsw ) == 1) {
                $isLogged =  array('status' => 'true', 'username' => $username);
            } 
            $isLogged = json_encode($isLogged);
            echo $isLogged;            
        } 
    }
    
    public function startsession() {
        $CIdb = $this->CIdb();
        if ($_GET['u'] != '') { // ho aggiunto query al db x avere il ruolo dell'utente
            $CIdb->select('USR_ID, USR_usrname, USR_role')->from('users')->where('USR_usrname', $_GET['u']);
            $query = $CIdb->get()->result();
            foreach($query as $numb=>$usr){
                $role = $usr->USR_role;
                $usrid = $usr->USR_ID;
            }
            $CIdb->select('PE_ID, PE_USR_ID, PE_WAH_ID, PE_mainrep, PE_maincen, WAH_wahcategory, WAH_wahname')->from('permissions')->where('PE_USR_ID', $usrid);
            $CIdb->join('warehouses', 'permissions.PE_WAH_ID = warehouses.WAH_ID');
            $query = $CIdb->get()->result();
            $permissions = array();
            if(!empty($query)){
                foreach($query as $numb=>$usrper){
                    $cat = $usrper->WAH_wahcategory;
                    $id = $usrper->PE_WAH_ID;
                    $name = $usrper->WAH_wahname;
                    if($cat == 1){
                        $permissions['cen'][$id] = $name;
                    } elseif($cat == 2){
                        $permissions['rep'][$id] = $name;
                    }
                    foreach($usrper as $field=>$value){
                        if($field == 'PE_mainrep' && $value == 1){
                            $permissions['mainrep'][$id] = $name;
                        } elseif($field == 'PE_maincen' && $value == 1){
                            $permissions['maincen'][$id] = $name;
                        }
                    }
                }
            }
            
            session_start();
            $_SESSION['usrid'] = $usrid;
            $_SESSION['username'] = $_GET['u'];
            $_SESSION['userrole'] = $role;
            $_SESSION['permissions'] = $permissions;
            redirect(site_url());
        }
    }
    
    public function UserPassword() {
        //$user = $_GET['user'];
        $user = 3;
        $data['user'] = 3;
        $this -> load -> view('header');
        $this -> load -> view('editPassword', $data);
        $this -> load -> view('footer');
    }
    
    public function saveNewPassword() {
        $all = $_POST;
        iprint_r($all);
    }
    
    public function UserEdit() {
        $usrid = $_SESSION['usrid'];
        $this->load->helper('form');
        $this->load->model('ManageUser_model');

        $path = 'json/edit_profile.php';  // da mettere su
        $totarray = url_get_contents($path);
        $formarray = $totarray['profile'];
        //iprint_r($formarray);
              
        $formarray = $this->ManageUser_model->edit_profile($usrid, $formarray);

        // array to view
        $datatoview = array(
            'formarray' => $formarray,
            'siteurl' => 'UserManagement/UpdateProfile'
        );

        //titolo
        $titolo = 'Modifica profilo';
			$head_data = array(
				'titolo' => $titolo
			);

        $this->load->view('header', $head_data);
        //$this->load->view('useredit');
        $this->load->view('profileedit', $datatoview);
        $this->load->view('footer');
    
    }
    public function UpdateProfile(){
        $this->load->model('ManageUser_model');
        $data = $_POST;

        $path = 'json/edit_profile.php';  // da mettere su
        $totarray = url_get_contents($path);
        $formfields = $totarray['profile']['formfields'];

        $this->ManageUser_model->update_profile($data, $formfields);
                

        //titolo
        $titolo = 'Modifica profilo';
			$head_data = array(
				'titolo' => $titolo
			);

        $this->load->view('header', $head_data);
        //$this->load->view('useredit');
        $this->load->view('profileeditsubmit');
        $this->load->view('footer');

    }
    
    public function UserList() {
        $this->load->view('header');
        $this->load->view('UserList');
        $this->load->view('footer');
    }
    
    public function sessiondestroy() {
        session_destroy();
        redirect(site_url('UserManagement'));
    }

}