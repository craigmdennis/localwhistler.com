!function(window){"use strict";var FilterJS=function(a,b,c,d){return new _FilterJS(a,b,c,d)};FilterJS.VERSION="1.5.1",$.fn.filterjs=function(a,b,c){var d=$(this);d.data("fjs")||d.data("fjs",new _FilterJS(a,d,b,c))},window.FilterJS=FilterJS;var _FilterJS=function(a,b,c,d){var e,f=0;this.data=a,this.view=c,this.container=b,this.options=d||{},this.categories_map={},this.record_ids=[],this.data.constructor!=Array&&(this.data=[this.data]);for(e in this.data[0])this.root=e,f+=1;return 1==f?this.getRecord=function(a,b){return b[a][this.root]}:(this.getRecord=function(a,b){return b[a]},this.root="fjs"),this.id_field=this.options.id_field||"id",this.render(this.data),this.parseOptions(),this.buildCategoryMap(this.data),this.bindEvents(),this.options.callbacks=this.options.callbacks||{},this.execCallBack("after_init",this.record_ids),this.execCallBack("after_add",this.data),this.options.filter_types=this.options.filter_types||{},this.options.filter_types.range||(this.options.filter_types.range=this.rangeFilter),this.options.streaming=this.options.streaming||{},this.options.streaming.data_url&&(this.options.streaming.stream_after=1e3*(this.options.streaming.stream_after||2),this.options.streaming.batch_size=this.options.streaming.batch_size||!1,this.streamData(this.options.streaming.stream_after)),(void 0==this.options.filter_on_init||1==this.options.filter_on_init)&&(this.options.filter_on_init=!0,this.filter()),this};_FilterJS.prototype={render:function(a){var b,c,d=$(this.container);if(a)for(var e=0,f=a.length;f>e;e++)b=this.getRecord(e,a),c=$(this.view(b)),c.attr({id:this.root+"_"+b[this.id_field],"data-fjs":!0}),c=d.append(c)},bindEvents:function(){var a=this,b=this.options.selectors,c=0,d=b.length;for(c;d>c;c++)this.bindSelectorEvent(b[c],a);this.options.search&&$(this.options.search.input).on("keyup",function(){a.filter()})},bindSelectorEvent:function(a,b){$(a.element).on(a.events,function(){b.filter()})},clear:function(){var a=this.options.selectors,b=0,c=a.length;for(b;c>b;b++)$(a[b].element).off(a[b].events);this.options.search&&$(this.options.search.input).off("keyup"),this.category_map=null,this.record_ids=null},filter:function(){var a,b,c,d,e=!1,f=0,g=this.options.selectors.length;if(g){for(f;g>f;f++)b=this.options.selectors[f],c=$(b.element).filter(b.select).map(function(){return $(this).val()}),c.length?(d=this.findObjects(c,this.categories_map[b.name],this.options.filter_types[b.type]),a=$.grep(a||this.record_ids,function(a){return-1!=d.indexOf(a)})):e=!0;e&&this.options.and_filter_on&&(a=[])}else a=this.record_ids;this.options.search&&(a=this.search(this.options.search,a)),this.hideShow(a),this.execCallBack("after_filter",a)},findObjects:function(a,b,c){var d,e,f=[],g=0,h=a.length;for(g;h>g;g++)e=a[g],d=c?$.map(b,function(a,b){return c(e,b)?a:void 0}):b.constructor==Array?b:b[e],d&&(f=f.concat(d));return f},buildEvalString:function(a){var b,c=a.split(".ARRAY."),d=1,e=c.length;for(b=c[0],d;e>d;d++)b+=".filter_collect('"+c[d]+"')";return b},addFilterCriteria:function(a,b,c){this.categories_map[a]={};var d=this.parseSelectorOptions({name:a},[b]);c=c||$(d.element).data("ids")||[],this.options.selectors.push(d),this.categories_map[a]=c,this.bindSelectorEvent(d,this)},parseOptions:function(){var a,b,c,d=this.options.filter_criteria;this.options.selectors=[];for(c in d)b=d[c],a=this.parseSelectorOptions({name:c},b),this.options.selectors.push(a),b.push(this.buildEvalString(b[1])),this.categories_map[c]={}},parseSelectorOptions:function(a,b){a.element=b[0].split(/.EVENT.|.SELECT.|.TYPE./)[0],a.events=(b[0].match(/.EVENT.(\S*)/)||[])[1],a.select=(b[0].match(/.SELECT.(\S*)/)||[])[1],a.type=(b[0].match(/.TYPE.(\S*)/)||[])[1];var c=$(a.element),d=c.attr("type");return a.select||("INPUT"==c.get(0).tagName?"checkbox"==d||"radio"==d?a.select=":checked":("hidden"==d||"text"==d)&&(a.select=":input"):"SELECT"==c.get(0).tagName&&(a.select="select")),a.events||("checkbox"==d||"radio"==d?a.events="click":("hidden"==d||"SELECT"==c.get(0).tagName)&&(a.events="change")),a},buildCategoryMap:function(data){for(var filter_criteria=this.options.filter_criteria,record,categories,obj,x,i=0,l=data.length;l>i;i++){record=this.getRecord(i,data),this.record_ids.push(record[this.id_field]);for(name in filter_criteria)if(categories=eval("record."+filter_criteria[name][2]),obj=this.categories_map[name],categories&&categories.constructor==Array)for(var j=0,lj=categories.length;lj>j;j++)x=categories[j],obj[x]?obj[x].push(record[this.id_field]):obj[x]=[record[this.id_field]];else obj[categories]?obj[categories].push(record[this.id_field]):obj[categories]=[record[this.id_field]]}},hideShow:function(a){var b="#"+this.root+"_",c=0,d=a.length;for($(this.container+" > *[data-fjs]").hide(),c;d>c;c++)$(b+a[c]).show()},search:function(a,b){var c=$.trim($(a.input).val()),d=a.search_in,e=$.isNumeric(a.min_length)?a.min_length:1;if(c.length<e)return b;var f="#"+this.root+"_";return c=c.toUpperCase(),$.map(b,function(a){var b=$(f+a);return d&&(b=b.find(d)),b.text().toUpperCase().indexOf(c)>=0?a:void 0})},execCallBack:function(a,b){this.options.callbacks[a]&&this.options.callbacks[a].call(this,b)},rangeFilter:function(a,b){var c=a.split("-");return 2==c.length&&("below"==c[0]&&(c[0]=-1/0),"above"==c[1]&&(c[1]=1/0),Number(b)>=c[0]&&Number(b)<=c[1])?!0:void 0},getRecordsByIds:function(a){var b,c=[],d=0,e=this.data.length;for(d;e>d;d++)b=this.getRecord(d,this.data),-1!=a.indexOf(b[this.id_field])&&c.push(b);return c},addData:function(a){if(void 0!=a&&0!=a.length){{a.length,"#"+this.root+"_"}this.execCallBack("before_add",a),this.data=this.data.concat(a),this.render(a),this.buildCategoryMap(a),this.execCallBack("after_add",a),this.filter()}},setStreamingTimer:function(){var a=this,b=this.options.streaming.batch_size?setInterval:setTimeout;return b(function(){a.streamData()},this.options.streaming.stream_after)},clearStreamingTimer:function(){this.timer&&clearTimeout(this.timer)},fetchData:function(){var a=this,b=this.options.params||{},c=this.options.streaming;b.offset=this.data.length,c.batch_size&&(b.limit=c.batch_size),this.options.search&&(b.q=$.trim($(this.options.search.input).val())),$.getJSON(c.data_url,b).done(function(c){null==b.limit||c&&c.length?(a.setStreamInterval(),a.addData(c)):a.stopStreaming()}).fail(function(){a.stopStreaming()})},setStreamInterval:function(){var a=this;1!=a.options.streaming.stop_streaming&&(a.timer=setTimeout(function(){a.fetchData()},a.options.streaming.stream_after))},stopStreaming:function(){this.options.streaming.stop_streaming=!0,this.timer&&clearTimeout(this.timer)},resumeStreaming:function(){this.options.streaming.stop_streaming=!1,this.streamData(this.options.streaming.stream_after)},streamData:function(){this.setStreamInterval(),this.options.streaming.batch_size||this.stopStreaming()}}}(this),Array.prototype.filter_collect=function(a,b){for(var b=b||[],c=0,d=this.length;d>c;c++){var e=this[c];e.constructor==Array?e.filter_collect(a,b):b.push(e[a])}return b},Array.prototype.indexOf||(Array.prototype.indexOf=function(a,b){for(var c=b||0,d=this.length;d>c;c++)if(this[c]===a)return c;return-1});var filter;filter={},function(a,b){"use strict";return filter={filterCount:0,include:"title,date,url,excerpt,taxonomy_business_filter",apiLocation:"/api/get_posts/?post_type=business&count=-1"+filter.include,settings:{filter_on_init:!0,filter_criteria:{location:[".js__filter-location .TYPE.any","taxonomy_business_location.ARRAY.slug"],type:[".js__filter-type .TYPE.any","taxonomy_business_type.ARRAY.slug"]},search:{input:"#filterSearch",search_in:".media__title, .media__footer"},filter_types:{any:function(a,b){return""===a?!0:a===b}},streaming:{data_url:filter.apiLocation,stream_after:1,batch_size:10},callbacks:{after_filter:function(a){b.googleMap.update_markers(a),filter.push_history(),filter.result_count(a),filter.result_sort(),filter.update_links(),filter.update_styles(),filter.affix(),filter.filterCount++}}},init:function(){var a=filter.get_api_data(filter.apiLocation);b.googleMap.init(),filter.bind(),filter.create_results(),filter.fJS=filter.filter_init(a)},filter_init:function(a){return FilterJS(a.posts,"#resultsList",filter.view,filter.settings)},bind:function(){Modernizr.history&&(b.onpopstate=filter.set_current_state),a("form").on("submit",function(a){a.preventDefault()}),a("#filterOrder").on("change",filter.result_sort)},affix:function(){var c=a("#controls").height(),d=a("#results").height(),e=a("#controls");return console.log("controlHeight",c),console.log("resultsHeight",d),a(b).width()<1100?!1:void(d>c?(console.log("Control height is larger than Results height."),e.affix({offset:{top:function(){return this.top=e.offset().top-20},bottom:function(){return this.bottom=a(".footer").height()+63}}})):filter.kill_affix(e))},kill_affix:function(c){"undefined"!=typeof c.data("bs.affix")&&(console.log("Kill affixed plugin"),a(b).off(".affix"),c.removeClass("affix affix-top affix-bottom").removeData("bs.affix"))},create_results:function(){a("#resultsList ").length?a("#resultsList").html(""):a("#results").html('<ol id="resultsList" class="media__list"></ol>')},update_styles:function(){var b="first",c="last",d="visible",e=a(".media");console.log(e.filter(":"+d+":"+b)),a("."+b+"-"+d).removeClass(b+"-"+d),a("."+c+"-"+d).removeClass(c+"-"+d),e.filter(":"+d+":"+b).addClass(b+"-"+d),e.filter(":"+d+":"+c).addClass(c+"-"+d)},get_url:function(){var a=b.location,c=a.pathname.split("/"),d=a.host,e="http://"+d+c[0]+"/";return e},is_location:function(){return""!==filter.get_current_state().location?!0:!1},is_type:function(){return""!==filter.get_current_state().type?!0:!1},is_search:function(){return""!==filter.get_current_state().search?!0:!1},is_order:function(){return""!==filter.get_current_state().order?!0:!1},get_current_state:function(){var b=a("#filterType :selected"),c=a("#filterLocation :selected"),d=a("#filterOrder :selected"),e=a("#filterSearch"),f=a("#filterView"),g={type:b.val(),order:d.val(),location:c.val(),search:e.val(),typeText:b.text(),orderText:d.text(),locationText:c.text(),view:f.val()};return g},set_current_state:function(){history.state.search&&a("#filterSearch").attr("value",history.state.search),filter.result_sort();var b=a("#filterForm").find("select");b.each(function(){a(this).find("option:selected").removeAttr("selected");var b=a(this).find("option");b.each(function(){var b=a(this).val();(b===history.state.location||b===history.state.type||b===history.state.order)&&(a(this).attr("selected","selected"),a(this).trigger("chosen:updated"))})})},generate_url:function(){var a=filter.get_url(),b=filter.get_current_state().location,c=filter.get_current_state().order,d=filter.get_current_state().type,e=filter.get_current_state().search;return a+="?s="+e,a+="&business_location="+b,a+="&business_type="+d,a+="&order="+c},generate_title:function(){var a,b=filter.get_current_state().locationText,c=filter.get_current_state().typeText;return a=filter.is_location()?b:filter.is_type()?c:filter.is_search()?c:"Filtering:"+c+" in "+b,a+=" | Local Whistler"},push_history:function(){Modernizr.history&&(a("#filterSearch").is(":focus")||0===filter.filterCount?b.history.replaceState(filter.get_current_state(),filter.generate_title(),filter.generate_url()):b.history.pushState(filter.get_current_state(),filter.generate_title(),filter.generate_url()))},push_analytics:function(){ga("send","event","select","filter",{nonInteraction:1})},result_sort:function(){var b=a("#filterOrder").find("option:selected"),c="."+b.attr("data-sort-target"),d=b.attr("data-sort-order").toLowerCase(),e=b.attr("data-sort-by");console.log("Sort Target",c),console.log("Sort Order",d),console.log("Sort By",e),a("ol .media").tsort(c,{order:d}),filter.update_styles()},result_count:function(b){a(".js__count").text(b.length?b.length+" businesses match":"No matches")},get_api_data:function(b){var c;return a.ajax({async:!1,url:b,dataType:"json",success:function(a){c=a}}),c},get_logo:function(a){var b=a.acf.logo,c=b.sizes["media--thumb-height"],d=b.sizes["media--thumb-width"],e='style="margin-left:-'+d/2+"px;margin-top:-"+c/2+'px;"';return""!==b?'<a class="media__link--logo media__link--left media__thumb js-color-target" href="'+b.url+'"><img class="media__logo js-color-trigger" src="'+b.sizes["media--thumb"]+'" alt="'+b.description+' Logo"'+e+" /></a>":void 0},get_tags:function(b){var c="";if(b.taxonomy_business_filter.length){c=['<div class="media__footer"><ul class="tags">'];var d;a.each(b.taxonomy_business_filter,function(){d='<li class="tag__item"><a class="tag__link" href="/filter/'+this.slug+'">'+this.title+"</a></li>",c.push(d)}),d="</ul></div>",c.push(d),c=c.join(",")+"",c=c.replace(/,/g,"")}return c},update_links:function(){var b=filter.generate_url();console.log(b+"&view=gallery"),a("#view-gallery").attr("href",b+"&view=gallery"),a("#view-list").attr("href",b+"&view=list"),a("#view-map").attr("href",b+"&view=map")},format_date:function(a){var b=["January","February","March","April","May","June","July","August","September","October","November","December"],c=new Date(a),d=c.getDate(),e=c.getMonth(),f=c.getFullYear(),g=b[e],h={iso:c.toUTCString(),pretty:g+" "+d+", "+f};return h},view:function(a){var c=filter.format_date(a.date).iso,d=filter.format_date(a.date).pretty,e=filter.get_tags(a),f="";return b.googleMap.add_marker(a),'<li class="media"><div class="has-logo"><div class="media__logo-container">'+filter.get_logo(a)+'</div><a class="media__link--container" href="'+a.url+'"><div class="media__heading"><h2 class="media__title">'+a.title+'</h2></div><div class="media__body" style="'+f+'"><p>'+a.excerpt+'</p></div></a><time class="media__date" datetime="'+c+'">'+d+"</time>"+e+"</div></li>"}}}(jQuery,window,document),$(document).ready(function(){"use strict";$("#results").length&&window.filter.init(),$(document).on("click",".btn--control",function(a){a.preventDefault();var b=$(this).attr("id"),c=b.replace("view-","");$.cookie("view",c,{expires:7}),$("body").removeClass("view-gallery view-list view-map").addClass(b),"view-map"===b&&($(window).trigger("resize"),google.maps.event.trigger(window.googleMap.map,"resize"),$("select").trigger("change"),window.filter.kill_affix($("#controls")),ga("send","event","button","click","Map View")),"view-list"===b&&(window.filter.affix($("#controls")),ga("send","event","button","click","List View"))})});var googleMap;googleMap={},function(a,b,c){"use strict";googleMap={center_lat_lng:[50.11632,-122.957356],map:null,markers:{},bounds:null,init:function(){var a={scrollwheel:!1,center:new google.maps.LatLng(this.center_lat_lng[0],this.center_lat_lng[1]),zoom:15,mapTypeId:google.maps.MapTypeId.ROADMAP,maxZoom:17,suppressInfoWindows:!0,panControlOptions:{position:google.maps.ControlPosition.RIGHT_CENTER},zoomControlOptions:{style:google.maps.ZoomControlStyle.SMALL,position:google.maps.ControlPosition.RIGHT_CENTER}};this.create_map(),this.map=new google.maps.Map(c.getElementById("resultsMap"),a),this.infowindow=new google.maps.InfoWindow({maxWidth:300}),google.maps.event.trigger(googleMap,"resize")},create_map:function(){a('<div class="map--full"><div id="resultsMap" class="js-mapping" style="height:100%;"></div></div>').insertBefore("footer")},add_marker:function(a){var b=a.custom_fields.martygeocoderlatlng[0].slice(1,-1),c=b.split(", "),d=this,e=new google.maps.Marker({position:new google.maps.LatLng(c[0],c[1]),title:a.title,map:this.map});e.setMap(this.map),e.info_window_content='<div id="content" class="context__map"><h1 class="title--large">'+a.title+"</h1><p>"+a.excerpt+'</p><a class="btn btn--primary" href="'+a.url+'">More details</a></div></div>',this.markers[a.id]=e,google.maps.event.addListener(e,"click",function(){d.infowindow.setContent(e.info_window_content),d.infowindow.open(d.map,e)})},update_markers:function(b){this.bounds=new google.maps.LatLngBounds,a.each(this.markers,function(){this.setMap(null)}),b.length?a.each(b,function(a,b){googleMap.markers[b].setMap(googleMap.map),googleMap.bounds.extend(new google.maps.LatLng(googleMap.markers[b].position.k,googleMap.markers[b].position.B))}):googleMap.bounds.extend(new google.maps.LatLng(googleMap.center_lat_lng[0],googleMap.center_lat_lng[1])),this.set_center_point()},set_center_point:function(){if(b.matchMedia("(min-width: 68.75em)").matches){{var a=1.3,c=this.bounds.getNorthEast(),d=this.bounds.getSouthWest(),e=(c.lat()-d.lat())*(a-1),f=(c.lng()-d.lng())*(a-1),g=new google.maps.LatLng(c.lat()+e,c.lng()+f);new google.maps.LatLng(d.lat()-e,d.lng()-f)}this.bounds.extend(g)}this.map.setCenter(this.bounds.getCenter()),this.map.fitBounds(this.bounds)}}}(jQuery,window,document);