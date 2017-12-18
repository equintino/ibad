<?php
    @$id=$_GET['id'];
    $act=$_GET['act'];
    @$ids=$_GET['ids'];
    
    $dao = new Dao();
    $search = new ModelSearchCriteria();
    $search->settabela('lt_membros');
    $search->setid($id);
    $model=$dao->encontrePorId($search);
    $nome=$model->getnome();
    $pai=$model->getpai();
    $mae=$model->getmae();
    $batismo=$model->getdt_batismo();
    $dd=substr($batismo,-2,2);
    $mm=substr($batismo,-5,2);
    $aa=substr($batismo,0,4);
    
    
    $nome=ModelValidador::iniciaisMaiusculas($nome);
    $pai=ModelValidador::iniciaisMaiusculas($pai);
    $mae=ModelValidador::iniciaisMaiusculas($mae);
    $nomes=explode(' ',$nome);
    $membro=strtolower($nomes[0]);
    $esp="&nbsp&nbsp&nbsp&nbsp";
    
    echo '<script>var batizado="'.$membro.'";
                  var id="'.$id.'"; 
                  var ids="'.$ids.'"; 
                  var nome="'.$nome.'";
                  var pai="'.$pai.'";
                  var mae="'.$mae.'";
                  var act="'.$act.'";
         </script>';
?>