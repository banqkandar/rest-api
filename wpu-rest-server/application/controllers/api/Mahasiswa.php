<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mhs');

        $this->methods['index_get']['limit'] = 10000;
        $this->methods['index_delete']['limit'] = 2;

    }

    public function index_get() {
        $id = $this->get('id');
        if($id === null) {
            $mahasiswa = $this->mhs->getMahasiswa();
        }else {
            $mahasiswa = $this->mhs->getMahasiswa($id);
        }
        
        if($mahasiswa) {
            $this->response([
                'status' => TRUE,
                'data' => $mahasiswa
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => '403 NOT FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete() {
        $id = $this->delete('id');
        if($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'Provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if($this->mhs->deleteMahasiswa($id) > 0 ) {
                //ok
                $this->response([
                    'status' => TRUE,
                    'data' => $id,
                    'message' => 'deleted'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                //id not found
                $this->response([
                    'status' => FALSE,
                    'message' => 'Id Not Found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post() {
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        ];

        if( $this->mhs->buatMahasiswa($data) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'new mahasiswa has been created'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'failed to create new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put() {
        $id = $this->put('id');
        $data = [
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan')
        ];

        if( $this->mhs->ubahMahasiswa($data, $id) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'new mahasiswa has been updated'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}