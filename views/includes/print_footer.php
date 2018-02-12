
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td align="center" valign="middle" class="footer_print">Copyright &copy; Anoosh 2012. All Rights Reserved					
		</td>
      </tr>
    </table>
<div id="divPaging" > </div>
<div class="yui-calcontainer single" id="cal1Container" style="display:none;" ><table class="yui-calendar y2009" id="cal1" cellspacing="0"> </table></div>

<script>

	(function() {
	    var Dom = YAHOO.util.Dom,
	        Event = YAHOO.util.Event,
	        cal1,
	        over_cal = false,
	        cur_field = '';

	    var init = function() {
	        cal1 = new YAHOO.widget.Calendar("cal1","cal1Container");
	        cal1.selectEvent.subscribe(getDate, cal1, true);
	        cal1.renderEvent.subscribe(setupListeners, cal1, true);
	        Event.addListener(cal_params, 'focus', showCal);
	        Event.addListener(cal_params, 'blur', hideCal);
	        
	        cal1.render();
	    }

	    var setupListeners = function() {
	        Event.addListener('cal1Container', 'mouseover', function() {
	            over_cal = true;
	        });
	        Event.addListener('cal1Container', 'mouseout', function() {
	            over_cal = false;
	        });
	    }

	    var getDate = function() {
	            var calDate = this.getSelectedDates()[0];
	            //calDate = (calDate.getMonth() + 1) + '/' + calDate.getDate() + '/' + calDate.getFullYear();
	            //calDate = calDate.getFullYear() + "-"+ (calDate.getMonth() + 1) + "-" + calDate.getDate();

	            var dd = calDate.getDate();
	            var mm = (calDate.getMonth() + 1);
	            var yyyy = calDate.getFullYear();
	            if(dd<=9)
	            {
		            dd = '0'+dd;
	            }
	            if(mm<=9)
	            {
	            	mm = '0'+mm;
	            }
	            //calDate =  yyyy + '-' + mm + '-' + dd;
	            calDate =  dd + '-' + mm + '-' + yyyy;
	            //calDate =  calDate.getDate() + '/' + (calDate.getMonth() + 1) + '/' + calDate.getFullYear();
	            cur_field.value = calDate;            
	            over_cal = false;
	            hideCal();
	    }

	    var showCal = function(ev) {
		    
	        var tar = Event.getTarget(ev);
	        cur_field = tar;
	        
	        var xy = Dom.getXY(tar),
	        date = Dom.get(tar).value;
	        
	        if (date) {
	        	a = date.split('-');
	            //date = a[1] + "/" + a[2] +"/" + a[0];
	            date = a[1] + "/" + a[0] +"/" + a[2];
	            cal1.cfg.setProperty('selected', date);
	            cal1.cfg.setProperty('pagedate', new Date(date), true);
	        } else {
	            cal1.cfg.setProperty('selected', '');
	            cal1.cfg.setProperty('pagedate', new Date(), true);
	        }
	        cal1.render();
	        Dom.setStyle('cal1Container', 'display', 'block');
	        xy[1] = xy[1] + 20;
	        Dom.setXY('cal1Container', xy);
	    }

	    var hideCal = function() {
	        if (!over_cal) {
	            Dom.setStyle('cal1Container', 'display', 'none');
	        }
	    };

	    //Event.addListener(window, 'load', init);
	    init();

	})();

	</script>
