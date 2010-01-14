
var EditInPlace=Class.create();EditInPlace.defaults={id:false,save_url:false,form_type:"text",auto_adjust:false,size:false,max_size:60,rows:false,max_rows:25,cols:60,save_on_enter:true,cancel_on_esc:true,focus_edit:true,select_text:false,click_event:"click",more_data:false,select_options:false,external_control:false,edit_title:"Click to edit.",empty_text:"Click to edit.",saving_text:"Saving ...",savebutton_text:"SAVE",cancelbutton_text:"CANCEL",savefailed_text:"Failed to save changes.",mouseover_highlight:"#ffff99",editfield_class:"eip_editfield",savebutton_class:"eip_savebutton",cancelbutton_class:"eip_cancelbutton",saving_class:"eip_saving",empty_class:"eip_empty",saving:'<span id="#{saving_id}" class="#{saving_class}" style="display: none;">#{saving_text}</span>',text_form:'<input type="text" size="#{size}" value="#{value}" id="#{id}_edit" name="#{id}_edit" class="#{editfield_class}" /> <br />',textarea_form:'<textarea cols="#{cols}" rows="#{rows}" id="#{id}_edit" name="#{id}_edit" class="#{editfield_class}">#{value}</textarea> <br />',start_select_form:'<select id="#{id}_edit" name="#{id}_edit" class="#{editfield_class}" /> <br />',select_option_form:'<option id="#{id}_option_#{option}" name="#{id}_option_#{option}" value="#{option}" #{selected}>#{option_text}</option>',stop_select_form:'</select>',start_form:'<span id="#{id}_editor" style="display: none;">',stop_form:'</span>',form_buttons:'<span><input type="button" value="#{savebutton_text}" id="#{id}_save" name="#{id}_save" class="#{savebutton_class}" /> OR <input type="button" value="#{cancelbutton_text}" id="#{id}_cancel" name="#{id}_cancel" class="#{cancelbutton_class}" /> </span>',is_empty:false,orig_text:false,orig_text_length:false,orig_text_encoded:false,orig_bk_color:false};EditInPlace.prototype={initialize:function(options){this.opt={};Object.extend(this.opt,EditInPlace.defaults);Object.extend(this.opt,options||{});},edit:function(){var opt=this.opt;var id=opt['id'];$(id).title=opt['edit_title'];this._saveOrigText();this._watchForEvents();},_saveOrigText:function(){var opt=this.opt;var id=opt['id'];opt['orig_text']=$(id).innerHTML;opt['orig_text_length']=opt['orig_text'].length;opt['orig_bk_color']=$(id).getStyle('background-color');var bk_id=id;while(!opt['orig_bk_color']){try{bk_id=$(bk_id).up();}
catch(err){break;}}
if(!opt['orig_bk_color']){opt['orig_bk_color']="#ffffff";}
if(Prototype.Browser.WebKit){opt['orig_bk_color']='#ffffff';}
if(opt['form_type']=='select'){for(var i in opt['select_options']){if(opt['select_options'][i]==opt['orig_text']){opt['orig_option']=i;break;}}}
if(opt['auto_adjust']){if(opt['orig_text_lenth']>opt['max_size']){opt['form_type']='textarea';}
else{opt['form_type']='text';}}
if(opt['is_empty']){if(!$(id).empty()){opt['is_empty']=false;$(id).removeClassName(opt['empty_class']);}}
if($(id).empty()){opt['is_empty']=true;$(id).innerHTML=opt['empty_text'];$(id).addClassName(opt['empty_class']);}
opt['orig_text_encoded']=opt['orig_text'].replace(/</g,'&lt;');opt['orig_text_encoded']=opt['orig_text'].replace(/>/g,'&gt;');opt['orig_text_encoded']=opt['orig_text'].replace(/"/g,'&quot;');},_watchForEvents:function(){var opt=this.opt;var id=opt['id'];opt['mouseover']=this._mouseOver.bindAsEventListener(this,id);opt['mouseout']=this._mouseOut.bindAsEventListener(this,id);opt['mouseclick']=this._mouseClick.bindAsEventListener(this,id);opt['canceledit']=this._cancelEdit.bindAsEventListener(this,id);opt['saveedit']=this._saveEdit.bindAsEventListener(this,id);$(id).observe('mouseover',opt['mouseover']);$(id).observe('mouseout',opt['mouseout']);$(id).observe(opt['click_event'],opt['mouseclick']);if(opt['external_control']){var ext_id=opt['external_control'];$(ext_id).observe('mouseover',opt['mouseover']);$(ext_id).observe('mouseout',opt['mouseout']);$(ext_id).observe(opt['click_event'],opt['mouseclick']);}},_mouseOver:function(e){var opt=this.opt;var id=opt['id'];$(id).setStyle({backgroundColor:opt['mouseover_highlight']});},_mouseOut:function(e){var opt=this.opt;var id=opt['id'];$(id).setStyle({backgroundColor:opt['orig_bk_color']});},_mouseClick:function(e){var opt=this.opt;var id=opt['id'];$(id).hide();if(opt['external_control']){$(opt['external_control']).hide();}
var form='';var start_form=new Template(opt['start_form']);var stop_form=new Template(opt['stop_form']);var form_buttons=new Template(opt['form_buttons']);form+=start_form.evaluate({id:id});switch(opt['form_type']){case'text':var size=opt['orig_text_length']+15;if(size>opt['max_size']){size=opt['max_size'];}
size=(opt['size']?opt['size']:size);var text_form=new Template(opt['text_form']);form+=text_form.evaluate({id:id,size:size,value:opt['orig_text_encoded'],editfield_class:opt['editfield_class']});break;case'textarea':var rows=(opt['orig_text_length']/opt['cols'])+2;for(var i=0;i<opt['orig_text_length'];i++){if(opt['orig_text'].charAt(i)=="\n"){rows++;}}
if(rows>opt['max_rows']){rows=opt['max_rows'];}
rows=(opt['rows']?opt['rows']:rows);var textarea_form=new Template(opt['textarea_form']);form+=textarea_form.evaluate({id:id,cols:opt['cols'],rows:rows,value:opt['orig_text_encoded'],editfield_class:opt['editfield_class']});break;case'select':var start_select_form=new Template(opt['start_select_form']);form+=start_select_form.evaluate({id:id,editfield_class:opt['editfield_class']});var option_form=new Template(opt['select_option_form']);var selected='';for(var i in opt['select_options']){if(opt['select_options'][i]==opt['orig_text']){selected='selected="selected"';}
else{selected='';}
form+=option_form.evaluate({id:id,option:i,selected:selected,option_text:opt['select_options'][i]});}
var stop_select_form=new Template(opt['stop_select_form']);form+=stop_select_form.evaluate({});break;}
form+=form_buttons.evaluate({id:id,savebutton_class:opt['savebutton_class'],savebutton_text:opt['savebutton_text'],cancelbutton_class:opt['cancelbutton_class'],cancelbutton_text:opt['cancelbutton_text']});form+=stop_form.evaluate({});this._displayForm(form);},_saveEdit:function(){var opt=this.opt;var id=opt['id'];var params={'id':id,'form_type':opt['form_type'],'old_content':opt['orig_text'],'new_content':$F(id+'_edit')};if(opt['form_type']=='select'){params['new_option']=params['new_content'];params['new_option_text']=$(id+'_option_'+params['new_content']).innerHTML;params['old_option']=opt['orig_option'];params['old_option_text']=opt['orig_text'];params['old_content']=params['old_option_text'];params['new_content']=params['new_option_text'];}
var post_data='';for(var i in params){post_data+='&'+i+'='+encodeURIComponent(params[i]);}
if(opt['more_data']){for(var i in opt['more_data']){post_data+='&'+i+'='+encodeURIComponent(params[i]);}}
post_data.sub('&','',1);var saving=new Template(opt['saving']);saving=saving.evaluate({saving_id:id+'_saving',saving_class:opt['saving_class'],saving_text:opt['saving_text']});$(id+'_editor').remove();$(id).insert({after:saving});$(id+'_saving').show();var my_obj=this;var xhr=new Ajax.Request(opt['save_url'],{method:'post',postBody:post_data,onSuccess:function(r){$(id).innerHTML=r.responseText;my_obj._saveOrigText();$(id+'_saving').remove();$(id).show();$(id).setStyle({backgroundColor:opt['orig_bk_color']});if(opt['external_control']){$(opt['external_control']).show();}},onFailure:function(r){$(id+'_saving').remove();$(id).innerHTML=opt['orig_text'];$(id).show();$(id).setStyle({backgroundColor:opt['orig_bk_color']});if(opt['external_control']){$(opt['external_control']).show();}
alert('Error saving changes.');}});},_cancelEdit:function(){var opt=this.opt;var id=opt['id'];$(id+'_editor').remove();$(id).show();$(id).setStyle({backgroundColor:opt['orig_bk_color']});if(opt['external_control']){$(opt['external_control']).show();}},_displayForm:function(form){var opt=this.opt;var id=opt['id'];$(id).insert({after:form});$(id+'_editor').show();if(opt['focus_edit']){$(id+'_edit').focus();}
if(opt['select_text']){$(id+'_edit').select();}
$(id+'_save').observe('click',opt['saveedit']);$(id+'_cancel').observe('click',opt['canceledit']);var my_obj=this;if(opt['save_on_enter']){$(id+'_edit').observe('keypress',function(e){if(e.keyCode==Event.KEY_RETURN){my_obj._saveEdit();}});}
if(opt['cancel_on_esc']){$(id+'_edit').observe('keypress',function(e){if(e.keyCode==Event.KEY_ESC){my_obj._cancelEdit();}});}}};Element.addMethods({editInPlace:function(element,options){if(!options){var options={};}
options['id']=$(element).id;Object.extend(options,arguments[1]);var eip=new EditInPlace(options);eip.edit();}});