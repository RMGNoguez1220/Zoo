<?php
    if (!class_exists("BaseDate"))
        include "classBD.php";
    if (!isset($_SESSION['Id'])){
        session_start();
        if (!isset($_SESSION['Id']))
            exit;
    }
    class Animales extends BaseDate{

        function __construct(){
            if(isset($_REQUEST['accion']))
                echo $this -> ejecuta($_REQUEST['accion']);
        }
 
        public function ejecuta($action) {

            $result = "";
            switch ($action) {
                case "list":
                    if (!$_SESSION['isAdmin']){
                        $cadeQuery = "SELECT Foto,NombreComun,Apodo, t.TipoAlimentacion, h.Descripcion as Habitat, c.Clima as 'Clima', a.Descripcion as 'Descripción' FROM Animal a
                        JOIN zoobd.tipoalimentacion t on a.TipoAlimentacion_id = t.IdTipoAlimentacion
                        JOIN zoobd.habitat h on a.Habitat_id = h.IdHabitat
                        JOIN zoobd.clima c on h.Clima_id = c.IdClima
                        order by IdAnimal";
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
            $html = "<div class='titulo-vista'><span>Animales</span><br></div>";
            $html .= '<div class="cAnimales">';
        
            $ordenInvertido = false; 
        
            foreach ($this->bloque as $renglon) {
                $html .= '<div class="info-animal">';
        
                if ($ordenInvertido) {
                    // descripcion, info, foto
                    $html .= '<div class="info2">';
                    $html .= $renglon['Descripción'];
                    $html .= '</div>';
        
                    $html .= '<div class="info">';
                    foreach ($renglon as $campo => $dato) {
                        if ($campo === 'NombreComun') {
                            $html .= '<p><strong>Nombre Común:</strong> ' . $dato . '</p>';
                        } elseif ($campo === 'TipoAlimentacion') {
                            $html .= '<p><strong>Alimentación:</strong> ' . $dato . '</p>';
                        } elseif ($campo !== 'Foto' && $campo !== 'Descripción') {
                            $html .= '<p><strong>' . $campo . ':</strong> ' . $dato . '</p>';
                        }
                    }
                    $html .= '</div>'; // div final info
        
                    $html .= '<div class="foto-grande">';
                    $html .= '<img src="' . $renglon['Foto'] . '" alt="Foto del animal">';
                    $html .= '</div>';
                } else {
                    // foto, info, descripcion
                    $html .= '<div class="foto-grande">';
                    $html .= '<img src="' . $renglon['Foto'] . '" alt="Foto del animal">';
                    $html .= '</div>';
        
                    $html .= '<div class="info">';
                    foreach ($renglon as $campo => $dato) {
                        if ($campo === 'NombreComun') {
                            $html .= '<p><strong>Nombre Común:</strong> ' . $dato . '</p>';
                        } elseif ($campo === 'TipoAlimentacion') {
                            $html .= '<p><strong>Alimentación:</strong> ' . $dato . '</p>';
                        } elseif ($campo !== 'Foto' && $campo !== 'Descripción') {
                            $html .= '<p><strong>' . $campo . ':</strong> ' . $dato . '</p>';
                        }
                    }
                    $html .= '</div>'; // div final info
        
                    $html .= '<div class="info2">';
                    $html .= $renglon['Descripción'];
                    $html .= '</div>';
                }
        
                $html .= '</div>';  // div final info-animales
        
                // Cambiar la variable de control para el próximo ciclo
                $ordenInvertido = !$ordenInvertido;
            }
        
            $html .= '</div>'; // div final cAnimales
            return $html;
        }
        
        
    }

    $oAnimales = new Animales();
?>

