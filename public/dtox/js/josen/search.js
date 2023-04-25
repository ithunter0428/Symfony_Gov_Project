var JsnSearch = null;

(function(){
var current = null;

JsnSearch = {
  fieldIds: {},
  fields: {},

  init: function(){
    current = this;
  },

  keywordSearchFormReset: function() {
    $('#'+this.fieldIds.keyword).val('');
    $('.'+this.fieldIds.keyword_target).attr("checked", false);
  }

};
})();