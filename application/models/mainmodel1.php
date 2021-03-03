<?php
class mainmodel1 extends CI_model
{
	//work

	//data insertion 
		public function regi($a)
		{

		$this->db->insert("registration",$a);

		}

		//password encryption
		public function encpswd($pass)
			{
				return password_hash($pass, PASSWORD_BCRYPT);
			}


			function is_email_available($email)  
      {  
           $this->db->where('email', $email);  
           $query = $this->db->get("registration");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }  
      public function is_phno_available($phno)  
      {  
           $this->db->where('phno', $phno);  
           $query = $this->db->get("registration");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      } 
      public function is_uname_available($uname)
       {  
           $this->db->where('uname', $uname);  
           $query = $this->db->get("registration");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      } 

     

			//view user details 
		public function viewt()
			{
				$this->db->select('*');
				$qry=$this->db->get("registration");
				return $qry;

			}

			//approval
	public function approve($id)
	{
		$this->db->set('status','1');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("registration");
		return $qry;
	}

	//reject
	public function reject($id)
	{
		$this->db->set('status','2');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("registration");
		return $qry;
	}

//delete
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete("registration");
	}


//login

	public function logi($uname,$pass)
	{
		$this->db->select('password');
		
		$this->db->where("uname=","$uname");
		$this->db->or_where("email=","$uname");
		$this->db->or_where("phno=","$uname");
		
		$this->db->from('registration');
		$qry=$this->db->get()->row("password");
		return $this->verifypas($pass,$qry);
	}
	public function verifypas($pass,$qry)
	{
		return password_verify($pass,$qry);
	}
	public function getuserid($uname)
	{
		$this->db->select('id');
		$this->db->from("registration");
		$this->db->where("uname=","$uname");
		$this->db->or_where("email=","$uname");
		$this->db->or_where("phno=","$uname");
		
		return $this->db->get()->row('id');
	}
	public function getuser($id)
	{
		$this->db->select('*');
		$this->db->from("registration");
		$this->db->where("id",$id);
		return $this->db->get()->row();
	}

//User profile updation
public function regupdateform($id)

{
$this->db->select('*');

$qry=$this->db->where("id",$id);
$qry=$this->db->get("registration");
return $qry;
}
public function regupdateform1($a,$id)
{
        $this->db->select('*');
        $qry=$this->db->where("id",$id);
        $qry=$this->db->update("registration",$a);
        return $qry;


}



//funtion to get email of user to send password
  public function ForgotPassword($email)
{
    $this->db->select('email');
    $this->db->from('registration');
    $this->db->where('email', $email);
    $query=$this->db->get();
    return $query->row_array();
}
 public function sendpassword($data)
{
    $email = $data['email'];
    $query1=$this->db->query("SELECT *  from registration where email = '".$email."' ");
    $row=$query1->result_array();
    if ($query1->num_rows()>0)
{
        $passwordplain = "";
        $passwordplain  = rand(999999999,9999999999);
        $newpass['password'] = md5($passwordplain);
        $this->db->where('email', $email);
        $this->db->update('registration', $newpass);
        // $mail_message='Dear '.$row[0]['name'].','. "\r\n";
        // $mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
        // $mail_message.='<br>Please Update your password.';
        // $mail_message.='<br>Thanks & Regards';
        // $mail_message.='<br>Your company name';
        // require 'PHPMailerAutoload.php';
        // require 'class.phpmailer.php';
        // $mail = new PHPMailer;
        // $mail->IsSendmail();
        // $mail->isSMTP();
        // $mail->SMTPAuth = true;
        // $mail->Host = "hostname";
        // $subject = 'Testing Email';
        // $mail->AddAddress($email);
        // $mail->IsMail();
        // $mail->From = 'admin@***.com';
        // $mail->FromName = 'admin';
        // $mail->IsHTML(true);
        // $mail->Subject = $subject;
        // $mail->Body    = $mail_message;
        $subject = "reset ypur password";
        $message= "Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>".$passwordplain.'</b>';
        mail($email, $subject, $message);

//         $mail->Send();
//         if (!$mail->send()) {

//             echo "<script>alert('msg','Failed to send password, please try again!')</script>";
//         } else {

//             echo "<script>alert('msg','Password sent to your email!')</script>";
//         }
//         redirect(base_url().'main1/login','refresh');
//     }
//     else
//     {

//         echo "<script>alert('msg','Email not found try again!')</script>";
//         redirect(base_url().'main1/login','refresh');
//     }
// }
    }}


}
?>