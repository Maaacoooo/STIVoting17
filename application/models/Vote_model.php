<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Vote_model extends CI_Model
{

/**
 * This model controls all VOTE  related functionalties
 */

     function check_votepass($pass) {

             $this->db->select('*');        
             $this->db->where('key', $pass);          
             $this->db->limit(1);

             $query = $this->db->get('vote_keys');

             if($query->num_rows() == 1)   {

                return TRUE;
               
             }   else   {

                return FALSE;

             }

    }


    function verify_votepass($pass) {

             $this->db->select('*');        
             $this->db->where('key', $pass);     
             $this->db->where('is_used', 1);          
             $this->db->limit(1);

             $query = $this->db->get('vote_keys');

             if($query->num_rows() == 1)   {                
                
                return FALSE;
               
             }   else   {
                
                return TRUE;

             }

    }

    function generate_key($key) { 
      
            $data = array(              
                'key' => $key  
             );
       
       return $this->db->insert('vote_keys', $data);          
        
    }


    // CREATE DATA ////////////////////////////////////////////////////////////////////

    function create() { 
      
            $data = array(              
                'title' => $this->input->post('value')  
             );
       
       return $this->db->insert($this->encrypt->decode($this->input->post('key')), $data);          
        
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