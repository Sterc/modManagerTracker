<?php
/**
 * Study: Manager page analytics
 *
 * Events: OnManagerPageBeforeRender
 *
 * @var modX $modx
 * @author Gauke Pieter Sietzema <gp@sterc.nl>
 *
 * @package Study
 */

$hotjar = $modx->getOption('study.hotjar_id', null, false);
$vwo = $modx->getOption('study.vwo_id', null, false);

switch ($modx->event->name) {
    case 'OnManagerPageBeforeRender':
        if($hotjar){
            $modx->regClientStartupHTMLBlock("
                <script>
                    (function(h,o,t,j,a,r){
                        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                        h._hjSettings={hjid:".$hotjar.",hjsv:5};
                        a=o.getElementsByTagName('head')[0];
                        r=o.createElement('script');r.async=1;
                        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                        a.appendChild(r);
                    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
                </script>
            ");
        }
        if($vwo){
            $modx->regClientStartupHTMLBlock("
                <script type='text/javascript'>
                    var _vwo_code=(function(){
                    var account_id=".$vwo.",
                    settings_tolerance=2000,
                    library_tolerance=2500,
                    use_existing_jquery=false,
                    f=false,d=document;return{use_existing_jquery:function(){return use_existing_jquery;},library_tolerance:function(){return library_tolerance;},finish:function(){if(!f){f=true;var a=d.getElementById('_vis_opt_path_hides');if(a)a.parentNode.removeChild(a);}},finished:function(){return f;},load:function(a){var b=d.createElement('script');b.src=a;b.type='text/javascript';b.innerText;b.onerror=function(){_vwo_code.finish();};d.getElementsByTagName('head')[0].appendChild(b);},init:function(){settings_timer=setTimeout('_vwo_code.finish()',settings_tolerance);var a=d.createElement('style'),b='body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}',h=d.getElementsByTagName('head')[0];a.setAttribute('id','_vis_opt_path_hides');a.setAttribute('type','text/css');if(a.styleSheet)a.styleSheet.cssText=b;else a.appendChild(d.createTextNode(b));h.appendChild(a);this.load('//dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&r='+Math.random());return settings_timer;}};}());_vwo_settings_timer=_vwo_code.init();
                </script>
            ");
        }
        break;
}
return;