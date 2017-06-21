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
 * ----------------------------------------------------------------------------
 * ----------------------------------------------------------------------------
 * 
 * VOTE PASS / VOTE KEYS
 *
 * ---------------------------------------------------------------------------
 */
    /**
     * Verifies the validity or existence of the vote pass
     * @param  String   $pass   the vote pass
     * @return boolean          TRUE if pass exist
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

    /**
     * This verifies the votepass if it is used or not
     * @param  String   $pass   the vote pass
     * @return boolean          TRUE if is_used
     */
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

    /**
     * [generate_key description]
     * @param  int      $key     the number of keys to be generated
     * @return boolean           it actually returns TRUE all the time. This could be VOID.
     */
    function generate_key($key) {       
        for ($x=1;$x<=$key;$x++) { 

            $data = array(              
                'key' => random_string('alnum', 6)  
             );
       
            $this->db->insert('vote_keys', $data);
        }  
        return TRUE;       
    }

    /**
     * This Clears the vote_key table
     * @return [void] [just a wild action]
     */
    function clear_votekeys() {
        $this->db->empty_table('vote_keys');
    }

    /** 
     * @param [String] $[str] [< 'Identifier of the query; all' = return all;>]
     * @return [Integer] [<Returns an Integer>]
     */
    
    function fetch_votepass($str) {
       
       if($str == 'all') {
            $query = $this->db->get('vote_keys');
            
        } else {
            $this->db->where('is_used', $str);
            $query = $this->db->get('vote_keys');            
        }

        return $query->result_array();
        
    }

    /** 
     * @param [String] $[str] [< 'Identifier of the query; all' = return all;>]
     * @return [Integer] [<Returns an Integer>]
     */
    
    function count_votepass($str) {

        if($str == 'all') {
            return $this->db->count_all_results('vote_keys');
        } else {
            $this->db->where('is_used', $str);
            return $this->db->count_all_results('vote_keys');
        }

    }

    ////////////////////////////////////////////////////////////////////////////////////


    /**
     * ------------------------------------------------------------------------------------------
     * ------------------------------------------------------------------------------------------
     * VOTES 
     *
     *-------------------------------------------------------------------------------------------
     */
    
    /**
     * This Clears the votes table
     * @return [void] [just a wild action]
     */
    function clear_votes() {
        $this->db->empty_table('votes');
    }


   


}