(function (window) {
    'use strict';
    var App = window.App || {};
    var Count = 0;
  
    function DataStore() {
      console.log('running the DataStore function');
      this.data = {};
    }
  
    DataStore.prototype.add = function (key, val) {
      this.data[key] = val;
      Count++;
    };
  
    DataStore.prototype.get = function (key) {
      return this.data[key];
    };
  
    DataStore.prototype.getAll = function () {
      console.log(Count);
      return this.data;
    };
  
    DataStore.prototype.remove = function (key) {
      Count--;
      delete this.data[key];
    };
  
    App.DataStore = DataStore;
    window.App = App;
})(window);