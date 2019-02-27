<?php
session_start();
if (isset($_POST['user']) || isset($_POST['segusoc']))
{
    header("location:login.php");
}
//echo "usr:" . $_SESSION["user"]  . " p: " . $_SESSION['segusoc'] . "ejer: " . $_SESSION["ejercicio"]. " cad: " . $_SESSION["cadenames"];
echo '<p align="center"><a href="logout.php">Salir</a></p>';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap-grid.css">
    <link rel="stylesheet" href="./css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="./css/bootstrap-reboot.css">
    <link rel="stylesheet" href="./css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">


    <link rel="stylesheet" href="./scss/_progress.scss">
    <link rel="stylesheet" href="./scss/_popover.scss">
    <link rel="stylesheet" href="./scss/_grid.scss">
    <link rel="stylesheet" href="./scss/_forms.scss">
    <link rel="stylesheet" href="./scss/utilities/_align.scss">
    <link rel="stylesheet" href="./scss/utilities/_borders.scss">
    <link rel="stylesheet" href="./scss/mixins/_reset-text.scss">
    <link rel="stylesheet" href="./scss/mixins/_gradients.scss">
    <link rel="stylesheet" href="./scss/mixins/_display.scss">
    <link rel="stylesheet" href="./scss/mixins/_tavbe-rows.scss">

    <script src="./js/bootstrap.bundle.js" charset="utf-8"></script>		
    <script src="./js/bootstrap.bundle.min.js" charset="utf-8"></script>		
    <script src="./js/bootstrap.js" charset="utf-8"></script>		
    <script src="./js/bootstrap.min.js" charset="utf-8"></script>		
    <script src="./js/util.js" charset="utf-8"></script>		

    <script src="./js/jquery-3-3-1.js" charset="utf-8"></script>		


   
    <title>Recibos de Pensionados</title>
  </head>
  <body>

 <?php
        $_ejercicio = $_SESSION["ejercicio"];     
        $_cadenames = $_SESSION["cadenames"];     
        echo "Recibos del ejercicio: " . $_ejercicio;
 ?>
<form action="index.php" method="post"> 
 <div >Selecciona el ejercicio:
    <select id="cboejercicio" name="cboejercicio">
        <option value=""></option>    
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
    </select>
 </div>
  




</form>
<form action="#" method="post"> 


<table class="table table-striped table-responsive-md btn-table" disabled="disabled">

<thead>
  <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
</thead>

