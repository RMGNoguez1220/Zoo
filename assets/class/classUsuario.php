<?php
    if (!class_exists("BaseDate"))
        include "classBD.php";

    if (!isset($_SESSION['Id'])){
        session_start();
        if (!isset($_SESSION['Id']))
            exit;
    }
    class Usaurio extends BaseDate{

        function __construct(){
            if(isset($_REQUEST['accion']))
                echo $this -> ejecuta($_REQUEST['accion']);
        }
 
        public function ejecuta($action) {
            $result = "";
            switch ($action) {
                case "list":
                    if ($_SESSION['isAdmin']){
                        $cadeQuery = "SELECT IdUsuario,Nombre,Apellidos,Genero,Correo,FechaUltiAcceso,Acesso FROM Usuario order by idUsuario";

                        $result = $this -> desTabla($cadeQuery);
                    } else 
                        $result = null;
                    break; 
                case "forEdit":
                    $registro = $this -> getTupla("SELECT * FROM usuario where idUsuario = " . $_POST['id']);
                case "Perfil":
                    $registro = $this -> getTupla("SELECT * FROM usuario where idUsuario = " . $_SESSION['Id']);
                case "forNew":
                    $result = '
                        <form id="formUsuario" class="form users" method="post" enctype="multipart/form-data">
                            <div class="container-Usuario" >
                                <div class="row form-Usuarios" >
                                    <div class="form-contend" >
                    
                                        <label for="nombre" class="usfornew">Nombres:</label>
                                        <input style = "max-width: 95%;" type="text" required id="nombre" value="'. (isset($registro) ? $registro->Nombre : "") .'" name="nombre" class="form-control">
                    
                                        <label for="apellidos" class="usfornew">Apellidos:</label>
                                        <input style = "max-width: 95%;" type="text" required id="apellidos" value="'. (isset($registro) ? $registro->Apellidos : "") .'" name="apellidos" class="form-control">
                    
                                        <label for="clave" class="usfornew">Clave:</label>
                                        <input style = "max-width: 95%;" type="text" id="clave" name="clave" class="form-control">
                    
                                        <label for="genero" class="usfornew">Genero:</label>
                                        <input style = "max-width: 95%;" type="text" required id="genero" value="'. (isset($registro) ? $registro->Genero : "") .'" name="genero" class="form-control">
                    
                                        <label for="foto" class="usfornew">Foto:</label>
                                        <input style = "max-width: 95%;" type="file" accept="image/jpeg" id="foto" name="foto" class="form-control" onchange="mostrarMiniaturaFoto(event)">
                                        <img id="miniaturaFoto" src="data:image/jpg;base64,'. base64_encode($registro -> Foto) .'" alt="Fotografia" class="miFotoPerfil">
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" value="'. (isset($registro) ? "update" : "insert") .'" name="accion">
                            '. (isset($registro) ? '<input type="hidden" name="IdUsuario" value="' . $registro->IdUsuario . '">' : "") .'
                        </form> 
                        <script>
                            function mostrarMiniaturaFoto(event) {
                                const input = event.target;
                                if (input.files && input.files[0]) {
                                    const reader = new FileReader();

                                    reader.onload = function (e) {
                                        document.getElementById("miniaturaFoto").src = e.target.result;
                                    };

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>';
                    break;
                    
                case "insert":
                    $cadeQuery = "INSERT INTO Usuario SET ";
                    foreach ($_POST as $campo => $valor)
                        if (!in_array($campo, array('accion')))
                            $cadeQuery .= $campo . " = '" . $valor . "', ";

                    $cadeQuery = substr($cadeQuery, 0 , -2); 
                    $this -> consulta($cadeQuery);
                    $result = $this -> ejecuta("list");
                        
                    break;

                case "delete":
                    $this -> consulta("DELETE FROM Usuario WHERE IdUsuario = '". $_POST['id'] ."'");
                    $result = $this -> ejecuta("list");
                    break;

                case "update":

                    $cadeQuery = "UPDATE Usuario SET ";
                    foreach ($_POST as $campo => $valor)
                        if (!in_array($campo, array('accion','clave' ,"IdUsuario")))
                            $cadeQuery .= $campo . " = '" . $valor . "', ";
                        else if ($campo == 'clave')
                            $cadeQuery .= "Clave = MD5(" . $valor . "),";                    
                    echo $cadeQuery;
                    if (is_file($_FILES["foto"]['tmp_name'])){
                        $foto = file_get_contents($_FILES["foto"]['tmp_name']);
                        unlink($_FILES["foto"]['tmp_name']);
                        $cadeQuery .= "Foto = '" . addslashes($foto) . "', ";
                    }
                    $cadeQuery = substr($cadeQuery, 0 , -2);

                    $cadeQuery .= " WHERE IdUsuario = '" . $_POST['IdUsuario'] . "'";
                    echo $cadeQuery;
                    $this -> consulta($cadeQuery);
                    $_SESSION['Nombre'] = $_POST['nombre'] . " " . $_POST['apellidos'];
                    // $result = $this -> ejecuta("list");
                    $result = "Perfil Actualizado" ; 
                    break;  

                case 'Categoria':
                    $tota = $this -> getTupla(
                        "SELECT count(*) total FROM Rondas R 
                            JOIN Categoria C ON R.IdCategoria = C.IdCategoria 
                            JOIN Inscritos I ON I.IdInscrito = R.IdInscritos 
                        WHERE I.IdUsuario = " . $_SESSION['Id']);
                    
                    $this->consulta(
                        "SELECT count(*) cuantos, Categoria FROM Rondas R 
                            JOIN Categoria C ON R.IdCategoria = C.IdCategoria
                            JOIN Inscritos I ON I.IdInscrito = R.IdInscritos
                        WHERE I.IdUsuario = " . $_SESSION['Id'] ." group by C.IdCategoria;");

                    foreach ($this->bloque as $row) 
                    $result .= number_format(($row["cuantos"]/$tota->total*100),0)." ".$row["Categoria"]."##";
                    $result=substr($result,0,-2);
                    
                    break;

                case "No_Jugadas":
                    $resu = $this->getTupla(
                        "SELECT count(*) as TotalRondas FROM rondas r
                            JOIN inscritos i ON r.IdInscritos = i.IdInscrito
                        WHERE i.IdUsuario =  " . $_SESSION['Id']);
                    
                    $totalRondas = $resu -> TotalRondas;
                
                    $result = '<div><span class="fs-2 spinme" style = "">🎮</span>';
                    $result .= '<span class="badge bg-secondary Shantell-1 mt-2" style = "background-color: #1579c000 !important;">Rondas Jugadas: ' . $totalRondas . '</span></div>';
                    break;

                default:
                    $result = "<h1> $action No Programada</h1>";
            }
            return $result;
        }

        function desTabla($query){

            $this->consulta($query);
    
            $html = "<span class='badge-categoria'>Usuarios Registradas</span><br>";
    
            $html .= '<div class = "cCategoria"> <div> <div >';
    
            $numRegistro = 0;
    
            $html .= '<table class = "table categoria tusuario table-hover table-striped table-info" >';
    
            foreach ($this->bloque as $renglon) {
                $html .= '<tr>';
    
                $botoRemove = '<form method="post"><button class="bx bx-x-circle borrar"></button>
                                            <input type="hidden" value="' . $renglon['IdUsuario'] . '" name="id">
                                            <input type="hidden" value="delete" name="accion">
                                        </form>';
    
                $botoEdit = '<form method="post"><button class="bx bxs-edit-alt editar"></button>
                                        <input type="hidden" value="' . $renglon['IdUsuario'] . '" name="id">
                                        <input type="hidden" value="forEdit" name="accion">
                                    </form>';
                // Cabecera
                if ($numRegistro == 0) {
    
                    $cabecera = "";
                    $temp = "";
                    $numRegistro++;
    
                    foreach ($renglon as $campo => $dato) {
                        $cabecera .= '<th>' . $campo . '</th>';
                        $temp .= '<td>' . $dato . '</td>';
                    }
                    
                    $html .= $cabecera . '<th>Editar</th>';
                    $html .= '<th>Borrar</th>';
                    $html .= '</tr><tr>' . $temp;
                
                } else {    
                    // Contenido
                    foreach ($renglon as $campo => $dato) {
                        $html .= '<td>' . $dato . '</td>';
                    }
                }
                $html .= '<td>' . $botoEdit . '</td>';
                $html .= '<td>' . $botoRemove . '</td>';
                $html .= '</tr>';
            }
    
            $html .= '</table></div></div></div>';
    
            return $html;
        }
    }

    $oUsuario = new Usaurio();
?>

