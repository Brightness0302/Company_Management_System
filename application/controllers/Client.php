<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    //View client page of add/edit/delete function
    public function index() {
        $this->check_usersession();
        $company_name = $this->session->userdata('companyname');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['user'] = $this->session->userdata('user');
        $data['clients'] = $this->home->alldata('client');

        $session['menu']="Clients";
        $session['submenu']="cm";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/client/client/head');
        $this->load->view('dashboard/client/client/body');
        $this->load->view('dashboard/client/client/foot');
        $this->load->view('dashboard/client/client/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View invoice page of add/edit/delete function
    public function invoicemanager() {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['invoices'] = $this->home->alldatafromdatabase($data['company']['id'], "invoice");

        $session['menu']="Clients";
        $session['submenu']="im";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/client/invoice/head');
        $this->load->view('dashboard/client/invoice/body');
        $this->load->view('dashboard/client/invoice/foot');
        $this->load->view('dashboard/client/invoice/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View proformainvoice page of add/edit/delete function
    public function proformainvoicemanager() {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['invoices'] = $this->home->alldatafromdatabase($data['company']['id'], "proformainvoice");

        $session['menu']="Clients";
        $session['submenu']="prm";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/client/proformainvoice/head');
        $this->load->view('dashboard/client/proformainvoice/body');
        $this->load->view('dashboard/client/proformainvoice/foot');
        $this->load->view('dashboard/client/proformainvoice/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View payment page of paid/unpaid function
    public function paymentmanager() {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['invoices'] = $this->home->alldatafromdatabase($data['company']['id'], "invoice");

        $session['menu']="Clients";
        $session['submenu']="pm";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/client/payment/head');
        $this->load->view('dashboard/client/payment/body');
        $this->load->view('dashboard/client/payment/foot');
        $this->load->view('dashboard/client/payment/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View project page of every human's projects and invoices of every project.
    public function projectmanager() {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['projects'] = $this->home->alldata('project');
        $data['invoices'] = $this->home->alldatafromdatabase($data['company']['id'], "invoice");

        $session['menu']="Clients";
        $session['submenu']="pjm";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/client/project/head');
        $this->load->view('dashboard/client/project/body');
        $this->load->view('dashboard/client/project/foot');
        $this->load->view('dashboard/client/project/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //Toggle payment of invoice function
    public function toggleinvoicepayment($invoice_id) {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];

        $res = $this->home->toggleinvoicepayment($data['company']['id'], $invoice_id);
        echo $res;
    }
    //View clientpage of creating.
    public function addclient() {
        $this->load->view('header');
        $this->load->view('main_page/head');
        $this->load->view('dashboard/client/client/addclient');
        $this->load->view('dashboard/client/client/functions.php');
        $this->load->view('footer');
    }
    //View userpage of creating.
    public function adduser() {
        $data['companies'] = $this->home->alldata('company');
        $data['modules'] = $this->home->alldata('module');

        $this->load->view('header');
        $this->load->view('main_page/head');
        $this->load->view('main_page/adduser', $data);
        $this->load->view('main_page/foot');
        $this->load->view('footer');
    }
    //View lastid of automation key in invoice table
    public function addinvoice() {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['invoice'] = $this->home->invoicefromsetting($data['company']['id'], 'invoice');

        $session['menu']="Clients";
        $session['submenu']="im";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/client/invoice/head');
        $this->load->view('dashboard/client/invoice/shead');
        $this->load->view('dashboard/client/invoice/addinvoice');
        $this->load->view('dashboard/client/invoice/foot');
        $this->load->view('dashboard/client/invoice/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View lastid of automation key in proforma table
    public function addproforma() {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['invoice'] = $this->home->invoicefromsetting($data['company']['id'], 'proformainvoice');

        $session['menu']="Clients";
        $session['submenu']="prm";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/client/proformainvoice/head');
        $this->load->view('dashboard/client/proformainvoice/shead');
        $this->load->view('dashboard/client/proformainvoice/addinvoice');
        $this->load->view('dashboard/client/proformainvoice/foot');
        $this->load->view('dashboard/client/proformainvoice/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View projectpage of creating
    public function addprojectbyinvoices() {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['invoices'] = $this->home->alldatafromdatabase($data['company']['id'], "invoice");

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/client/project/head');
        $this->load->view('dashboard/client/project/shead');
        $this->load->view('dashboard/client/project/addproject', $data);
        $this->load->view('dashboard/client/project/foot');
        $this->load->view('dashboard/client/project/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View projectpage of editting
    public function editprojectbyinvoices($project_id) {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $project = $this->home->databyid($project_id, 'project');
        if ($project['status']=='failed')
            return;
        $data['project'] = $project['data'];
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['invoices'] = $this->home->alldatafromdatabase($data['company']['id'], "invoice");

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/client/project/head');
        $this->load->view('dashboard/client/project/shead');
        $this->load->view('dashboard/client/project/editproject', $data);
        $this->load->view('dashboard/client/project/foot');
        $this->load->view('dashboard/client/project/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View clientpage of editting replacing by projects
    public function editclientbyprojects($client_id) {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $res = $this->home->databyid($client_id, 'client');
        if ($res['status'] == "failed")
            return;
        $data['client'] = $res['data'];
        $data['projects'] = $this->home->alldata('project');
        $data['invoices'] = $this->home->alldatafromdatabase($data['company']['id'], "invoice");

        $session['menu']="Clients";
        $session['submenu']="pjm";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/client/project/head');
        $this->load->view('dashboard/client/project/editclient', $data);
        $this->load->view('dashboard/client/project/foot');
        $this->load->view('dashboard/client/project/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View clientpage of editting.
    public function editclient($client_id) {
        $result = $this->home->databyid($client_id, 'client');
        if ($result['status']=="failed")
            return;
        $data['client']=$result['data'];

        $this->load->view('header');
        $this->load->view('main_page/head');
        $this->load->view('dashboard/client/client/editclient', $data);
        $this->load->view('dashboard/client/client/functions.php');
        $this->load->view('footer');
    }
    //View userpage of editting.
    public function edituser($user_id) {
        $result = $this->home->databyid($user_id, 'user');
        $data['companies'] = $this->home->alldata('company');
        $data['modules'] = $this->home->alldata('module');
        if ($result['status']=="failed")
            return;
        $data['user']=$result['data'];

        $this->load->view('header');
        $this->load->view('main_page/head');
        $this->load->view('main_page/edituser', $data);
        $this->load->view('main_page/foot');
        $this->load->view('footer');
    }
    //View invoicepage of editting.
    public function editinvoice($invoice_id) {
        $data['clients'] = $this->home->alldata('client');
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];

        $session['menu']="Clients";
        $session['submenu']="im";
        $this->session->set_flashdata('menu', $session);

        $result = $this->home->databyidfromdatabase($data['company']['id'], 'invoice', $invoice_id);
        if ($result['status']=="failed")
            return;
        $data['invoice']=$result['data'];

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/client/invoice/head');
        $this->load->view('dashboard/client/invoice/shead');
        $this->load->view('dashboard/client/invoice/editinvoice');
        $this->load->view('dashboard/client/invoice/foot');
        $this->load->view('dashboard/client/invoice/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View proformapage of editting.
    public function editproforma($invoice_id) {
        $data['clients'] = $this->home->alldata('client');
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];

        $session['menu']="Clients";
        $session['submenu']="prm";
        $this->session->set_flashdata('menu', $session);

        $result = $this->home->databyidfromdatabase($data['company']['id'], 'proformainvoice', $invoice_id);
        if ($result['status']=="failed")
            return;
        $data['invoice']=$result['data'];

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/client/proformainvoice/head');
        $this->load->view('dashboard/client/proformainvoice/shead');
        $this->load->view('dashboard/client/proformainvoice/editinvoice');
        $this->load->view('dashboard/client/proformainvoice/foot');
        $this->load->view('dashboard/client/proformainvoice/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //Delete User param(user_name)
    public function deluser() {
        $user_name = $this->session->userdata('username');
        $result = $this->home->removeUser($user_name);
        echo $result;
    }
    //Delete Client param(client_name)
    public function delclient($clientid) {
        $result = $this->home->removeClient($clientid);
        echo $result;
    }
    //Delete Company param(company_name)
    public function delinvoice($invoice_id) {
        $type=$this->input->post('type');

        $company_name = $this->session->userdata('companyname');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];

        $result = $this->home->removeInvoice($type, $data['company']['id'], $invoice_id);
        echo $result;
    }
    //Del project
    public function delproject($project_id) {
        echo $this->home->delProject($project_id);
    }
    //Save(Add/Edit) User post(object(name, number, ...)) get(id)
    public function saveuser() {
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $company=serialize($this->input->post('company'));
        $module=serialize($this->input->post('module'));

        if (!isset($_GET['id'])) {
            $projects_id = $this->home->createUser($username, $password, $company, $module);
            echo $projects_id;
            return;
        }

        $id = $_GET['id'];
        $result = $this->home->saveUser($id, $username, $password, $company, $module);
        echo $result;
    }
    //Save(Add/Edit) Client post(object(name, number, ...)) get(id)
    public function saveclient() {
        $name=$this->input->post('name');
        $number=$this->input->post('number');
        $address=$this->input->post('address');
        $VAT=$this->input->post('VAT');
        $bankname=$this->input->post('bankname');
        $bankaccount=$this->input->post('bankaccount');
        $EORI=$this->input->post('EORI');
        $Ref=$this->input->post('Ref');

        if (!isset($_GET['id'])) {
            $projects_id = $this->home->createClient($name, $number, $address, $VAT, $bankname, $bankaccount, $EORI, $Ref);
            echo $projects_id;
            return;
        }

        $id = $_GET['id'];
        $result = $this->home->saveClient($id, $name, $number, $address, $VAT, $bankname, $bankaccount, $EORI, $Ref);
        echo $result;
    }
    //Save(Add/Edit) Client post(object(name, number, ...)) get(id)
    public function saveinvoice() {
        $company_name = $this->session->userdata('companyname');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed') {
            echo $company_name;
            return;
        }
        $data['company'] = $company['data'];

        $type=$this->input->post('type');
        $date_of_issue=$this->input->post('date_of_issue');
        $due_date=$this->input->post('due_date');
        $input_invoicenumber=$this->input->post('input_invoicenumber');
        $input_inputreference=$this->input->post('input_inputreference');
        $invoice_vat=$this->input->post('invoice_vat');
        $short_name=$this->input->post('short_name');
        $client_name=$this->input->post('client_name');
        $sub_total=$this->input->post('sub_total');
        $tax=$this->input->post('tax');
        $total=$this->input->post('total');
        $lines=$this->input->post('lines');

        $client_name = str_replace(" ","_", $client_name);

        if (!isset($_GET['id'])) {
            $projects_id = $this->home->createInvoice($data['company']['id'], $type, $date_of_issue, $due_date, $input_invoicenumber, $input_inputreference, $invoice_vat, $short_name, $client_name, $sub_total, $tax, $total, $lines);
            echo $projects_id;
            return;
        }

        $id = $_GET['id'];
        $result = $this->home->saveInvoice($id, $data['company']['id'], $type, $date_of_issue, $due_date, $input_invoicenumber, $input_inputreference, $invoice_vat, $short_name, $client_name, $sub_total, $tax, $total, $lines);
        echo $result;
    }
    //Save(Add/Edit) User post(object(name, number, ...)) get(id)
    public function saveproject() {
        $name=$this->input->post('name');
        $invoices=$this->input->post('invoices');

        if (empty($name)) {
            echo "Input Name";
            return;
        }

        $company_name = $this->session->userdata('companyname');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];

        if (!isset($_GET['id'])) {
            $projects_id = $this->home->createProject($name);
            if ($projects_id != -1)
                $this->home->updateInvoices($data['company']['id'], $projects_id, $invoices);
            echo $projects_id;
            return;
        }

        $id = $_GET['id'];
        $result = $this->home->saveProject($id, $name);
        $this->home->updateInvoices($data['company']['id'], $id, $invoices);
        echo $result;
    }
    //Save(Edit) User post(object(name, number, ...)) params(name)
    public function saveClientbyprojects() {
        $client_name = $this->session->userdata('clientname');
        $res = $this->home->databyname($client_name, 'client');
        if ($res['status']=="failed") {
            echo "Error client";
            return;
        }
        $client = $res['data'];
        $projects=$this->input->post('projects');

        if ($projects=="") {
            echo "Input projects";
            return;
        }

        if (count($projects)==0) {
            echo "Input projects";
            return;
        }

        $result = $this->home->updateProjects($client['id'], $projects);
        echo $result;
    }
    //UploadImage post(fileinput) param(path)
    public function uploadImage($path) {
        if (!isset($_GET['id'])) // works with request 
        {
            echo "nothing";
            return;
        }

        // echo "123:".$this->lang->line('proj.proj_sel');

        $id = $_GET['id'];
        // echo $countfiles;
        if ($path=="company")
            $path="assets/company/image/";
        if ($path=="employee")
            $path="assets/employee/";
        if ($path=="background")
            $path="assets/background/";
        if(file_exists($path.$id.".jpg")) {
            unlink($path.$id.".jpg");
        }
        if(!empty($_FILES['files']['name'][0])) {

            $_FILES['file']['name'] = $_FILES['files']['name'][0];
            $_FILES['file']['type'] = $_FILES['files']['type'][0];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][0];
            $_FILES['file']['error'] = $_FILES['files']['error'][0];
            $_FILES['file']['size'] = $_FILES['files']['size'][0];

            $config['image_library'] = 'gd2';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
            $config['max_size'] = "2048000"; // Can be set to particular file size , here it is 2 MB(2048 Kb)
            $new_name = $id.".jpg";
            $config['file_name'] = $new_name;

            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            // $arr = array('msg' => 'something went wrong', 'success' => false);

            if($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();
                // $this->resize_image($uploadData['full_path']);
                // $filename = $uploadData['file_name'];
                // $arr = array('msg' => 'Image has been uploaded successfully', 'success' => true);
            }
            else {
                echo $this->upload->display_errors();
            }
        }
        // echo json_encode($arr);
    }
    //convert html to pdf
    public function htmltopdf() {
        $this->load->library('Pdf');

        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['invoice'] = $this->session->userdata('htmltopdf');

        $html = $this->load->view('dashboard/client/invoice/head', [], true);
        $html .= $this->load->view('dashboard/client/invoice/shead', [], true);
        $html .= $this->load->view('dashboard/client/invoice/invoicepreview', $data, true);

        $this->pdf->createPDF($html, $company_name.'-'.$data['invoice']['type'].$data['invoice']['input_invoicenumber'].'-'.date("Y.m.d").'-'.$data['invoice']['input_inputreference'].'.pdf');
        echo "success";
    }
    //showing html page for deploying pdf
    public function invoicepreview() {
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['clients'] = $this->home->alldata('client');
        $data['invoice'] = $this->session->userdata('htmltopdf');

        $this->load->view('dashboard/client/invoice/head');
        $this->load->view('dashboard/client/invoice/shead');
        $this->load->view('dashboard/client/invoice/invoicepreview', $data);
    }
    //Save information for deploying pdf.
    public function savesessionbyjson() {
        $data["type"]=$this->input->post('type');
        $data["input_street"]=$this->input->post('input_street');
        $data["input_city"]=$this->input->post('input_city');
        $data["input_state"]=$this->input->post('input_state');
        $data["input_zipcode"]=$this->input->post('input_zipcode');
        $data["input_nation"]=$this->input->post('input_nation');
        $data["input_taxname"]=$this->input->post('input_taxname');
        $data["input_taxnumber"]=$this->input->post('input_taxnumber');
        $data["date_of_issue"]=$this->input->post('date_of_issue');
        $data["due_date"]=$this->input->post('due_date');
        $data["input_invoicenumber"]=$this->input->post('input_invoicenumber');
        $data["input_inputreference"]=$this->input->post('input_inputreference');
        $data["invoice_vat"]=$this->input->post('invoice_vat');
        $data["short_name"]=$this->input->post('short_name');
        $data["client_name"]=$this->input->post('client_name');
        $data["client_address"]=$this->input->post('client_address');
        $data["sub_total"]=$this->input->post('sub_total');
        $data["tax"]=$this->input->post('tax');
        $data["total"]=$this->input->post('total');
        $data["lines"]=$this->input->post('lines');
        $data["companycoin"]=$this->input->post('companycoin');

        $this->session->set_userdata("htmltopdf", $data);
        echo "success";
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