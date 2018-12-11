<?php
$cd = (isset($_SESSION['__CD__']))? $_SESSION['__CD__'] : '';
unset($_SESSION['__CD__']);

$filter = new InputFilter();
?>
<html>
  <style type="text/css">
   .Footer .content {
      padding   :0px !important;
   }
   *html body {
      overflow-y: hidden;
   }
  </style>
  <body onresize="autoResizeScreen()" onload="autoResizeScreen()">
  <iframe name="casesFrame" id="casesFrame" src ="<?php echo $cd; ?>../cases/main_init<?php echo $filter->xssFilterHard($_POST['qs']); ?>" width="99%" height="768" frameborder="0">
      <p>Your browser does not support iframes.</p>
  </iframe>
  </body>
  <script>
    if ( document.getElementById('pm_submenu') )
      document.getElementById('pm_submenu').style.display = 'none';
      document.documentElement.style.overflowY = 'hidden';

      var oClientWinSize = getClientWindowSize();


    function autoResizeScreen() {
		var containerList1, containerList2;
		oCasesFrame    = document.getElementById('casesFrame');
		oClientWinSize = getClientWindowSize();

		containerList1 = document.getElementById("pm_header");
		if (document.getElementById("mainMenuBG") &&
			document.getElementById("mainMenuBG").parentNode &&
			document.getElementById("mainMenuBG").parentNode.parentNode &&
			document.getElementById("mainMenuBG").parentNode.parentNode.parentNode &&
			document.getElementById("mainMenuBG").parentNode.parentNode.parentNode.parentNode){
				containerList2 = document.getElementById("mainMenuBG").parentNode.parentNode.parentNode.parentNode;
			}
		if (containerList1 === containerList2) {
			height = oClientWinSize.height - containerList1.clientHeight;
			oCasesFrame.style.height = height;
			if (oCasesFrame.height ) {
				oCasesFrame.height = height;
			}
		} else {
			height = getClientWindowSize().height-90;
			oCasesFrame.style.height = height + 'px';
			oCasesSubFrame = oCasesFrame.contentWindow.document.getElementById('casesSubFrame');
			if(oCasesSubFrame){
				oCasesSubFrame.style.height = (height-5) + 'px';;
			} else {
			setTimeout('autoResizeScreen()', 2000);
			}
		}
    }
  </script>
  <SCRIPT src="/jscore/src/PM.js" type=text/javascript></SCRIPT>
  <SCRIPT src="/jscore/src/Sessions.js" type=text/javascript></SCRIPT>
</html>