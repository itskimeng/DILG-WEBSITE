<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>
<div class="blog-featured<?php echo $this->pageclass_sfx;?>">
<?php if ($this->params->get('show_page_heading') != 0) : ?>
<div class="page-header">
  <h1>
  <?php echo $this->escape($this->params->get('page_heading')); ?>
  </h1>
</div>
<?php endif; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
<article class="panel">
<div class="items-leading">
  <?php foreach ($this->lead_items as &$item) : ?>
    <div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
      <div class="page-header">
      <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
      ?>
    </div>
    </div>
    <div class="clearfix"></div>
    <?php
      $leadingcount++;
    ?>
  <?php endforeach; ?>
</div>
</article>
<div class="clearfix"></div>
<?php endif; ?>
<?php
  $introcount = (count($this->intro_items));
  $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
  <?php foreach ($this->intro_items as $key => &$item) : ?>

    <?php
    $key = ($key - $leadingcount) + 1;
    $rowcount = (((int) $key - 1) % (int) $this->columns) + 1;
    $row = $counter / $this->columns;

    if ($rowcount == 1) : ?>

    <div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row; ?> row-fluid">
    <?php endif; ?>
      <article class="panel">
      <div class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?> span<?php echo round((12 / $this->columns));?>">
        <div class="page-header">
      <?php
          $this->item = &$item;
          echo $this->loadTemplate('item');
      ?>
        </div>
      </div>
      </article>
      <?php $counter++; ?>

      <?php if (($rowcount == $this->columns) or ($counter == $introcount)) : ?>

    </div>
    <?php endif; ?>

  <?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
  <div class="items-more">
  <?php echo $this->loadTemplate('links'); ?>
  </div>
<?php endif; ?>

<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) : ?>
  <div class="pagination">

    <?php if ($this->params->def('show_pagination_results', 1)) : ?>
      <p class="counter pull-right">
        <?php echo $this->pagination->getPagesCounter(); ?>
      </p>
    <?php  endif; ?>
        <?php echo $this->pagination->getPagesLinks(); ?>
  </div>
