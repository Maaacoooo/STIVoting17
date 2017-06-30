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
Class Settings_model extends CI_Model
{


    /**
     * This fetches the row data from the Settings table as requested
     * @param  String        $id     The Unique Key or ID
     * @return String Array          The array of row
     */
    function page($id) {

             $this->db->select('*');        
             $this->db->where('key', $id);          

             $query = $this->db->get('settings');

             return $query->row_array();

    }

    /**
     * This fetches all the results from the Settings table as requested
     * @param  String        $grp    The settings_grp 
     * @return String Array          The array of results
     */
    function fetch_pages($grp) {

             $this->db->select('*');        
             $this->db->where('setting_grp', $grp);          

             $query = $this->db->get('settings');

             return $query->result_array();
    }


    function update_page($key) {

            $data = array(             
                'title'     => $this->input->post('title'),  
                'value'     => $this->input->post('value')        
             );
            
            $this->db->where('key', $key);
            return $this->db->update('settings', $data);     
    }
     

}