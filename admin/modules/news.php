<?php
    $news = getAllNews();
    $totalNews = getTotalNews();

    /**
     * Permite obtener la cantidad de noticias que hay registradas
     * @return string
     */
    function getTotalNews() {
        $query = "SELECT COUNT(id) as TOTAL from news;";
        global $cnx;
        $rows = mysqli_query($cnx, $query);
        $results = mysqli_fetch_assoc($rows);
        $totalNews = $results['TOTAL'];
        return $totalNews;
    }

    /**
     * Permite obtener las noticias 
     * @return Array
     */
    function getAllNews() {
        $query = "SELECT n.id, 
            DATE_FORMAT(n.date,'%d/%m/%Y') as date, 
            CONCAT(LEFT(n.title, 10), '...') as title, 
            c.description AS category, 
            CONCAT(LEFT(n.description, 50), '...') as description
            FROM news n 
            LEFT JOIN category c on c.id = n.fk_category
            ORDER BY n.date DESC; ";
        global $cnx;
        return mysqli_query($cnx, $query);
    }

?>
<div class="jumbotron jumbotron-fluid jumbotron_register primary-color text-white">
    <div class="container">
        <h2 class="h2-reponsive mb-4 mt-2 font-bold">Noticias</h2>
        <p class="lead"> Ya se encuentran registradas <?php echo $totalNews; ?> noticias en el sistema</p>
    </div>
</div>
<div class="table-editable" style="padding-left:15px;padding-right:15px">
    <span class="table-add float-right mb-3 mr-2">
        <a href="index.php?section=add" class="text-success">
            <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
        </a>
    </span>
    <table class="table table-bordered table-responsive-md table-striped text-center">
        <tr>
            <th class="text-center">Fecha</th>
            <th class="text-center">Título</th>
            <th class="text-center">Categoría</th>
            <th class="text-center">Descripción</th>
            <th class="text-center">Acciones</th>
        </tr>
        <?php while($new = mysqli_fetch_assoc($news)): ?>
            <tr>
                <td class="pt-3-half"><?php echo $new['date']; ?></td>
                <td class="pt-3-half"><?php echo $new['title']; ?></td>
                <td class="pt-3-half"><?php echo $new['category']; ?></td>
                <td class="pt-3-half"><?php echo $new['description']; ?></td>
                <td>
                    <span class="table-remove">
                        <a class="btn btn-primary btn-sm my-0" href="index.php?section=edit&id=<?php echo $new['id'];?>">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm my-0" href="actions/delete.php?section=delete&id=<?php echo $new['id'];?>">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </span>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

