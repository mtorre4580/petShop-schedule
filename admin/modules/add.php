<?php 
    $query = "SELECT * FROM category";
    $categories = mysqli_query($cnx, $query);
?>
<div class="jumbotron jumbotron-fluid jumbotron_register primary-color text-white">
    <div class="container">
        <h2 class="h2-reponsive mb-4 mt-2 font-bold">Agregar noticia</h2>
    </div>
</div>
<div class="container__form__edit">
    <form id="form_add" method="POST" action="actions/add.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4 container__img__edit">
                <div style="width:50%;display:flex;justify-content:center;align-items:center;flex-wrap:wrap">
                    <label for="pic" class="btn light-green btn-small" style="border:0;display:flex;justify-content:center;align-items:center">
                        <input id="pic" type="file" style="display:none;" class="form-control" name="image" />
                        <i class="fa fa-image" style="text-align:center;font-size: 5em"></i>
                    </label>
                    <span style="color:#757575">Subir Foto</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="md-form">
                    <input type="text" id="title" name="title" class="form-control" />
                    <label for="title">Título</label>
                </div>
                <div class="md-form ml-0 mr-0">
                    <p class="label__category">Categoría</p>
                    <select class="form-control option__reservation" name="type">
                        <option value="">Sin categoría</option>
                        <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                        <option value="<?php echo $category['id'];?>">
                            <?php echo $category['description'];  ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="md-form">
                    <textarea id="add_description_new" name="description" class="form-control form-control rounded-0" rows="5" cols="50"></textarea>
                    <label for="add_description_new">Descripción</label>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <button class="btn light-green" type="submit">Aceptar</button>
        </div>
    </form>
</div>