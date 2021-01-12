/*
* spa.util.js
* 범용 자바스크립트 유틸리티 
*/

/*jslint browser : true, continue : ture,
devel : true, indent : 2, maxerr : 50,
newcap : true, nomen : true, pulsplus : true,
regexp : true, sloppy : true, vars : true,
white : true
*/

/*global $, spa */
spa.util = (function(){
    var makeError, setConfigMap;
   
    // public 메서드 
    // 목적 : 에러 객체 생성을 위한 편의 래퍼
    // 인자 :
    //  name_text : 에러 명
    //  msg_text : 에러 상세 메시지
    //  data : 선택적으로 에러 객체에 첨부할 데이터
    // 반환값 : 새로 생성한 에러 객체
    // 예외 : 없음

    makeError = function( name_text, msg_text, data){
        var error = new Error();
        error.name = name_text;
        error.message = msg_text;
        if(data){error.data = data;}
        return error;
    };
     
    // 목적 : 기능 모듈에서 설정을 지정하기 위한 공통 코드
    // 인자 :
    //  input_map : 설정에서 지정할 키-값 맵
    //  settable_map : 설정 가능한 키 맵
    //  config_map : 설정을 적용할 맵
    // 반환값 : true
    // 예외 : 입력 키가 허용되지 않은 키이면 예외
    setConfigMap = function(arg_map){
        var input_map = arg_map.input_map,
            settable_map = arg_map.settable_map,
            config_map = arg_map.config_map,
            key_name, error;

        for(key_name in input_map){
            if(input_map.hasOwnProperty(key_name)){
                if(settable_map.hasOwnProperty(key_name)){
                    config_map[key_name] = input_map[key_name];
                }
                else{
                    error = makeError('Bad Input', 'Setting config key |' + key_name +'| is not supported');
                    throw error;
                }
            }
        }
    };
    
    return {
        makeError : makeError,
        setConfigMap : setConfigMap
    };
})();