<?php
class Order extends CI_Controller {
  public function index()
  {
    #$this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->model('order_model');

    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'callback_ldap_check');

    if ($this->form_validation->run() == FALSE)
    {
      $order = $this->order_model->get_order_def();
      $data['items'] = $order;
      $this->load->view('templates/header');
      $this->load->view('order_form', $data);
      $this->load->view('templates/footer');
    }
    else
    {
      $this->email_data();
      $this->load->view('order_form_success');
    }
  }

  public function ldap_check()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    // LOAD MODEL HERE

    if ($username == $password)
    {
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('ldap_check', 'Benutzername-Passwort-Kombination ist falsch');
      return FALSE;
    }
  }

  public function email_data($data = '')
  {
    $email_config['protocol'] = 'sendmail';
    $email_config['mailpath'] = '/usr/sbin/sendmail';
    $email_config['charset'] = 'iso-8859-1';
    $email_config['charset'] = 'utf-8';

    $email_config['wordwrap'] = TRUE;

    $this->load->library('email');
    $this->email->initialize($email_config);

    $this->email->from('your@example.com', 'Your Name');
    $this->email->to('indubio@anstalt');
    #$this->email->cc('another@another-example.com');
    #$this->email->bcc('them@their-example.com');

    $this->email->subject('Email Test');
    $this->email->message(mb_convert_encoding('Testing the email class. Überprüfen', "UTF-8"));

    $this->email->send();
    return TRUE;
  }

  public function show()
  {
    $this->load->model('order_model');
    $order = $this->order_model->get_order_def();
    $data['title'] = "test"; #$order['title'];
    $data['body'] = "test"; #$order['body'];
    $data['items'] = $order;

    $this->load->view('templates/header', $data);
    $this->load->view('order_form', $data);
    $this->load->view('templates/footer', $data);
  }

}
?>
