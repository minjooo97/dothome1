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
                    <div class="listSearch">
                        <form name="tableSearch" method="post" action="searchResult.php">
                            <fieldset>
                                <legend class="sr-only">게시판 검색 영역입니다.</legend>
                                <input type="search" placeholder="검색어를 입력하세요!" aria-label="search" name="searchKeyword" class="form-search">
                                <select name="searchOption" id="searchOption" class="form-select">
                                    <option value="title">제목</option>
                                    <option value="content">내용</option>
                                    <option value="tandc">제목과 내용</option>
                                    <option value="torc">제목 또는 내용</option>
                                </select>
                                <button type="submit" class="form-btn">검색</button>
                                <a class="form-btn black" href="writeBoard.php">글 쓰기</a>
                            </fieldset>
                        </form>
                        <!-- <legend class="sr-only">검색란 입니다.</legend>
                        <div>
                            <label for="search" class="sr-only">검색</label>
                            <input type="search" name="search" id="search" class="input-text search" placeholder="검색어를 입력하세요!" required />
                        </div>
                        <div>
                            <label for="title" class="sr-only">제목</label>
                            <select name="title" id="title" class="title" required>
                                <option value="제목">제목</option>
                            </select>
                        </div>
                        <button class="searchBtn" type="submit" value="검색">검색</button>
                        <button class="writeBtn" type="submit" value="글쓰기"><a href="writeBoard.php">글쓰기</a></button> -->
                    </div>
                    <!-- //listSearch -->
                    <div class="listTable">
                        <table class="table">
                            <colgroup>
                                <col style="width: 10%">
                                <col style="width: 65%">
                                <col style="width: 10%">
                                <col style="width: 15%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>제목</th>
                                    <th>등록자</th>
                                    <th>게시일</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_GET['page'])){
                                        $page = (int) $_GET['page'];
                                    } else {
                                        $page = 1; 
                                    }

                                    $numView = 20;
                                    $viewLimit = ($numView * $page) - $numView;

                                    $sql = "SELECT b.boardID, b.boardTitle, m.youNickName, b.regTime FROM myBoard b JOIN myMember m ON (m.memberID = b.memberID) ORDER BY boardID ";
                                    $sql .= "ASC LIMIT {$viewLimit}, {$numView}";
                                    // $sql .= "LIMIT 0, 20";  //(20 * 1) - 20  --> {$numView * $page} - $numView 
                                    // $sql .= "LIMIT 20, 40";  //(20 * 2) - 20  --> {$numView * $page} - $numView 
                                    // $sql .= "LIMIT 40, 60";  //(20 * 3) - 20  --> {$numView * $page} - $numView 
                                    $result = $dbConnect -> query($sql);

                                    if($result){
                                        $dataCount = $result -> num_rows;

                                        if($dataCount > 0){
                                            for($i=1; $i<=$dataCount; $i++){
                                                $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
                                                echo "<tr>";
                                                echo "<td>".$memberInfo['boardID']."</td>";
                                                echo "<td class='left'><a href='viewBoard.php?boardID={$memberInfo['boardID']}'>".$memberInfo['boardTitle']."</a></td>";
                                                echo "<td>".$memberInfo['youNickName']."</td>";
                                                echo "<td>".date('Y-m-d H:i', $memberInfo['regTime'])."</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                        echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
                                        }
                                    } else {
                                        echo "관리자에게 문의하세요";
                                        exit;
                                    }
                                ?>
                                <!-- <tr>
                                    <td>1</td>
                                    <td>안녕하세요</td>
                                    <td>minjooo</td>
                                    <td>2021.01.07 14:30</td>
                                </tr> -->
                            </tbody>
                        </table>
                        <!-- //listTable -->

                        <!-- pagination -->
                        <?php
                            include 'pagination.php';
                        ?>
                        <!-- //pagination -->

                        <!-- <ul>
                            <li>번호</li>
                            <li>제목</li>
                            <li>등록자</li>
                            <li>게시일</li>
                        </ul>
                        <ul>
                            <li>1</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>2</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>3</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>4</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>5</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>6</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>7</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>8</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>9</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>10</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>11</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                        <ul>
                            <li>12</li>
                            <li><a href="#">포트폴리오는 어떻게 만드나요?</a></li>
                            <li>minjooo</li>
                            <li>2021.01.06 14:30</li>
                        </ul>
                    </div>
                    <div class="nextBtn">
                        <ul>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">6</a></li>
                            <li><a href="#">></a></li>
                            <li><a href="#">>></a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </section>
        <!-- //boradCont -->
    </main>
</body>
</html>