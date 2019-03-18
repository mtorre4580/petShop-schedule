<?php

    $limitLength = 6; 
    $totalNews = 'SELECT COUNT(ID) AS TOTAL FROM news;';
    $rows = mysqli_query($cnx, $totalNews);
    $results = mysqli_fetch_assoc($rows);
    $totalRows = $results['TOTAL'];
    $totalLinks = ceil($totalRows / $limitLength);
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    if ($currentPage < 1) { 
        $currentPage = 1; 
    }
    if ($currentPage > $totalLinks) { 
        $currentPage = $totalLinks; 
    }
    $limitInit = ($currentPage - 1) * $limitLength; 
    if ($limitInit < 0 ) { 
        $limitInit = 0; 
    }

    $query = "SELECT n.id , 
                DATE_FORMAT(n.date,'%d/%m/%Y') as date,
                LEFT(n.description, 100) as description, 
                IFNULL(n.image ,'empty_new.png') as image , 
                n.title, c.description AS category 
            FROM news n LEFT JOIN category c ON  n.fk_category = c.id";

    $categorySelected = isset($_GET['category']) ? $_GET['category'] : null;

    if(!empty($categorySelected) && ($categorySelected > 0 && $categorySelected < getTotalCategories())) {
        $query = $query." WHERE n.fk_category = '$categorySelected'"; 
    } else {
        $query = $query." ORDER BY date DESC LIMIT $limitInit, $limitLength ;";
    }

    $news = mysqli_query($cnx, $query);
    
    $categories = getAllCategories();

    /**
     * Permite obtener todas las categorias
     * @return Array
     */
    function getAllCategories() {
        $query = "SELECT * FROM category";
        global $cnx;
        return mysqli_query($cnx, $query);
    }

    /**
     * Permite obtener el total de categorias para validar despues
     * @return Array
     */
    function getTotalCategories() {
        $query = "SELECT COUNT(ID) AS TOTAL from category;";
        global $cnx;
        $rows = mysqli_query($cnx, $query);
        $results = mysqli_fetch_assoc($rows);
        return $results['TOTAL'];
    }

?>
<section>
    <div class="jumbotron jumbotron-fluid jumbotron_register primary-color text-white">
        <div class="container">
            <h2 class="h2-reponsive mb-4 mt-2 font-bold">Noticias</h2>
        </div>
        <div class="container">
            <?php if(!empty($categorySelected)) : ?>
                <div class="container__categories">
                    <a class="btn-floating peach-gradient" href="index.php?section=news" style="color:#fafafa">Quitar filtros 
                        <i class="far fa-times-circle"></i>
                    </a>
                </div>
            <?php endif; ?>
            <div class="container__categories">
                <?php foreach($categories as $category) : ?>
                    <a href="index.php?section=news&category=<?php echo $category['id'];?>" class="badge badge-success">
                        <?php echo $category['description']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="container__news">
            <div class="row">
                <?php if(!empty($news)) : ?>
                    <?php foreach($news as $new) : ?>
                        <div class="col-md-4">
                            <div class="card card_new">
                                <div class="view overlay">
                                    <a href="index.php?section=detail&id=<?php echo $new['id']; ?>">
                                        <img class="card-img-top" src="uploads/<?php echo $new['image']; ?>" alt="<?php echo $new['title']; ?>" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo $new['title']; ?></h3>
                                    <span><i class="far fa-clock"></i> <?php echo $new['date']; ?></span>
                                    <hr class="hr-light">
                                    <p class="card-text mb-4"><?php echo $new['description']; ?></p>
                                    <a href="index.php?section=detail&id=<?php echo $new['id']; ?>" class="d-flex justify-content-end">
                                        <span style="font-size:1.2rem">Leer más <i class="fa fa-angle-double-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php if($totalLinks != 1) : ?>
            <nav>
                <ul class="pagination pagination-circle pg-blue mb-0 justify-content-end">
                    <?php if($currentPage > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?section=news&page=<?php echo $currentPage - 1;?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php for($i = 1; $i < $totalLinks ; $i++) : ?>
                        <?php if($i == $currentPage): ?>
                            <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link" href="index.php?section=news&page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if($currentPage < $totalLinks): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?section=news&page=<?php echo $currentPage + 1;?>"><span aria-hidden="true">&raquo;</span></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>

