<?php

class PostModel extends CI_Model {
    const TABLE_NAME = 'post';

    public function __construct()
    {
        $this->load->database();
    }

    public function getPost($id = false)
    {
        if ($id === false)
        {
            $query = $this->db->query('SELECT * FROM `post`');
            //Chú ý hàm result_array luôn trả về một array kết quả query
            return $query->result_array();
        }
        $query = $this->db->query('SELECT * FROM `post` WHERE `id` = '.$id);
        //Chú ý hàm result_array luôn trả về kết quả query của phần tử đầu tiên
        return $query->row_array();
    }

    /**
     * @param $data
     * Data có dạng key-value
     */
    public function createPost($data){
        $postTitle = $data['title'];
        $postContent = $data['content'];
        $adminUserName = $this->getAdminUsername();
        $queryString = "INSERT INTO `post` (`title`, `content`, `username`) VALUES ('$postTitle', '$postContent', '$adminUserName')";
        $query = $this->db->query($queryString);
        if($query){
            return true;
        }
        return false;
    }

   public function changePost($data){
    	var_dump();
    	$id=$data['id'];
    	$ok1=0;
    	$ok2=0;
    	if($data['title']!='')
		{
			$postTitle=$data['title'];
			$sql="update `post` set title='$postTitle' where id='$id'";
			$query=$this->db->query($sql);
			$ok1=1;
		}
    	if ($data['content']!='') {
			$postContent = $data['content'];
			$sql="update `post` set content='$postContent' where id='$id'";
			$query=$this->db->query($sql);
			$ok2=1;
		}
    	if($ok1 && ok2){
    		return true;
		}
    	return false;
	}

	public function countrecord(){
    	$query=$this->db->query('select * from `post`');
		//return $query->row_array();
		$ha=$query->result_array();
		return count($ha);
	}

	public function get3dl($start, $limit)
	{
		$sql="select *from `post` limit ".$start.",".$limit;
		//return $sql;
		//echo $start.$limit;
		$query=$this->db->query($sql);
		return $query->result_array();
	}

    public function deletePost($postId){
        $queryString = "DELETE FROM `post` WHERE `post`.`id` = $postId";
        $query = $this->db->query($queryString);
        if($query){
            return true;
        }
        return false;
    }

    private function getAdminUsername(){
        session_start();
        return $_SESSION['admin_email'];
    }
}
