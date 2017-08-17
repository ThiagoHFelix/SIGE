<?php

defined('BASEPATH') OR exit('No direct script access allowed');

interface Pessoa_interface{


 public function registra_login($dados);
 public function get_pessoa($senha,$email);
 public function __destruct();
 public function get_all_pessoa();



}
