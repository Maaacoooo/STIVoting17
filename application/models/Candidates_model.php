<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright (c)2017, Jenmar "Maco" Cortes
 * Copyright TechDepot PH
 * All Rights Reserved
 * 
 * This license is a legal agreement between you and the Maco Cortes
 * for the use of STI Online Voting Systen referred to as the "Software"
 * By obtaining the Software you agree to comply with the terms and conditions of this license.
 *
 * PERMITTED USE
 * With approval from Maco Cortes, You are permitted to use the program for educational purposes only.
 * 
 * MODIFICATION AND REDISTRIBUTION 
 * Unless with written approval obtained from Maco Cortes, 
 * You are NOT allowed to modify, copy, redistribute, and sell the Software.
 *
 * For any concerns, you may reach Maco Cortes via:
 * maco.techdepot@gmail.com
 * facebook.com/Maaacoooo
 * maco@techdepot-ph.com
 * TechDepot-PH.com
 */
Class Candidates_model extends CI_Model
{


    // CANDIDATE MODULE ////////////////////////////////////////////////////////////////////

    /**
     * Saves a candidate record
     * @return boolean    returns TRUE if success
     */
    function create_candidate() { 

            $filename = ''; //img filename empty if not present

            //Process Image Upload
              if($_FILES['img']['name'] != NULL)  {        

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['encrypt_name'] = TRUE;                        

                $this->load->library('upload', $config);
                $this->upload->initialize($config);         
                
                $field_name = "img";
                $this->upload->do_upload($field_name);
                $data2 = array('upload_data' => $this->upload->data());
                foreach ($data2 as $key => $value) {     
                  $filename = $value['file_name'];
                }
                
            }
      
            $data = array(              
                'name'      => $this->input->post('name'),  
                'position'  => $this->input->post('position'),  
                'course'    => $this->input->post('course'),  
                'year'      => $this->input->post('year'),  
                'party'     => $this->input->post('party'),  
                'img'       => $filename  
             );
       
            return $this->db->insert('candidate', $data);          
            

    }
    
    /**
     * Deletes a candidate record
     * @param  int    $id    the DECODED id of the item.   
     * @return boolean    returns TRUE if success
     */
    function delete_candidate($id) {

        $filename = $this->read_candidate($id)['img'];

        if($filename) {
            unlink('./uploads/'.$filename); // Deletes the uploaded image if exist
        }

        return $this->db->delete('candidate', array('id' => $id)); 

    }


    /**
     * Updates a candidate record
     * @param  int      $id    the DECODED id of the item. 
     * @return void            returns TRUE if success
     */
    function update_candidate($id) { 

            $filename = $this->read_candidate($id)['img']; //gets the old data 

            //Process Image Upload
              if($_FILES['img']['name'] != NULL)  {        

                unlink('./uploads/'.$filename); //Deletes the old photo

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['encrypt_name'] = TRUE;                        

                $this->load->library('upload', $config);
                $this->upload->initialize($config);         
                
                $field_name = "img";
                $this->upload->do_upload($field_name);
                $data2 = array('upload_data' => $this->upload->data());
                foreach ($data2 as $key => $value) {     
                  $filename = $value['file_name'];
                }
                
            }
      
            $data = array(              
                'name'      => $this->input->post('name'),  
                'position'  => $this->input->post('position'),  
                'course'    => $this->input->post('course'),  
                'year'      => $this->input->post('year'),  
                'party'     => $this->input->post('party'),  
                'img'       => $filename  
             );
            
            $this->db->where('id', $id);
            return $this->db->update('candidate', $data);          
        
    }

    /**
     * @param  int      $id     the ID of the selected item
     * @return String Array     returns the Row Array
     */
    function read_candidate($id) {

            $this->db->select('*');        
            $this->db->where('id', $id);          
            $this->db->limit(1);

            $query = $this->db->get('candidate');

            return $query->row_array();
    }

    /**
     * Returns the paginated array of rows 
     * @param  int      $limit      The limit of the results; defined at the controller
     * @param  int      $id         the Page ID of the request. 
     * @return Array        The array of returned rows 
     */
    function fetch_candidates($limit, $id) {

            $this->db->select('*');
            $this->db->limit($limit, (($id-1)*$limit));

            $query = $this->db->get("candidate");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    /**
     * Returns the total number of rows of candidate title
     * @return int       the total rows
     */
    function count_candidates() {
        return $this->db->count_all("candidate");
    }



    //////////////////
    /// HELPERS /// //
    //////////////////


    /**
     * Returns the complete Array of row items of 'years' table
     * @return String Arr   The array of row items of the 'years' table
     */
    function years() {

            $this->db->select('*');
            $query = $this->db->get('year');

            return $query->result_array();

    }


    /**
     * Returns the complete Array of row items of 'course' table
     * @return String Arr   The array of row items of the 'course' table
     */
    function courses() {

            $this->db->select('*');
            $query = $this->db->get('course');

            return $query->result_array();

    }



    /**
     * Returns the complete Array of row items of 'party' table
     * @return String Arr   The array of row items of the 'party' table
     */
    function party() {

            $this->db->select('*');
            $query = $this->db->get('party');

            return $query->result_array();

    }

    
    /**
     * Returns the complete Array of row items of position table
     * @return String Arr   The array of row items of the position table
     */
    function positions() {

            $this->db->select('*');
            $query = $this->db->get('position');

            return $query->result_array();

    }





}