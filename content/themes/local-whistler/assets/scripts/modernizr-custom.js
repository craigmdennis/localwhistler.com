/* Modernizr (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-cssclasses-input-history
 */
;window.Modernizr=function(e,t,n){function w(e){f.cssText=e}function E(e,t){return w(prefixes.join(e+";")+(t||""))}function S(e,t){return typeof e===t}function x(e,t){return!!~(""+e).indexOf(t)}function T(e,t,r){for(var i in e){var s=t[e[i]];if(s!==n)return r===!1?e[i]:S(s,"function")?s.bind(r||t):s}return!1}function N(){i.input=function(n){for(var r=0,i=n.length;r<i;r++)d[n[r]]=n[r]in l;return d.list&&(d.list=!!t.createElement("datalist")&&!!e.HTMLDataListElement),d}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" "))}var r="2.8.2",i={},s=!0,o=t.documentElement,u="modernizr",a=t.createElement(u),f=a.style,l=t.createElement("input"),c={}.toString,h={},p={},d={},v=[],m=v.slice,g,y={}.hasOwnProperty,b;!S(y,"undefined")&&!S(y.call,"undefined")?b=function(e,t){return y.call(e,t)}:b=function(e,t){return t in e&&S(e.constructor.prototype[t],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(t){var n=this;if(typeof n!="function")throw new TypeError;var r=m.call(arguments,1),i=function(){if(this instanceof i){var e=function(){};e.prototype=n.prototype;var s=new e,o=n.apply(s,r.concat(m.call(arguments)));return Object(o)===o?o:s}return n.apply(t,r.concat(m.call(arguments)))};return i}),h.history=function(){return!!e.history&&!!history.pushState};for(var C in h)b(h,C)&&(g=C.toLowerCase(),i[g]=h[C](),v.push((i[g]?"":"no-")+g));return i.input||N(),i.addTest=function(e,t){if(typeof e=="object")for(var r in e)b(e,r)&&i.addTest(r,e[r]);else{e=e.toLowerCase();if(i[e]!==n)return i;t=typeof t=="function"?t():t,typeof s!="undefined"&&s&&(o.className+=" "+(t?"":"no-")+e),i[e]=t}return i},w(""),a=l=null,i._version=r,o.className=o.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(s?" js "+v.join(" "):""),i}(this,this.document);