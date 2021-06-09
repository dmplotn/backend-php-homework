const displayChart = (data) => {
  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create chart instance
  var chart = am4core.create("currency-chart", am4charts.XYChart);

  chart.language.locale = am4lang_ru_RU;

  chart.numberFormatter.numberFormat = "#.00";

  // Add data
  chart.data = data;

  // Create axes
  var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  dateAxis.renderer.minGridDistance = 50;

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

  // Create series
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = "currencyRate";
  series.dataFields.dateX = "date";
  series.strokeWidth = 2;
  series.minBulletDistance = 10;
  series.tooltipText = "{valueY}";
  series.tooltip.pointerOrientation = "vertical";
  series.tooltip.background.cornerRadius = 20;
  series.tooltip.background.fillOpacity = 0.5;
  series.tooltip.label.padding(12,12,12,12)

  // Add scrollbar
  chart.scrollbarX = new am4charts.XYChartScrollbar();
  chart.scrollbarX.series.push(series);

  // Add cursor
  chart.cursor = new am4charts.XYCursor();
  chart.cursor.xAxis = dateAxis;
  chart.cursor.snapToSeries = series;

  // Add range selector
  var selector = new am4plugins_rangeSelector.DateAxisRangeSelector();
  selector.container = document.getElementById("#currency-chart-range-selector");
  selector.axis = dateAxis;
  selector.inputDateFormat = "dd.MM.yyyy";
  selector.position = "right";
  selector.periods = [];
};

const getChartData = () => {
  const data = JSON.parse(document.getElementById('chart-data').dataset.chartData);

  return data.map(({ currencyRate, date }) => {
    const formatter = new Intl.NumberFormat('ru-RU', {
      minimumFractionDigits: 2, maximumFractionDigits: 2 
    });

    const formattedRate = formatter.format(currencyRate).replace(',', '.');

    return {
      currencyRate: formattedRate,
      date
    }
  });
}
