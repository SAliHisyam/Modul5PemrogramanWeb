<?php

namespace Controller;

include "Traits/ApiResponseFormatter.php";
include "Models/Product.php";

use Models\Product;
use Traits\ApiResponseFormatter;

class ProductController{
    use ApiResponseFormatter;
    public function index(){
        $productModel = new Product();
        $response = $productModel->findAll();
        return $this->apiResponse(200, "Success", $response);
        //var_dump($response);
    }

    public function getById($id){
        $productModel = new Product();
        $response = $productModel->findByID($id);
        return $this->apiResponse(200, "Success", $response);
    }

    public function insert(){
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        if(json_last_error()){
            return $this->apiResponse(400, "error invalid input", null);
        }
        
        $productModel = new Product();
        $response = $productModel->create([
            "product_name" => $inputData['product_name']
        ]);

        return $this->apiResponse(200, "Success", $response);
    }

    public function update($id){
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        if(json_last_error()){
            return $this->apiResponse(400, "error invalid input", null);
    }
    $productModel = new Product();
    $response = $productModel->update([
        "product_name" => $inputData['product_name'],
    ], $id);
        return $this->apiResponse(200, "Success", $response);

    }

    public function delete($id){
        $productModel = new Product();
        $response = $productModel->destroy($id);
        return $this->apiResponse(200, "Success", $response);
    }
}