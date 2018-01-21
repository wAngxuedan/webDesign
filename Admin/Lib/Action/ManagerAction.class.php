<?php
header("Content-Type:text/html; charset=utf-8");
class ManagerAction extends Action {
    public function index(){
	$this->display();
    }
}