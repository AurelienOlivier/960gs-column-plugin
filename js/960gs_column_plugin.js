/**
 * Handle: 960gs Column Plugin
 * Version: 0.1
 * Deps: jquery
 * Enqueue: true
 */

var c960gs = function () {}

c960gs.prototype = {
    options           : {},
    generateShortCode : function() {
        var attrs = '';
        var selectedTxt = '';
        if(tinyMCE.getInstanceById('content')){
            selectedTxt = tinyMCE.getInstanceById('content').selection.getContent();
        }
        
        jQuery.each(this['options'], function(name, value){
            if (value != '') {
                attrs += ' ' + name + '="' + value + '"';
            }
        });
        
        if(selectedTxt != ""){
            return '[960gs' + attrs + ']'+selectedTxt;
        }
        
        return '[960gs' + attrs + ']';
    },
    sendToEditor      : function(f) {
        var collection = jQuery(f).find("input[id^=c960gs]:not(input:checkbox),input[id^=c960gs]:checkbox:checked,select[id^=c960gs]");
        var $this = this;
        collection.each(function () {
            var name = this.name.substring(7, this.name.length-1);
            if(this.value!="0" && this.value!="aucune") $this['options'][name] = this.value;
        });
        send_to_editor(this.generateShortCode());
        return false;
    },
    sendClearerToEditor      : function(f) {
        send_to_editor('[960gs_clear]');
        return false;
    },
    sendCloserToEditor      : function(f) {
        send_to_editor('[960gs_close]');
        return false;
    }
}

var c960gs = new c960gs();