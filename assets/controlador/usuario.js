var dataPoints = [
        { y: 6, label: "Aniamles" },
        { y: 4, label: "Nombres" },
        { y: 5, label: "Ciudades" },
        { y: 7, label: "Flores" },
        { y: 4, label: "Cosas" },
        { y: 2, label: "Apellidos" },
        { y: 9, label: "Colores" },
        { y: 4, label: "Comidas" }
    ];

var Puntos = [
    // { y: 26, name: "School Aid"},
    // { y: 20, name: "Medical Aid" },
    // { y: 5, name: "Debt/Capital" },
    // { y: 3, name: "Elected Officials" },
    // { y: 7, name: "University" },
    // { y: 17, name: "Executive" },
    // { y: 22, name: "Other Local Assistance"}
];

function usuario(accion,Id){
    switch (accion) {
        case "Perfil":
            EditPerfil(Id);
            break;
        
        case "actualizar":
            actualizarPerfil(Id);
            break;

        case "Categoria":
            mostrarMisCategorias(accion,Id);
            break;
        
        case "No_Jugadas":
            mostrarMisNumJugadas(accion,Id); 
            break;
        default:
            $.alert({
                title: "Error",content:accion + ", No esta programada en usuario.js"
            });
    }
}


function EditPerfil(Id) {
    $.confirm({ 
        // theme: 'modern',
        theme: 'material',
        title: "Editar Perfil",
        content: 'url: ../class/classUsuario.php?accion=Perfil',
        columnClass: "col-md-6",
        type: "green",
        buttons: {
            pruebame: {
                text: 'Actualizar',
                btnClass: 'btn-green',
                action: function () {
                    usuario("actualizar", Id);
                }
            },
            Cancelar: function () {
                
            }
        },
    });
}

function actualizarPerfil(Id) {
    var nombre = $("#nombre").val();
    var apellido = $("#apellidos").val();
    var clave = $("#clave").val();
    var genero = $("#genero").val();
    var formData = new FormData();
  
    if (nombre.trim() === "" || apellido.trim() === "" || clave.trim() === "" || genero.trim() === "") {
      $.alert({
        title: "Error",
        content: "Todos los campos deben estar llenos",
        type: "red",
        onClose: function () {
          usuario("Perfil", Id);
        }
      });
      return;
    }
    
    // formData=$("#formUsuario").serialize();
    formData = new FormData(document.getElementById("formUsuario"));
    // formData.append("dato", "valor");

    $.ajax({
        url: "../class/classUsuario.php", 
        data: formData,    
        type: "post",
        //  atributos a activar cuando el formualrio tenga archivos.
        dataType: "html",cache: false,contentType: false,processData: false,
        beforeSend: function() {},
        success: function (codigoHTMLResultante){ //
            // Si todo salio bien, Actualizar foto y nombre en la interfaz.
            datos = codigoHTMLResultante.split("##");
            
            alerta("Aviso", "Datos Actualizados", "green", function () {
                // Recargar la página después de cerrar la alerta
                location.reload(true);
            });

            if (datos.length > 1){  
                
            } else {
                if ($("#foto").prop("files").length === 0)
                    return;
                alerta("Aviso","Los datos o la foto no se actualizaron bien, vuelva a intentarlo, si el problema persiste, contacte a ayuda@basta.com")
            }
        } 
    } )
}

function alerta(titulo, contenido, color, onCloseCallback) {
    $.alert({
        title: titulo,
        content: contenido,
        type: color,
        onClose: onCloseCallback 
    });
}

function mostrarMisCategorias (accion,id) {

    $.ajax({url: "../class/classUsuario.php", 
         data: {'accion':accion},    
        type: "post",
        success: function (resultado) {
            rengDatos=resultado.split("##")
            rengDatos.forEach(function (renglon){
                punto = renglon.split(" ")
                Puntos.push({ y: punto[0], name: punto[1]})
                cargaGrafica();
            });
        }
   })

    // var chart = new CanvasJS.Chart("chartContainer", {
    //     title: {
    //         text: "Mis Categorias",
    //         fontColor: "rgba(26, 223, 214, 0.959)"
    //     },
    //     backgroundColor: "#a42b2b00",
    //     data: [{
    //         type: "pie",
    //         indexLabel: "{label} : #percent%",
    //         toolTipContent: "{label}: {y}",
    //         indexLabelFontColor: "black",
    //         dataPoints: dataPoints
    //     }]
    // });

    // chart.render();
} 

function cargaGrafica(){
    
    var chart = new CanvasJS.Chart("chartContainer", {
        // exportEnabled: true,
        animationEnabled: true,

        title:{
            text: "Categorias Respondidas",
            fontColor: "rgba(26, 223, 214, 0.959)",
            fontWeight: "bold",
            fontFamily: "Arial, sans-serif",
            fontSize: 50,
        },
        backgroundColor: "#a42b2b00",
        data: [{
            type: "pie",
            showInLegend: true,
            toolTipContent: "{name}: <strong>{y}%</strong>",
            indexLabel: "{name} - {y}%",
            dataPoints: Puntos,
            indexLabelFontColor: "rgba(26, 223, 214, 0.959)"
        }]
        });
    chart.render();   
}

function mostrarMisNumJugadas(accion,id) {
    $.ajax({ 
        url: "../class/classUsuario.php",
        method: "POST",
        data: { "accion":accion },
        success: function (resultado){
        $("#rank").html(resultado) },
    })
}