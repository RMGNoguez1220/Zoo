<?php
    if (!class_exists("BaseDate"))
        include "classBD.php";
    if (!isset($_SESSION['Id'])){
        session_start();
        if (!isset($_SESSION['Id']))
            exit;
    }
    class Recorridos extends BaseDate{

        function __construct(){
            if(isset($_REQUEST['accion']))
                echo $this -> ejecuta($_REQUEST['accion']);
        }
 
        public function ejecuta($action) {

            $result = "";
            switch ($action) {
                case "list":
                    if (!$_SESSION['isAdmin']){
                        $cadeQuery = "SELECT r.IdRecorrido,TipoRecorrido as 'Recorrido De Tipo', Precio, Horario, concat(u.Nombre, ' ', u.Apellidos) as Guia
                        FROM recorrido r
                        join usuario u on r.Guia_id = u.IdUsuario";
                        $result = $this -> desTabla($cadeQuery);
                    } else 
                        $result = null;
                    break; 

                default:
                    $result = "<h1> $action No Programada</h1>";
            }
            return $result;
        }

        function desTabla($query) {
            $this->consulta($query);
            $vista = '';
            $html = "<div class='titulo-vista'><span>Recorridos</span><br></div>";
            $html .= '<div class="cAnimales">';
        
            $ordenInvertido = false; 
        
            foreach ($this->bloque as $renglon) {
                $TipoRecorrido = "Select TipoRecorrido from recorrido where IdRecorrido =" . $renglon['IdRecorrido'] ;
                $num = $this -> getTupla($TipoRecorrido);

                $html .= '<div class="info-animal">';

                if ($num -> TipoRecorrido === 'safari')
                    $Foto = "..\img\safari.jpg";
                elseif ($num -> TipoRecorrido === 'normal')
                    $Foto = "..\img\dnormal.jpg";
                elseif ($num -> TipoRecorrido === 'coche')
                    $Foto = "..\img\coche.jpg";
               
                if ($ordenInvertido) {
        
                    $html .= '<div class="info">';
                    foreach ($renglon as $campo => $dato) {
                        if ($campo === 'NombreComun') {
                            $html .= '<p><strong>Nombre Común:</strong> ' . $dato . '</p>';
                        } elseif ($campo === 'TipoAlimentacion') {
                            $html .= '<p><strong>Alimentación:</strong> ' . $dato . '</p>';
                        } elseif ($campo !== 'IdRecorrido' && $campo !== 'Descripción') {
                            $html .= '<p><strong>' . $campo . ':</strong> ' . $dato . '</p>';
                        }
                    }
                    $html .= '</div>'; // div final info
                    $html .= '<div class="foto-grande izquierda">';
                    $html .= '<img  src="'.$Foto.'" alt="Foto del animal" class = "imgVista">';
                    $html .= '</div>';
                } else {
                    // foto, info, descripcion
                    $html .= '<div class="foto-grande derecha">';
                    $html .= '<img src="'.$Foto.'" alt="Foto del animal" class = "imgVista">';
                    $html .= '</div>';
        
                    $html .= '<div class="info">';
                    foreach ($renglon as $campo => $dato) {
                        if ($campo === 'NombreComun') {
                            $html .= '<p><strong>Nombre Común:</strong> ' . $dato . '</p>';
                        } elseif ($campo === 'TipoAlimentacion') {
                            $html .= '<p><strong>Alimentación:</strong> ' . $dato . '</p>';
                        } elseif ($campo !== 'IdRecorrido' && $campo !== 'Descripción') {
                            $html .= '<p><strong>' . $campo . ':</strong> ' . $dato . '</p>';
                        }
                    }
                    $html .= '</div>'; // div final info
                }
        
                $html .= '</div>';  // div final info-animales
        
                // Cambiar la variable de control para el próximo ciclo
                $ordenInvertido = !$ordenInvertido;
            }
        
            $html .= '</div>'; // div final cAnimales
            return $html;
        }
        
    }

    $oRecorridos = new Recorridos();
?>

