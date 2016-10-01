<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('api_index');
	}
	
	public function send()
	{
		//$this->load->view('api_send');
		$xmldata = file_get_contents('php://input');
		$xml=simplexml_load_string($xmldata) or die("Error: Cannot create object");
		
		// Load API Model
		$this->load->model('Storage_model');
		
		// Set System Data
		$SystemName 		= $xml->system[0]->SystemName;               
		$SystemOS 			= $xml->system[0]->OperatingSystemVersion;
		$SystemApiKey 		= $xml->system[0]->ApiKey;
		$TestScenario 		= $xml->system[0]->TestScenario;
		$Private	 		= $xml->system[0]->Private;
		$Email		 		= $xml->system[0]->Email;
		$TestDate 			= $xml->system[0]->Date;
		$system['name'] 	= $SystemName;
		$system['os']		= $SystemOS;
		$system['api']		= $SystemApiKey;
		$system['private']	= $Private;
		$system['email']	= $Email;
		
		// Validate API Key
		if (!$this->Storage_model->insert_system($system)) {
			echo "API Key invalid!";
			return false;
		}
		
		// Import System
		$sys_id = $this->Storage_model->insert_system($system);
		
		// Import Result Metrics
		foreach ($xml->data as $measurement) {		
			$metric['mbsec'] = $measurement->MBSec;
			$metric['iops'] = $measurement->IOPS;
			$metric['sizeiokbytes'] = $measurement->SizeIOKBytes;
			$metric['latencyms'] = $measurement->LatencyMS;
			$metric['outstandingios'] = $measurement->OutStandingIOs;
			$metric['type'] = $measurement->Type;
			$metric['target'] = $measurement->Target;
			$metric['scenario'] = $TestScenario;
			$metric['testname'] = $measurement->Test;
			$metric['unixdate'] = $TestDate;
			$metric['sysid'] = $sys_id;
			$this->Storage_model->insert_performance($metric);
		}
		
		echo "Data accepted";
	}
}
