<?php 

    $id = isset($_GET['id']) ? $_GET['id'] : header("location:index.php?section=news");
    $categories = getAllCategories();
    $new = getDetailNew($id);

    /**
     * Permite obtener todas las categorias para mostrar en el select
     * @return Array
     */
    function getAllCategories() {
        $query = "SELECT * FROM category";
        global $cnx;
        return mysqli_query($cnx, $query);
    }

    /**
     * Permite obtener el detalle completo de la noticia
     * @param string $id
     * @return Array
     */
    function getDetailNew($id) {
        $query = "SELECT * FROM news WHERE id='$id';";
        global $cnx;
        $result = mysqli_query($cnx, $query);
        return mysqli_fetch_assoc($result);
    }

?>
<div class="jumbotron jumbotron-fluid jumbotron_register primary-color text-white">
    <div class="container">
        <h2 class="h2-reponsive mb-4 mt-2 font-bold">Editar</h2>
        <p class="lead">Una vez que modifiques los datos se veran reflejados en el listado de novedades</p>
    </div>
</div>
<div class="container__form__edit">
    <form id="form_edit" method="POST" action="actions/edit.php">
        <div class="row">
            <div class="col-md-4 container__img__edit">
                <img src="../uploads/<?php echo empty($new['image']) ? 'empty_new.png' : $new['image'] ?>" class="img-fluid" alt="<?php echo $new['title']; ?>" />
            </div>
            <div class="col-md-8">
                <div class="md-form">
                    <input type="text" value="<?php echo $new['title']; ?>" id="title" name="title" class="form-control" />
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <label for="title">Título</label>
                </div>
                <div class="md-form ml-0 mr-0">
                    <p class="label__category">Categoría</p>
                    <select class="form-control option__reservation" name="type">
                        <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                        <option value="<?php echo $category['id'];?>" <?php if($category['id'] == $new['fk_category'] ) echo ' selected '; echo '' ?>>
                            <?php echo $category['description'];  ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="md-form">
                    <textarea id="edit_description_new" name="description" class="form-control form-control rounded-0" rows="5" cols="50">
                        <?php echo nl2br($new['description']); ?>
                    </textarea>
                    <label for="edit_description_new">Descripción</label>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <button class="btn light-green" type="submit">Modificar</button>
        </div>
    </form>
</div>