const displayMap = (data) => {
  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create map instance
  var chart = am4core.create("currency-map", am4maps.MapChart);

  // Set map definition
  chart.geodata = am4geodata_worldLow;

  // Set projection
  chart.projection = new am4maps.projections.Miller();

  // Set lang
  chart.geodataNames = am4geodata_lang_RU;

  // Add zoom control
  chart.zoomControl = new am4maps.ZoomControl();

  // Series for World map
  var worldSeries = chart.series.push(new am4maps.MapPolygonSeries());
  worldSeries.exclude = ["AQ"];
  worldSeries.useGeodata = true;
  worldSeries.data = data;
  worldSeries.tooltip.getFillFromObject = false;
  worldSeries.tooltip.background.fill = am4core.color("#000000");

  var polygonTemplate = worldSeries.mapPolygons.template;
  polygonTemplate.tooltipHTML = `
    <strong>{name}</strong><hr>
    Текущий курс {currencyIso} к RUB: <strong>{currencyRate}</strong><br>
    <a href="#" style="color: white">Подробнее о валюте</a>
  `;

  // Set up tooltips
  worldSeries.calculateVisualCenter = true;
  polygonTemplate.tooltipPosition = "fixed";
  worldSeries.tooltip.label.interactionsEnabled = true;
  worldSeries.tooltip.keepTargetHover = true;

  // Set up legend
  var legend = new am4maps.Legend();
  legend.parent = chart.chartContainer;
  legend.background.fill = am4core.color("#000");
  legend.background.fillOpacity = 0.05;
  legend.width = 350;
  legend.align = "right";
  legend.padding(10, 15, 10, 15);
  legend.data = [{
    "name": "Страны с доступным курсом валют",
    "fill":"#9EAED8"
  }];
  legend.itemContainers.template.clickable = false;
  legend.itemContainers.template.focusable = false;

  polygonTemplate.adapter.add("fill", function(fill, target) {
    if (target.dataItem.dataContext && target.dataItem.dataContext.available) {
      return am4core.color("#9EAED8");
    }
    return fill;
  });

  polygonTemplate.adapter.add("interactionsEnabled", function(enable, target) {
    if (target.dataItem.dataContext && target.dataItem.dataContext.available) {
      return enable;
    }
    return false;
  });
};

const getMapData = () => {
  const data = JSON.parse(document.getElementById('map-data').dataset.mapData);

  return data.map(({ countryIso, currencyIso, currencyRate, currencyId }) => ({
      id: countryIso,
      currencyRate,
      currencyIso,
      currencyId,
      available: true
  }));
};
