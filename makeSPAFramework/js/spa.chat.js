/*
* spa.chat.js
* spa용 채팅 기능 모듈
*/

/*jslint browser : true, continue : ture,
devel : true, indent : 2, maxerr : 50,
newcap : true, nomen : true, pulsplus : true,
regexp : true, sloppy : true, vars : true,
white : true
*/

/*global $, spa */
spa.chat=(function(){ // 모듈의 네임스페이스를 생성
    // 모듈 스코프 변수 시작 
    var configMap ={ // HTML 템플릿과 기본 설정을 저장
            main_html : String()
                +'<div style="padding:1em; color:#fff;">'
                    + ' Say Hello To Chat '
                +'</div>',
            settable_map : {}
        },
        stateMap = {$container:null},
        jqueryMap={},
        setJqueryMap, configModule, initModule;
    // 모듈 스코프 변수 끝
  
    // 유틸리티 메서드
    // 유틸리티 메서드
  
    // DOM 메서드
    setJqueryMap = function(){
        var $container = stateMap.$container;
        jqueryMap = {$container:$container};
    };
    // DOM 메서드
  
    // 이벤트 핸들러
    // 이벤트 핸들러
  
    // public 메서드
  
    // 목적 : 허용된 키의 설정 조절
    // 인자 : 설정 가능한 키와 값으로 구성된 맵, color_name : 사용할 색깔
    // 설정 : configMap.settable_map 은 허용된 키를 모두 선언
    // 반환 값 : true
    // 예외 없음
    configModule = function(input_map){
        spa.util.setConfigMap({
            input_map : input_map,
            settable_map : configMap.settable_map,
            config_map : configMap
        });
        return true;
    };
  
    initModule = function($container){
        $container.html(configMap.main_html); // 컨테이너를 html 템플릿으로 채움
        stateMap.$container = $container;
        setJqueryMap();
        return true;
    };
    // public 메서드

    return { // 설정과 초기화 메서드를 반환
        configModule : configModule,
        initModule : initModule
    };    
})();