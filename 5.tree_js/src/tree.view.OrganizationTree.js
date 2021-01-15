/**
 * @param {string} sSelector
 * @param {tree.collection.Organizations} oCollection
 * @constructor
 */
tree.view.OrganizationTree = function(sSelector, oCollection){
    this._sSelector = sSelector;
    this.oCollection = oCollection;

    this._assignElements();
    this.render();
};
  
tree.view.OrganizationTree.prototype = {
   _assignElements: function(){
        this.welOrganizations = $(this._sSelector);
        this.welTitleSet = this.welOrganizations.children('.title_set');
        this.welTreeSet = this.welOrganizations.children('.tree_set');
        this._tmplRootNode = _.template($('#tmpl_root_node')[0].innerHTML);
        this._tmplPlainNode = _.template($('#tmpl_plain_node')[0].innerHTML);
    },

    /**
     * 조직도 트리를 렌더링 한다.
     */
    render : function(){
        this._renderRootOrganization();
        this._renderPlainOrganization();
    },

    /**
     * 최상위 조직을 렌더링한다.
     * @private
     */
    _renderRootOrganization : function(){
        this.welTreeSet.append(this._tmplRootNode({
            company : this.oCollection.find(this.oCollection.COMPANY_NODE),
            unspecified : this.oCollection.find(this.oCollection.UNSPECIFIED_NODE)
        }));
    },

    /**
     * 그 외 조직을 렌더링한다.
     * @private
     */
    _renderPlainOrganization : function(){
        var oSelf = this,
            welList = this.welTreeSet.find('ul.list');

        this.oCollection.each(function(oOrganization){
            if (!oOrganization.isRoot()) {
                var welParent = welList.find('a[data-organization-id=' + oOrganization.nParentId + ']'),
                    welOrganization = $(oSelf._tmplPlainNode({organization : oOrganization}));

                if (welParent.length === 0) {
                    welList.append(welOrganization);
                } else {
                    welParent.siblings('ul').append(welOrganization);
                }
            }
        });
    }
};