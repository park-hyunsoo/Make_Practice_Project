/*jslint browser : true, continue : ture,
        devel : true, indent : 2, maxerr : 50,
        newcap : true, nomen : true, pulsplus : true,
        regexp : true, sloppy : true, vars : true,
        white : true
*/
// JSLINT 설정을 포함 
// SPA 모듈
// 채팅 슬라이더 기능 제공
var spa =(function($){ // 모든 코드를 spa 네임스페이스에 패키징
    // 모듈 스코프 변수 선언
    var configMap={ // 상수 설정, 모든 변수를 선언, 모듈 설정 값은 configMap에 상태는 stateMap 에 저장한다.
        extended_height : 434,
        extended_title : 'Click to retract',
        retracted_height : 16,
        retracted_title : 'Click to extend',
        template_html : '<div class="spa-slider"></div>'
    },  
    $chatSlider, // 그외 나머지 모듈 스코프 변수 선언
    toggleSlider, onClickSlider, initModule;

    // DOM 메서드, 슬라이더 높이를 조정
    toggleSlider = function(){ // 모든 도규먼트 객체 모델 조작 메서드를 한데 모아 같은 영역에 넣는다. 
        var slider_height = $chatSlider.height();

        // 슬라이더가 닫혀 있으면 연다.
        if(slider_height === configMap.retracted_height){
            $chatSlider
              .animate({height:configMap.extended_height})
              .attr('title', configMap.extended_title)
            return true;
        } // 열려 있으면 닫는다. 
        else if (slider_height === configMap.extended_height){
            $chatSlider
              .animate({height:configMap.retracted_height})
              .attr('title', configMap.retracted_title);
            return true;        
        }
        
        return false; // 슬라이더 상태가 전환되는 동안에는 아무 일도 하지 않음
    };

    onClickSlider = function(event){ // 이벤트 핸들러, 클릭 이벤트를 받고 toggleSlider를 호출
      // 모든 이벤트 핸들러 메서드를 모아 같은 영역에 지정한다.
      // 핸들러 코드는 간결한것이 좋고 핸들러에서는 화면을 업데이트, 비즈니스 로직을 처리 할 메서드를 호출
      toggleSlider();
      return false;
    };

    // Public 메서드, 초기 상태 설정 및 기능을 제공
    initModule = function($container){
        // HTML 렌더링, 슬라이더 높이 및 제목 초기화
        // 클릭 이벤트와 이벤트 핸들러 바인딩
        $container.html(configMap.template_html); // 슬라이더 템플릿을 활용해서 채운다.
        $chatSlider = $container.find('.spa-slider'); // 채팅 슬라이더 div를 찾아서 이를 모듈 스코프 변수에 저장한다. 
        // 모듈 스코프 변수는 spa 네임스페이스 내 모든 함수에서 접근할 수 있다.

        $chatSlider
          .attr('title', configMap.retracted_title)
          .click(onClickSlider); // 이벤트와속성을 설정
        
        return true;
    };
    return {initModule : initModule}; // spa 네임스페이스에서 객체를 반환함으로 써 public 메서드를 노출한다.
}(jQuery)); // jQuery 라이브러리를 전달

// DOM이 준비되면 SPA를 실행
jQuery(document).ready(
    function(){spa.initModule(jQuery('#spa'));}
);

