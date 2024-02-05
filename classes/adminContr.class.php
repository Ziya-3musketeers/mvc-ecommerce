<?php 

class adminContr extends Admin {

  public function usersList(){
    $this->searchOGmber();
  }

  public function showInspectedUser(){
    $this->inspectUser();
  }

  public function productsList(){
    $this->showProduct();
  }

  public function showInspectedProduct(){
    $this->inspectProduct();
  }

  public function showSearchOGmber(){
    $this->searchOGmbers();
  }

  public function showReviews(){
    $this->adminReviews();
  }
}