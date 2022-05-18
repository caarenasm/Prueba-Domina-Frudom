<?php include("../template/cabecera.php"); ?>
<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtFechaCrear=(isset($_POST['txtFechaCrear']))?$_POST['txtFechaCrear']:"";
$txtFechaNom=(isset($_POST['txtFechaNom']))?$_POST['txtFechaNom']:"";
$txtRepAso=(isset($_POST['txtRepAso']))?$_POST['txtRepAso']:"";
$txtCamRe=(isset($_POST['txtCamRe']))?$_POST['txtCamRe']:"";
$txtFink=(isset($_POST['txtFink']))?$_POST['txtFink']:"";
$txtCanLo=(isset($_POST['txtCanLo']))?$_POST['txtCanLo']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");


switch($accion){
    case "Agregar":
        
        $sentenciaSQL= $conexion->prepare("INSERT INTO manifiesto (Fecha_Creacion,Fecha_Nomina,Repartidor_Asociado,Camion_Reparto,Finca,Cantidades_Lotes) VALUES (:Fecha_Creacion,:Fecha_Nomina,:Repartidor_Asociado,:Camion_Reparto,:Finca,:Cantidades_Lotes);");
        $sentenciaSQL->bindParam(':Fecha_Creacion',$txtFechaCrear);
        $sentenciaSQL->bindParam(':Fecha_Nomina',$txtFechaNom);
        $sentenciaSQL->bindParam(':Repartidor_Asociado',$txtRepAso);
        $sentenciaSQL->bindParam(':Camion_Reparto',$txtCamRe);
        $sentenciaSQL->bindParam(':Finca',$txtFink);
        $sentenciaSQL->bindParam(':Cantidades_Lotes',$txtCanLo);
        $sentenciaSQL->execute();
        header("location:manifiestos.php");
        break;
    case "Modificar":
        $sentenciaSQL= $conexion->prepare("UPDATE manifiesto SET Fecha_Creacion=:Fecha_Creacion WHERE id=:id");
        $sentenciaSQL->bindParam(':Fecha_Creacion',$txtFechaCrear);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL= $conexion->prepare("UPDATE manifiesto SET Fecha_Nomina=:Fecha_Nomina WHERE id=:id");
        $sentenciaSQL->bindParam(':Fecha_Nomina',$txtFechaNom);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL= $conexion->prepare("UPDATE manifiesto SET Repartidor_Asociado=:Repartidor_Asociado WHERE id=:id");
        $sentenciaSQL->bindParam(':Repartidor_Asociado',$txtRepAso);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL= $conexion->prepare("UPDATE manifiesto SET Camion_Reparto=:Camion_Reparto WHERE id=:id");
        $sentenciaSQL->bindParam(':Camion_Reparto',$txtCamRe);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL= $conexion->prepare("UPDATE manifiesto SET Finca=:Finca WHERE id=:id");
        $sentenciaSQL->bindParam(':Finca',$txtFink);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL= $conexion->prepare("UPDATE manifiesto SET Cantidades_Lotes=:Cantidades_Lotes WHERE id=:id");
        $sentenciaSQL->bindParam(':Cantidades_Lotes',$txtCanLo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        header("location:manifiestos.php");
        break;
    case "Cancelar":
        header("location:manifiestos.php");
        break;
    case "Seleccionar":
        $sentenciaSQL= $conexion->prepare("SELECT * FROM manifiesto WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $manifiesto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtFechaCrear=$manifiesto['Fecha_Creacion'];
        $txtFechaNom=$manifiesto['Fecha_Nomina'];
        $txtRepAso=$manifiesto['Repartidor_Asociado'];
        $txtCamRe=$manifiesto['Camion_Reparto'];
        $txtFink=$manifiesto['Finca'];
        $txtCanLo=$manifiesto['Cantidades_Lotes'];

        //echo "Presionado Botón Seleccionar";
        break;
    case "Borrar":
            $sentenciaSQL= $conexion->prepare("DELETE FROM manifiesto WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        //echo "Presionado Botón Borrar";
        header("location:manifiestos.php");
        break;
        
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM manifiesto");
$sentenciaSQL->execute();
$listaManifiestos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="col-md-3.5">

    <div class="card">
        <div class="card-header">
            Datos del Manifiesto
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
        <div class = "form-group">
        <label for="txtID">ID</label>
        <input type="text" required readonly class="form-control" value="<?php echo $txtID ?>" name="txtID" id="txtID" placeholder="ID">
        </div>

        <div class = "form-group">
        <label for="txtFechaCrear">Fecha Creación</label>
        <input type="text" required class="form-control" value="<?php echo $txtFechaCrear ?>" name="txtFechaCrear" id="txtFechaCrear" placeholder="Fecha creación">
        </div>

        <div class = "form-group">
        <label for="txtFechaNom">Fecha Nomina</label>
        <input type="text" required class="form-control" value="<?php echo $txtFechaNom ?>" name="txtFechaNom" id="txtFechaNom" placeholder="Fecha nomina">
        </div>

        <div class = "form-group">
        <label for="txtRepAso">Repartidor Asociado</label>
        <input type="text" required class="form-control" value="<?php echo $txtRepAso ?>" name="txtRepAso" id="txtRepAso" placeholder="Repartidor asociado">
        </div>

        <div class = "form-group">
        <label for="txtCamRe">Camión Reparto</label>
        <input type="text" required class="form-control" value="<?php echo $txtCamRe ?>" name="txtCamRe" id="txtCamRe" placeholder="Camión reparto">
        </div>
        
        <div class = "form-group">
        <label for="txtFink">Finca</label>
        <input type="text" required class="form-control" value="<?php echo $txtFink ?>" name="txtFink" id="txtFink" placeholder="Finca">
        </div>

        <div class = "form-group">
        <label for="txtCanLo">Cantidades Lotes</label>
        <input type="text" required class="form-control" value="<?php echo $txtCanLo ?>" name="txtCanLo" id="txtCanLo" placeholder="Cantidades Lotes">
        </div>

        <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
            <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
            <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
        </div>

    </form>
        </div>
    </div>

    

</div>

<div class="col-md-8">
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha Creacion</th>
                <th>Fecha Nomina</th>
                <th>Repartidor Asociado</th>
                <th>Camion Reparto</th>
                <th>Finca</th>
                <th>Cantidades Lotes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaManifiestos as $manifiesto) { ?>
            <tr>
                <td><?php echo $manifiesto['id']; ?></td>
                <td><?php echo $manifiesto['Fecha_Creacion']; ?></td>
                <td><?php echo $manifiesto['Fecha_Nomina']; ?></td>
                <td><?php echo $manifiesto['Repartidor_Asociado']; ?></td>
                <td><?php echo $manifiesto['Camion_Reparto']; ?></td>
                <td><?php echo $manifiesto['Finca']; ?></td>
                <td><?php echo $manifiesto['Cantidades_Lotes']; ?></td>
                
                <td>

                    <form method="post">

                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $manifiesto['id']; ?>" />

                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />

                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                    </form>

                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</div>


<?php include("../template/pie.php"); ?>