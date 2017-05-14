<?php 
// No direct access
defined('_JEXEC') or die; ?>

<?php if (isset($ticker)):  ?>
	<div class="mod-stocks <?php echo $params['layout'] == 'wide' ? 'mod-stocks--wide' : ''; ?>">
		<?php if ($params['layout'] == 'wide'): ?>
			<span class="mod-stocks__title"><?php echo JText::_('NASDAQ: ') ?></span>

			<?php if (isset($ticker->symbol)): ?>
				<span class="mod-stocks__title"><?php echo $ticker->symbol; ?></span>
			<?php  endif; ?>

			<?php if (isset($ticker->price)): ?>
				<span class="mod-stocks__value"><?php echo $ticker->price; ?></span>
			<?php  endif; ?>

			<?php if (isset($ticker->change)): ?>
				<span class="mod-stocks__value"><?php echo $ticker->change; ?></span>
			<?php  endif; ?>

			<?php if (isset($ticker->chg_percent)): ?>
				<span class="mod-stocks__title"><?php echo $ticker->chg_percent; ?></span>
			<?php  endif; ?>

		<?php else: ?>
			<p class="mod-stocks__title"><?php echo JText::_('Exchange: NASDAQ'); ?></p>

			<?php if (isset($ticker->price)): ?>
				<p><span class="mod-stocks__term"><?php echo JText::_('Price'); ?></span>: <span class="mod-stocks__value"><?php echo $ticker->price; ?></span></p>
			<?php  endif; ?>

			<?php if (isset($ticker->change) && isset($ticker->chg_percent)): ?>
				<p><span class="mod-stocks__term"><?php echo JText::_('Change'); ?></span>: <span class="mod-stocks__value"><?php echo $ticker->change .' '. $ticker->chg_percent; ?></span></p>
			<?php  endif; ?>

			<?php if (isset($ticker->volume)): ?>
				<p><span class="mod-stocks__term"><?php echo JText::_('Volume'); ?></span>: <span class="mod-stocks__value"><?php echo $ticker->volume; ?></span></p>
			<?php  endif; ?>

			<?php if (isset($ticker->utctime)): ?>
				<p class="mod-stocks__time"><?php echo $ticker->utctime ?></p>
			<?php  endif; ?>

			<p class="mod-stocks__disclaimer"><em><?php echo JText::_('Quote delayed by at least 15 minutes'); ?></em></p>
		<?php endif; ?>
	</div>
<?php endif; ?>