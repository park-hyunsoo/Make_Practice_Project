$(document).ready(function(){
    var loginSubmit = $('#loginSubmit'); //로그인 버튼 
    var loginEmail = $('#loginEmail'); //이메일 주소 입력 폼 
    var loginPw = $('#loginPw');  //로그인 폼의 비밀번호 입력 폼  
  
    loginSubmit.click(function(){ //로그인 버튼 클릭 이벤트
        var regEmailPattern = /^[a-zA-Z_\-0-9]+@[a-z]+.[a-z]+$/; // 정규표현식 
      
        if(!regEmailPattern.test(loginEmail.val())){ // 이메일 주소 패턴이 맞는지 확인
            alert('입력한 이메일 주소가 올바르지 않습니다. ');
            return false;
        }
        if(loginPw.val().length < 8){ // 비밀 번호 확인
            alert('비밀번호를 입력하지 않았거나 8글자 이하입니다. ');
            return false;
        }
    });
  
    var signUpSubmit = $('#signUpSubmit'); // 회원 가입 버튼 
    var userName = $('#userName'); //이름 입력 폼
    var userEmail = $('#userEmail'); //이메일 입력 폼
    var userPw = $('#userPw'); //비밀번호 입력 폼
    var birthYear = $('#birthYear'); //생년 selectTag
    var birthMonth = $('#birthMonth'); //생년 selectTag
    var birthDay = $('#birthDay'); //생일 selectTag
    var valueError = $('#valueError'); //필터링 시 값이 오류일 때 무엇이 오류인지 보여 준다.
    
    signUpSubmit.click(function(){ // 버튼 클릭 이벤트
        if(userName.val() == ''){  //이름이 공백인지 확인
            valueError.text('이름을 입력하세요.'); //알림 오류 메시지 입력
            userName.focus();   //이름 입력란에 포커스
            timeOutCall();      //오류 메시지를 2초 후 사라지게 하는 함수를 호출
            return false;
        }
     
        var regNamePattern = /^[가-힣a-zA-Z]+$/; //값이 공백이 아니면 해당 값이 유효한 값인지 확인
        if(regNamePattern.test(userName.val())){
            console.log('the value of userName is good');
        }else{
            valueError.text('정확한 이름을 입력하세요.');
            userName.focus();
            timeOutCall();
            return false;
        }
  
        var regEmailPattern = /^[a-zA-Z_\-0-9]+@[a-z]+.[a-z]+$/; //이메일 유효성 확인
        if(regEmailPattern.test(userEmail.val())){
            console.log('exp email good');
        }else{
            valueError.text('정확한 이메일 주소를 입력하세요.');
            userEmail.focus();
            timeOutCall();
            return false;
        }
  
        //데이터베이스에 같은 이메일 주소를 사용하는 사용자가 있는지 확인
        emailCheck = false;
        $.ajax({
            type : 'post', //post 전송방식으로 전달
            dataType : 'json', //json 언어로 전달
            url : './database/myMember.php', //이 주소에 데이터 전달
            data : {mode:'emailCheck', userEmail:userEmail.val()}, //전달할 데이터
            async : false, //값을 전달 받은 후 실행,
  
            success : function (data){
                console.log(data.result);
            if(data.result == true){ //사용해도 좋은 이메일 주소인 경우
                emailCheck = true;
            }else{ //이미 존재하는 이메일 주소인 경우
                emailCheck =false;
            }
        },
        //AJAX 통신 에러 발생시 에러코드 확인
        error: function (request, status, error){
            console.log('request ' + request);
            console.log('status ' + status);
            console.log('error ' + error);
        }
        });

        //이메일 주소 중복시 처리
        if(emailCheck == false){
            valueError.text('이미 존재하는 이메일 주소 입니다.');
            userEmail.focus();
            timeOutCall();
            return false;
        }
        //비밀번호 길이 8자 이상인지 확인
        if(userPw.val().length >= 8){
            console.log('the value of password is good');
        }else{
            valueError.text('비밀번호를 8자 이상 입력하세요.');
            userPw.focus();
            timeOutCall();
            return false;
        }   
        if(birthYear.val() == ''){
            valueError.text('생년을 입력하세요.');
            birthYear.focus();
            timeOutCall();
            return false;
        }
        if(birthMonth.val() == ''){
            valueError.text('생월을 입력하세요.');
            birthMonth.focus();
            timeOutCall();
            return false;
        }
        if(birthDay.val() == ''){
            valueError.text('생일을 입력하세요.');
            birthDay.focus();
            timeOutCall();
            return false;
        }

        //성별을 체크했는지 확인. 값이 m이거나 w이면 통과
        if($(":input:radio[name=gender]:checked").val() == 'm' || $(":input:radio[name=gender]:checked").val() == 'w'){
            console.log('gender val good');
        }else{
            valueError.text('성별을 선택해주세요.');
            timeOutCall();
            return false;
        }
        //여기까지 return false에 만나지 않았다면 true를 반환해 회원가입 정보를 제출
        return true;
  
        function timeOutCall(){ //setTimoeout 함수는 어떠한 기능의 시간을 지연시킬 때 사용하는 내장 함수
            setTimeout(function(){
                $('#valueError').text('');
            },2000)
        }
  
    });
  
});
