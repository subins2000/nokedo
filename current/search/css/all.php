<? header("Content-Type:text/css");?>
body{
background-color:#CCC;
}
#content{margin:3% auto;position: relative;padding: 0px 14px 15px 14px;width: 700px;line-height: 18px;background:#EEE !important;border:21px solid #EEE;border-radius:10px;-moz-background-clip: padding;-webkit-background-clip: padding;background-clip: padding-box;border: 20px solid rgba(0, 0, 0, 0.3);-webkit-border-radius: 40px;-moz-border-radius: 40px;border-radius: 40px;}
#search #vl{margin-left:22%;}
/*Appearcance*/
input[type=text]{border:1px solid rgba(204, 204, 204,.7);background:rgba(204, 238, 221,.7);border-radius:.4em;min-height:27px;text-shadow: 0 1px 0 rgb(240, 240, 240);box-shadow:outset 0 1px 1px rgba(255, 255, 255, 0.75);display: inline-block;outline: none;padding: 0 8px;}
input[type=text]:hover{border:1px solid rgba(204, 204, 204,1);background: rgba(204, 238, 221,1);}
input[type=text]:active{border:1px solid rgba(204, 204, 204,1);background: rgba(204, 238, 228,1);}
input[type=button],.sb{border:1px solid rgba(204, 204, 204,.7);background:rgba(77, 144, 254,1);cursor:pointer;color:white;min-height:28px;min-width:67px;border-radius:.3em;}
input[type=button]:hover,.sb:hover{border:1px solid rgba(204, 204, 204,.9);background: rgb(77, 137, 254);box-shadow: outset 0 4px 2px rgba(0,0,0,0.1);}
input[type=button]:active,.sb:active{border:1px solid rgba(204, 204, 204,1);background: rgba(77, 127, 294,1);box-shadow: inset 0 4px 2px rgba(0,0,0,0.1);}
/*End Appearance*/
#pagination{background: #EEE;width: 100%;position: fixed;bottom: -14px;left: 110px;right: 0px;height: 40px;left:0px;padding-top: 5px;width:100%;}
#pagination .pgn{width: 50px;text-align: center;color:white; cursor: pointer;}
#pagination table{margin-top:3px;}
.nc{font-size: 20px;text-align: center;font-weight: bold;}
.sb-g{border: 1px solid rgb(221, 221, 221);cursor:pointer;width: 30px;color: rgb(0, 99, 220);}
.overlap{z-index:-1;opacity:.7;}
.ac_results {padding: 0px;border: 1px solid black;background-color: white;overflow: hidden;z-index: 99999;}
.ac_results ul {width: 100%;list-style-position: outside;list-style: none;padding: 0;margin: 0;}
.ac_results li{margin: 0px;padding: 2px 5px;cursor: default;display: block;font: menu;font-size: 12px;line-height: 16px;overflow: hidden;}
.ac_loading {background: white url('indicator.gif') right center no-repeat;}
.ac_odd {background-color: #eee;}
.ac_over {background-color: #CCC;}
.selected{border-left:2px solid #DD4B39;}
