/*
* spa.js
* 루트 네임스페이스 모듈
*/

/*jslint browser : true, continue : ture,
devel : true, indent : 2, maxerr : 50,
newcap : true, nomen : true, pulsplus : true,
regexp : true, sloppy : true, vars : true,
white : true
*/

/*global $, spa */ // JSLint가 spa와 $를 전역 변수로 인지하도록 설정,
var spa =(function(){ // 모듈 패턴을 이용해 spa 네임스페이스를 만든다. initModule 하나만 외부로 노출한다. 
    var initModule = function($container){
      spa.shell.initModule($container);
    };
    return {initModule:initModule};
}());
