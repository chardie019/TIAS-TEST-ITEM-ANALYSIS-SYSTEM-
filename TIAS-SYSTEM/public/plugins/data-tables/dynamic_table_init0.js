                function fnFormatDetails ( oTable, nTr )
{           
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>FULLNAME:</td><td>'+aData[2]+ '</td></tr>';
    sOut += '<tr><td>EXAMINATION TITLE:</td><td>'+aData[3]+ '</td></tr>';
    sOut += '<tr><td>EXAMINATION TERM:</td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td>EXAMINATION SUBJECT:</td><td>'+aData[8]+' </td></tr>';
     sOut += '<tr><td>TOTAL OF QUESTIONS IN THIS EXAM:</td><td>'+aData[6]+' QUESTIONS</td></tr>';
     sOut += '<tr><td>SUMMARY :</td><td>'+aData[2]+' got a score of '+aData[6]+'(CORRECT) / '+aData[7]+'(TOTAL) Which Is '+aData[5]+' </td></tr>';
   
    sOut += '</table>';

        
    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
    nCloneTd.className = "center";

    $('#hidden-table-info thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#hidden-table-info tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $('#hidden-table-info tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );
} );