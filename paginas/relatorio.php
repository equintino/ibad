<?php
   require_once '../dao/RelBusca.php';
   $dao = new Dao();
   $search = new RelBusca();
   $search->settabela('saldo');
   $search->setorder('ano');
   $search->setdesc('DESC');
   
   $saldos=$dao->encontre($search);