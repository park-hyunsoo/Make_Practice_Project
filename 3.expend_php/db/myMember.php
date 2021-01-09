<?php
class myMember{
    protected $dbConnection = null; // 데이터베이스 접속 정보
    protected $mode;

    //생성자
    function __construct(){ // 가지고 있는 post mode 값에 따라 함수를 자동 호출 한다. 
        //mode값에 따라 메서드 호출
        if(isset($_POST['mode'])){
            $this->mode = $_POST['mode'];
            //mode의 값에 따라 메서드 호출
            if($this->mode == 'emailCheck'){
                $this->emailCheck($_POST['userEmail']);
            }else if($this->mode == 'save'){
                $this->signUp();
            }else if($this->mode == 'photo'){
                $this->photoSave();
            }
        }
    }

    protected function dbConnection(){ // 데이터베이스 접속 정보를 가져옴
        include_once $_SERVER['DOCUMENT_ROOT'].'/db/connect.php';
    }

    function signUp(){ // 회원 가입
        $userName = trim($_POST['userName']); // 이름
        if(!preg_match('/^[a-zA-Z가-힣]+$/', $userName)){
            echo '올바른 이름이 아닙니다.';
            exit;
        }
        $userEmail = trim($_POST['userEmail']); // 이메일
        if(!filter_Var($userEmail, FILTER_VALIDATE_EMAIL)){
            echo '올바른 이메일이 아닙니다.';
            exit;
        }
      
        $userPw = $_POST['userPw']; // 비밀번호 
        if($userPw == ''){
            echo '비밀번호 값이 공백입니다.';
            exit;
        }
        $userPw = sha1('mySalt'.$userPw);

        //생 년 월일
        $birthYear = (int) $_POST['birthYear'];
        if($birthYear == ''){
            echo '생년 값이 빈값입니다.';
            exit;
        }
      
        $birthYearCheck = false;
        $thisYear = date('Y', time());
        for($i = 1900; $i <= $thisYear; $i++){
            if($i == $birthYear){
                $birthYearCheck = true;
               break;
            }
        }
        if($birthYearCheck == false){
            echo '올바른 생년 값이 아닙니다.';
            exit;
        }
        $birthMonth = (int) $_POST['birthMonth'];
        if($birthMonth == ''){
            echo '생월 값이 빈값입니다.';
            exit;
        }
        $birthMonthCheck = false;
        for($i = 1; $i <= 12; $i++){
            if($i == $birthMonth){
                $birthMonthCheck = true;
                break;
            }
        }
        if($birthMonthCheck == false){
            echo '올바른 생월 값이 아닙니다.';
            exit;
        }
        $birthDay = (int) $_POST['birthDay'];
        if($birthDay == ''){
            echo '생일 값이 빈값입니다.';
            exit;
        }
        $birthDayCheck = false;
        for($i = 1; $i <= 31; $i++){
            if($i == $birthDay){
                $birthDayCheck = true;
                break;
            }
        }
        if($birthDayCheck == false){
            echo '올바른 값이 아닙니다.';
            exit;
        }
        $birth = $birthYear.'-'.$birthMonth.'-'.$birthDay;

        //성별
        $gender = $_POST['gender'];
        $genderCheck = false;
        switch($gender){
            case 'm';
            case 'w';
                $genderCheck = true;
            break;
        }
        if($genderCheck == false){
            echo '올바른 성별 정보가 아닙니다.';
            exit;
        }
        //검증 완료

        //이름정보를 real_escape_string 처리
        //데이터베이스 입력정보가 필요하므로 정보를 담고 있는 dbConnection메서드를 호출
        $this->dbConnection();
        $userName = $this->dbConnection->real_escape_string($userName);

        //기본 프로필 사진 주소 설정
        $profilePhoto = '';
        if($gender == 'm'){
            $profilePhoto = '/image/cat.jpg';
        }else if($gender == 'w'){
            $profilePhoto = '/image/cat.jpg';
        }

        $coverPhoto = '/image/cat.jpg'; //기본 커버 사진 설정
        $regTime = time(); //회원가입시간

        //데이터베이스에 입력
        $sql = "INSERT INTO mymember(userName, email, pw, birthDay, gender, profilePhoto, coverPhoto, regtime) ";
        $sql .= "VALUES('{$userName}','{$userEmail}','{$userPw}','{$birth}','{$gender}','{$profilePhoto}','{$coverPhoto}','{$regTime}')";

        $res = $this->dbConnection->query($sql);

        //쿼리 질의 성공시
        if($res){
            //회원가입에 성공했으므로 세션생성
            $_SESSION['myMemberSes']['email'] = $userEmail;
            $_SESSION['myMemberSes']['userName'] = $userName;
            //insert_id는 입력한 정보의 primary_key(고객번호)를 반환
            $_SESSION['myMemberSes']['myMemberID'] = $this->dbConnection->insert_id;
            $_SESSION['myMemberSes']['profilePhoto'] = $profilePhoto;
            $_SESSION['myMemberSes']['coverPhoto'] = $coverPhoto;
            //세션 생성 후 나의 페이지로 이동
            header("Location:../me.php");
        }else{
            echo "<script>alert('실패'); location.href='../index.php';</script>";
            exit;
        }
    }

    function emailCheck($email){
        $result = false; //이메일 사용가능 여부의 리턴 값으로 초기값 false 대입
  
        //이메일 유효성 검사
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //같은 이메일 주소 있는지 찾는 쿼리문
            $sql = "SELECT * FROM mymember WHERE email = '{$email}'";
            $this->dbConnection();
            $res = $this->dbConnection->query($sql);
  
            //데이터베이스에서 가져온 결과 수를 체크하여 0이면 사용 가능
            //0이 아니면 이미 존재하는 이메일
            if($res->num_rows == 0){
                $result = true;
            }
        }
        //값 전달
        echo json_encode(array(
          'result' => $result
        ));
    }
}
$myMember = new myMember;