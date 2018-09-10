<?php
include_once( 'includes/status_messages.php' );


/**
 * Generate html output for tab with vnstat traffic amount information.
 */
function DisplayVnstat(&$extraFooterScripts)
{
?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-primary">
        <div class="panel-heading"><i class="fa fa-bar-chart fa-fw"></i> <?php echo _("Bandwidth monitoring"); ?></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <ul id="tabbarBandwidth" class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#daily" aria-controls="daily" role="tab" data-toggle="tab"><?php echo _("Daily"); ?></a></li>
                      <li role="presentation" class=""><a href="#monthly" aria-controls="monthly" role="tab" data-toggle="tab"><?php echo _("Monthly"); ?></a></li>
                    </ul>
                    <div id="tabsBandwidth" class="tabcontenttraffic tab-content">
                      <div role="tabpanel" class="tab-pane active fade in" id="daily">
                        <div class="row">
                          <div class="col-lg-12">
                            <h4><?php echo _('Daily traffic amount'); ?></h4>
                            <label for="cbxInterfacedaily"><?php echo _('interface'); ?></label> <select id="cbxInterfacedaily" class="form-control" name="interface">
<?php
exec("ip -o link show | awk -F ': ' '{print $2}' | grep -v lo ", $interfacesWlo);
foreach ($interfacesWlo as $interface) {
    echo '                              <option value="' , htmlentities($interface, ENT_QUOTES) , '">' ,
            htmlentities($interface, ENT_QUOTES) , '</option>' , PHP_EOL;
}

?>
                            </select>
                            <div class="hidden alert alert-info" id="divLoaderBandwidthdaily">
                            <?php echo sprintf(_("Loading %s bandwidth chart"), _('daily')); ?>
                            </div>
                            <div id="divChartBandwidthdaily"></div>
                            <div id="divTableBandwidthdaily"></div>
                          </div>
                        </div>
                      </div><!-- /.tab-pane -->
                      <div role="tabpanel" class="tab-pane fade" id="monthly">
                        <div class="row">
                          <div class="col-lg-12">
                            <h4><?php echo _("Monthly traffic amount"); ?></h4>
                            <label for="cbxInterfacemonthly"><?php echo _('interface'); ?></label> <select id="cbxInterfacemonthly" class="form-control" name="interface">
<?php
foreach ($interfacesWlo as $interface) {
    echo '                            <option value="' , htmlentities($interface, ENT_QUOTES) , '">' ,
            htmlentities($interface, ENT_QUOTES) , '</option>' , PHP_EOL;
}

?>
                            </select>
                            <div class="hidden alert alert-info" id="divLoaderBandwidthmonthly">
                            <?php echo sprintf(_("Loading %s bandwidth chart"), _('monthly')); ?>
                            </div>
                            <div id="divChartBandwidthmonthly"></div>
                            <div id="divTableBandwidthmonthly"></div>
                          </div>
                        </div>
                      </div><!-- /.tab-pane -->
                    </div><!-- /.tabsBandwidth -->
                  </div><!-- /.panel-default -->
                </div><!-- /.col-md-6 -->
              </div><!-- /.row -->
           </div><!-- /.panel-body -->
         </div><!-- /.panel-primary -->
       <div class="panel-footer"><?php echo _("Information provided by vnstat"); ?></div>
      </div><!-- /.panel-primary -->
    </div><!-- /.col-lg-12 -->
  </div><!-- /.row -->
<?php
    $extraFooterScripts[] = array('src'=>'vendor/raphael/raphael.min.js',
                                  'defer'=>false);
    $extraFooterScripts[] = array('src'=>'vendor/morrisjs/morris.min.js', 'defer'=>false);
    $extraFooterScripts[] = array('src'=>'vendor/datatables/js/jquery.dataTables.min.js', 'defer'=>false);
    $extraFooterScripts[] = array('src'=>'js/bandwidthcharts.js', 'defer'=>false);
}

