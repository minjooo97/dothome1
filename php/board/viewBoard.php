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
            <a href="#boradCont">게시판</a>
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
        <!-- board -->
        <section id="boardCont">
            <div class="container">
                <div class="listBoard">
                    <h2>무엇이든 물어보세요!</h2>
                    <div class="listTable">
                        <table class="table">
                            <colgroup>
                                <col style="width: 20%">
                                <col style="width: 80%">
                            </colgroup>
                            <tbody>
                                <?php
                                    if(isset($_GET['boardID']) && (int) $_GET['boardID'] > 0){
                                        $boardID = $_GET['boardID'];

                                        $sql = "SELECT b.boardID, b.boardTitle, b.boardContent, m.youNickName, b.regTime FROM myBoard b JOIN myMember m ON (m.memberID = b.memberID) WHERE b.boardID = {$boardID}";

                                        $result = $dbConnect -> query($sql);

                                        if($result){
                                            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
                                            
                                            echo "<tr><th>제목</th><td class='left'>".$memberInfo['boardTitle']."</td></tr>";
                                            echo "<tr><th>등록자</th><td class='left'>".$memberInfo['youNickName']."</td></tr>";
                                            echo "<tr><th>등록일</th><td class='left'>".date('Y-m-d H:i', $memberInfo['regTime'])."</td></tr>";
                                            echo "<tr><th class='h'>내용</th><td class='left h'>".$memberInfo['boardContent']."</td></tr>";
                                        }
                                    }
                                ?>
                                <!-- <tr>
                                    <th>제목</th>
                                    <td>내용</td>
                                </tr>
                                <tr>
                                    <th>등록자</th>
                                    <td>내용</td>
                                </tr>
                                <tr>
                                    <th>등록일</th>
                                    <td>내용</td>
                                </tr>
                                <tr>
                                    <th>내용</th>
                                    <td>내용</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="listSearch">
                        <a class="form-btn black mt10" href="board.php">목록보기</a>
                    </div>
                    <!-- //listTable -->
                </div>
            </div>
        </section>
        <!-- //boradCont -->
    </main>
</body>
</html>