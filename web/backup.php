<?php
$host = "localhost";//host do banco
$user = "root";//usuario do banco
$senha = "";//senha do banco 
$db = 'ibad';
$dbc = mysql_connect($host,$user,$senha);
$m   = mysql_select_db($db, $dbc);
$sql = "show databases";//print_r($sql);die;
$sts = mysql_query($sql,$dbc) or die (mysql_error());
$data = date("d-m-y");
while ($row = mysql_fetch_array($sts)){
    if($row[0]==$db){
        $nome = $row[0];
        //print_r($nome);
        $NARQUIVO = $nome."-".$data;
        $resp = `mysqldump --host=$host --user=$user --password=$senha --databases $nome > ../db/$NARQUIVO.sql`;//--databases
    }
}
$arquivo = "mysql_".$data;
//criar os pacotinhos com todos os arquivos.sql
$resp = `tar -cvzf ../db/$arquivo.tar.gz ../db/*.sql`;
$resp = `rm ../db/*.sql`;
?>

