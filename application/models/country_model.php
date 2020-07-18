<?php

class country_model extends CI_Model {


        public function __construct()
	{
		$this->load->database();
	}


        public function getEntries()
        {
                $this->db->order_by('Country_Code','ASC');
                $query = $this->db->get('tbl_country');
                return $query->result();
        }

        public function insert($data)
        {
               return $this->db->insert('tbl_country', $data);
        }

        public function delete($data)
        {
               $this->db->where('Country_Id',$data);
		      return $this->db->delete('tbl_country');
        }

        public function single_entry($id){
            $query = $this->db->get_where('tbl_country',array('Country_Id' => $id));
		    return $query->row_array();
        }

        public function update($data)
        {
            return $this->db->update('tbl_country', $data, array('Country_Id' => $data['Country_Id']));
        }

}

?>