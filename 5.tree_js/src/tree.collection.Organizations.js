/**
 * @param {string} sApiUrl 조직도 API 주소
 * @constructor
 */
tree.collection.Organization = function(sApiUrl){
    this._sApiUrl = sApiUrl;
    this._aComposite = [];
    
    this._requestOrganizations();
};

tree.collection.Organization.prototype = {
    /**
    * 조직 리스트를 요청한다.
    * @private
    */
    _requestOrganizations : function(){
        var oSelf = this;
        $.ajax({
            url: this._sApiUrl,
            async: false
        }).then($.proxy(this._createOrganizations, this))
        .then($.proxy(this._composeOrganizations, this));
    },

    /**
    * 조직 리스트를 객체화한다.
    * @param {Array.<OrganizationDataSet>} aListData
    * @returns {Array}
    * @private
    */
    _createOrganizations : function(aListData){
        var aOrganizations = [];
        // 조직 리스트를 객체화 한다.
        _.each(aListData, function(htDataSet){
            aOrganizations.push(new tree.model.Organization(htDataSet));
        });
        return aOrganizations;
    },

    /**
      * 조직을 트리 구조로 조합한다.
      * @param {Array.<naver.model.Organization>} aOrganizations
      * @private
      */
    _composeOrganizations : function(aOrganizations){
      var oParent = null, oSelf = this; // 실행 문맥 전달
  
      // 객체화된 조직 리스트를 트리 구조로 조합한다.
      _.each(aOrganizations, function(oOrganization){
        if(oOrganization.isRoot()){
          oSelf._aComposite.push(oOrganization);
        }else{
          oParent = _.findWhere(aOrganizations, {nId: oOrganization.nParentId});
          oParent.appendChild(oOrganization);
        }
      });
    },

    /**
    * 조직을 처음부터 마지막까지 순회한다.
    * @param {function} fnCallback
    */
    each: function(fnCallback){
        var oSelf = this;
        _.each(this._aComposite, function(oOrganization){
            oSelf._traverse(oOrganization, undefined, fnCallback);
        });
    },

    /**
    * ID 값과 같은 조직을 찾아서 반환한다.
    * @param {number} nTargetId
    * @returns {tree.model.Organization}
    */
    find : function(nTargetId){
        var oSelf = this,
            oResult = null;
        
        _.every(this._aComposite, function(oOrganization){ 
            oResult = oSelf._traverse(oOrganization, nTargetId); 
            return oResult === null; 
        });

        return oResult;
    },

    /**
    * 전달 받은 조직의 하위 조직을 제귀적으로 순회한다.
    * @param {tree.model.Organization} oOrganization
    * @param {number|undefined} nTargetId
    * @param {function?} fnCallback
    * @returns {null|tree.model.Organization}
    * @private
    */
    _traverse : function(oOrganization, nTargetId, fnCallback){
        var aChildren = oOrganization.getChildren(),
            oResult = null,
            oSelf = this;
 
        if(typeof fnCallback === 'function'){fnCallback(oOrganization);}
        if(oOrganization.nId === nTargetId){return oOrganization;}
        _.every(aChildren, function(oChild){
            oResult = oSelf._traverse(oChild, nTargetId, fnCallback);
            return !oResult;
        });

        return oResult;
    },

    /**
    * 지정한 조직의 해로운 하위 조직을 생성한다.
    * @param {number} nId
    * @returns {jQuery.Deferred}
    */
    create: function(nId){
        var oSelf = this;
        return $.ajax({
            url: this._sApiUrl+'/'+nId,
            type: 'POST'
        }).then(function(htDataSet){
            var oOrganization = new tree.model.Organization(htDataSet),
            oParent = oSelf.find(oOrganization.nParentId);
  
            oParent.appendChild(oOrganization);
            return oOrganization;
        });
    },
    /**
    * 조직의 이름을 변경한다.
    * @param {number} nId
    * @param {string} sName
    * @returns {jQuery.Deferred}
    */
    rename : function(nId, sName){
        var oSelf = this;

        return $.ajax({
            url : this._sApiUrl +'/'+ nId +'?name='+ sName,
            type : 'PUT'
        }).then(function(htDataSet){
            var oOrganization = oSelf.find(htDataSet.id);
            oOrganization.sName = htDataSet.name;

            return oOrganization;
        });
    },

    /**
    * 하위 조직을 삭제한다.
    * @param {tree.model.Organization} oOrganization
    */
    removeChild : function(oOrganization){
        this._aChildren = _.without(this._aChildren, oOrganization);
    },
    /**
    * 조직을 삭제 한다.
    * @param {number} nId
    * @returns {jQuery.Deferred}
    */
    remove : function(nId){
        var oSelf = this;

        return $.ajax({
            url : this._sApiUrl +'/'+ nId,
            type : 'DELETE'
        }).then(function(htRemoved){
            var oOrganization = oSelf.find(htRemoved.id),
                oParent = oSelf.find(oOrganization.nParentId);

            oParent.removeChild(oOrganization);
        }); 
    },

};