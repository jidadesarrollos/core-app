function jd(){return!0}function replaceAll(a,e){var o=a,t=a.indexOf(e);if(t>-1)for(;t>-1;)o=a.substring(0,t),o+=a.substring(t+1),t=o.indexOf(e),a=o;return o}function validarRadio(a){var a=a,e="input[name="+a+"]";e=$(e).length>0?e:'input[name="'+a+'[]"]';var o=($(e).prop("type"),0),t=new Array;return $(e+":checked").length>0&&(radiosSeleccionados=$(e+":checked"),$.each(radiosSeleccionados,function(){t.push(this.value),o++}),1==o?t[0]:t.join(","))}function serializar(a){var e="a:"+a.length+":{";for(i=0;i<a.length;i++)e+="i:"+i+";s:"+a[i].length+':"'+a[i]+'";';return e+="}"}function armarTiny(a){a||(a="textarea.tiny"),valoresTiny={selector:a,language:"es",plugins:[" link charmap print preview anchor","searchreplace code fullscreen","insertdatetime table paste"],toolbar:"undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"},tinymce.init(valoresTiny)}function convertirByteAMb(a){return parseInt((a/1024/1024).toFixed(2))}function scroll(){$("[data-scroll=true]").on("click",function(a){a.preventDefault();var e=$(this.hash);if(e=e.length&&e||$("[name="+this.hash.slice(1)+"]"),e.length){var o=e.offset().top;return $("html,body").animate({scrollTop:o},900),!1}})}function initCarousel(){$("#j-carousel").owlCarousel({singleItem:!0,slideSpeed:700,paginationSpeed:700,rewindSpeed:700,lazyEffect:"fade",navigation:!1,pagination:!1,paginationNumbers:!1,autoHeight:!1,addClassActive:!0})}function getActiveIndex(){link=window.location.pathname,idSeccion=jd.replaceAll(link,"/");$(".owl-item .active > .item");$("[data-id="+idSeccion+"]").data("owlslide",1)}!function(a){function e(e,t){a(this);return this.each(function(a,i){v=new o(i,e,t)})}var o=function(e,o,t){this.objeto=e,this.configuracion=o,this.$obj=a(this.objeto),this.init(),this._FileReader=new FileReader,this._data={}};o.prototype={regExps:{imagen:/\.(jpe?g|png|gif)$/i},_archivosCargados:0,_archivosSeleccionados:0,_data:{},_obtConfiguracion:function(){var e={preCarga:function(){},onLoadArchivo:this._defaultOnload,postCarga:function(){console.log("carga default")},multiple:!1,name:"_jcargaArchivo",btnCarga:!1,onLoad:!1};this._configuracion=a.extend(e,this.configuracion)},init:function(){this._obtConfiguracion(),$file=a("<input>").attr({type:"file",id:this._configuracion.name,name:this._configuracion.name,style:"display:none",multiple:this._configuracion.multiple}),this.$obj.after($file),this.$file=$file,this.file=$file.get(0),this._manejarEventos()},_manejarEventos:function(){console.log("paso en manejarEventos"),this.$obj.on("click",function(a){this.$file.off(),console.log("aca ?"),this.$file.trigger("click").on("change",this._managerChange.bind(this))}.bind(this))},_managerChange:function(a){var e=a.target,o=this;this._archivosSeleccionados=e.files.length,this._defaultPrecarga.call(o,a)},_managerLoadEnd:function(e){var o=(e.currentTarget,this);++o._archivosCargados,this._configuracion.btnCarga?(console.log("en la 103"),a(this._configuracion.btnCarga).on("click",this._postData.bind(this))):o._archivosCargados==o._archivosSeleccionados&&this._configuracion.url&&(console.log("en la 107"),this._postData())},_managerOnLoad:function(a){var e=a.target,o=this;e.removeEventListener("load",o._managerOnLoad),o._configuracion.onLoad.call(o,a)},_postData:function(){var e=new FormData,o=this,t=o._archivosCargados>1?o._configuracion.name+"[]":o._configuracion.name;[].forEach.call(o._archivos,function(a){e.append(t,a)});for(key in o._data)e.append(key,o._data[key]);a.ajax({url:this._configuracion.url,type:"post",processData:!1,contentType:!1,data:e,dataType:"json",success:function(a){o.file.value="",console.log("we are here 1"),o._configuracion.postCarga(a)},error:function(a){console.log("error",a)}})},_defaultPrecarga:function(a){var e=a.target,o=this,t=e.files;this._archivos=t,o._configuracion.preCarga.call(o,a),t&&(band=0,[].forEach.call(t,function(a){a.id_app=band,++band;var e=new FileReader;e.addEventListener("load",this._managerOnLoad.bind(o),!1),e.addEventListener("loadend",this._managerLoadEnd.bind(o),!1),e.readAsDataURL(a)}.bind(o)))},_defaultOnload:function(e){var o=new Image,t=e.target;o.height=150,o.title=t.title,o.src=t.result,$li=a("<li>").html(o),a("#imagenes").append($li),++this._archivoCargados},_previewImage:function(){}},a.fn.jCargaFile=e,a('[data-jida="cargaFile"]').each(function(a,e){console.log(a,e),new o(e)})}(jQuery),jd.inicializandoAjax=0,jd.cargandoAjaxUno=1,jd.cargandoAjaxDos=2,jd.listoInteraccionAjax=3,jd.listoAjaxCompleto=4,jd.contentTypeForm="application/x-www-form-urlencoded",jd.ajax=function(a){try{this.parametros=a,this.valores=this.inicializarValores(),this.enviarData()}catch(a){console.error(a)}},jd.ajax.prototype={valoresPredeterminados:{contentType:"application/x-www-form-urlencoded",metodo:"POST",funcionCarga:null,contentype:!0,parametros:null,respuesta:"html",cargando:"<div class='cargaAjax'> Cargando...</div>",funcionProgreso:!1,pushstate:!1},inicializarValores:function(){return $.extend(this.valoresPredeterminados,this.parametros)},httpr:function(){var a=!1;try{a=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){try{a=new ActiveXObject("Microsoft.XMLHTTP")}catch(e){a=!1}}return a||"undefined"==typeof XMLHttpRequest||(a=new XMLHttpRequest),a},enviarData:function(){var a="s-ajax=true";this.obAjax=this.httpr(),objeto=this,ajax=this.obAjax,ajax.onreadystatechange=function(){objeto.Listo.call(objeto)},"object"==typeof this.valores.parametros&&null!=this.valores.parametros?(a+="&",$.each(this.valores.parametros,function(e,o){a+="&"+encodeURI(e)+"="+encodeURI(o)})):"string"==typeof this.valores.parametros&&(a+="&"+this.valores.parametros),"get"!=this.valores.metodo&&"GET"!=this.valores.metodo||(this.valores.url+="?"+a),ajax.open(this.valores.metodo,this.valores.url,!0),1==this.valores.contentype&&(ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),ajax.setRequestHeader("HTTP_X_REQUESTED_WITH","XMLHttpRequest"),ajax.setRequestHeader("X-Requested-With","XMLHttpRequest")),ajax.send(a),setTimeout(function(){console.log(ajax.readyState),1!=ajax.readyState&&0!=ajax.readyState||(ajax.abort(),console.log("La llamada ajax a tardado demasiado"))},15e3)},Listo:function(){if(ajax=this.obAjax,ajax.readyState!=jd.cargandoAjaxUno&&ajax.readyState!=jd.cargandoAjaxDos||($(".cargaAjax").remove(),$("body").prepend(this.valores.cargando)),ajax.readyState==jd.listoAjaxCompleto){$(".cargaAjax").remove();var a=ajax.status;200==a||0==a?(this.procesarRespuesta(),!1!==typeof this.valores.pushState&&this.validarPushState(),this.valores.funcionCarga.call(this)):this.errorCarga()}},validarPushState:function(){"object"==typeof this.valores.pushState?(pushStateDefault={id:null,title:null,url:null},state=$.extend(pushStateDefault,this.valores.pushState),history.pushState(state.id,state.title,state.url)):"string"==typeof this.valores.pushState&&history.pushState(null,null,this.valores.pushState),window.addEventListener("popstate",function(a){console.log("im here")})},errorCarga:function(){window.location.href=window.location.pathname+"#error",console.log("Error estatus: "+this.obAjax.status)},procesarRespuesta:function(){var a;switch(this.valores.respuesta){case"json":a=JSON.parse(this.obAjax.responseText);break;default:a=this.obAjax.responseText}this.respuesta=a}},function(){function a(a){return this.each(function(){var e=$(this);new ControlCarga(e,a)})}ControlCarga=function(a,e){this.inicializarValores(e),this.init(a,e)},ControlCarga.prototype={inicializarValores:function(a){var e={multiple:!1};if("string"==typeof a){if(this.botonCarga=a,console.log(this.botonCarga),this.conf=e,$(this.botonCarga).length<1)throw console.log("No se encuentra definido el boton de envio")}else this.conf=$.extend(e,a)},init:function(a,e){obj=this;var a=$(a),o=$('<input type="file"/>').css({display:"none",bottm:"0",position:"absolute"});obj.conf.multiple&&(o.prop("multiple",!0),o.attr("name",o.attr("name")+"[]")),a.after(o),a.on("click",function(){o.click()}),o.on("change",function(){this.files}),console.log(obj.botonCarga),$(obj.botonCarga).on("click",function(a){for(a.preventDefault(),archivos=o[0].files,console.log(archivos),formData=new FormData,i=0;i<archivos.length;++i)formData.append("archivos[]",archivos[i],archivos[i].name);new jd.ajax({url:"/excel/carga-archivo",file:formData,respuesta:"html",funcionCarga:function(){$("#respuestaCarga").html(this.respuesta)}})})}},cargaArchivo=function(a){jd.cargador(this,a)},$.fn.controlCarga=a,$.fn.controlCarga.Contructor=ControlCarga,jQuery.fn.jd=new jd}(jQuery),function(a){a.fn.jidaControl=function(){elemento=this,elemento.each(function(){a(this).data("jidacontrolaply")||new jd.controladorInput(this)})}}(jQuery),jd.controladorInput=function(a,e){this.control=a,this.controlObject=$(a),objeto=this,this.validacion=this.controlObject.data("jidacontrol"),this.inicializador()},jd.controladorInput.prototype={inicializador:function(){if(formato="",this.validaciones[this.validacion]){patronXDefault={tipo:1},patronDeValidacion=this.validaciones[this.validacion],patron=$.extend(patronXDefault,patronDeValidacion),controladores=["controlador","controladorCaracter","controladorDecimal"],funcionControlador=controladores[patron.tipo];this.controlObject.prop("id");$(this.controlObject).data("jidacontrolaply",!0),$(this.controlObject).on("keypress",{validacion:objeto.validaciones[this.validacion].cadena,formato:objeto.formatosDisponibles[this.validacion]},objeto[funcionControlador]),$(this.controlObject).on("keyup",{formato:objeto.formatosDisponibles[this.validacion]},this.formateador)}},controladorDecimal:function(a){if(tecla=String.fromCharCode(a.which),key=a.which,isCtrl=!1,8==a.which||9==a.which||9==a.keyCode||37==a.which||38==a.which||39==a.which||40==a.which||222==a.keyCode||222==a.which)return!0;if(17==key&&(isCtrl=!0),1!=isCtrl||37!=key&&39!=key&&46!=key&&161!=key&&225!=key&&17!=key&&18!=key)if(patron=a.data.validacion,patron.test(tecla)){if(decimal=$(this).data("decimal"),decimal="undefined"==typeof decimal?0:decimal,elemento=$(this),valorNumero=elemento.val(),tamValorNumero=valorNumero.length+1,tamValorNumero>=decimal+1){for(numeroSinFormato=replaceAll(valorNumero,"."),valorNumero.indexOf(",")>=0&&(numeroSinFormato=valorNumero.replace(",","")),numeroSinFormato+=tecla,numA=numeroSinFormato.substr(numeroSinFormato.length-decimal),numSinPunto=replaceAll(numeroSinFormato.substr(0,numeroSinFormato.length-decimal),"."),numSinPunto=numSinPunto,numB="",i=1;numSinPunto.length>3;)numB="."+numSinPunto.substr(numSinPunto.length-3)+numB,numSinPunto=numSinPunto.substring(0,numSinPunto.length-3);numB=numSinPunto+numB,decimal>0?numeroFinal=numB+","+numA:numeroFinal=numB,elemento.val(numeroFinal),a.preventDefault()}}else a.preventDefault();else a.preventDefault()},controladorCaracter:function(a){return tecla=String.fromCharCode(a.which),key=a.which,isCtrl=!1,8==a.which||9==a.which||9==a.keyCode||37==a.keyCode||39==a.keyCode||46==a.keyCode||222==a.keyCode||222==a.which||(17==key&&(isCtrl=!0),1!=isCtrl||37!=key&&39!=key&&46!=key&&161!=key&&225!=key&&17!=key&&18!=key?(patron=a.data.validacion,patron.test(tecla)?(decimal=$(this).data("decimal"),decimal):a.preventDefault()):a.preventDefault(),this)},controlador:function(a){if(tecla=String.fromCharCode(a.which),key=a.which,isCtrl=!1,8==a.which||9==a.which||9==a.keyCode||37==a.which||38==a.which||39==a.which||40==a.which||222==a.keyCode||222==a.which)return!0;if(17==key&&(isCtrl=!0),1!=isCtrl||37!=key&&39!=key&&46!=key&&161!=key&&225!=key&&17!=key&&18!=key){if(patron=a.data.validacion,formato=a.data.formato,cadenaInsertada=this.value+tecla,tamCadena=cadenaInsertada.length,cadenaValidada=cadenaInsertada+formato.substr(tamCadena),patron.test(cadenaValidada))return!0;a.preventDefault()}else a.preventDefault();return this},formateador:function(a){return cadenaInsertada=$(this).val().toUpperCase(),tamCadena=cadenaInsertada.length,a.data.formato?(formato=a.data.formato,tamanioFormato=formato.length):tamanioFormato=100,8!=a.which&&(caracteresDeSeparacion=/^[\/.\-]{1}$/,proximoCaracter=formato[tamCadena],tamanioFormato>=tamCadena&&(caracterEsperado=formato[tamCadena-1],caracterIngresado=cadenaInsertada[tamCadena-1],caracteresDeSeparacion.test(caracterEsperado)?(cadenaInsertada[tamCadena-1]=caracterEsperado,caracterIngresado=caracterIngresado!=caracterEsperado?caracterIngresado:"",$(this).val(cadenaInsertada+caracterIngresado)):caracteresDeSeparacion.test(proximoCaracter)&&proximoCaracter!=caracterEsperado&&$(this).val(cadenaInsertada+proximoCaracter))),this},validaciones:{numerico:{cadena:/^[0-9]*$/,tipo:1},cedula:{cadena:/^([V|E|G|J|P|N]\-{1}\d{8})*$/,tipo:0},rifConFormato:{cadena:/^([V|E|G|J|P|N]\-{1}\d{8}-{1}\d{1})*$/,tipo:0},rif:{cadena:/^([V|v|E|e|G|g|J|j|P|p|N|n]\d{9})*$/,tipo:0},telefono:{cadena:/^(\d{11})*$/,tipo:1},miles:{cadena:/^[0-9]*$/,tipo:2},caracteres:{cadena:/^[A-ZñÑa-z ]*$/},alfanumerico:{cadena:/^[0-9A-ZñÑa-z ]*$/},coordenada:{cadena:/^\-?[0-9]{2}\.[0-9]{3,15}/,tipo:0},fecha:{cadena:/^\d{2,4}[\-|\/]{1}\d{2}[\-|\/]{1}\d{2,4}$/,tipo:0}},formatosDisponibles:{rif:"J123456789",rifConFormato:"J-12345678-9",fecha:"00-00-0000"}},function(a){(function(e){a("[data-liparent]").on("click",this.checksubnivel)}).prototype.checksubnivel=function(){var e=a(this);e.children("ul").length>0&&(e.children("ul").hasClass("show")?(a("ul.show").removeClass("show"),e.removeClass("selected")):(a("ul.show").removeClass("show"),a("li").removeClass("selected"),e.addClass("selected"),e.children("ul").addClass("show")))}}(jQuery),function($){function jPlugin(a,e){$(this);return this.each(function(e,o){$(this).on("click",function(e){o=new jValidador(this,a,e)})})}jValidador=function(a,e,o){if(this._default={funcionError:this.mensajeError,totalError:!1,divError:!1,cssError:"div-error",vControl:!0,post:!1,prev:!1,validaciones:!1,form:!1,campo:!1,viaData:!1},a)if(this.$ele=$(a),this.config=e,this.errores=new Object,"object"==typeof this.config?this.config=$.extend(this._default,this.config):this.config=this._default,this.config.campo){this.$ele=$(a);this.initInput()}else{this.$ele.data("config",this.config),this.config.form?this.$form=$("#"+this.config.form):this.$form=$(this.$ele[0].form),this.$ele.data("jd.validador",this),this.$form.data("jd.validador",this);this.init()||o.preventDefault()}else console.log("ele is FALSE")},jValidador.VERSION="1.1";var jdValidador='[data-jida="validador"]';jValidador.replaceAll=function(a,e,o){if(!a)return a;o||(o="");var t=a,i=a.indexOf(e);if(i>-1)for(;i>-1;)t=a.substring(0,i),t=t+o+a.substring(i+1),i=t.indexOf(e),this.errores=!0,a=t;return t},$.fn.validadorJida=jPlugin,jValidador.prototype={initInput:function(e){return $ele=this.$ele,bandera=!0,jv=this,$ele.data("validacion")&&!0===bandera&&!jv.validar($ele,jv.verificarValidaciones($ele.data("validacion")))?(eval(jv.config.funcionError).call(this,$ele),jv.erroresCampo=!0,bandera=!1,bandera):bandera},erroresCampo:!1,init:function(a){var e=this.$ele;if(jv=e.data("jd.validador"),jv.errores=new Object,t=!0,jv.validarFuncionesExternas("prev")){var o=this.$form,t=!0;void 0===o&&void 0===o.elements||($.each(o[0].elements,function(a,e){var o=$(e),i=jv.obtValidacionesCampo(o);if(i&&!0===t&&!jv.validar(o,jv.verificarValidaciones(i)))return jv.totalErrores||jv.config.funcionError.call(this,o,jv),t=!1}),t&&(t=jv.validarFuncionesExternas("post")))}else t=!1;return t},obtValidacionesCampo:function(a){return this.config.viaData?(validaciones=a.data("validacion"),"string"==typeof validaciones&&(validaciones=JSON.parse(validaciones)),validaciones):"undefined"!=this.config.validaciones[a.attr("id")]&&this.config.validaciones[a.attr("id")]},validarFuncionesExternas:function(tipo){return 0==this.config[tipo]||void 0===this.config[tipo]||("string"==typeof this.config[tipo]?result=eval(this.config[tipo]).call(this,jv.$form):result=this.config[tipo].call(this),result)},validar:function(a,e){var o=!0;return 1!=e.obligatorio&&"object"!=typeof e.obligatorio||(o=jv.obligatorio(a,e.obligatorio)),o?$.each(e,function(e,t){type=typeof parametros,0!=t&&1==o&&"obligatorio"!=e&&(jv[e]?jv[e](a,e,t)||(jv.errores[a.attr("id")]=e,o=!1):jValidador.validaciones[e]?jv.ejecutarValidacion(a,e)||(jv.errores[a.attr("id")]=e,o=!1):(console.log(e,t),console.error("No existe la validacion solicitada "+e+" para el campo "+a.attr("id"))))}):jv.errores[a.attr("id")]="obligatorio",o},externa:function(a,e,o){if(o.funcion)return o.funcion.call(this,a,e,o);if(o.expr)return this.ejecutarValidacion(a,e,o.expr);throw new Error("No se ha formulado correctamente la validacione xterna"+e)},expr:function(a,e,o){return this.ejecutarValidacion(a,e,o.expr)},ejecutarValidacion:function(a,e,o){o||(o=jValidador.validaciones[e].expr);var t=a.val();return"numerico"!=e&&"decimal"!=e||(t=jValidador.replaceAll(t,"."),"decimal"==e&&t.replace(",",".")),""==t||!!o.test(t)},mensajeError:function(a,e){if(a){$input=a;var o=jv.errores[a.attr("id")],t=e.obtValidacionesCampo(a),i="",n=e.$form.find("."+e.config.cssError);i=void 0!=t[o]&&t[o].mensaje?t[o].mensaje:jValidador.validaciones[o].mensaje,n.length>0?$input.parent().hasClass("control-multiple")?($input.focus().parent().before(n.html(i).show()),$("html,body").animate({scrollTop:$input.offset().top-200})):($input.focus().before(n.html(i).show()),$("html,body").animate({scrollTop:$input.offset().top-200})):($divError=$("<div></div>").addClass(jv.config.cssError).html(i),e.$form.on("click",function(a){$(a.target).attr("id")!=jv.$ele.attr("id")&&$divError.fadeOut()}),$input.parent().hasClass("control-multiple")?($input.focus().parent().before($divError).show(),$("html,body").animate({scrollTop:$input.offset().top-200})):($input.focus().before($divError).show(),$("html,body").animate({scrollTop:$input.offset().top-200})))}},verificarValidaciones:function(a){var e={numerico:!1,documentacion:!1,obligatorio:!1,caracteres:!1};return void 0!==a?(a instanceof Array&&(newObject=Object(),$.each(a,function(a,e){newObject[e]=!0}),a=newObject),$.extend(e,a)):e},obligatorio:function(a,e){void 0===e.evaluacion&&(e.evaluacion="igual");var o=a.attr("type"),t=!0;if(e.condicional){var i,n=$("#"+e.condicional);if(e.tipo&&"radio"==e.tipo||"radio"==n.attr("type")){n.length<1&&(n=$("input[name="+e.condicional+"]")),i=$("input[name="+e.condicional+"]:checked").val();var r=n.attr("name");void 0===r&&console.error("El condicional para "+a.attr("name")+" no ha sido definido correctamente",n,e)}else i=n.val();switch(t=!1,e.evaluacion){case"igual":i==e.condicion&&(t=!0);break;case"diff":i!=e.condicion&&(t=!0);break;case"mayor":i>e.condicion&&(t=!0);break;case"menor":i<e.condicion&&(t=!0)}}else t=!0;if(!0===t)switch(o){case"RADIO":case"radio":case"CHECKBOX":case"checkbox":var r=a.attr("name");$('input[name="'+r+'"]:checked').length>0?resp=!0:resp=!1;break;default:""==a.val().trim()?resp=!1:resp=!0}else resp=!0;return resp},documentacion:function(a,e,o){var t=jValidador.validaciones[e].expr,i=a.val();return o.campo_codigo&&(i=a.prev().val()+i),""==i||!!t.test(i)},telefono:function(a,e,o){var t=11,i="",n="",r=jValidador.validaciones.telefono.expr,c=jValidador.validaciones.celular.expr,s=jValidador.validaciones.internacional.expr,l=a.val();if(o.code&&(i=$("#"+a.attr("id")+"-codigo").val(),"undefined"==i&&(i=""),jv.divMsjError="#box"+jValidador.replaceAll(a.attr("id"),"#","")),o.ext&&(t+=4,n=$("#"+a.attr("id")+"-ext").val()),""!=(l=i+l+n)){var d=c.test(l)?1:0,u=r.test(l)?1:0,h=s.test(l)?1:0;return console.log("valido?",d,u,l,o.tipo),!(!o.tipo||!("telefono"==o.tipo&&1==u||"celular"==o.tipo&&1==d||"internacional"==o.tipo&&1==h||"multiple"==o.tipo&&(1==u||1==d)))}return!0},igualdad:function(a,e,o){return campo=$("#"+o.campo),a.val()==campo.val()},contrasenia:function(a,e,o){var t=jValidador.validaciones.minuscula.expr,i=jValidador.validaciones.mayuscula.expr,n=jValidador.validaciones.numero.expr,r=jValidador.validaciones.caracteresEsp.expr,c=a.val();if(""!=c){var s=t.test(c)?1:0,l=i.test(c)?1:0,d=n.test(c)?1:0,u=r.test(c)?1:0;return 1==s&&1==l&&1==d&&1==u&&c.length>=8}return!1},obtErrores:function(){return jv.errores}},jValidador.validaciones={obligatorio:{mensaje:"El campo no puede estar vacio"},email:{expr:/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/,mensaje:"El campo debe ser un mail"},numerico:{expr:/^\d+$/,mensaje:"El campo debe ser numerico"},moneda:{expr:/^\d+$/,mensaje:"El campo debe ser numerico"},decimal:{expr:/^([0-9])*[.|,]?[0-9]*$/,mensaje:"El campo debe ser numerico con decimales"},caracteres:{expr:/^[A-ZñÑa-záéíóúÁÉÍÓÚ ]*$/,mensaje:"El campo solo puede contener caracteres"},celular:{expr:/^0?(412|416|414|424|426)\d{7}$/,mensaje:"El formato del celular no es valido"},telefono:{expr:/^0?2[0-9]{9,13}$/,mensaje:"El formato del telefono no es valido"},caracteresEspeciales:{expr:/^([^(*=;\\)])*$/,mensajes:"Caracteres invalidos en el campo"},tiny:{mensaje:"El campo es obligatorio"},alfanumerico:{expr:/^[\dA-ZñÑa-záéíóúÁÉÍÓÚ.,\' ]*$/,mensaje:"El campo solo puede contener letras y numeros"},documentacion:{expr:/^(([V|v|E|e|G|g|J|j|P|p|N|n]{1})?\d{7,10})*$/,mensaje:"El campo debe tener el siguiente formato J18935170 o 18935170"},programa:{expr:/^[\d\/\.A-Za-z_-]*$/,mensaje:"El campo solo puede contener letras, guion y underscore"},minuscula:{expr:/[a-z]/,mensaje:"La contraseña debe tener al menos una minuscula"},mayuscula:{expr:/[A-Z]/,mensaje:"La contraseña debe tener al menos una mayuscula"},numero:{expr:/[0-9]/,mensaje:"La contraseña debe tener al menos un número"},caracteresEsp:{expr:/(\||\!|\"|\#|\$|\%|\&|\/|\(|\)|\=|\'|\?|\<|\>|\,|\;|\.|\:|\-|\_|\*|\~|\^|\{|\}|\+)/,mensaje:"La contraseña debe tener al menos un caracter especial"},coordenada:{expr:/^\-?[0-9]{2}\.[0-9]{3,15}/,mensaje:"La coordenada debe tener el siguiente formato:"},internacional:{expr:/^\d{9,18}$/,mensaje:"El telefono internacional no es valido"},igualdad:{mensaje:"Los campos no pueden ser iguales"}},$.fn.jValidador=jPlugin,$(document).on("click",jdValidador,function(a){if(void 0!=$(this).data("config"))var e=$(this).data("config");else var e=new Object;e.viaData=!0,new jValidador(this,e,a)})}(jQuery);