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
    
    $ano=(date('Y'));
    
    if($act=='carteirinha'){
        echo '<script>var ids="'.$ids.'"</script>';
        $ids=explode(',',$_GET['ids']);
        foreach($ids as $id){           
            $search->setid($id);
            $model=$dao->encontrePorId($search);          
                        if(!$model->getrg()){
                            $rg=000000000;
                        }else{
                            $rg=$model->getrg();
                        }
            $dt_nascimento1=substr($model->getdt_nascimento(),-2,2).' / '.substr($model->getdt_nascimento(),-5,2).' / '.substr($model->getdt_nascimento(),0,4);
            $dt_ingresso1=substr($model->getdt_ingresso(),-2,2).' / '.substr($model->getdt_ingresso(),-5,2).' / '.substr($model->getdt_ingresso(),0,4);
            $dt_batismo1=substr($model->getdt_batismo(),-2,2).' / '.substr($model->getdt_batismo(),-5,2).' / '.substr($model->getdt_batismo(),0,4);
            $endereco=ModelValidador::logradouro($model->gettipo()).' '.ModelValidador::iniciaisMaiusculas($model->getendereco()).', '.$model->getnumero().' - ';
            if($model->getcomplemento()){
                $endereco .=ModelValidador::iniciaisMaiusculas($model->getcomplemento()).' - ';
            }
            $endereco .=ModelValidador::iniciaisMaiusculas($model->getbairro()).'/'.$model->getestado();
            echo '<script>
                var act="'.$act.'";
                var foto1="'.$model->getfoto().'";
                var nome1="'.ModelValidador::iniciaisMaiusculas($model->getnome(),"nome").'";
                var pai1="'.ModelValidador::iniciaisMaiusculas($model->getpai(),"carteirinha").'";
                var mae1="'.ModelValidador::iniciaisMaiusculas($model->getmae(),"carteirinha").'";
                var dt_nascimento1="'.$dt_nascimento1.'";
                var estcivil1="'.ModelValidador::iniciaisMaiusculas($model->getestcivil()).'";
                var dt_ingresso1="'.$dt_ingresso1.'";
                var dt_batismo1="'.$dt_batismo1.'";
                var funcao1="Membro";
                var rg1="'.$rg.'";
                var endereco1="'.$endereco.'";
                var ano1="'.$ano.'";
                var ano2=parseInt(ano1)+1;
                var ano3=parseInt(ano1)+2;
                var ano4=parseInt(ano1)+3;
                var ano5=parseInt(ano1)+4;                     
            </script>';
            echo '<script>var batizado=null;var id=null;var nome=null;var pai=null;var mae=null;
             </script>';
        }
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