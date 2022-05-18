<?php include("template/cabecera.php"); ?>

<?php 
include("administrador/config/bd.php");
$sentenciaSQL= $conexion->prepare("SELECT * FROM manifiesto");
$sentenciaSQL->execute();
$listaManifiestos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listaManifiestos as $manifiestos) { ?>
<div class="col-md-4">
<div class="card">
    <img class="card-img-top" src="holder.js/100x180/" alt="">
    <div class="card-body">
        <h4 class="card-title"><?php echo $manifiestos['Finca']; ?></h4>
        <a name="" id="" class="btn btn-primary" href="administrador/seccion/manifiestos.php" role="button">Ver más</a>
    </div>
</div>
</div>
<?php } ?>


<?php include("template/pie.php"); ?>  