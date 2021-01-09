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
    <header>
        <div id="myService"> Web Service </div>
        
        <div id="viewType">
            <a href="./me.html" id="meLink"> me </a>
            <a href="./all.html" id="allLink"> all </a>
        </div>

        <!-- 로그인 후 -->
        <div id="myName">
            <p> 안녕하세요. 님 </p>
            <div id="logoutBox">
                <input type="button" id="logoutBtn" value="로그아웃" />
            </div>
        </div>
        
        <!-- 로그인 전 -->
        <div id="loginForm">
            <form name="loginForm" method="post" action="./login.php">
                <div id="loginEmailArea">
                    <label for="loginEmail">E-Mail</label> <!-- 아이디 입력 -->
                    <div class="loginInputBox">
                        <input type="email" id="loginEmail" name="email" placeholder="이메일" required/> 
                        <!-- pattern="[a-zA-Z].+[0-9]" 을 넣을 수 도 있다.-->
                    </div>
                </div>
                <div id="loginPwArea">
                    <label for="loginPw">Password</label> <!-- 패스워드 입력 -->
                    <div class="loginInputBox">
                        <input type="password" id="loginPw" name="loginPw" placeholder="비밀번호" required/> 
                        <!-- pattern="[a-zA-Z].+[0-9]" 을 넣을 수 도 있다.-->
                    </div>
                </div>
                <div class="loginSubmitBox">
                    <input type="submit" id="loginSubmit" value="로그인" /> 
                </div>
            </form>
        </div>
    </header>
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
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                        <select>
                    </div>
                    <div class="selectBox selectBoxMargin">
                        <select name="birthMonth" id="birthMonth">
                            <option value="">월</option> <!-- 이 부분은 HTML5 달력으로 대체.. -->
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        <select>
                    </div>
                    <div class="selectBox">
                        <select name="birthDay" id="birthDay">
                            <option value="">일</option> <!-- 이 부분은 HTML5 달력으로 대체.. -->
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
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
    <footer>
        <p> My Web Service </p>
    </footer>  
</body>
</html>
