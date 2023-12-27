<?php

namespace App\Controllers;

use App\Models\DatasetModel;
use App\Models\JenisDataModel;
use App\Models\KelasModel;

class Home extends BaseController
{
    protected $Dataset;
    protected $JenisData;
    protected $Kelas;

    public function __construct()
    {
        $this->Dataset = new DatasetModel();
        $this->JenisData = new JenisDataModel();
        $this->Kelas = new KelasModel();
    }

    public function index()
    {
        $dataset = $this->Dataset->getDataWithKelass();
        $minMax = $this->Dataset->getMaxMin();
        $data = [
            'dataset' => $dataset,
            'sepal_length' => $this->request->getVar('SepalLength'),
            'sepal_width' => $this->request->getVar('SepalWidth'),
            'petal_length' => $this->request->getVar('PetalLength'),
            'petal_width' => $this->request->getVar('PetalWidth'),
            'minMax' => $minMax
        ];

        echo view('layout');
        echo view('knn/identifikasi',$data);
        echo view('script');
    }

    public function dashboard(){
        echo view('layout');
        echo "<h1>Ini Adalah tugas datamining semerter 3</h1>";
    }

    public function knn(){
        echo view('layout');
        echo view('knn/index');
    }
}
