$(function() {
  function getDataForTab(number, projectId) {
    var result = [];
    result = $.ajax({
      type: 'POST',
      url: 'includes/db/userview.php',
      data: {number: number, projectId: projectId, type: 'getDataForNumber'}
    });
    return result;
  };
  function getTabs(projectId) {
    var result = [];
    result = $.ajax({
      type: 'POST',
      url: 'includes/db/userview.php',
      data: {projectId: projectId, type: 'getTabsForProject'}
    });
    return result;
  };
  function getMonths() {
    var result = [];
    result = $.ajax({
      type: 'POST',
      url: 'includes/db/userview.php',
      data: {type: 'getAllMonths'}
    });
    return result;
  };
  var tabs = [], tabData = [], tableData = [], months = [], monthAcs = [], selTab, charts = [];
  var projectId = 10;
  getMonths().done(function(data) {
    months = JSON.parse(data);
    for(var i = 0, month; month = months[i]; i++) {
      monthAcs[month.akronym] = month.id;
    }
  });
  function handleTabs(projectId) {
    getTabs(projectId).done(function(data) {
      tabs = JSON.parse(data);
      handleTabData(tabs[0]['akronym'], projectId);
    });
  };
  handleTabs(projectId);
  function getColWidths(element) {
    var width = $(element).width();
    var cols = [];
    for(var i = 13; i-- > 0;) {
      if(i == 0) {
        cols[i] = width - 12 * cols[1] - 2;
      } else {
        cols[i] = Math.floor(width/10*9/12);
      }
    }
    return cols;
  };
  var rowRenderer = function rowRendering(instance, td, row, col, prop, value, cellProperties) {
    Handsontable.renderers.TextRenderer.apply(this, arguments);
    td.style.backgroundColor = '#eee';
  }
  function handleTabData(tab, projectId) {
    selTab = tab;
    getDataForTab(tab,projectId).done(function(data) {
      tabData = JSON.parse(data);
      while(months.length == 0) {
        
      }
      tableData = getTableData(tabData, months);
      rowCount = tableData.length;
      colHeaders = getColHeaders(months);
      var $container = $("#"+tab+"_Table");
      $container.handsontable({
        data: tableData,
        dataSchema: {
          scope: {subkennzahl_id: null, subkennzahl_akronym: null},
          Okt: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Nov: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Dez: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Jan: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Feb: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Mär: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Apr: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Mai: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Jun: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Jul: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Aug: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null},
          Sep: {wert_gebucht: null, wert_kein_risiko: null, wert_mittleres_risiko: null, wert_hohes_risiko: null, wert_potenzial: null, wert_adjustment: null,kommentar: null, zeitstempel: null}
        },
        fillHandle: false,
        minRows: rowCount,
        maxRows: rowCount,
        minCols: 13,
        maxCols: 13,
        cells: function(row, col, prop) {
          if(row % 2 == 1) {
            this.renderer = rowRenderer;
          }
        },
        colWidths: getColWidths(document.getElementById(tab+'_Table')),
        rowHeaders: false,
        colHeaders: colHeaders,
        columns: [
          {data: 'scope.subkennzahl_akronym'},
          {data: 'Okt.wert_gebucht'},
          {data: 'Nov.wert_gebucht'},
          {data: 'Dez.wert_gebucht'},
          {data: 'Jan.wert_gebucht'},
          {data: 'Feb.wert_gebucht'},
          {data: 'Mär.wert_gebucht'},
          {data: 'Apr.wert_gebucht'},
          {data: 'Mai.wert_gebucht'},
          {data: 'Jun.wert_gebucht'},
          {data: 'Jul.wert_gebucht'},
          {data: 'Aug.wert_gebucht'},
          {data: 'Sep.wert_gebucht'}
        ],
        minSpareRows: 0,
        contextMenu: true,
        autoColumnSize: true,
        afterChange: function(change, source) {
          updateCharts();
        }
      });
      initCharts();
      window.setHeight();
    });
  };
  function getTableData(data, months) {
    var resultArray = [], rows = [];
    for(var i = 0, row; row = data['data'][i]; i++) {
      row = row['datensatz'];
      if(rows[row['subkennzahl_id']] === undefined) {
        rows[row['subkennzahl_id']] = [];
        rows[row['subkennzahl_id']]['scope'] = {
          subkennzahl_akronym: row['subkennzahl_akronym'],
          subkennzahl_id: row['subkennzahl_id'],
          wert_gebucht: 0.00,
          wert_kein_risiko: 0.00,
          wert_mittleres_risiko: 0.00,
          wert_hohes_risiko: 0.00,
          wert_potenzial: 0.00,
          wert_adjustment: 0.00,
          kommentar: null,
          zeitstempel: null,
          id: null,
          stichtag_id: row['stichtag_id'],
          projekt_id: row['projekt_id'],
          benutzer_id: row['benutzer_id'],
          jahr_id: row['jahr_id'],
          quelle_id: row['quelle_id'],
          serviceline_id: row['serviceline_id'],
          status_id: row['status_id'],
          vertragshalter_id: row['vertragshalter_id'],
          vertragsbestandteil_id: row['vertragsbestandteil_id']
        }
      }
      var dataObject = {
        id: row['id'],
        subkennzahl_akronym: row['subkennzahl_akronym'],
        subkennzahl_id: row['subkennzahl_id'],
        wert_gebucht: row['wert_gebucht'], 
        wert_kein_risiko: row['wert_kein_risiko'],
        wert_mittleres_risiko: row['wert_mittleres_risiko'],
        wert_hohes_risiko: row['wert_hohes_risiko'],
        wert_potenzial: row['wert_potenzial'],
        kommentar: row['kommentar'],
        wert_adjustment: row['wert_adjustment'],
        zeitstempel: row['zeitstempel']
      };
      rows[row['subkennzahl_id']][months[row['monat_id'] - 1].akronym] = dataObject;
    }
    var i = 0;
    for(var row in rows) {
      resultArray[i++] = rows[row];
    }
    return resultArray;
  };
  function getColHeaders(months) {
    var result = [];
    result[0] = 'Scope';
    for(var i = 0, month; month = months[i]; i++) {
      result[i + 1] = month['akronym'];
    }
    return result;
  };
  function initCharts() {
    var table = $('#GM_Table').handsontable('getInstance');
    $('#chart_1').highcharts({
      data: {
        firstRowAsNames: true,
        switchRowsAndColumns: true,
        table: table.table
      },
      chart: {
        type: 'line',
        events: {
          redraw: function() {
            var label = this.renderer.label('The chart was just redrawn', 100, 120).attr({fill:Highcharts.getOptions().colors[0],padding: 10, r: 5, zIndex: 8}).css({color: '#FFFFFF'}).add();
            setTimeout(function() {
              label.fadeOut();
            }, 1000);
          }
        }
      }
    });
    $('#chart_2').highcharts({
      data: {
        firstRowAsNames: true,
        switchRowsAndColumns: true,
        table: table.table
      },
      chart: {
        type: 'bar'
      }
    });
    $('#chart_3').highcharts({
      data: {
        firstRowAsNames: true,
        switchRowsAndColumns: true,
        table: table.table
      },
      chart: {
        type: 'pie',
        options3d: {
          enabled: true,
          alpha: 45,
          beta: 0
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          depth: 35,
          dataLabels: {
            enabled: true
          }
        }
      }
    });
    $('#chart_4').highcharts({
      data: {
        firstRowAsNames: true,
        switchRowsAndColumns: true,
        table: table.table
      },
      chart: {
        type: 'area'
      }
    });
  };
  function updateCharts() {
    $('.charts').empty();
    initCharts();
  }
});
