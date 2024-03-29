<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Peserta_model');
        peserta_cek();
    }

    // ================================= Dashboard Area =========================
    public function index()
    {
        $data = $this->_session();
        $data['judul'] = "Dashboard - KELEPON PRAMUKA UNIB";
        $this->load->view('peserta/header', $data);
        $this->load->view('peserta/navbar', $data);
        $this->load->view('peserta/sidebar');
        $this->load->view('peserta/dashboard');
        $this->load->view('peserta/footer');
    }
    // ================================= end Dashboard Area =========================

    // ================================= Data Peserta Area =============================
    public function datadiri()
    {
        $cek = $this->Peserta_model->cekdatadiri();
        if ($cek) {
            $data = $this->_session();
            // $user = $this->Peserta_model->getdatadiri();
            $data['datadiri'] = $this->Peserta_model->getdatadiri();
            $data['golongan'] = $this->Peserta_model->golongan();
            $data['pangkalan'] = $this->Peserta_model->getdatapangkalan();
            $data['judul'] = "Data Diri - KELEPON PRAMUKA UNIB";
            $this->load->view('peserta/header', $data);
            $this->load->view('peserta/navbar', $data);
            $this->load->view('peserta/sidebar', $data);
            $this->load->view('peserta/datadiri', $data);
            $this->load->view('peserta/footer');
        } else {
            $this->_inputdatadiri();
        }
    }

    private function _inputdatadiri()
    {
        $data = $this->_session();
        $data['golongan'] = $this->Peserta_model->golongan();
        $data['judul'] = "Data Diri - KELEPON PRAMUKA UNIB";
        $this->load->view('peserta/header', $data);
        $this->load->view('peserta/navbar', $data);
        $this->load->view('peserta/sidebar', $data);
        $this->load->view('peserta/inputdata', $data);
        $this->load->view('peserta/footer');
    }

    public function inputdatadiri()
    {
        $post = $this->input->post();
        $id = $this->session->userdata('id');
        $data = array(
            'id_user' => $id,
            'id_golongan' => $post['golongan'],
            'tempatlahir' => htmlspecialchars($post['tempatlahir']),
            'tanggallahir' => $post['tanggallahir'],
            'provinsi' => htmlspecialchars($post['provinsi']),
            'kota' => htmlspecialchars($post['kota']),
            'alamat' => htmlspecialchars($post['alamat'])
        );
        $this->Peserta_model->inputdatadiri($data);
        redirect('peserta/datadiri');
    }

    public function editdatadiri()
    {
        $post = $this->input->post();
        $datadiri = array(
            'tempatlahir' => $post['tempatlahir'],
            'tanggallahir' => $post['tanggallahir'],
            'alamat' => $post['alamat'],
            'kota' => $post['kota'],
            'provinsi' => $post['provinsi'],
            'id_golongan' => $post['golongan']
        );

        $user = array(
            'nama' => $post['nama'],
            'email' => $post['email'],
            'telepon' => $post['telepon']
        );
        $this->Peserta_model->editdatadiri($user);
        $this->Peserta_model->_editdatadiri($datadiri);
        redirect('peserta/datadiri');
    }

    public function inputdatapangkalan()
    {
        $post = $this->input->post();
        $gudep = uniqid();
        $data = array(
            'id_pangkalan' => $gudep,
            'nogudep' => $post['ranting'] . '.' . $post['gudep'],
            'namapangkalan' => $post['nama'],
            'kotapangkalan' => $post['kota'],
            'provinsipangkalan' => $post['provinsi']
        );
        $this->Peserta_model->inputdatapangkalan($data);
        redirect('peserta/datadiri');
    }

    public function editdatapangkalan()
    {
        $post = $this->input->post();
        $this->Peserta_model->editdatapangkalan($post);
        redirect('peserta/datadiri');
    }


    public function uploadfoto()
    {
        $post = $this->input->post();
        $id = $this->session->userdata('id');
        $upload = $_FILES['image']['name'];
        $ext = pathinfo($upload, PATHINFO_EXTENSION);

        if ($upload) {
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 5000;
            $config['upload_path']          = './src/dashboard/assets/berkas/foto';
            $config['file_name']            = $id . '.' . $ext;
            unlink($config['upload_path'] . '/' . $post['hapus']);
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $newimage = $this->upload->data('file_name');
                $this->Peserta_model->uploadfoto($newimage);
            } else {
                echo $this->upload->display_errors();
            }
        }

        redirect('peserta/datadiri');
    }

    public function uploadidentitas()
    {
        $post = $this->input->post();
        $id = $this->session->userdata('id');
        $upload = $_FILES['identitas']['name'];
        $ext = pathinfo($upload, PATHINFO_EXTENSION);

        $upload = $_FILES['identitas']['name'];
        if ($upload) {
            $config['allowed_types']        = 'jpg|png|pdf';
            $config['max_size']             = 5000;
            $config['upload_path']          = './src/dashboard/assets/berkas/identitas';
            $config['file_name']            = $id . '.' . $ext;

            unlink($config['upload_path'] . '/' . $post['hapus']);
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('identitas')) {
                $newimage = $this->upload->data('file_name');
                $this->Peserta_model->uploadidentitas($newimage);
            } else {
                echo $this->upload->display_errors();
            }
        }

        redirect('peserta/datadiri');
    }

    public function uploadsuratmandat()
    {
        $post = $this->input->post();
        $id = $this->session->userdata('id');

        $upload = $_FILES['suratmandat']['name'];
        $ext = pathinfo($upload, PATHINFO_EXTENSION);

        if ($upload) {
            $config['allowed_types']        = 'jpg|png|pdf';
            $config['max_size']             = 5000;
            $config['upload_path']          = './src/dashboard/assets/berkas/mandat';
            $config['file_name']            = $id . '.' . $ext;

            unlink($config['upload_path'] . '/' . $post['hapus']);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('suratmandat')) {
                $newimage = $this->upload->data('file_name');
                $this->Peserta_model->uploadsuratmandat($newimage);
            } else {
                echo $this->upload->display_errors();
            }
        }

        redirect('peserta/datadiri');
    }
    // ================================= end Data Peserta Area =========================

    // ================================= Mata Lomba Area ===================================
    public function matalomba()
    {
        if (cek_status() == 3) {
            $this->matalombadipilih();
        } else {
            // cek_bayar();
            $data = $this->_session();
            $data['lomba'] = $this->Peserta_model->getmatalomba();
            $data['judul'] = 'Mata Lomba - KELEPON PRAMUKA UNIB';
            $this->load->view('peserta/header', $data);
            $this->load->view('peserta/navbar', $data);
            $this->load->view('peserta/sidebar');
            $this->load->view('peserta/matalomba', $data);
            $this->load->view('peserta/footer');
        }
    }

    public function pilihmatalomba()
    {
        // cek_bayar();

        $idlomba = $this->uri->segment('3');
        $this->Peserta_model->pilihlomba($idlomba);
        redirect('peserta/matalomba');
    }

    public function batalmatalomba()
    {
        $idlomba = $this->uri->segment('3');
        $this->Peserta_model->batallomba($idlomba);
        redirect('peserta/matalomba');
    }

    public function matalombadipilih()
    {
        $data = $this->_session();
        $data['lomba'] = $this->Peserta_model->getmatalomba();
        $data['log'] = $this->Peserta_model->getlogid();
        $data['judul'] = 'Mata Lomba Dipilih - KELEPON PRAMUKA UNIB';
        $this->load->view('peserta/header', $data);
        $this->load->view('peserta/navbar', $data);
        $this->load->view('peserta/sidebar');
        $this->load->view('peserta/matalombadipilih', $data);
        $this->load->view('peserta/footer');
    }

    public function uploadkarya()
    {
        $post = $this->input->post();

        if ($post) {
            $this->Peserta_model->uploadkarya($post);
            redirect('peserta/matalombadipilih');
        } else {
            $data = $this->_session();
            $data['uri'] = $this->uri->segment('3');
            $data['log'] = $this->Peserta_model->getlog($data['uri']);
            if (!isset($data['log'])) {
                redirect('peserta/matalombadipilih');
            } else {
                $data['judul'] = 'Upload Karya - KELEPON PRAMUKA UNIB';
                $this->load->view('peserta/header', $data);
                $this->load->view('peserta/navbar', $data);
                $this->load->view('peserta/sidebar');
                $this->load->view('peserta/uploadkarya', $data);
                $this->load->view('peserta/footer');
            }
        }
    }

    public function matalombapeserta()
    {
        $post = $this->input->post();
        $this->Peserta_model->matalombapeserta($post);
        redirect('peserta/matalombadipilih');
    }

    public function matalombaupload()
    {
        $post = $this->input->post();
        if ($post) {
            $idlomba = $this->uri->segment('3');
            $this->_matalombaupload($idlomba);
        } else {
            $lom = $this->uri->segment('3');
            $data = $this->_session();
            $data['log'] = $this->Peserta_model->getlog($lom);
            if (!isset($data['log'])) {
                redirect('peserta/matalombadipilih');
            } else {
                $data['judul'] = 'Upload Data Peserta - KELEPON PRAMUKA UNIB';
                $this->load->view('peserta/header', $data);
                $this->load->view('peserta/navbar', $data);
                $this->load->view('peserta/sidebar');
                $this->load->view('peserta/matalombaupload', $data);
                $this->load->view('peserta/footer');
            }
        }
    }

    private function _matalombaupload($data)
    {
        $post = $this->input->post();
        $id = $this->session->userdata('id');

        $upload = $_FILES['identitas']['name'];
        $ext = pathinfo($upload, PATHINFO_EXTENSION);

        if ($upload) {
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 5000;
            $config['upload_path']          = './src/dashboard/assets/berkas/pesertaidentitas';
            $config['file_name']            = $id . $data . '.' . $ext;
            $this->load->library('upload', $config);

            unlink($config['upload_path'] . '/' . $post['hapus']);


            if ($this->upload->do_upload('identitas')) {
                $newimage = $this->upload->data('file_name');
                $this->Peserta_model->uploadpeserta($newimage, $data);
            } else {
                echo $this->upload->display_errors();
            }
        }

        redirect('peserta/matalombadipilih');
    }
    // ================================= end Mata Lomba Area ================================

    //================================== Account Management =====================================
    public function profile()
    {
        $data = $this->_session();
        $data['judul'] = 'Account Settings - KELEPON PRAMUKA UNIB';
        $this->load->view('peserta/header', $data);
        $this->load->view('peserta/navbar', $data);
        $this->load->view('peserta/sidebar');
        $this->load->view('all/userprofile', $data);
        $this->load->view('peserta/footer');
    }

    // ======================================Peserta Invoice ====================================
    public function invoice()
    {

        $get = $this->Peserta_model->get_pembayaran();
        if (empty($get)) {
            $data = $this->_session();
            $data['log'] = $this->Peserta_model->getlogid();
            if (!empty($data['log'])) {
                $data['judul'] = 'Pembayaran - KELEPON PRAMUKA UNIB';
                $this->load->view('peserta/header', $data);
                $this->load->view('peserta/navbar', $data);
                $this->load->view('peserta/sidebar');
                $this->load->view('peserta/invoice', $data);
                $this->load->view('peserta/footer');
            } else {
                redirect('peserta/matalomba');
            }
        } else {
            if ($get['status_payment'] == 3) {
                // redirect('peserta/paymentstatus');
                $this->paymentstatus();
            } else if ($get['status_payment'] == 2) {
                $this->_checkout();
            } else if ($get['status_payment'] == 1) {
                $this->paymentstatus();
            } else if ($get['status_payment'] == 4) {
                $this->_checkout();
            } else {
                $this->_checkout();
            }
        }
    }

    private function _checkout()
    {
        $data = $this->_session();
        $data['get'] = $this->Peserta_model->get_pembayaran();
        $data['chanel'] = $this->Peserta_model->get_chanel();
        $data['judul'] = 'Pembayaran - KELEPON PRAMUKA UNIB';
        $this->load->view('peserta/header', $data);
        $this->load->view('peserta/navbar', $data);
        $this->load->view('peserta/sidebar');
        $this->load->view('peserta/invoicemetode', $data);
        $this->load->view('peserta/footer');
    }

    public function inputchanel()
    {
        // cek_bayar();

        $chanel = $this->uri->segment('3');
        $this->Peserta_model->inputchanel($chanel);
        redirect('peserta/invoice');
    }

    public function inputtotal()
    {
        // cek_bayar();

        $post =  $this->input->post();
        $this->Peserta_model->inputtotal($post);
        redirect('peserta/invoice');
    }

    public function bayar()
    {
        // cek_bayar();

        $user = $this->Peserta_model->session();
        $pay = $this->Peserta_model->get_pembayaran();

        $post = array(
            'id' => $pay['id_user'],
            'total' => $pay['total'],
            'kode_chanel' => $pay['kode_chanel'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'telepon' => $user['telepon']
        );

        $lomba = $this->Peserta_model->getlogid();
        $url = regTripay($post, $lomba);
        $this->Peserta_model->paymenturl($url);
        $this->Peserta_model->ubahstatus('1');

        redirect('peserta/paymentstatus');
    }

    public function paymentstatus()
    {
        $get = $this->Peserta_model->get_pembayaran();
        if ($get['status_payment'] == 3) {
            $this->_printinvoice();
        } else {
            $data = $this->_session();
            $data['url'] = $this->Peserta_model->get_bayar();
            $data['payment'] = $this->Peserta_model->get_pembayaran();
            $data['judul'] = 'Status Pembayaran - KELEPON PRAMUKA UNIB';
            $this->load->view('peserta/header', $data);
            $this->load->view('peserta/navbar', $data);
            $this->load->view('peserta/sidebar');
            $this->load->view('peserta/bayarproses', $data);
            $this->load->view('peserta/footer');
        }
    }

    private function _printinvoice()
    {
        $data = $this->_session();
        $data['url'] = $this->Peserta_model->get_bayar();
        $data['payment'] = $this->Peserta_model->get_pembayaran();
        $data['judul'] = 'Status Pembayaran - KELEPON PRAMUKA UNIB';
        $this->load->view('peserta/header', $data);
        $this->load->view('peserta/navbar', $data);
        $this->load->view('peserta/sidebar');
        $this->load->view('peserta/printinvoice', $data);
        $this->load->view('peserta/footer');
    }

    // ======================================end Peserta Invoice ================================

    //================================== end Account Management =================================
    private function _session()
    {
        $user = $this->Peserta_model->session();
        $data['user'] = array(
            'nama' => $user['nama'],
            'email' => $user['email'],
            'telepon' => $user['telepon'],
            'pp' => $user['foto_profile']
        );
        return $data;
    }
}