<?php endif; ?>
  
  <div class="items-row cols-3 row-0 row-fluid">
    <!-- custom panel -->
    <!-- start invitation to bid -->
    <div class="d-flex flex-row" style="background-color:#f7a975; margin-bottom:-2%;">
      <div class="form-group" style="background-color: #e96c13;padding: 1%; height: 30px; color:white">
        <b><i class="fa fa-sticky-note-o" aria-hidden="true"></i> INVITATION TO BID</b>
          <a class="btn btn-default pull-right" href="index.php?option=com_content&view=category&id=26" style="color:white;">More</a>
      </div>
      <ul class="custom-ul list-group" style="color:black">
        <li>
          <a href="/bid-opportunities/1672-ib-2021-001-improvement-of-dilg-batangas-provincia" style="color:black;">IB-2021-001 : Improvement of DILG Batangas Provincial Office</a>
        </li>
        <li>
          <a href="/bid-opportunities/1570-rfq-2020-362-improvement-of-rtf-elcac-operations-center" style="color:black;">RFQ 2020-362 Improvement of RTF-ELCAC Operations Center</a>
        </li>
        <li>
          <a href="/bid-opportunities/1555-rfq-2020-348-supply-of-drinking-water-to-be-used-in-the-regional-office" style="color:black;">RFQ 2020-348 Supply of Drinking Water to be used in the Regional Office</a>
        </li>
        <li>
          <a href="/bid-opportunities/1557-rfq-2020-343-provision-of-janitorial-service-in-regional-office-for-one-1-year-january-1-to-december-31-2021" style="color:black;">RFQ 2020-343 Provision of Janitorial Service in Regional Office for One (1) Year (January 1 to December ...</a>
        </li>
        <li>
          <a href="/bid-opportunities/1558-rfq-2020-344-provision-of-security-services-in-regional-office-for-one-1-year-january-1-to-december-31-2021-2" style="color:black;">RFQ 2020-344 Provision of Security Services in Regional Office for One (1) Year (January 1 to December ...</a>
        </li>
      </ul>
    </div>
    <!-- end invitation to bid -->
    <br>
    <!-- start notice of award -->
    <div class="d-flex flex-row" style="background-color:#e5f8b0; margin-bottom:-2%;">
      <div class="form-group" style="background-color: #8aaa32;padding: 1%; height: 30px; color:white">
        <b><i class="fa fa-trophy" aria-hidden="true"></i> NOTICE OF AWARD</b>
          <a class="btn btn-default pull-right" href="index.php?option=com_content&view=category&id=26" style="color:white;">More</a>
      </div>
      <ul class="custom-ul list-group" style="color:black">
        <li>
          <a href="/bid-opportunities/notice-of-award/1662-notice-to-proceed-of-cover-and-pages-corporation-for-the-re-bidding-printing-of-doh-endorsed-covid-19-iec-materials-for-distribution-to-lgus" style="color:black;">Notice to Proceed of Cover and Pages Corporation for the Re-Bidding-Printing of DOH- Endorsed COVID-...</a>
        </li>
        <li>
          <a href="/bid-opportunities/notice-of-award/1664-notice-of-award-of-cover-and-pages-corporation-for-the-re-bidding-printing-of-doh-endorsed-covid-19-iec-materials-for-distribution-to-lgus" style="color:black;">Notice of Award of Cover and Pages Corporation for the Re-Bidding-Printing of DOH- Endorsed COVID-19...</a>
        </li>
        <li>
          <a href="/bid-opportunities/notice-of-award/1625-notice-to-proceed-of-mcj-valenzuela-construction-enterprises-for-the-improvement-of-rtf-elcac-operations-center-carpenter-mason-tile-setter-painter-and-plumber" style="color:black;">Notice to Proceed of MCJ Valenzuela Construction Enterprises for the Improvement of RTF-ELCAC Opera...</a>
        </li>
        <li>
          <a href="/bid-opportunities/notice-of-award/1627-notice-to-proceed-of-asr-computer-trading-and-services-for-the-repair-of-defective-ict-equipment-in-the-provincial-offices" style="color:black;">Notice to proceed of ASR Computer Trading and Services for the repair of defective ICT equipment in the ...</a>
        </li>
        <li>
          <a href="/bid-opportunities/notice-of-award/1629-notice-to-proceed-of-emilio-jose-office-supplies-trading-for-the-repair-and-maintenance-of-ict-equipment-calabarzon" style="color:black;">Notice to proceed of Emilio Jose Office Supplies Trading for the repair and maintenance of ICT equipment...</a>
        </li>
      </ul>
    </div>
    <!-- end notice of award -->
    <br>
    <!-- start career -->
    <div class="d-flex flex-row" style="background-color:#AFDBE3; margin-bottom:-2%;">
      <div class="form-group" style="background-color: #107d84;padding: 1%; height: 30px; color:white">
        <b><i class="fa fa-briefcase" aria-hidden="true"></i> CAREERS</b>
          <a class="btn btn-default pull-right" href="index.php?option=com_content&view=category&id=27" style="color:white;">More</a>
      </div>
      <ul class="custom-ul list-group" style="color:black">
        <li>
          <a href="/careers/1669-notice-of-vacancy-ao-iv-assistant-budget-officer-and-ao-iv-assistant-hrmo-2" style="color:black;">Notice of Vacancy: LGOO VII and LGOO VI (2)</a>
        </li>
        <li>
          <a href="/careers/1617-notice-of-vacancy-lgoo-vii-1-and-lgoo-vi-3" style="color:black;">Notice of Vacancy: LGOO VII (1) and LGOO VI (3)</a>
        </li>
        <li>
          <a href="/careers/1554-notice-of-vacancy-ao-iv-assistant-budget-officer-and-ao-iv-assistant-hrmo" style="color:black;">Notice of Vacancy: AO IV (Assistant Budget Officer), AO IV (Assistant HRMO) and ADA IV</a>
        </li>
        <li>
          <a href="/careers/1553-notice-of-vacancy-acct-iii-and-lgoo-ii" style="color:black;">Notice of Vacancy: ACCT III and LGOO II</a>
        </li>
        <li>
          <a href="/careers/1439-notice-of-vacancy-lgoo-ii-ao-v-budget-officer-ada-iv-2" style="color:black;">Notice of Vacancy: LGOO VI(3), LGOO V(4), LGOO III (3), LGOO II (2), ADA IV(2)</a>
        </li>
      </ul>
    </div>
    <!-- end career --> 
  </div>  
  
  
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style type="text/css">
  .custom-ul {
    list-style: none;
    padding: 0;
  }
  .custom-ul > li {
    padding-left: 1.3em;
  }
  .custom-ul > li:before {
    content: "\f00c"; /* FontAwesome Unicode */
    font-family: FontAwesome;
    display: inline-block;
    margin-left: -1.3em; /* same as padding-left set on li */
    width: 1.3em; /* same as padding-left set on li */
  }
  .custom-ul > li:hover {
    text-decoration: underline;
  }
</style>


