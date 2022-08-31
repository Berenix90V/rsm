// Call the dataTables jQuery plugin

$(document).ready(function() {
    $('#dataTable').DataTable();
    $.fn.dataTable.ext.order['dom-class'] = function(settings, col)
{
    return this.api().column(col, {order:'index'}).nodes().map(function(td, span)
    {
        return $('span', td).hasClass('toconfirm') ? 1 : 0;
    });
}
    //console.log('ciao');
 });
  

