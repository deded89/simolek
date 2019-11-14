<!DOCTYPE html>
<html>
  <head>
    <title>Overlay</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.dataTables.min.css">

  <style media="screen">
  th, td { white-space: nowrap; }
  div.dataTables_wrapper {
      width: 800px;
      margin: 0 auto;
  }
  </style>

  </head>
  <body>
    <table id="example" class="stripe row-border order-column" style="width:100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger</td>
                <td>Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
            </tr>

        </tbody>
    </table>
  </body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.js" charset="utf-8"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#example').DataTable( {
      // scrollY:        "300px",
      "scrollX":        true,
      "scrollCollapse": true,
      // paging:         false,
      "fixedColumns":   {
          "leftColumns": 1,
      }
  } );
} );
</script>
