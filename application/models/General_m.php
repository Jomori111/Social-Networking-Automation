<?php

class General_m extends CI_Model
{

	function __construct()
    {
        parent::__construct();
    }

    public function get_company_list()
    {
    	$sql = "SELECT * FROM tbl_company";
    	$query = $this->db->query($sql);
        $result = $query->result_array();
        $data = array();
        foreach($result as $key => $row)
        {
            $res = [];
            $res['no'] = $key+1;
            $res['id'] = $row['id'];
            $res['name'] = $row['name'];

            array_push($data,$res);
        }
    	return $data;
    }

    public function get_company_image()
    {
    	$sql = "SELECT * FROM tbl_company_image";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }

    public function upload_company_name($data)
    {
    	$file = $data['file'];
		$file = str_replace("'", "''", "$file");
		$id = $data['id'];

    	$sql = "INSERT INTO tbl_company_image(company,path) VALUES(".$id.",'".$file."')";
    	$query = $this->db->query($sql);

    	$sql = "SELECT MAX(id) as id FROM tbl_company_image WHERE company = ".$id;
    	$query = $this->db->query($sql);
    	$result = $query->result_array();

    	$sql = "SELECT * FROM tbl_company_image WHERE id = ".$result[0]['id'];
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }

    public function get_company_message($id)
    {

    	$sql = "SELECT * FROM tbl_message WHERE company = ".$id;
    	$query = $this->db->query($sql);
        $data = array();
        $result = $query->result_array();
        foreach($result as $key => $res)
        {
            $row = array();
            $row['id'] = $res['id'];
            $row['no'] = $key+1;
            $row['name'] = $res['name'];
            $row['message'] = $res['message'];

            array_push($data,$row);
        }


    	return $data;
    }

    public function get_company_link($id)
    {
    	$sql = "SELECT * FROM tbl_link WHERE company = ".$id;
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }

    public function get_company_addon($id)
    {
    	$sql = "SELECT * FROM tbl_addon WHERE company = ".$id;
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }

    public function get_company_hash($id)
    {
    	$sql = "SELECT * FROM tbl_hash WHERE company = ".$id;
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }

    public function save_new_message($id,$message,$name)
    {
    	$message = str_replace("'", "''", "$message");
    	$sql = "INSERT INTO tbl_message(company,message,name) VALUES(".$id.",'".$message."','".$name."')";
    	$query = $this->db->query($sql);

    	return "success";
    }

    public function save_new_addon($id,$message,$name)
    {
    	$message = str_replace("'", "''", "$message");
    	$sql = "INSERT INTO tbl_addon(company,message,name) VALUES(".$id.",'".$message."','".$name."')";
    	$query = $this->db->query($sql);

    	return "success";
    }

    public function save_new_link($id,$new_nick,$new_link)
    {
    	$nick = str_replace("'", "''", "$nick");
    	$link = str_replace("'", "''", "$link");
    	
    	$sql = "INSERT INTO tbl_link(company,nick,link) VALUES(".$id.",'".$new_nick."','".$new_link."')";
    	$query = $this->db->query($sql);
    	return "success";
    }

    public function save_new_hash($id,$hash,$name)
    {
        $hash = str_replace("'", "''", "$hash");
    	$name = str_replace("'", "''", "$name");

    	$sql = "INSERT INTO tbl_hash(company,hash,name) VALUES(".$id.",'".$hash."','".$name."')";
    	$query = $this->db->query($sql);
    	return "success";
    }

    public function get_link_by_id($id)
    {
    	$sql = "SELECT * FROM tbl_link WHERE id = ".$id;
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }

    public function save_post($company,$image,$message,$link,$nick,$addon,$hash){
    	$message = str_replace("'", "''", "$message");
    	$nick = str_replace("'", "''", "$nick");
    	$link = str_replace("'", "''", "$link");
    	$addon = str_replace("'", "''", "$addon");
    	$hash = str_replace("'", "''", "$hash");

    	$sql = "INSERT INTO tbl_post(company,image,message,link,nick,addon,hash) VALUES(".$company.",'".$image."','".$message."','".$link."','".$nick."','".$addon."','".$hash."')";
    	$query = $this->db->query($sql);


        $sql = "SELECT MAX(id) as id FROM tbl_post";
        $query = $this->db->query($sql);
        $result = $query->result_array();

        $this->session->set_userdata("post_id",$result[0]['id']);
    	return "success";
    }

    public function update_company_name($data)
    {
        $sql = "UPDATE tbl_company SET name = '".$data['name']."' WHERE id = ".$data['id'];
        $query = $this->db->query($sql);
        return "success";
    }

    public function insert_company($name)
    {
        $name = str_replace("'", "''", "$name");

        $sql = "INSERT INTO tbl_company(name) VALUES('".$name."')";
        $query = $this->db->query($sql);
        return "success";
    }

