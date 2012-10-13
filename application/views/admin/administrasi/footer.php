</div>
<div id="footer">
<div id="footer-atas">
<div id="inner-footer-atas">
<div style="clear:both; height:1px; width:100%;"></div>
<div class="title-inner-footer-atas">Online Support :</div> 
<div style="float:left; width:810px; background-color:#FFFFFF; padding:6px; height:16px;"><?php
	foreach($online->result_array() as $o)
	{
?>
	<a href = 'ymsgr:sendim?<?php echo $o['online_support']; ?>'><img src="http://opi.yahoo.com/online?u=<?php echo $o['online_support']; ?>&amp;m=g&amp;t=1" border="0" title="<?php echo $o['online_support']; ?>"></a>
<?php
	}
?>
</div>
<div class="cleaner_h5"></div>
</div>
</div>
<div id="footer-bawah">
<div id="isi-footer-bawah">
Copyright © 2012 Corruption Reporting and Collaboration System - A Hack Again Corruption
<div class="cleaner_h5"></div>
Corruption Reporting and Collaboration System. | <a href="#top">Back to top</a></div>
</div>
</div>
</body>
</html>
