<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* CHECK THE ADDON STATUS */
if (! function_exists('addon_status')) {
    function addon_status($unique_identifier = '') {
        $CI	=&	get_instance();
        $CI->load->database();
        $result = $CI->db->get_where('addons', array('unique_identifier' => $unique_identifier));
        if ($result->num_rows() > 0) {
            $result = $result->row_array();
            return $result['status'];
        }else{
            return 0;
        }
    }
}

/* CHECK IF THE STUDENT IS ELIGIBLE FOR DOWNLOADING THE CERTIFICATE */
if (! function_exists('certificate_eligibility')) {
    function certificate_eligibility($course_id = "", $user_id = "") {
        $CI	=&	get_instance();
        $CI->load->database();

        if ($user_id == "") {
            $user_id = $CI->session->userdata('user_id');
        }
        $result = $CI->db->get_where('certificates', array('course_id' => $course_id, 'student_id' => $user_id));
        if ($result->num_rows() > 0) {
            return 1;
        }else{
            return 0;
        }
    }
}

/* GET THE SHAREABLE LINK OF CERTIFICATE */
if (! function_exists('generate_certificate')) {
    function generate_certificate($course_id = "", $user_id = "") {
        $CI	=&	get_instance();
        $CI->load->database();

        if ($user_id == "") {
            $user_id = $CI->session->userdata('user_id');
        }
        $result = $CI->db->get_where('certificates', array('course_id' => $course_id, 'student_id' => $user_id))->row_array();
        return $result['shareable_url'];
    }
}

/* COUNT OFFLINE PAYMENT PENDING USER */
if (! function_exists('get_pending_offline_payment')) {
    function get_pending_offline_payment() {
        $CI =&  get_instance();
        $CI->load->database();

        $count_pending_payment = count($CI->db->get_where('offline_payment', array('status' => 0))->result_array());
        return $count_pending_payment;
    }
}





