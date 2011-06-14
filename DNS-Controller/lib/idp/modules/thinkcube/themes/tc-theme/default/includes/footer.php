<?php



if(!empty($this->data['htmlinject']['htmlContentPost'])) {
	foreach($this->data['htmlinject']['htmlContentPost'] AS $c) {
		echo $c;
	}
}


?>



		<hr />
		<div >
		<!-- <img src="/<?php echo $this->data['baseurlpath']; ?>resources/icons/ssplogo-fish-small.png" alt="Small fish logo" style="float: right" /> -->		
		@ <?php echo date("Y"); ?> Thinkcube System (Pvt) Ltd.Powered by  <a href="http://rnd.feide.no/">Feide RnD</a>
		</div>
		<br style="clear: right" />
		
	</div><!-- #content -->

</div><!-- #wrap -->

</body>
</html>
