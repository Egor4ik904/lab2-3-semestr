<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css?ver=<?php echo time()?>"><link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>CRUD</title>
</head>
<body>

<header>
    <div class="container">
        <div class="header__main">
            <p><?=$_COOKIE['user']?></p>
            <a href="/lab_2_egor/exit.php">Exit</a>
        </div>
    </div>
</header>


<main>
    <div class="container">
        <div class="main">
            <div class="main__column main__column--nav">
            </div>
            <div class="main__column main__column--timeline">
                <div class="offer">
                    <h2>Лента новостей</h2>
                    <a href="#add__offer" class="offer__news">
                        Предложить новость
                    </a>
                </div>
                <?php
                $connect = mysqli_connect('localhost', 'root', 'root', 'login_form');
                $mysql = mysqli_query($connect, "SELECT * FROM `posts` order by id desc");
                $count = 0;

                if($mysql->num_rows > 0) {
                    while ($row = $mysql->fetch_assoc()) {
                        if($count <= 100) {
                            $user = $row;
                            $user_id = $user['id'];
                            $user_id = (int)$user_id;

                            if ($user['image'] > 0) {
                                $image = base64_encode($user['image']);
                                $show_image = '<img src="data:image/*;base64,'.htmlspecialchars($image).'" alt="">';
                            } else {
                                $show_image = '';
                            }

                            $post =  '
                            <div class="news">
                                <div class="news__content">
                                    <h3 class="news__user">'.htmlspecialchars($user['user']).'</h3>
                                    '. $show_image .'
                                    <p class="news__text">'.htmlspecialchars($user['text']).'</p>
                                    <div class="feedback">
                                        <form action="posts/like.php" method="post">
                                            <input type="hidden" value="'.$user_id.'" name="post_id">
                                            <button type="submit" class="like" name="like">
                                                <img class="plus" src="free-icon-like-126473.png">
                                                <p class="counter__like">'.htmlspecialchars($user['likes']).'</p>
                                            </button>
                                        </form>
                                        <form action="posts/dislike.php" method="post">
                                            <input type="hidden" value="'.$user_id.'" name="post_id_dislike">
                                            <button type="submit" class="dislike" name="dislike">
                                                <img class="minus" src="free-png.ru-37.png" alt="">
                                                <p class="counter__dislike">'.htmlspecialchars($user['dislikes']).'</p>
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            '."\n";

                            echo $post;
                            $comment = '';
                            $count++;
                        }
                    }
                }
                ?>
            </div>

            <div class="main__column main__column--recommendations">

            </div>

            <div id="add__offer">
                <div id="add__offer_window">
                    <form class="add__post__form" action="posts/posts.php" method="post" enctype="multipart/form-data">
                        <textarea placeholder="Enter your message" rows="4" cols="50" id="massage" name="message"  required="" ></textarea>
                        <div class="input__wrapper">
                            <input name="file" type="file" id="input__file" class="input input__file" multiple>
                        </div>
                        <div class="add__offer_buttons">
                            <a href="#" class="offer__news">Закрыть</a>
                            <button class="offer__news" type="submit">Предложить новость</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
