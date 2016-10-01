<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* Name: Api Model
*
* Author: 
* Karim Vaes
* storage@kvaes.be
*
* Copyright 2015 Karim Vaes
* 
* Released: tbd
* Build on: PHP5 or above and Codeigniter 3.0+
*/

class Storage_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Insert Metric METHOD
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	/**
	 * insert_metric
	 * @Input object
	 * 		$metric
	 *			['mbsec']
	 *			['iops']
	 *			['sizeiokbytes']
	 *			['latencyms']
	 *			['outstandingios']
	 *			['type']
	 *			['target']
	 * @Return 
	 *		result of active record insert
	 *
	 * @Example
	 *
     * <MBSec>99MB/s</MBSec>
     *   <IOPS>300.1</IOPS>
     *   <SizeIOKBytes>8</SizeIOKBytes>
     *   <LatencyMS>5</LatencyMS>
     *   <OutStandingIOs>1</OutStandingIOs>
     *   <Type>Random</Type>
     *   <Target>C:\test</Target>
     *   <Test>SmallIO</Test>
     * </data>
	 */
	public function insert_performance($metric)
	{
	    $data['metric_mbsec']   		= $metric['mbsec'];
		$data['metric_iops']   			= $metric['iops'];
		$data['metric_sizeiokbytes']   = $metric['sizeiokbytes'];
		$data['metric_latencyms']   	= $metric['latencyms'];
		$data['metric_outstandingios']  = $metric['outstandingios'];
		$data['metric_type']  			= $metric['type'];
		$data['metric_target']   		= $metric['target'];
		$data['metric_testname']   		= $metric['testname'];
		$data['metric_scenario']   		= $metric['scenario'];
		$data['metric_unixdate']   		= $metric['unixdate'];
		$data['metric_sysid_fk']   		= $metric['sysid'];
        return $this->db->insert('storage_performance', $data);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Insert System METHOD
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	/**
	 * insert_system
	 * @Input object
	 * 		$system
	 *			['name']
	 *			['os']
	 *			['api']
	 * @Return object
	 *		$system_sysid
	 *
	 * @Example
	 *
	 * <system>
	 *   <SystemName>$systemname</SystemName>
	 *   <OperatingSystemVersion>$operatingsystem</OperatingSystemVersion>
	 *   <TestScenario>Scenario01</TestScenario>
	 *   <Date>$unixdate</Date>
	 * </system>
	 */
	
	public function insert_system($system)
	{
	    $data['system_name']   			= $system['name'];
		$data['system_os']  			= $system['os'];
		$data['system_api_key']			= $system['api'];
		$data['system_private']			= $system['private'];
		$data['system_email']			= $system['email'];
		
		// Check if system is already known
		$sys_id = $this->find_system($system);
        
		// Unknown systems will be added
		if ($sys_id < 1) {
			$this->db->insert('storage_system', $data);
			$sys_id = $this->find_system($system);
			
			$message = "You can find your benchmarks on ; http://storage.kvaes.be/system/details/".$data['system_name']." Enjoy!";
			
			$this->load->library('email');
			$this->email->from('storage@kvaes.be', 'Storage Performance Benchmarker');
			$this->email->to($data['system_email']);
			$this->email->subject('Storage Performance Benchmark for '.$data['system_name']);
			$this->email->message($message);
			$this->email->send();
			
		}
		
		// Return Primary Key
		return $sys_id;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Find System METHOD
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	/**
	 * find_system
	 * @Input object
	 * 		$system
	 *			['name']
	 *			['api']
	 * @Return object
	 *		$system_sysid
	 *
	 */
	
	public function find_system($system)
	{
		$filter = array('system_name' => $system['name']);
		$this->db->where($filter);
		$this->db->limit(1);
		$query = $this->db->get('storage_system');
		$row = $query->row();
		if (!$row) {
			$return = 0;
		} else {
			$return = $row->system_sysid;
		}
		return $return;
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Validate API Key METHOD
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	/**
	 * validate_api_key
	 * @Input object
	 * 		$system
	 *			['name']
	 *			['api']
	 * @Return object
	 *		True/False
	 *
	 */
	
	public function validate_api_key($system)
	{
		return true; //temp
		
		$filter = array('system_api_key' => $system['api']);
		$this->db->where($filter);
		$this->db->limit(1);
		$query = $this->db->get('storage_system');
		$row = $query->row();
		if ($row->system_sysid < 1) {
			return false;
		} else {
			return true;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// List Private Systems METHOD
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	/**
	 * list_private_systems
	 * @Input object
	 * 		Email
	 * @Return object
	 *		$query
	 *
	 */
	
	public function list_private_systems($email)
	{
		$filter = array('system_email' => $email);
		$this->db->where($filter);
		$this->db->select('system_name');
		$query = $this->db->get('storage_system');
		return $query;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// List Systems METHOD
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	/**
	 * list_systems
	 * @Input object
	 * 		None
	 * @Return object
	 *		$query
	 *
	 */
	
	public function list_systems()
	{
		$filter = array('system_private' => 0);
		$this->db->where($filter);
		$this->db->select('system_name');
		$query = $this->db->get('storage_system');
		return $query;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// List Results METHOD
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	/**
	 * list_results
	 * @Input object
	 * 		$system_name
	 * @Return object
	 *		$query => 'metric_unixdate','metric_scenario'
	 *
	 */
	
	public function list_results($system_name)
	{
		$system['name'] = $system_name;
		$sys_id = $this->find_system($system);
		$filter = array('metric_sysid_fk' => $sys_id);
		$this->db->where($filter);
		$this->db->select('metric_unixdate, metric_scenario');
		#$this->db->group_by(metric_unixdate');
		$this->db->distinct();
		$query = $this->db->get('storage_performance');
		return $query;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// List Details METHOD
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	/**
	 * list_results
	 * @Input object
	 * 		$system_name, $unix_date
	 * @Return object
	 *		$query 
	 *
	 */
	
	public function list_details($system_name,$unix_date=null)
	{
		$system['name'] = $system_name;
		$sys_id = $this->find_system($system);
		if ($unix_date <> null) {
			$filter = array('metric_sysid_fk' => $sys_id, 'metric_unixdate' => $unix_date);
		} else {
			$filter = array('metric_sysid_fk' => $sys_id);
		}	
		$this->db->order_by('metric_mid', 'ASC');
		$this->db->where($filter);
		$query = $this->db->get('storage_performance');
		return $query;
	}
	
}

/* End of file Api_model.php */
/* Location: ./application/model/Api_model.php */
