/* global jQuery:false */
/* global ANGELA_STORAGE:false */

//-------------------------------------------
// Theme Options fields manipulations
//-------------------------------------------
jQuery(document).ready(function() {
	"use strict";

	// Toggle inherit button and cover
	jQuery('#angela_options_tabs').on('click', '.angela_options_inherit_lock,.angela_options_inherit_cover', function (e) {
		var parent = jQuery(this).parents('.angela_options_item');
		var inherit = parent.hasClass('angela_options_inherit_on');
		if (inherit) {
			parent.removeClass('angela_options_inherit_on').addClass('angela_options_inherit_off');
			parent.find('.angela_options_inherit_cover').fadeOut().find('input[type="hidden"]').val('');
		} else {
			parent.removeClass('angela_options_inherit_off').addClass('angela_options_inherit_on');
			parent.find('.angela_options_inherit_cover').fadeIn().find('input[type="hidden"]').val('inherit');
			
		}
		e.preventDefault();
		return false;
	});

	// Refresh linked field
	jQuery('#angela_options_tabs').on('change', '[data-linked] select,[data-linked] input', function (e) {
		var chg_name     = jQuery(this).parent().data('param');
		var chg_value    = jQuery(this).val();
		var linked_name  = jQuery(this).parent().data('linked');
		var linked_data  = jQuery('#angela_options_tabs [data-param="'+linked_name+'"]');
		var linked_field = linked_data.find('select');
		var linked_field_type = 'select';
		if (linked_field.length == 0) {
			linked_field = linked_data.find('input');
			linked_field_type = 'input';
		}
		var linked_lock = linked_data.parent().parent().find('.angela_options_inherit_lock').addClass('angela_options_wait');
		// Prepare data
		var data = {
			action: 'angela_get_linked_data',
			nonce: ANGELA_STORAGE['ajax_nonce'],
			chg_name: chg_name,
			chg_value: chg_value
		};
		jQuery.post(ANGELA_STORAGE['ajax_url'], data, function(response) {
			var rez = {};
			try {
				rez = JSON.parse(response);
			} catch (e) {
				rez = { error: ANGELA_STORAGE['ajax_error_msg'] };
				console.log(response);
			}
			if (rez.error === '') {
				if (linked_field_type == 'select') {
					var opt_list = '';
					for (var i in rez.list) {
						opt_list += '<option value="'+i+'">'+rez.list[i]+'</option>';
					}
					linked_field.html(opt_list);
				} else {
					linked_field.val(rez.value);
				}
				linked_lock.removeClass('angela_options_wait');
			}
		});
		e.preventDefault();
		return false;
	});
	
	
	// Check for dependencies
	//-----------------------------------------------------------------------------
	jQuery('.angela_options .angela_options_section').each(function () {
		angela_options_check_dependencies(jQuery(this));
	});
	jQuery('.angela_options .angela_options_item_field [name^="angela_options_field_"]').on('change', function () {
		angela_options_check_dependencies(jQuery(this).parents('.angela_options_section'));
	});
	

	// Return value of the field
	function angela_options_get_field_value(fld, num) {
		var ctrl = fld.parents('.angela_options_item_field');
		var val = fld.attr('type')=='checkbox' || fld.attr('type')=='radio' 
					? (ctrl.find('[name^="angela_options_field_"]:checked').length > 0
						? (num === true
							? ctrl.find('[name^="angela_options_field_"]:checked').parent().index()+1
							: (ctrl.find('[name^="angela_options_field_"]:checked').val()!=''
								&& ''+ctrl.find('[name^="angela_options_field_"]:checked').val()!='0'
									? ctrl.find('[name^="angela_options_field_"]:checked').val()
									: 1
								)
							)
						: 0
						)
					: (num === true ? fld.find(':selected').index()+1 : fld.val());
		if (val===undefined || val===null) val = '';
		return val;
	}
	
	// Check for dependencies
	function angela_options_check_dependencies(cont) {
		cont.find('.angela_options_item_field').each(function() {
			var ctrl = jQuery(this), id = ctrl.data('param');
			if (id == undefined) return;
			var depend = false;
			for (var fld in angela_dependencies) {
				if (fld == id) {
					depend = angela_dependencies[id];
					break;
				}
			}
			if (depend) {
				var dep_cnt = 0, dep_all = 0;
				var dep_cmp = typeof depend.compare != 'undefined' ? depend.compare.toLowerCase() : 'and';
				var dep_strict = typeof depend.strict != 'undefined';
				var fld=null, val='', name='', subname='';
				var parts = '', parts2 = '';
				for (var i in depend) {
					if (i == 'compare' || i == 'strict') continue;
					dep_all++;
					name = i;
					subname = '';
					if (name.indexOf('[') > 0) {
						parts = name.split('[');
						name = parts[0];
						subname = parts[1].replace(']', '');
					}
					if (name.charAt(0)=='#' || name.charAt(0)=='.') {
						fld = jQuery(name);
						if (fld.length > 0 && !fld.hasClass('angela_inited')) {
							fld.addClass('angela_inited').on('change', function () {
								jQuery('.angela_options .angela_options_section').each(function () {
									angela_options_check_dependencies(jQuery(this));
								});
							});
						}
					} else
						fld = cont.find('[name="angela_options_field_'+name+'"]');
					if (fld.length > 0) {
						val = angela_options_get_field_value(fld);
						if (subname!='') {
							parts = val.split('|');
							for (var p=0; p < parts.length; p++) {
								parts2 = parts[p].split('=');
								if (parts2[0]==subname) {
									val = parts2[1];
								}
							}
						}
						for (var j in depend[i]) {
							if ( 
								   (depend[i][j]=='not_empty' && val!='')	// Main field value is not empty - show current field
								|| (depend[i][j]=='is_empty' && val=='')	// Main field value is empty - show current field
								|| (val!=='' && (!isNaN(depend[i][j]) 		// Main field value equal to specified value - show current field
													? val==depend[i][j]
													: (dep_strict 
															? val==depend[i][j]
															: (''+val).indexOf(depend[i][j])==0
														)
												)
									)
								|| (val!=='' && (""+depend[i][j]).charAt(0)=='^' && (''+val).indexOf(depend[i][j].substr(1))==-1)
																// Main field value not equal to specified value - show current field
							) {
								dep_cnt++;
								break;
							}
						}
					} else
						dep_all--;
					if (dep_cnt > 0 && dep_cmp == 'or')
						break;
				}
				if ((dep_cnt > 0 && dep_cmp == 'or') || (dep_cnt == dep_all && dep_cmp == 'and')) {
					ctrl.parents('.angela_options_item').show().removeClass('angela_options_no_use');
				} else {
					ctrl.parents('.angela_options_item').hide().addClass('angela_options_no_use');
				}
			}
			// Individual dependencies
			//------------------------------------
			if (id == 'color_scheme') {		// Disable color schemes less then main scheme!
				fld = ctrl.find('[name="angela_options_field_'+id+'"]');
				if (fld.length > 0) {
					val = angela_options_get_field_value(fld);
					var num = angela_options_get_field_value(fld, true);
					cont.find('.angela_options_item_field').each(function() {
						var ctrl2 = jQuery(this), id2 = ctrl2.data('param');
						if (id2 == undefined) return;
						if (id2 == id || id2.substr(-7)!='_scheme') return;
						var fld2 = ctrl2.find('[name="angela_options_field_'+id2+'"]'),
						    val2 = angela_options_get_field_value(fld2);
						if (fld2.attr('type')!='radio') fld2 = fld2.find('option');
						fld2.each(function(idx2) {
							var dom_obj = jQuery(this).get(0);
							dom_obj.disabled = idx2 != 0 && idx2 < num;
							if (dom_obj.disabled) {
								if (jQuery(this).val()==val2) {
									if (fld2.attr('type')=='radio')
										fld2.each(function(idx3) {
											jQuery(this).get(0).checked = idx3==0;
										});
									else
										fld2.each(function(idx2) {
											jQuery(this).get(0).selected = idx3==0;
										});
								}
							}
						});
					});
				}
			}
		});
	}

});