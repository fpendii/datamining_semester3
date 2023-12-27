<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'dataset';
    protected $primaryKey       = 'iddataset';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['sepal_length','sepal_width','petal_length','petal_width','idkelas','idjenis'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDataWithKelass(){
        return $this->join('kelas', 'kelas.idkelas = dataset.idkelas')
                    ->join('jenisdata', 'jenisdata.idjenis = dataset.idjenis')
                    ->select('dataset.iddataset, dataset.sepal_length, dataset.sepal_width, petal_length, petal_width , kelas.kelas, jenisdata.jenis')
                    ->where('jenisdata.idjenis',1)
                    ->findAll();
    }

    public function getMaxMin(){
        $result =  $this->query("SELECT MAX(sepal_length) AS max_spl, MIN(sepal_length) AS min_spl, MAX(sepal_width) AS max_spw, MIN(sepal_width) AS min_spw, MAX(petal_length) AS max_ptl, MIN(petal_length) AS min_ptl, MAX(petal_width) AS max_ptw, MIN(petal_width) AS min_ptw FROM dataset WHERE idjenis = 1");
        return $result->getResult();
    }

    public function insertData($data){
        return $this->db->table($this->table)->insertBatch($data);
    }
}
