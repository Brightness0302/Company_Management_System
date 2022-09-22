<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    //View client page of add/edit/delete function
    public function index() {
        $companyid = $this->session->userdata('companyid');
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['projects'] = $this->home->alldatafromdatabase($companyid, 'project');
        $data['stocks'] = $this->home->alldatafromdatabase($companyid, 'stock');
        $data['invoices'] = $this->home->alldatafromdatabase($data['company']['id'], "invoice");
        $data['expenses'] = $this->home->alldatafromdatabase($companyid, 'expense_category');

        foreach ($data['projects'] as $key => $project) {
            $res = $this->home->databyid($project['client'], 'client');
            $data['projects'][$key]['client'] = $res['data'];
        }

        $session['menu']="Projects";
        $session['submenu']="pj_pm";
        $session['second-submenu']="";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/project/project/head');
        $this->load->view('dashboard/project/project/body');
        $this->load->view('dashboard/project/project/foot');
        $this->load->view('dashboard/project/project/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View projectpage of creating
    public function addproject() {
        $companyid = $this->session->userdata('companyid');
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['stocks'] = $this->home->alldatafromdatabase($companyid, 'stock');
        $data['expenses'] = $this->home->alldatafromdatabase($companyid, 'expense_category');
        $data['project'] = $this->project->productfromsetting($companyid, 'project');

        $session['menu']="Projects";
        $session['submenu']="prm";
        $session['second-submenu']="Add New Project";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/project/project/head');
        $this->load->view('dashboard/project/project/shead');
        $this->load->view('dashboard/project/project/addproject');
        $this->load->view('dashboard/project/project/foot');
        $this->load->view('dashboard/project/project/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View projectpage of editting
    public function editproject($project_id) {
        $companyid = $this->session->userdata('companyid');
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $project = $this->home->databyidfromdatabase($companyid, 'project', $project_id);
        if ($project['status']=='failed')
            return;
        $data['project'] = $project['data'];

        $res = $this->home->databyid($data['project']['client'], 'client');
        $data['project']['client'] = $res['data'];

        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['invoices'] = $this->home->alldatafromdatabase($data['company']['id'], "invoice");
        $data['stocks'] = $this->home->alldatafromdatabase($companyid, 'stock');
        $data['expenses'] = $this->home->alldatafromdatabase($companyid, 'expense_category');

        $session['menu']="Projects";
        $session['submenu']="prm";
        $session['second-submenu']="Edit Project";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/project/project/head');
        $this->load->view('dashboard/project/project/shead');
        $this->load->view('dashboard/project/project/editproject');
        $this->load->view('dashboard/project/project/foot');
        $this->load->view('dashboard/project/project/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }

    public function saveproject() {
        $companyid = $this->session->userdata('companyid');

        $name = $this->input->post('project_name');
        $client = $this->input->post('client_id');
        $value = $this->input->post('value');
        $vat = $this->input->post('vat');
        if (!isset($_GET['id'])) {
            $projectid = $this->project->createProject($companyid, $name, $client, $value, $vat);
            echo $projectid;
            return;
        }

        $id = $_GET['id'];
        $result = $this->project->saveProject($companyid, $id, $name, $client, $value, $vat);
        echo $result;
    }
    //Del project
    public function delproject($project_id) {
        $companyid = $this->session->userdata('companyid');

        echo $this->project->delProject($companyid, 'project', $project_id);
    }

    public function showdatabyproject() {
        $id = $_GET['id'];
        $companyid = $this->session->userdata('companyid');

        $material = $this->home->alldatafromdatabase($companyid, 'material');

        foreach ($data['supplier_materials'] as $index => $product) {
            $result = $this->supplier->getdatabyproductidfromdatabase($companyid, 'material_lines', $product['id']);
            $data['supplier_materials'][$index]['attached'] = false;

            $data['supplier_materials'][$index]['acq_subtotal_without_vat'] = $result['acq_subtotal_without_vat'];
            $data['supplier_materials'][$index]['acq_subtotal_vat'] = $result['acq_subtotal_vat'];
            $data['supplier_materials'][$index]['acq_subtotal_with_vat'] = $result['acq_subtotal_with_vat'];
            $data['supplier_materials'][$index]['selling_subtotal_without_vat'] = $result['selling_subtotal_without_vat'];
            $data['supplier_materials'][$index]['selling_subtotal_vat'] = $result['selling_subtotal_vat'];
            $data['supplier_materials'][$index]['selling_subtotal_with_vat'] = $result['selling_subtotal_with_vat'];
            $invoicename = $product['id'].".pdf";
            $path = "assets/company/attachment/".$companyname."/supplier/";
            if(file_exists($path.$invoicename)) {
                $data['supplier_materials'][$index]['attached'] = true;
            }
        }

        $data['expense_products'] = $this->home->alldatabycustomsettingfromdatabase($companyid, 'expense_product', 'projectid', $id);

        foreach ($data['expense_products'] as $index => $product) {
            $data['expense_products'][$index]['attached'] = false;
            $invoicename = $product['id'].".pdf";
            $path = "assets/company/attachment/".$companyname."/expense/";
            if(file_exists($path.$invoicename)) {
                $data['expense_products'][$index]['attached'] = true;
            }
        }

        $session['menu']="Projects";
        $session['submenu']="prm";
        $session['second-submenu']="Edit Project";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/project/project/head');
        $this->load->view('dashboard/project/project/shead');
        $this->load->view('dashboard/project/project/showdatabyproject');
        $this->load->view('dashboard/project/project/foot');
        $this->load->view('dashboard/project/project/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //If usersession is not exist, goto login page.
    public function check_usersession() {
        if($this->session->userdata('user')) {
            // do something when exist
            return true;
        } else{
            // do something when doesn't exist
            redirect('home/signview');
            return false;
        }
    }
};
