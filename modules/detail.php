<?php
    $invalidRequest = isset($_SESSION['ERR_COMMENT']) ? $_SESSION['ERR_COMMENT'] : null;
    $userLogged = isset($_SESSION['USER_LOGGED']) ? $_SESSION['USER_LOGGED'] : null;
?>
<?php 
    $id = $_GET['id'];
    $queryDetail = "SELECT 
                DATE_FORMAT(date,'%d/%m/%Y') as date, 
                description, 
                IFNULL(image ,'empty_new.png') as image, 
                title 
            FROM news WHERE id = '$id';";
    $resultQueryDetail = mysqli_query($cnx, $queryDetail);
    $detail = mysqli_fetch_assoc($resultQueryDetail);
    $queryComments = "SELECT c.content as description, 
                            DATE_FORMAT(c.date,'%d/%m/%Y') as date_comment, 
                            u.id, u.name, 
                            IFNULL(u.pic ,'empty_new.png') as pic FROM comments c
                     LEFT JOIN USER u ON u.id = c.fk_user WHERE c.fk_new = '$id'";
    $comments = mysqli_query($cnx, $queryComments);
?>
<section>
    <div class="jumbotron jumbotron-fluid jumbotron_register primary-color text-white">
        <div class="container">
            <h2 class="h2-reponsive mb-4 mt-2 font-bold"><?php echo $detail['title']; ?></h2>
            <p class="lead"><?php echo $detail['date']; ?></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid image__detail" src="uploads/<?php echo $detail['image']; ?>" alt="<?php echo $detail['title']; ?>" >
            </div>
            <div class="col-md-8">
                <p class="description__detail"><?php echo nl2br($detail['description']); ?></p>
            </div>
            <div class="col-md-12 ctn__comments">
                <h2 class="text-bold">Comentarios</h2>
                <?php if($comments->num_rows > 0) : ?>
                    <?php foreach($comments as $comment) : ?>
                        <div class="ctn__cluster__comment">
                            <div>
                                <img src="uploads/<?php echo $comment['pic']; ?>" class="img-fluid rounded-circle" alt="<?php echo $comment['name']; ?>" />
                            </div>
                            <div class="ctn__cluster__comment__detail">
                                <p><span class="badge badge-light"><?php echo $comment['date_comment']; ?></span></p>
                                <p class="text-bold"><?php echo $comment['name']; ?></p>
                                <p><?php echo $comment['description']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Esta noticia no posee comentarios, sé el primero</p>
                <?php endif; ?>
                <?php if(empty($userLogged)) : ?>
                    <a href="index.php?section=login">Inicia sesión para comentar</a>
                <?php else : ?>
                    <form id="form_send_comment" action="actions/sendComment.php" method="post">
                        <div class="md-form">
                            <i class="fas fa-pencil-alt prefix"></i>
                            <textarea name="comment" id="comment" class="md-textarea form-control" rows="3"></textarea>
                            <input type="hidden" name="idNew" value="<?php echo $id; ?>" />
                            <div>
                                <p id="errFormComment" class="invalid"><?php echo $invalidRequest ?></p>
                            </div>
                            <label for="comment">Escribir comentario</label>
                        </div>
                        <div class="text-center mt-4">
                            <button class="btn light-green" type="submit">Enviar</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

       
