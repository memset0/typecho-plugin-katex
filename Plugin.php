<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * MarkdownParse Katex for Typecho (Modified by memset0)
 * 
 * @package MardownKatex
 * @author zyuzhi & memset0
 * @version 1.0.1.233
 * @link https://blog.zyuzhi.me
 */
class MarkdownKatex_Plugin implements Typecho_Plugin_Interface
{
    public static $count = 0;
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Abstract_Contents')->markdown = array('MarkdownKatex_Plugin','parseDown');
        Typecho_Plugin::factory('Widget_Archive')->footer = array('MarkdownKatex_Plugin','footer');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    public static function parseDown($text)
    {
        require_once dirname(__FILE__) . '/ParsedownKatex.php';
        $content = ParsedownKatex::instance()->setFencedCodeBlockClassPrefix('')->text($text);
        return $content;
    }

    public static function footer($content) {
        ?>
<link href="//cdn.bootcss.com/KaTeX/0.10.1/katex.min.css" rel="stylesheet">
<script src="//cdn.bootcss.com/KaTeX/0.10.1/katex.min.js"></script>
<script>
var tmp = document.getElementsByTagName('katex-inline');
for (var i = 0; i < tmp.length; i++) { var t = tmp[i].innerHTML, e; console.log(katex.render(tmp[i].innerText, tmp[i], {displayMode: false, throwOnError: false})); }
tmp = document.getElementsByTagName('katex');
for (var i = 0; i < tmp.length; i++) { var t = tmp[i].innerHTML, e; console.log(katex.render(tmp[i].innerText, tmp[i], {displayMode: true, throwOnError: false})); }
</script>
<?php
    }
}
