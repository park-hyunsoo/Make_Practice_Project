<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/common/session.php';
    if(isset($_SESSION['myMemberSes'])){
        header("Location:./me.php");
        exit;
    }
?>
<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta charset="utf-8" />
    <title> Web Service </title>
    <link rel="stylesheet" href="./css/reset.css" />
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./js/index.js"></script>
</head>
<body class="container">
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/include/header.php';
    ?>
    <!-- 컨테이너 부분 -->
    <div id="container">
    <section id="introSite"> <!-- 이렇게 섹션을 나눠논 부분을 pc에서는 전부 보이고 모바일에서는 보이지 않게 한다. -->
        <div id="siteComment"> <!-- 사이트 설명 -->
             My First Web Service 
        </div>
        <div id="signUpBtn"> <!-- 회원 가입 버튼 -->
            <p> 가입하기 </p>
        </div>
    </section>
    <section id="signUp">
        <div id="signUpCenter">
            <form id="signUpForm" method="post" action="./myMember.php"> <!-- 가입 정보 입력 -->
                <div class="row">
                    <div class="inputBox">
                        <input type="text" name="userName" id="userName" placeholder="이름" />
                    </div>
                </div>
                <div class="row">
                    <div class="inputBox">
                        <input type="email" name="userEmail" id="userEmail" placeholder="이메일" />
                    </div>
                </div>
                <div class="row">
                    <div class="inputBox">
                        <input type="password" name="userPw" id="userPw" placeholder="비밀번호" />
                    </div>
                </div>
                <div class="row">
                    <label>생일</label>
                    <div class="selectBox">
                        <select name="birthYear" id="birthYear">
                            <option value="">연도</option> <!-- 이 부분은 HTML5 달력으로 대체.. -->
                            <?php
                            //현재 연도를 구함
                            $nowYear = date("Y",time());
                            //현재 연도부터 1900년도까지 내림차순으로 option태그 생성
                            for($i = $nowYear; $i >= 1900; $i--){?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php
                            }
                            ?>
                        <select>
                    </div>
                    <div class="selectBox selectBoxMargin">
                        <select name="birthMonth" id="birthMonth">
                            <option value="">월</option> <!-- 이 부분은 HTML5 달력으로 대체.. -->
                            <?php
                            for($i = 1; $i <= 12; $i++){?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php
                            }
                            ?>
                        <select>
                    </div>
                    <div class="selectBox">
                        <select name="birthDay" id="birthDay">
                            <option value="">일</option> <!-- 이 부분은 HTML5 달력으로 대체.. -->
                            <?php
                            for($i = 1; $i <= 31; $i++){?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php
                            }
                            ?>
                        <select>
                    </div>
                </div>
                <div class="row genderRow">
                    <div id="genderLabel">
                        <label for="gW" id="gMW">여성</label>
                        <label for="gM" id="gMM">남성</label>
                    </div>
                    <input type="radio" name="gender" class="gender" id="gW" value="w" />
                    <input type="radio" name="gender" class="gender" id="gM" value="m" />
                </div>
                <div class="row">
                    <p id="valueError"></p>
                </div>
                <div class="row">
                    <div class="submitBox">
                        <input type="submit" id="signUpSubmit" value="가입하기" />
                    </div>
                </div>
                <input type="hidden" name="mode" value="save" />
            </form>
            <div id="goToLoginBtn"> <!-- 모바일에서는 한 화면에 전부 들어가지 않으므로 -->
                 <p>로그인하기</p>
            </div> <!-- 클릭 시 ui 변동을 위해 추가 -->
        </div>
    </section>
    </div>

</body>
</html>
