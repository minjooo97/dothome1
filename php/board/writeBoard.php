<?php
    include '../connect/connect.php';
    include '../connect/session.php';
    include '../connect/checkSession.php';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="webstoryboy">
    <meta name="description" content="웹스토리보이 포트폴리오 사이트입니다.">
    <meta name="keywords" content="웹표준, 웹접근성, 사이트만들기, 포트폴리오, 웹스토리보이">
    <title>minjoo's Portfolio</title>
    
    <!-- CSS Style -->
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <!-- webfonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
</head>
<body>
    <!-- skip -->
        <div id="skip">
            <a href="#boradCont">게시글 작성하기</a>
        </div>
    <!-- //skip -->
   
    <!-- header -->
    <header id="header">
        <?php
            include '../component/header.php';
        ?>
    </header>
    <!--  //header -->
    <main>
        <!-- boradCont -->
        <section id="boradCont">
            <div class="container">
                <div class="writeBoard">
                    <h2>게시글을 작성해주세요.</h2>
                    <form action="saveBoard.php" name="boardwrite" method="post">
                        <fieldset>
                            <legend class="sr-only">게시판 작성 영역입니다.</legend>
                            <div>
                                <label for="boardTitle">제목</label>
                                <input type="text" name="boardTitle" id="boardTitle" class="title-text" require autofocus placeholder="제목을 작성해주세요." />
                            </div>
                            <div>
                                <label for="boardTitle">내용</label>
                                <textarea name="boardContent" id="boardContent" class="title-text" rows="13" require placeholder="내용을 작성해주세요."></textarea>
                            </div>
                        </fieldset>
                        <button class="writeBoardBtn" type="submit" value="저장하기">저장하기</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- //boradCont -->
    </main>
</body>
</html>