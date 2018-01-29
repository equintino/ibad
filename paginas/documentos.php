<?php
    if(array_key_exists('id',$_GET)){
        $id=$_GET['id'];
    }else{
        $id=null;
    }
    if(array_key_exists('ids',$_GET)){
        $ids=$_GET['ids'];
    }else{
        $ids=null;
    }
    $act=$_GET['act'];
    
    $dao = new Dao();
    $search = new ModelSearchCriteria();
    $search->settabela('lt_membros');
    $search->setorder('nome');
    if($act=='carteirinha'){
        $nome=$_GET['nome'];
        $search->setnome($nome);
    }
    $model=$dao->encontre($search);    
    
    $ano=(date('Y'));
    
    if($act=='carteirinha'){
        echo '<script>var ids="'.$ids.'"</script>';
        echo '<script>
                var act="'.$act.'";
                var batizado=null;var id=null;var nome=null;var pai=null;var mae=null;
             </script>';
    }else{
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
    }
?>