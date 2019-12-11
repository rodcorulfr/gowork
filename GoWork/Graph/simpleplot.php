<?php
# PHPlot Example: Pie/text-data-single
require_once 'phplot.php';

# The data labels aren't used directly by PHPlot. They are here for our
# reference, and we copy them to the legend below.
$data = array(
  array('Australia', 7849),
  array('Dem Rep Congo', 299),
  array('Canada', 5447),
);

$plot = new PHPlot(900,700);
$plot->SetImageBorderType('solid');

$plot->SetPlotType('pie');
$plot->SetDataType('text-data-single');
$plot->SetDataValues($data);

# Set enough different colors;
$plot->SetDataColors(array('red', 'green', 'blue'));

# Main plot title:
$plot->SetTitle("World Gold Production, 1990\n(1000s of Troy Ounces)");

# Build a legend from our data array.
# Each call to SetLegend makes one line as "label: value".
foreach ($data as $row)
  $plot->SetLegend(implode(': ', $row));
# Place the legend in the upper left corner:
$plot->SetLegendPixels(5, 5);

$plot->DrawGraph();