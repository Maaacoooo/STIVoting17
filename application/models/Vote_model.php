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