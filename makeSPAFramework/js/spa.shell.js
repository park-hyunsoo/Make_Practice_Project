/*
* spa.shell.js
* SPA 용 셀 모듈
*/

/*jslint browser : true, continue : ture,
devel : true, indent : 2, maxerr : 50,
newcap : true, nomen : true, pulsplus : true,
regexp : true, sloppy : true, vars : true,
white : true
*/

/* 전역 $, spa */
spa.shell = (function(){ 
    // 모듈 스코프 변수 시작 : 전역에서 사용할 수 있는 변수를 모듈 스코프 영역에 모두 선언 //
    var configMap = { // 문자열은 들여쓰기를 해서 우선 가독성이 좋게 한다. 
        main_html : String() 
        +    '<div class="spa-shell-head">'
        +      '<div class="spa-shell-head-logo"></div>' 
        +      '<div class="spa-shell-head-acct"></div>'
        +      '<div class="spa-shell-head-search"></div>'
        +    '</div>'
        +    '<div class="spa-shell-main">'
        +      '<div class="spa-shell-main-nav"></div>'
        +      '<div class="spa-shell-main-content"></div>'
        +    '</div>'
        +    '<div class="spa-shell-foot"></div>'
        +    '<div class="spa-shell-chat"></div>'
        +    '<div class="spa-shell-modal"></div>',
        chat_extent_time : 1000, 
        chat_retract_time : 300,
        chat_extend_height: 450,
        chat_retract_height: 15,
        chat_extended_title : 'Click to retract',
        chat_retracted_title : 'Click to extend',
        anchar_schema_map:{ // uriAnchor 에서 유효성 검사에 사용할 맵을 정의
          chat : {open:true, closed:true}
        }
    }, 
    stateMap = { 
      $container : null,
      is_chat_retracted: true, // 모듈에서 사용하는 키를 나열하면 나중에 찾거나 검사하기 쉬워진다.
      anchor_map :{} // 현재 앵커 값을 모듈 상태 맵에 저장
    },
    jqueryMap = {}, // 제이쿼리 객체는 여기에 캐싱 
    copyAnchorMap, changeAnchorPart, onHashchange, // 사용할 메서드를 정의 
    setJqueryMap, initModule; // 모듈 스코프 변수는 모두 이 영역에 선언, 나중에 대입한다.
    // 모듈 스코프 변수 끝 //

    // 유틸리티 메서드 시작 : 페이지 엘리먼트와 상호작용하지 않는 함수를 보관 //
    copyAnchorMap = function(){ // 저장된 앵커 맵의 복사본을 반환, 이를 통해 연산 부담을 최소화
    // 제이쿼리 extend() 유틸리티를 사용해 개체를 복사한다. 모든 자바스크립트 객체는 참조로 전달되고 제대로 복사하는 것은 간단하지 않다.
        return $.extend(true, {}, stateMap.anchor_map);
    };
    // 유틸리티 메서드 끝 //

    // Dom 메서드 시작 : 페이지 엘리먼트를 생성하고 조작하는 메서드 //
    setJqueryMap = function(){ // jQuery 컬랙션 객체를 캐싱하기 위해, 거의 모든 기능 모듈 내에 존재  
        var $container=stateMap.$container; // 캐싱을 해야 문서 탐색 횟수를 크게 줄일 수 있다
        jqueryMap = {
            $container : $container,
            $chat : $container.find('.spa-shell-chat') // jqueryMap 에 컬렉션을 캐싱한다.
        };
    };

    // toggleChat 을 작성, 열고 닫기를 하는 단일 메서드 
    // 목적 : 채팅 슬라이더 영역을 열고 닫음
    // 인자 :
    //   do_extend - true이면 열고, false이면 닫음
    //   callback - 애니메이션 종료 시점에 callback 함수를 실행
    // 반환 값 : boolean
    //   true : 슬라이더 애니메이션 실행
    //   false : 슬라이더 애니메이션이 실행되지 않음 
    toggleChat = function (do_extend, callback){
        var
          px_chat_ht = jqueryMap.$chat.height(), // 캐싱된 객체를 사용해서 높이를 가져오고 
          is_open = px_chat_ht === configMap.chat_extend_height, // 현재 높이가 열린 높이와 같은지, 판단하는 조건을 미리 값으로 생성 
          is_closed = px_chat_ht === configMap.chat_retract_height, // 현재 높이가 닫힌 높이와 같은지
          is_sliding = !is_open && !is_closed; // 열린 상태가 아니고, 닫힌 상태도 아니면 실행 중 상태, 연속 클릭 방지

        if (is_sliding){return false;} // 경쟁 조건을 피하고 애니메이션이 실행 중이면 함수를 종료

        if(do_extend){ // 채팅 슬라이더 확장 시작
            jqueryMap.$chat.animate(
              {height:configMap.chat_extend_height},
              configMap.chat_extend_time,
              function(){
                jqueryMap.$chat.attr( // 툴팁 표시를 위한 속성 추가 
                  'title', configMap.chat_extended_title
                ); 
                stateMap.is_chat_retracted = false; // 상태 정보 추가 
                if(callback) { callback(jqueryMap.$chat);}
              }
            );
            return true;
        } // 채팅 슬라이더 확장 끝

        jqueryMap.$chat.animate( // 채팅 슬라이더 축소 시작
          {height: configMap.chat_retract_height},
          configMap.chat_retract_time,
          function(){
              jqueryMap.$chat.attr(
                'title', configMap.chat_retracted_title
              ); // 속성을 추가, 툴팁 표시를 위한
              stateMap.is_chat_retracted = true; // 상태 정보 추가 
              if(callback) { callback(jqueryMap.$chat);} // 경쟁 조건을 피함
          }
        );
        return true;
    }   
    
    // 목적 : URI 앵커 컴포넌트의 일부 영역 변경, 자동으로 앵커를 업데이트, 인자를 받아 지정된 키 값을 업데이트
    // 인자 : *arg_map - URI 앵커 중 변경할 부분을 나타내는 맵
    // 반환값 : boolean
    // - true : 앵커 부분이 변경됨
    // - false : 변경되지 않음
    // 행동 :
    //  현재 앵커는 stateMap.anchor_map에 저장되어 있고, 인코딩 방식은 uriAnchor를 참고
    //  이 메서드는 copyAnchorMap()을 사용해 이 맵을 복사하고
    //  arg_map 을 사용해 키-값을 수정한다.
    //  인코딩 과정에서 독립적인 값과 의존적인 값을 구분하고
    //  uriAnchor를 활용해 uri 변경을 시도
    //  성공 시 true, 실패는 false를 반환

    changeAnchorPart = function(arg_map){
        var anchor_map_revise = copyAnchorMap(), // 현재 앵커 상태를 가져오고 
            bool_return = true,
            key_name, key_name,dep;

        // 변경 사항을 앵커 맵으로 합침
        KEYVAL:
        for(key_name in arg_map){ // 인자로 들어온 처음이라면 chat:open 
            if(arg_map.hasOwnProperty(key_name)){
                // 반복 과정 중 의존적 키는 건너뜀
                if(key_name.indexOf('_')===0){continue KEYVAL;} // 
                
                // 독립적 키 값을 업데이트
                anchor_map_revise[key_name] = arg_map[key_name];

                // 대응 되는 의존적 키를 업데이트
                key_name_dep='_'+key_name;
                
                if(arg_map[key_name_dep]){
                    anchor_map_revise[key_name_dep]=arg_map[key_name_dep];
                }else{
                    delete anchor_map_revise[key_name_dep];
                    delete anchor_map_revise['_s'+key_name_dep];
                }
            }
        }
        // 앵커 맵으로 변경 사항 병합 작업 끝

        // URI 업데이트 시도, 성공하지 못하면 원복
        try{ // 스키마에 부합하지 않으면 앵커를 설정하지 않음 예외를 던짐 
            $.uriAnchor.setAnchor(anchor_map_revise);
        }
        catch(error){
            // URI를 기존 상태로 대체
            $.uriAnchor.setAnchor(stateMap.anchor_map,null,true);
            bool_return = false;
        }
        // 업데이트 시도 끝
        return bool_return;
    };

    // Dom 메서드 종료 //
  
    // 이벤트 핸들러 시작 : 이벤트 관련 처리 // 
    // 목적 : hashchange 이벤트 처리
    // 인자 : event 이벤트 객체
    // 설정 : 없음
    // 반환값 : false
    // 행동 : URI 앵커 컴포넌트 파싱, 새로운 애플리케이션 상태를 현재 상태와 비교, 현재 상태와 다를때만 상태 변경
    onHashchange = function(event){
        var anchor_map_previous=copyAnchorMap(), // 현재 상태 앵커를 가져오고
            anchor_map_proposed,
            _s_chat_previous, _s_chat_proposed,
            s_chat_proposed;
    
        // 앵커 파싱
        try{
            anchor_map_proposed = $.uriAnchor.makeAnchorMap(); // 현재 uri를 파싱  
        } catch(error){
            $.uriAnchor.setAnchor(anchor_map_previous, null, true);
            return false;
        }
        stateMap.anchor_map=anchor_map_proposed;

        //편의 변수
        _s_chat_previous = anchor_map_previous._s_chat;
        _s_chat_proposed = anchor_map_proposed._s_chat;

        // 변경된 경우 채팅 컴포넌트 조정 시작
        if(!anchor_map_previous || _s_chat_previous !== _s_chat_proposed){
            s_chat_proposed = anchor_map_proposed.chat;
            switch(s_chat_proposed){
                case 'open':
                    toggleChat(true);
                    break;
                case 'closed':
                    toggleChat(false);
                    break;
                default:
                    toggleChat(false);
                    delete anchor_map_proposed.chat;
                    $.uriAnchor.setAnchor(anchor_map_proposed, null, true);
            }
        }
        // 변경된 경우 채팅 컴포넌트 조정 끝
        return false;
    };

    onClickChat=function(event){ // 앵커 chat 파라미터만 변경하게끔 수정 
        changeAnchorPart({
            chat:(stateMap.is_chat_retracted ? 'open':'closed') // 닫혀 있으면 open을 열려 있으면 closed
        });
        return false;
    };
    // 이벤트 핸들러 끝 //
  
    // public 메서드 시작 : 외부로 노출하는 public 영역 //
    initModule = function($container){ // 들어온 컨테이너에 template을 설정 
        stateMap.$container = $container;
        $container.html(configMap.main_html);
        setJqueryMap();
  
        // 채팅 슬라이더 초기화 및 클릭 핸들러 바인딩
        stateMap.is_chat_retracted=true;
        jqueryMap.$chat.attr('title', configMap.chat_retracted_title).click(onClickChat);
  
        // 스키마를 사용하게 끔 uriAnchor를 변경
        $.uriAnchor.configModule({ // 스키마를 대상으로 유효성 검사를 하게끔
            schema_map: configMap.anchor_schema_map
        });
      
        // 기능 모듈을 설정 및 초기화
        spa.chat.configModule({});
        spa.chat.initModule(jqueryMap.$chat);

        // URI 앵커 변경 이벤트 처리
        // 모든 기능 모듈이 설정 및 초기화 된 후 실행 
        // 이렇게 하지 않으면 페이지 로드 시점에 앵커를 판단하는데 사용되는 트리거 이벤트를 모듈에서 처리할 수 없다.
        $(window).bind('hashchange', onHashchange).trigger('hashchange');
    };
    // public 메서드 끝 //

    return {initModule:initModule};
})();