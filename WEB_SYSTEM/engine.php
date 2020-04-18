
<?php
    if(isset($_POST['crearVPN']) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $vpnNombre = $_POST['nombreVPN'];        
        $salida =  shell_exec("sudo /usr/local/bin/pivpn -a nopass -n " .$vpnNombre. " -d 1080 ");
        header("location:index.php");
    }
    if(isset($_GET['deleteVPN']) && $_SERVER["REQUEST_METHOD"] == "GET"){
       $vpnNombre = str_replace(".ovpn", "", $_GET['deleteVPN']."");
       $salida =  shell_exec("sudo /usr/local/bin/pivpn -r " .$vpnNombre);
       $salida =  shell_exec("sudo /bin/rm /var/www/html/ovpns/" .$vpnNombre. ".ovpn"); 
       header("location:index.php");
    }
    #header("location:index.php#lista");
?>
