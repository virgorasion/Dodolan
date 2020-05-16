<?php 
include_once("_header.php");
require_once("core/Database.php");
session_start();
$db = new Database();

?> 

<div class="container">
    <div class="arus">
        <h1>Arus Modal</h1>
    </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Nama</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Fauzan</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Fatin</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Agung</td>
    </tr>
  </tbody>
</table>
</div>