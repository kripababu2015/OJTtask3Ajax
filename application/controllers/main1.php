<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main1 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	/**
 * Super Class
 *
 * @package	Package Name
 * @subpackage	Subpackage
 * @category	Category
 * @author	Kripa Babu
 *@date 02/03/2021
 * @link	http://localhost/ojttask3/


 */
	/*
	*@function name:index page
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
	
	public function index()
	{
		$this->load->view('login');
	}
	

/*
	*@function name:registration page 
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
	
	
	
	public function register()
	{
		$this->load->view('reg');
	}


 /*
	*@function name:AJAX email availability
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
public function email_availibility()  
      {  
      	 if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  

           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
           }  
           else  
           {  
                $this->load->model("mainmodel1");  
                if($this->mainmodel1->is_email_available($_POST["email"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }  
       

      }
      /*
	*@function name:AJAX phone number availability
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
      public function phno_availability()
      {

                $this->load->model("mainmodel1");  
                if($this->mainmodel1->is_phno_available($_POST["phno"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Phone number Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           } 

            /*
	*@function name:AJAX Email availability
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
      public function uname_availability()
      {

                $this->load->model("mainmodel1");  
                if($this->mainmodel1->is_uname_available($_POST["uname"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> user name Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           } 
      

       /*
	*@function name:registration insertion
	* @author	Kripa Babu
	*@date 02/03/2021

	*/

	
	public function regi()
	{
		//$this->load->helper(array('form', 'url'));
		
		$this->load->library("form_validation");
		$this->form_validation->set_rules("fname","name",'required');
		$this->form_validation->set_rules("lname","last name",'required');
		$this->form_validation->set_rules("email","email",'required');

		
		  
           
          
		$this->form_validation->set_rules("phno","phone number",'required');
		$this->form_validation->set_rules("dob","date of birth",'required');
		$this->form_validation->set_rules("address","address",'required');
		$this->form_validation->set_rules("district","district",'required');
		$this->form_validation->set_rules("pin","pin",'required');
		
		$this->form_validation->set_rules("uname","user name",'required');
		
		$this->form_validation->set_rules("password","password",'required');

		
		if($this->form_validation->run())
		{
			
			$this->load->model('mainmodel1');	
		$pass=$this->input->post("password");
		$encpass=$this->mainmodel1->encpswd($pass);
		$a=array("fname"=>$this->input->post("fname"),
				"lname"=>$this->input->post("lname"),
				"email"=>$this->input->post("email"),
				"phno"=>$this->input->post("phno"),
				"dob"=>$this->input->post("dob"),
				"address"=>$this->input->post("address"),
				"district"=>$this->input->post("district"),
				"pin"=>$this->input->post("pin"),
				
				"uname"=>$this->input->post("uname"),
				"password"=>$encpass,'status'=>'0','utype'=>'0');
		
		$this->mainmodel1->regi($a);
		redirect(base_url().'main1/register');
		}
		
		
	}
	
	 /*
	*@function name:view page  Approval/reject/delete
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
	
	public function viewregap()
	{
		if($_SESSION['logged_in']==true && $_SESSION['utype']=='1')
        {

		$this->load->model('mainmodel1');
		$data['n']=$this->mainmodel1->viewt();
		$this->load->view('viewregap',$data);
		}
        else
        {
             redirect(base_url().'main/index');
        }
		

	}

	 /*
	*@function name: Approval action
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
	
	public function approve()
	{
		if($_SESSION['logged_in']==true && $_SESSION['utype']=='1')
        {

		$this->load->model('mainmodel1');
		$id=$this->uri->segment(3);
		$this->mainmodel1->approve($id);
		redirect('main1/viewregap','refresh');
		}
        else
        {
             redirect(base_url().'main/index');
        }
		
		
	}

	 /*
	*@function name: Reject action
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
	public function reject()
	{
		if($_SESSION['logged_in']==true && $_SESSION['utype']=='1')
        {

		$this->load->model('mainmodel1');
		$id=$this->uri->segment(3);
		$this->mainmodel1->reject($id);
		redirect('main1/viewregap','refresh');
		}
        else
        {
             redirect(base_url().'main/index');
        }
		
		

		
	}
	 /*
	*@function name: Delete action
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
	public function delete()
	{
		if($_SESSION['logged_in']==true && $_SESSION['utype']=='1')
        {

		$this->load->model('mainmodel1');
		$id=$this->uri->segment(3);
		$this->mainmodel1->delete($id);
		redirect('main1/viewregap','refresh');
		}
        else
        {
             redirect(base_url().'main/index');
        }
		
		
	}

	 /*
	*@function name: Login
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
	public function login()
	{
		$this->load->view('login');

	}

 /*
	*@function name: Login Check
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
	public function logincheck()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("uname","uname",'required');
		$this->form_validation->set_rules("pass","password",'required');
		if($this->form_validation->run())
		{
		
			$this->load->model('mainmodel1');	
			$uname=$this->input->post("uname");
			$password=$this->input->post("pass");
			$a=$this->mainmodel1->logi($uname,$password);
			if($a)
			{
			$id=$this->mainmodel1->getuserid($uname);
			$user=$this->mainmodel1->getuser($id);
			$this->load->library(array('session'));
			$this->session->set_userdata(array('id'=>(int)$user->id,
				'status'=>$user->status,'utype'=>$user->utype,'logged_in'=>(bool)true));
			if($_SESSION['status']=='1' && $_SESSION['utype']=='1' && $_SESSION['logged_in']==true)
			{
				redirect(base_url().'main1/viewregap');
			}
			elseif($_SESSION['status']=='1' && $_SESSION['utype']=='0' && $_SESSION['logged_in']==true)
			{
				redirect(base_url().'main1/regupdate');
			}
			else
			{
				echo "waiting for approval";

			}
		}
		else
		{
			echo "invalid user";
		}
	}
	else
	{
		redirect(base_url().'main/reg');
	}
}


  /*
	*@function name: update profile and user home page
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
public function regupdate()
    {
       if($_SESSION['logged_in']==true && $_SESSION['utype']=='0' && $_SESSION['status']=='1')
        {
        
        $this->load->model('mainmodel1');
        $id=$this->session->id;
        $data['user_data']=$this->mainmodel1->regupdateform($id);
        $this->load->view('userupdate',$data);
        }
        else
        {
             redirect(base_url().'main1/index');
        }

    }
     /*
	*@function name: update action
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
    public function reguserupdate()
    {
        $a=array("fname"=>$this->input->post("fname"),
				"lname"=>$this->input->post("lname"),
				"email"=>$this->input->post("email"),
				"phno"=>$this->input->post("phno"),
				"dob"=>$this->input->post("dob"),
				"address"=>$this->input->post("address"),
				"district"=>$this->input->post("district"),
				"pin"=>$this->input->post("pin"));
        $this->load->model('mainmodel1');
       
        if($this->input->post("submit"))
        {
            $id=$this->session->id;
            $this->mainmodel1->regupdateform1($a,$id);
            redirect('main1/regupdate','refresh');
        }

    }
     /*
	*@function name: logout
	* @author	Kripa Babu
	*@date 02/03/2021

	*/
function logout()
{
    $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
    $this->session->sess_destroy();
    redirect(base_url().'main1/index');
}

 /*
	*@function name: forgot password view 
	* @author	Kripa Babu
	*@date 03/03/2021

	*/
		public function forgotpswd()
	{
		$this->load->view('forgotpswd');
	}
	

 public function ForgotPassword()
{
	$this->load->model('mainmodel1');
    $email = $this->input->post('email');
    $findemail = $this->mainmodel1->ForgotPassword($email);
    if ($findemail) {
        $this->mainmodel1->sendpassword($findemail);
    } else {
        echo "<script>alert(' $email not found, please enter correct email id')</script>";
        redirect(base_url() . 'main1/login', 'refresh');
    }
}
}