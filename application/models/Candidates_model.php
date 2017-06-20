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
       
            return $this->db->insert('candidates', $data);          
        
    }
    
    /**
     * Deletes a candidate record
     * @param  int    $id    the DECODED id of the item.   
     * @return boolean    returns TRUE if success
     */
    function delete_candidate($id) {

        return $this->db->delete('candidates', array('id' => $id)); 

    }


    /**
     * Updates a candidate record
     * @param  int      $id    the DECODED id of the item. 
     * @return void            returns TRUE if success
     */
    function update_candidate($id) { 
      
            $data = array(              
                'name'      => $this->input->post('name'),  
                'position'  => $this->input->post('position'),  
                'course'    => $this->input->post('course'),  
                'year'      => $this->input->post('year'),  
                'party'     => $this->input->post('party'),  
                'img'       => $this->input->post('img')  
             );
            
            $this->db->where('id', $id)
            return $this->db->update('candidates', $data);          
        
    }

    /**
     * @param  int      $id     the ID of the selected item
     * @return String Array     returns the Row Array
     */
    function read_candidate($id) {

            $this->db->select('*');        
            $this->db->where('id', $id);          
            $this->db->limit(1);

            $query = $this->db->get('candidates');

            return $query->row_array();
    }




// DELETE DATA ////////////////////////////////////////////////////////////////////

    function delete() {

          return $this->db->delete($this->encrypt->decode($this->input->post('key')), array('id' => $this->encrypt->decode($this->input->post('id')))); 

    }

// UPDATE DATA ////////////////////////////////////////////////////////////////////
   
   function update(){

            $data = array(              
                'title' => $this->input->post('value')  
             );

          $this->db->where('id', $this->encrypt->decode($this->input->post('id')));
          return $this->db->update($this->encrypt->decode($this->input->post('key')), $data);

    }


}