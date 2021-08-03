<script>
document.addEventListener("DOMContentLoaded", function(event) {
    if(document.querySelector('.ct-chart-sales-value')) {
        <?php
            $prevSixDays = date('d M Y', strtotime("-6 days"));
            $prevFiveDays = date('d M Y', strtotime("-5 days"));
            $prevFourDays = date('d M Y', strtotime("-4 days"));
            $prevThreeDays = date('d M Y', strtotime("-3 days"));
            $prevTwoDays = date('d M Y', strtotime("-2 days"));
            $prevOneDays = date('d M Y', strtotime("-1 days"));
            $today = date('d M Y');
        ?>
          new Chartist.Line('.ct-chart-sales-value', {
            labels: ['<?php echo $prevSixDays; ?>', '<?php echo $prevFiveDays; ?>', '<?php echo $prevFourDays; ?>', '<?php echo $prevThreeDays; ?>', '<?php echo $prevTwoDays; ?>', 'Yesterday', 'Today'],
            series: [
                [<?php getNumberOfPatients($prevSixDays); ?>, <?php getNumberOfPatients($prevFiveDays); ?>, <?php getNumberOfPatients($prevFourDays); ?>, <?php getNumberOfPatients($prevThreeDays); ?>, <?php getNumberOfPatients($prevTwoDays); ?>, <?php getNumberOfPatients($prevOneDays); ?>, <?php getNumberOfPatients($today); ?>]
            ]
          }, {
            low: 0,
            showArea: true,
            fullWidth: true,
            plugins: [
              Chartist.plugins.tooltip()
            ],
            axisX: {
                // On the x-axis start means top and end means bottom
                position: 'end',
                showGrid: true
            },
            axisY: {
                // On the y-axis start means left and end means right
                showGrid: false,
                showLabel: false,
                labelInterpolationFnc: function(value) {
                    return '$' + (value / 1) + 'k';
                }
            }
        });
    }

});
</script>