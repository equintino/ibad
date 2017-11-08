<?php
   $dao = new Dao();
   $search = new ModelSearchCriteria();
   $search->settabela('saldo');
   $search->setorder('ano');
   $search->setdesc('DESC');
   
   $saldos=$dao->encontre($search);
?>

