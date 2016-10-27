$(function () {

    function fnFormatDetails(oTable, nTr) {
        var aData = oTable.fnGetData(nTr);
        var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
        sOut += '<tr><td>Last Checkout:</td><td>' + aData[5] + '</td></tr>';
        sOut += '<tr><td>IMEI:</td><td>' + aData[6] + '</td></tr>';
        sOut += '<tr><td>Resolution:</td><td>' + aData[7] + '</td></tr>';
        sOut += '<tr><td>Vendor:</td><td>' + aData[8] + '</td></tr>';
        sOut += '<tr><td>Priority:</td><td>' + aData[9] + '</td></tr>';
        sOut += '<tr><td>OS Type:</td><td>' + aData[10] + '</td></tr>';
        sOut += '</table>';
        return sOut;
    }

    /*  Insert a 'details' column to the table  */
    var nCloneTh = document.createElement('th');
    var nCloneTd = document.createElement('td');
    nCloneTd.innerHTML = '<i class="fa fa-plus-square-o"></i>';
    nCloneTd.className = "center";

    $('#table2 thead tr').each(function () {
        this.insertBefore(nCloneTh, this.childNodes[0]);
    });

    $('#table2 tbody tr').each(function () {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
    });

    /*  Initialse DataTables, with no sorting on the 'details' column  */
    var oTable = $('#table2').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        "aaSorting": [
            [2, 'asc']
        ]
    });

    /*  Add event listener for opening and closing details  */
    $(document).on('click', '#table2 tbody td i', function () {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
            /* This row is already open - close it */
            $(this).removeClass().addClass('fa fa-plus-square-o');
            oTable.fnClose(nTr);
        } else {
            /* Open this row */
            $(this).removeClass().addClass('fa fa-minus-square-o');
            oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
    });

});