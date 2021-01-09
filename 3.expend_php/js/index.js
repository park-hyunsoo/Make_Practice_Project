$(document).ready(function(){ // 이 안에 코드를 작성한다, 페이지 로드 완료 시 동작 

    // 모바일 부분 
    var signUpBtn = $('#signUpBtn'); // 가입 하기 버튼 (모바일 용)
    var goToLoginBtn=$('#goToLoginBtn'); // 로그인 하기 버튼 (모바일 용)
    
    var signUp=$('#signUp'); // 회원 가입 폼
    var loginForm=$('#loginForm'); // 로그인 폼
    var introSite=$('#introSite'); // 웹 서비스 인트로
    
    // 회원 가입 부분 : 클릭 시 로그인, 문구 없어지고 가입폼 등장
    signUpBtn.click(function(){ // 가입하기 버튼 클릭
        loginForm.slideUp(); // 로그인 폼 숨기기
        signUp.slideDown(); // 가입폼 보이기
        introSite.slideUp(); // 인트로 문구 숨기기
    });
    
    var genderWoman=$('#gMW'); // 성별 버튼 클릭 처리
    var genderMan=$('#gMM');
    function genderBgInit()
    {
        genderMan.css('background','#fff');
        genderMan.css('color','#000');
        genderWoman.css('background','#fff');
        genderWoman.css('color','#000');
    }
    genderWoman.click(function(){ 
        genderBgInit(); // 배경색, 텍스트 색 초기화 함수 호출 
        $(this).css('background','#64cbf9');
        $(this).css('color','#fff');
    });
    genderMan.click(function(){ 
        genderBgInit(); // 배경색, 텍스트 색 초기화 함수 호출 
        $(this).css('background','#64cbf9');
        $(this).css('color','#fff');
    });
    
    // 회원 가입 폼 중에서 화면 크기가 늘어나면 화면이 모바일 화면을 유지한다. 
    // jquery로 css 적용 시 inline으로 적용되 external 보다 우선순위가 높으므로
    // 이부분은 수정 필요 하다 조금만 커지면 화면이 아예 없어짐 
    $(window).resize(function(){ // 화면이 커지면 회원 가입 폼이 나오게 하고 
        if(window.innerWidth >=1100){
            loginForm.slideDown();
            signUp.slideDown();
            introSite.slideDown();
        }else{
            // 줄어들면 없어지게 한다
            signUp.slideUp();            
        }
    });
    
    // 로그인 부분 : 클릭 시 가입 폼이 없어지고 첫 화면으로 변경
    goToLoginBtn.click(function(){
        loginForm.slideDown(); // 로그인폼 보이기
        signUp.slideUp(); // 가입 폼 숨기기
        introSite.slideDown();// 문구 보이기
    });
});