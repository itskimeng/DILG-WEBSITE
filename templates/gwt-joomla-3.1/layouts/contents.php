<!-- contents -->
<div id="main"><a name="maincontents"></a>
	<div class="row">
		
		<?php if ($this->params->get('sidebarPosition') == 3): ?>
			
			<?php include JPATH_THEMES . '/' . $this->template .'/layouts/content-modules.php'; ?>
			<?php
			$sidebar_left_class = '';
			$content_class = '';
			$sidebar_right_class = '';
			if(($this->countModules('left-sidebar') || $this->params->get('pstPosition') == 1) && ($this->countModules('right-sidebar') || $this->params->get('pstPosition') == 2)){
				$sidebar_left_class = 'large-3 medium-3 columns';
				$content_class = 'large-6 medium-6 columns';
				$sidebar_right_class = 'large-3 medium-3 columns';
			}
			elseif((!$this->countModules('left-sidebar') || $this->params->get('pstPosition') != 1) && ($this->countModules('right-sidebar') || $this->params->get('pstPosition') == 2)){
//				$sidebar_left_class = 'large-3 medium-3 columns';
				$content_class = 'large-8 medium-8 columns';
				$sidebar_right_class = 'large-4 medium-4 columns';
			}
			elseif(($this->countModules('left-sidebar') || $this->params->get('pstPosition') == 1) && (!$this->countModules('right-sidebar') || $this->params->get('pstPosition') != 2)){
				$sidebar_left_class = 'large-4 medium-4 columns';
				$content_class = 'large-8 medium-8 columns';
//				$sidebar_right_class = 'large-4 medium-4 columns';
			}
			else{
				$content_class = 'large-12 medium-12 columns';
			}
			?>
			<?php if($this->countModules('left-sidebar') || $this->params->get('pstPosition') == 1): ?>
			<div class="<?php echo $sidebar_left_class; ?>">
				<?php if($this->params->get('pstPosition') == 1): ?>
				<ul class="breadcrumbs time">
					<p class="pst">PHILIPPINE STANDARD TIME</p>
					<iframe src="http://oras.pagasa.dost.gov.ph/time_display/time/" frameborder="0" height="20" width="175" allowTransparency="true" scrolling="no"></iframe>
				</ul>
				<?php endif; ?>
				<jdoc:include type="modules" name="left-sidebar" style="xhtml" />
			</div>
			<?php endif; ?>
			
			<div id="content" class="<?php echo $content_class; ?>">
				<div class="post-box">
		            <jdoc:include type="message" style="xhtml" />
		            <jdoc:include type="component" style="xhtml" />
		            <div style="clear: both;"></div>
				</div>
			</div>

			<?php if($this->countModules('right-sidebar') || $this->params->get('pstPosition') == 2): ?>
			<div class="<?php echo $sidebar_right_class; ?>">
				<?php if($this->params->get('pstPosition') == 2): ?>
				<ul class="breadcrumbs time">
					<p class="pst">PHILIPPINE STANDARD TIME</p>
					<iframe src="http://oras.pagasa.dost.gov.ph/time_display/time/" frameborder="0" height="20" width="175" allowTransparency="true" scrolling="no"></iframe>
				</ul>
				<?php endif; ?>
				<jdoc:include type="modules" name="right-sidebar" style="xhtml" />
			</div>
			<?php endif; ?>
			<?php /*
			<div class="large-3 medium-3 columns">
				<ul class="breadcrumbs time">
					<p class="pst">PHILIPPINE STANDARD TIME</p>
					<iframe src="http://oras.pagasa.dost.gov.ph/time_display/time/" frameborder="0" height="20" width="175" allowTransparency="true" scrolling="no"></iframe>
				</ul>
				<jdoc:include type="modules" name="right-sidebar" style="xhtml" />
			</div>
			*/
			?>
			
			<?php include JPATH_THEMES . '/' . $this->template .'/layouts/content-modules-bott.php'; ?>
		
		<?php elseif ($this->params->get('sidebarPosition') == 2): ?>
			
			<?php include JPATH_THEMES . '/' . $this->template .'/layouts/content-modules.php'; ?>
			
			<div id="content" class="large-12 columns">
				<div class="post-box">
		            <jdoc:include type="message" style="xhtml" />
		            <jdoc:include type="component" style="xhtml" />
		            <div style="clear: both;"></div>
				</div>
			</div>
			
			<?php include JPATH_THEMES . '/' . $this->template .'/layouts/content-modules-bott.php'; ?>
			
		<?php elseif ($this->params->get('sidebarPosition') == 1): ?>
			
			<?php include JPATH_THEMES . '/' . $this->template .'/layouts/content-modules.php'; ?>
			
			<?php
			$content_class = '';
			$sidebar_right_class = '';
			if($this->countModules('right-sidebar') || $this->params->get('pstPosition') == 2){
//				$sidebar_left_class = 'large-3 medium-3 columns';
				$content_class = 'large-8 medium-8 columns';
				$sidebar_right_class = 'large-4 medium-4 columns';
			}
			else{
				$content_class = 'large-12 medium-12 columns';
			}
			?>

			<div>
			
			<div id="content" class="<?php echo $content_class; ?>">
				<div class="post-box">
		            <jdoc:include type="message" style="xhtml" />
		            <jdoc:include type="component" style="xhtml" />
		            <div style="clear: both;"></div>
				</div>
			</div>
			
			<div class="<?php echo $sidebar_right_class ?>">
				<?php if($this->params->get('pstPosition') != 0): ?>
				<ul class="breadcrumbs time">
					<p class="pst">PHILIPPINE STANDARD TIME</p>
					<iframe src="http://oras.pagasa.dost.gov.ph/time_display/time/" frameborder="0" height="20" width="175" allowTransparency="true" scrolling="no"></iframe>
				</ul>
				<?php endif; ?>
				<jdoc:include type="modules" name="right-sidebar" style="xhtml" />
			</div>
			
			</div>
			
			<?php include JPATH_THEMES . '/' . $this->template .'/layouts/content-modules-bott.php'; ?>
			
		<?php else: ?>
			
			<?php include JPATH_THEMES . '/' . $this->template .'/layouts/content-modules.php'; ?>
			
			<?php
			$content_class = '';
			$sidebar_left_class = '';
			if($this->countModules('left-sidebar') || $this->params->get('pstPosition') == 1){
				$sidebar_left_class = 'large-4 medium-4 columns';
				$content_class = 'large-8 medium-8 columns';
				// $sidebar_right_class = 'large-4 medium-4 columns';
			}
			else{
				$content_class = 'large-12 medium-12 columns';
			}
			?>

			<div class="<?php echo $sidebar_left_class ?>">
				<?php if($this->params->get('pstPosition') != 0): ?>
				<ul class="breadcrumbs time">
					<p class="pst">PHILIPPINE STANDARD TIME</p>
					<iframe src="http://oras.pagasa.dost.gov.ph/time_display/time/" frameborder="0" height="20" width="175" allowTransparency="true" scrolling="no"></iframe>
				</ul>
				<?php endif; ?>
				<jdoc:include type="modules" name="left-sidebar" style="xhtml" />
			</div>
			
			<div id="content" class="<?php echo $content_class; ?>">
				<div class="post-box">
		            <jdoc:include type="message" style="xhtml" />
		            <jdoc:include type="component" style="xhtml" />
				</div>
			</div>
			
			<?php include JPATH_THEMES . '/' . $this->template .'/layouts/content-modules-bott.php'; ?>
		
		<?php endif?>
		
	</div>
</div>
		
		

		
		
		
		
<!-- end contents -->
