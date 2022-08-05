<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
    $entrada_actual = conseguirEntrada($db, $_GET['id']);
    if(!isset($entrada_actual['id'])){
        header('Location: index.php');
    }
?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

    <div id="principal">
        <h1>Editar Entrada</h1>
        <p>
            Edita tu entrada <?=$entrada_actual['titulo'] ?>
        </p>
        <br>
        <form action="guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method="POST">
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>">
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo'): '';?>

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" cols="115" rows="10"><?=$entrada_actual['descripcion']?></textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion'): '';?>

            <label for="categoria">Categoria</label>
            <select name="categoria">
                <?php $categorias = conseguirCategorias($db);
                    if(isset($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)):
                ?>
                    <option value="<?=$categoria['id']?>"<?=($categoria['id'] == $entrada_actual['categoria_id'] ? 'selected="selected"' : '') ?>>
                                <?=$categoria['nombre']?>
                    </option>
                <?php 
                        endwhile;
                    endif;
                ?>

            </select>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria'): '';?>
            
            <input type="submit" value="Guardar">

        </form>
        <?php borrarErrores(); ?>
    </div>

<?php
    require_once 'includes/footer.php';
?>