    public function get_company_social_info($id)
    {
        $sql = "SELECT * FROM tbl_company WHERE id = ".$id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function save_company_linkedin_info($token,$profile)
    {
        $company = $this->session->userdata("company");
        $sql = "UPDATE tbl_company SET linkedin_token = '".$token."',linkedin_id = '".$profile."' WHERE id = ".$company;
        $query = $this->db->query($sql);
        return "success";
    }

    public function get_post_content($id)
    {
        $sql = "SELECT tp.message,tp.link,tci.path,tp.hash,tp.addon,tp.company FROM tbl_post as tp LEFT JOIN tbl_company_image as tci ON tci.id = tp.image WHERE tp.id = ".$id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function save_company_twitter_info($access_token)
    {
        $id = $this->session->userdata("company");
        $sql = "UPDATE tbl_company SET twitter_token = '".$access_token['oauth_token']."', twitter_token_secret = '".$access_token['oauth_token_secret']."' WHERE id = ".$id;
        $query = $this->db->query($sql);
        return "success";
    }

    public function get_post_data()
    {
        $sql = "SELECT tp.id,tp.message,tp.link,tci.path,tp.hash,tp.addon FROM tbl_post as tp LEFT JOIN tbl_company_image as tci ON tci.id = tp.image";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function insert_message($id,$message)
    {
        $message = str_replace("'", "''", "$message");
        $sql = "INSERT INTO tbl_message(message,company) VALUES('".$message."',".$id.")";
        $query = $this->db->query($sql);
        return "success";
    }

    public function update_message_list($data)
    {
        $message = $data['message'];
        $name = $data['name'];
        $message = str_replace("'", "''", "$message");
        $sql = "UPDATE tbl_message SET message = '".$message."',name = '".$name."' WHERE id = ".$data['id'];
        $query = $this->db->query($sql);
        return "success";
    }

    public function delete_message_list($id)
    {
        $sql = "DELETE FROM tbl_message WHERE id = ".$id;
        $query = $this->db->query($sql);
        return "success";
    }


    public function insert_link($id,$nick,$link)
    {
        $nick = str_replace("'", "''", "$nick");
        $link = str_replace("'", "''", "$link");
        $sql = "INSERT INTO tbl_link(nick,link,company) VALUES('".$nick."','".$link."',".$id.")";
        $query = $this->db->query($sql);
        return "success";
    }

    public function update_link_list($data)
    {
        $link = $data['link'];
        $link = str_replace("'", "''", "$link");
        $nick = $data['nick'];
        $nick = str_replace("'", "''", "$nick");

        $sql = "UPDATE tbl_link SET link = '".$link."',nick = '".$nick."' WHERE id = ".$data['id'];
        $query = $this->db->query($sql);
        return "success";
    }

    public function delete_link_list($id)
    {
        $sql = "DELETE FROM tbl_link WHERE id = ".$id;
        $query = $this->db->query($sql);
        return "success";
    }




    public function insert_hash($id,$hash)
    {
        $hash = str_replace("'", "''", "$hash");
        $sql = "INSERT INTO tbl_hash(hash,company) VALUES('".$hash."',".$id.")";
        $query = $this->db->query($sql);
        return "success";
    }

    public function update_hash_list($data)
    {
        $hash = $data['hash'];
        $name = $data['name'];
        $hash = str_replace("'", "''", "$hash");
        $name = str_replace("'", "''", "$name");
        $sql = "UPDATE tbl_hash SET hash = '".$hash."',name = '".$name."' WHERE id = ".$data['id'];
        $query = $this->db->query($sql);
        return "success";
    }

    public function delete_hash_list($id)
    {
        $sql = "DELETE FROM tbl_hash WHERE id = ".$id;
        $query = $this->db->query($sql);
        return "success";
    }





    public function insert_addon($id,$addon)
    {
        $addon = str_replace("'", "''", "$addon");
        $sql = "INSERT INTO tbl_addon(message,company) VALUES('".$addon."',".$id.")";
        $query = $this->db->query($sql);
        return "success";
    }

    public function update_addon_list($data)
    {
        $addon = $data['addon'];
        $name = $data['name'];
        $addon = str_replace("'", "''", "$addon");
        $name = str_replace("'", "''", "$name");
        $sql = "UPDATE tbl_addon SET message = '".$addon."',name = '".$name."' WHERE id = ".$data['id'];
        $query = $this->db->query($sql);
        return "success";
    }

    public function delete_addon_list($id)
    {
        $sql = "DELETE FROM tbl_addon WHERE id = ".$id;
        $query = $this->db->query($sql);
        return "success";
    }

    public function add_additional_text($linkedin,$facebook,$twitter,$instagram)
    {
        $sql = "INSERT INTO tbl_social_additional(linkedin,facebook,twitter,instagram) VALUES('".$linkedin."','".$facebook."','".$twitter."','".$instagram."')";
        $query = $this->db->query($sql);
        return "success";
    }

    public function get_additional_text()
    {
        $sql = "SELECT * FROM tbl_social_additional";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function save_instagram_info($data)
    {
        // $sql = "UPDATE tbl_company SET "
    }

    public function save_company_facebook_info($token)
    {
        $id = $this->session->userdata("company");
        $sql = "UPDATE tbl_company SET facebook_token = '".$token."' WHERE id = ".$id;
        $query = $this->db->query($sql);
        return "success";
    }
}


?>

