/**
 * @param {string} sApiUrl 조직도 API 주소
 * @constructor
 */
tree.collection.Organization = function(sApiUrl){
    this._sApiUrl = sApiUrl;
    this._requestOrganizations();
};

tree.collection.Organization.prototype = {
    /**
    * 조직 리스트를 요청한다.
    * @private
    */
    _requestOrganizations : function(){
        $.ajax({
            url: this._sApiUrl,
            async: false
        }).then(function(aListData){
            console.log(aListData);
        });
    }
};