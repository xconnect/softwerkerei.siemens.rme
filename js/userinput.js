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
  var tabs = [], tabData = [], tableData = [], months = [], monthAcs = [], selTab;
  var projectId = $('#menu select option[selected]').val();
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
        beforeChange: function(change, source) {
          if(change !== null) {
            tableData[change[0][0]][change[0][1].split('.')[0]] = $.extend(true, {}, tableData[change[0][0]]['scope']);
          }
        },
        afterSelectionEnd: function(r, c, r2, c2) {
          if(r == r2 && c == c2 && tableData[r][colHeaders[c]] !== undefined && colHeaders[c] != 'Scope') {
            if($('#'+tab+'_cell').attr('data-row') !== "" &&
                $('#'+tab+'_cell').attr('data-cell') !== "") {
              var row = $('#'+tab+'_cell').attr('data-row');
              var col = $('#'+tab+'_cell').attr('data-cell');
              tableData[row][col]['wert_hohes_risiko'] = $('#'+tab+'_hr').val();
              tableData[row][col]['wert_mittleres_risiko'] = $('#'+tab+'_mr').val();
              tableData[row][col]['wert_kein_risiko'] = $('#'+tab+'_booked').val();
              tableData[row][col]['wert_potenzial'] = $('#'+tab+'_potential').val();
              tableData[row][col]['kommentar'] = $('#'+tab+'_comment').val();
              tableData[row][col]['wert_adjustment'] = $('#'+tab+'_adjustment').val();
            }
            $('#'+tab+'_hr').val(tableData[r][colHeaders[c]]['wert_hohes_risiko']);
            $('#'+tab+'_mr').val(tableData[r][colHeaders[c]]['wert_mittleres_risiko']);
            $('#'+tab+'_booked').val(tableData[r][colHeaders[c]]['wert_kein_risiko']);
            $('#'+tab+'_potential').val(tableData[r][colHeaders[c]]['wert_potenzial']);
            $('#'+tab+'_comment').val(tableData[r][colHeaders[c]]['kommentar']);
            $('#'+tab+'_adjustment').val(tableData[r][colHeaders[c]]['wert_adjustment']);
            $('#'+tab+'_cell').attr('data-row', r);
            $('#'+tab+'_cell').attr('data-cell', colHeaders[c]);
          } else if(r == r2 && c == c2 && colHeaders[c] != 'Scope') {
            tableData[r][colHeaders[c]] = $.extend(true, {}, tableData[r]['scope']);
            $('#'+tab+'_hr').val(tableData[r][colHeaders[c]]['wert_hohes_risiko']);
            $('#'+tab+'_mr').val(tableData[r][colHeaders[c]]['wert_mittleres_risiko']);
            $('#'+tab+'_booked').val(tableData[r][colHeaders[c]]['wert_kein_risiko']);
            $('#'+tab+'_potential').val(tableData[r][colHeaders[c]]['wert_potenzial']);
            $('#'+tab+'_comment').val(tableData[r][colHeaders[c]]['kommentar']);
            $('#'+tab+'_adjustment').val(tableData[r][colHeaders[c]]['wert_adjustment']);
            $('#'+tab+'_cell').attr('data-row', r);
            $('#'+tab+'_cell').attr('data-cell', colHeaders[c]);
          }
        }
      });
      window.setHeight();
    });
    submitHandler();
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
  $('li a[role=tab]').on('click', function() {
    var tab = this.attributes.href.value.split('#')[1];
    var projectId = $('#menu select option[selected]').val();
    setTimeout(function() {
      handleTabData(tab, projectId);
    }, 200);
  });
  $('#menu select option').on('click', function() {
    var projectId = $(this).val();
    window.location = window.location + '?projectId=' + projectId;
  });
  function submitHandler() {
    $('#'+selTab+'_submit').on('click', function() {
      if($('#'+selTab+'_cell').attr('data-row') !== "" &&
          $('#'+selTab+'_cell').attr('data-cell') !== "") {
        var row = $('#'+selTab+'_cell').attr('data-row');
        var col = $('#'+selTab+'_cell').attr('data-cell');
        tableData[row][col]['wert_hohes_risiko'] = $('#'+selTab+'_hr').val();
        tableData[row][col]['wert_mittleres_risiko'] = $('#'+selTab+'_mr').val();
        tableData[row][col]['wert_kein_risiko'] = $('#'+selTab+'_booked').val();
        tableData[row][col]['wert_potenzial'] = $('#'+selTab+'_potential').val();
        tableData[row][col]['kommentar'] = $('#'+selTab+'_comment').val();
        tableData[row][col]['wert_adjustment'] = $('#'+selTab+'_adjustment').val();
      }
      var values = [], cell = [];
      for(var i = 0, row; row = tableData[i]; i++) {
        for(var col in row) {
          if(col !== 'scope') {
            cell = {
              id: row[col]['id'],
              subkennzahl_id: row[col]['subkennzahl_id'],
              wert_gebucht: row[col]['wert_gebucht'], 
              wert_kein_risiko: row[col]['wert_kein_risiko'],
              wert_mittleres_risiko: row[col]['wert_mittleres_risiko'],
              wert_hohes_risiko: row[col]['wert_hohes_risiko'],
              wert_potenzial: row[col]['wert_potenzial'],
              kommentar: row[col]['kommentar'],
              zeitstempel: row[col]['zeitstempel'],
              benutzer_id: row['scope']['benutzer_id'],
              jahr_id: row['scope']['jahr_id'],
              projekt_id: row['scope']['projekt_id'],
              monat_id: monthAcs[col],
              wert_adjustment: row[col]['wert_adjustment'],
              stichtag_id: row['scope']['stichtag_id'],
              quelle_id: row['scope']['quelle_id'],
              serviceline_id: row['scope']['serviceline_id'],
              status_id: row['scope']['status_id'],
              vertragshalter_id: row['scope']['vertragshalter_id'],
              vertragsbestandteil_id: row['scope']['vertragsbestandteil_id']
            }
            if(values[i] === undefined) values[i] = [];
            values[i].push(cell);
          }
        }
      }
      result = $.ajax({
        type: 'POST',
        url: 'includes/db/userview.php',
        data: {values: values, type: 'saveDataForTab'}
      }).done(function(data) {
        console.log(data);
      });
    });
  };
})
