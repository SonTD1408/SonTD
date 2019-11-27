<?php

/**
 * Class NewsModel
 * Dùng để lấy dữ liệu từ database.
 * Bắt buộc extends từ CI_Model
 */
class NewsModel extends CI_Model {

    /**
     * Hàm này bắt buộc phải có khi tạo Model
     * NewsModel constructor.
     */
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Hàm getNews
     * @param bool $id
     * @return mixed
     */
    public function getNews($id = false)
    {
        /**
         * Có 2 cách viết query đều ra một kết quả tương đương nhau
         * Cách 1 là viết theo MYSQL query
         * Cách 2 là viết theo framework CI
         * Recommend dùng cách 1
         */
        if ($id === false)
        {
            //$queryCach2 = $this->db->get('news');
            $query = $this->db->query('SELECT * FROM `news`');
            //Chú ý hàm result_array luôn trả về một array kết quả query
            return $query->result_array();
        }
        //$queryCach2 = $this->db->get_where('news', array('id' => $id));
        $query = $this->db->query('SELECT * FROM `news` WHERE `id` = '.$id);
        //Chú ý hàm result_array luôn trả về kết quả query của phần tử đầu tiên
        return $query->row_array();
    }

    public function createNews($data){

    }
}