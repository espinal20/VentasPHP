<?php include_once "includes/header.php";
    include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "almacen";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
    if (!empty($_POST)) {
		$id = $_POST['id'];
        $nombre_almacen = $_POST['nombre_almacen'];
        $fecha_almacen = $_POST['fecha_almacen'];
        $alert = "";
        if (empty($id) || empty($nombre_almacen) || empty($fecha_almacen)) {
            $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
        } else {
            $query = mysqli_query($conexion, "SELECT * FROM almacen WHERE id = '$id'");
            $result = mysqli_fetch_array($query);
            if ($result > 0) {
                $alert = '<div class="alert alert-warning" role="alert">
                        El código ya existe
                    </div>';
            } else {
				$query_insert = mysqli_query($conexion,"INSERT INTO almacen(id,nombre_almacen,fecha_almacen) values ('$id', '$nombre_almacen','$fecha_almacen')");
                if ($query_insert) {
                    $alert = '<div class="alert alert-success" role="alert">
                Almacen Registrado
              </div>';
                } else {
                    $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el almacen
              </div>';
                }
            }
        }
    }
    ?>
 <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevo_almacen"><i class="fas fa-plus"></i></button>
 <?php echo isset($alert) ? $alert : ''; ?>
 <div class="table-responsive">
     <table class="table table-striped table-bordered" id="tbl">
         <thead class="thead-dark">
             <tr>
                 <th>Id</th>
                 <th>Nombre Almacen</th>
                 <th>Fecha de Registro</th> 
             </tr>
         </thead>
         <tbody>
             <?php
                include "../conexion.php";

                $query = mysqli_query($conexion, "SELECT * FROM almacen");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query)) {
                        if ($data == 1) {
                        
                        } else {
                            
                        }
                ?>
                     <tr>
                         <td><?php echo $data['id']; ?></td>
                         <td><?php echo $data['nombre_almacen']; ?></td>
                         <td><?php echo $data['fecha_almacen']; ?></td>
             <?php }
                } ?>
         </tbody>

     </table>
 </div>
 <div id="nuevo_almacen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header bg-primary text-white">
                 <h5 class="modal-title" id="my-modal-title">Nuevo Almacen</h5>
                 <button class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="" method="post" autocomplete="off">
                     <?php echo isset($alert) ? $alert : ''; ?>
                     <div class="form-group">
                         <label for="id">Id del Almacen</label>
                         <input type="text" placeholder="Ingrese el id del almacen" name="id" id="id" class="form-control">
                     </div>
                     <div class="form-group">
                         <label for="nombre_almacen">Nombre del Almacen</label>
                         <input type="text" placeholder="Ingrese nombre del almacen" name="nombre_almacen" id="nombre_almacen" class="form-control">
                     </div>
                     <div class="form-group">
                         <label for="fecha_almacen">Precio</label>
                         <input type="date" class="form-control" name="fecha_almacen" id="fecha_almacen">
                     </div>
                     
                     <input type="submit" value="Guardar Almacen" class="btn btn-primary">
                 </form>
             </div>
         </div>
     </div>
 </div>

 <?php include_once "includes/footer.php"; ?>