<tbody>
  <tr>
    <th scope="row"></th>
    <td>

        <?php
        $p_pension =  $_SESSION["user"];
        $p_nss =  $_SESSION["segusoc"];
        $_ejercicio = $_SESSION["ejercicio"];
        $_cadenames = $_SESSION["cadenames"];
    try 
       {
                    include "Conecta.php";
                    

                    $Consulta1 = "Select pensionado, nss, ";
                    $Consulta2 = " case when rene is null then  0 else 1 end rene, ";
                    $Consulta3 = " case when rfeb is null then  0 else 1 end rfeb, "; 
                    $Consulta4 = " case when rmar is null then  0 else 1 end rmar, ";
                    $Consulta5 = " case when rabr is null then  0 else 1 end rabr, "; 
                    $Consulta6 = " case when rmay is null then  0 else 1 end rmay, ";
                    $Consulta7 = " case when rjun is null then  0 else 1 end rjun, ";
                    $Consulta8 = " case when rjul is null then  0 else 1 end rjul, ";
                    $Consulta9 = " case when rago is null then  0 else 1 end rago, ";
                    $Consulta10 = " case when rsep is null then  0 else 1 end rsep, ";
                    $Consulta11 = " case when roct is null then  0 else 1 end roct, ";
                    $Consulta12 = " case when rnov is null then  0 else 1 end rnov, ";
                    $Consulta13 = " case when rdic is null then  0 else 1 end rdic  ";   
                    $Consulta14 = " from timbradopensionados.tim" . $_ejercicio  . " where pensionado = ? and nss = ? ";

                    $Consulta = $Consulta1.$Consulta2.$Consulta3.$Consulta4.$Consulta5.$Consulta6.$Consulta7.$Consulta8.$Consulta9.$Consulta10.$Consulta11.$Consulta12.$Consulta13.$Consulta14;
                    
                    $stmt = mysqli_prepare($conexion,$Consulta);
                    if ( !$stmt )
                    {   
                        throw new Exception(); }


                    if (! mysqli_stmt_bind_param($stmt,'ii',$p_pension,$p_nss))
                    {   
                        throw new Exception(); }

                    $Par = mysqli_stmt_execute($stmt);
                        if ($Par==false)
                        {
                            mysqli_stmt_close($stmt);
                            //echo "Error al ejecutar la consulta" . $Consulta . ' pe: ' . $p_pension . ' nss ' . $p_nss;
                            throw new Exception(); 
                        }else{
                            $Par =mysqli_stmt_bind_result($stmt,$pensionado,$nss,$rene,$rfeb,$rmar,$rabr,$rmay,$rjun,$rjul,$rago,$rsep,$roct,$rnov,$rdic);
                            while (mysqli_stmt_fetch($stmt)) {
            /* código para poner botones */
                            
                    if ($rene==1){
                        echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(1);' >Ene</button>";
                    }else{
                        echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Ene</button>";
                    }                
                    echo "</td>";
                    echo "<td>";
                    if ($rfeb==1){
                        echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(2);' >Feb</button>";
                    }else{
                        echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Feb</button>";
                    }                
                    echo "</td>";
                    echo "<td>";

                    if ($rmar==1){
                        echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(3);'>Mar</button>";
                    }else{
                        echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Mar</button>";
                    }                
                    echo "</td>";
                    echo "<tr>";
                echo "<tr>";
                echo "<th scope='row'></th>";
                echo "<td>";

                if ($rabr==1){
                    echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(4);'>Abr</button>";
                }else{
                    echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Abr</button>";
                }                
                echo "</td>";
                echo "<td>";
                if ($rmay==1){
                    echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(5);'>May</button>";
                }else{
                    echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>May</button>";
                }                
                echo "</td>";
                echo "<td>";

                if ($rjun==1){
                    echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(6);'>Jun</button>";
                }else{
                    echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Jun</button>";
                }                
                echo "</td>";
                echo "<tr>";
            echo "<tr>";
            echo "<th scope='row'></th>";
            echo "<td>";


            if ($rjul==1){
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(7);'>Jul</button>";
            }else{
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Jul</button>";
            }                
            echo "</td>";
            echo "<td>";
            if ($rago==1){
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(8);'>Ago</button>";
            }else{
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Ago</button>";
            }                
            echo "</td>";
            echo "<td>";

            if ($rsep==1){
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(9);'>Sep</button>";
            }else{
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Sep</button>";
            }                
            echo "</td>";
            echo "<tr>";
            echo "<tr>";
            echo "<th scope='row'></th>";
            echo "<td>";

            if ($roct==1){
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(10);' >Oct</button>";
            }else{
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Oct</button>";
            }                
            echo "</td>";
            echo "<td>";
            if ($rnov==1){
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(11);'>Nov</button>";
            }else{
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Nov</button>";
            }                
            echo "</td>";
            echo "<td>";

            if ($rdic==1){
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' onclick='muestra_pdf(12);'>Dic</button>";
            }else{
                echo "<button type='button' class='btn btn-outline-primary btn-sm m-0 waves-effect' disabled='disabled'>Dic</button>";
            }                
            echo "</td>";
            echo "<tr>";
            /*********************************************/
                            }
                        }
                    mysqli_stmt_close($stmt);
                    mysqli_close($conexion);
                    
         } catch (Exception $e) {
            mysqli_close($conexion);
                echo "  <div class='alert alert-success' role='alert'>";
                echo "   <h4 class='alert-heading'>Bienvenido!</h4>";
                echo "   <p>Para poder obtener tu recibo, primero deberás seleccionar el ejercicio a consultar y posteriormente presiona el mes que corresponda del recibo que deseas.</p>";                
                echo "   <p></p>";                
                echo "   <p><strong>Nota:</strong> si no aparecen tus recibos, deberás de acudir a la CAPREPOL </p>";                                
                echo "   <hr>";
                echo "   <p class='mb-0'><center><strong>No olvides mantener actualizados tus datos.</strong></center></p>";
                echo "   </div>";
                }
        ?>

 

</tbody>

</table>
</form>
</body>
</html>

<script>

$(document).ready(function(){
    $('#cboejercicio').change(function(){   
        var ejercicio = $(this).val();
            $.ajax({
                url:"ponejercicio.php",
                method:"POST",
                data:{ejercicio:ejercicio},
                cache:"false",
                beforeSend:function(){
                },
                success:function(data)
                        {
                         if (data == "1")
                            {
                                
                             window.location.href = 'index.php';

                            }else{
                              alert('err');
                            }
                         } // sucess 
            }); // ajax
    });// click(function ;
}); //ready(function
</script>



<script>
    function muestra_pdf(pmes)
    {    
      if (pmes >= 1 )
      {          
        var recibos =['rene','rfeb','rmar','"rabr','rmay','"rjun','rjul','rago','rsep','roct','rnov','rdic'];
        var cadenames = recibos[pmes-1];  
        $.ajax({
            url:"traecampo.php",//aqui va tu direccion donde esta tu funcion php
            method:"POST", //aqui puede ser igual get
            data:{cadenames:cadenames},//aqui tus datos 
            cache:"false",
            beforeSend:function(){},
            success:function(data){                
                if (data == "1")
                    {        
                      window.location.href = 'muestra.php';
                    }else{
                      alert( data);
                    }                      
           }
         });

      }else{
          alert("Debe de seleccionar un mes !!!");
      }
    }
    </script>



