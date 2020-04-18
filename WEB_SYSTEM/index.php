
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" crossorigin="anonymous">
        <title>PIVPN ADMINISTRADOR</title>
        <script>
                function soloLetras(e) {
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toLowerCase();
                letras = "abcdefghijklmnopqrstuvwxyz1234567890";
                especiales = [8, 37, 39, 46];

                if(letras.indexOf(tecla) == -1)
                    return false;
            }

            function limpia() {
                var val = document.getElementById("vpnName").value;
                var tam = val.length;
                for(i = 0; i < tam; i++) {
                    if(!isNaN(val[i]))
                        document.getElementById("vpnName").value = '';
                }
            }
        </script>       
    </head>
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-md-center align-items-center">
            <a class="navbar-brand" href="#">
                <img src="http://www.pivpn.io/images/pivpn_logo.png" alt="" width="30" height="30">
                PIVPN
            </a>
        </nav>
        
        <br> 
        
        <div class="container bg-light border border-dark rounded alert alert-dark" >
            <form action="engine.php" method="post">
                <div class="form-group" >
                    <label class="text-dark" for="exampleInputEmail1">Crear cliente VPN</label>
                    
                    <input type="text" class="form-control" id="nombreVPN" name="nombreVPN" aria-describedby="emailHelp" placeholder="Ingrese el nombre del cliente VPN*" required autofocus onkeypress="return soloLetras(event)" onblur="limpia()">
                    
                    <small id="emailHelp" class="form-text text-muted">*Utilice letras y números unicamente.</small>
                    <small id="emailHelp" class="form-text text-muted">*No deje espacios en blanco.</small>
                </div>
                <button type="submit" class="btn bg-dark btn-lg btn-primary btn-block border border-dark" name="crearVPN" >Crear cliente VPN</button>
            </form>
        </div>
        
        <div  class="container bg-light border border-dark rounded alert alert-dark" >
            <form  id="lista" action="index.php#lista">
                <div>
                    <label id="lista" class="text-dark" for="exampleInputEmail1">Clientes VPN</label>
                    <div class="alert alert-light border text-monospace">
                        <code class="text-dark  text-monospace text-dark">
                                <?php
                                    $salida = shell_exec('sudo /usr/local/bin/pivpn -l | grep -v Revoked');
                                    print "<pre>$salida</pre>";
                                ?>
                        </code>
                    </div>
                    <button type="submit" class="btn bg-dark btn-lg btn-primary btn-block border border-dark"  onclick="" >Actualizar listado</button>
                </div>
            </form>
        </div>
        
        <div  class="container bg-light border border-dark rounded alert alert-dark" >
            <form  action="index.php#con">
                <div>
                    <label  id="con" class="text-dark" for="exampleInputEmail1">Conecciones VPN</label>
                    <div class="alert alert-light border text-monospace">
                        <code class="text-dark  text-monospace text-dark">
                                <?php
                                    $salida = shell_exec('sudo /usr/local/bin/pivpn -c');
                                    print "<pre>$salida</pre>";
                                ?>
                        </code>
                    </div>
                    <button type="submit" class="btn bg-dark btn-lg btn-primary btn-block border border-dark"  onclick="" >Actualizar estado</button>
                </div>
            </form>
        </div>
        
        <div class="container bg-light border border-dark rounded alert alert-dark " >
                <div>
                    <label id="files" class="text-dark" for="exampleInputEmail1">Administrar clientes VPN</label>
                    <div class="alert alert-light border text-monospace align-items-center">                       
                        <table class="table text-center text-dark">
                          <thead class="thead-light">
                            <tr>
                              <th scope="col">Cliente VPN</th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                              
                            <?php
                                $salida = shell_exec('sudo /bin/ls -w 1 /var/www/html/ovpns');
                                $vpnFile = "";
                                for($i=0;$i<strlen($salida."");$i++)
                                    {
	                                   if( $salida[$i] == "\n"){
                                            echo "<tr>\n\n";
                                            
                                            echo "<td>".$vpnFile."</td>\n\n";
                                           
                                            echo "<td>
                                            <a href=\"/ovpns/".$vpnFile."\" download>
                                            <button id=\"".$vpnFile."\" type=\"button\" class=\"btn btn-dark btn-sm btn-lg\">
                                            Descargar
                                            </button>
                                            </a>
                                            </td>
                                            \n\n";
                                           
                                            echo "<td>\n
                                            <a href=\"/engine.php?deleteVPN=".$vpnFile."\">\n
                                            <button type=\"button\" class=\"btn btn-secondary btn-sm btn-lg\"\n>
                                            Eliminar\n
                                            </button>\n
                                            </a>\n
                                            </td>\n
                                            \n";
                                            echo "</tr>\n";
                                            $vpnFile = "";
                                       }else{
                                           $vpnFile .= $salida[$i];
                                       }
                                    }
                            ?>  
                              
                          </tbody>
                        </table>
                    </div>
                </div>
        </div>
        
        
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-md-center align-items-center">
            <a class="navbar-brand" href="https://github.com/ozzvb">
                https://github.com/ozzvb
            </a>
                    | 
            <a class="navbar-brand" href="https://github.com/pivpn/pivpn">
              https://github.com/pivpn/pivpn
            </a>
        </nav>
      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>