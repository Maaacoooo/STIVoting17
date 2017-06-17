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


}