<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
        }

        $data['title'] = 'Login Admin';

        $this->load->view('admin/auth/login', $data);
    }

    public function login()
    {
        $username = trim((string) $this->input->post('username', TRUE));
        $password = (string) $this->input->post('password', TRUE);

        if ($username === '' || $password === '') {
            $this->session->set_flashdata('error', 'Username dan password wajib diisi.');
            redirect('admin/auth');
        }

        $user = $this->db
            ->where('username', $username)
            ->where('status', 'aktif')
            ->limit(1)
            ->get('users')
            ->row();

        if (!$user) {
            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('admin/auth');
        }

        $password_valid = password_verify($password, (string) $user->password);

        // Keep existing MD5 accounts usable and upgrade them after login.
        if (!$password_valid && hash_equals((string) $user->password, md5($password))) {
            $password_valid = TRUE;
            $this->db->where('id', $user->id)->update('users', array(
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ));
        }

        if (!$password_valid) {
            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('admin/auth');
        }

        $session_data = array(
            'user_id'   => $user->id,
            'nama'      => $user->nama,
            'username'  => $user->username,
            'role'      => $user->role,
            'foto'      => $user->foto,
            'logged_in' => TRUE
        );

        $this->session->set_userdata($session_data);

        redirect('admin/dashboard');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/auth');
    }
}
