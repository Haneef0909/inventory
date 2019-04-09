<!DOCTYPE html>
<html>
    <head>
        <style>
          table,
          thead,
          tbody {
            width: 100%;
            border: 1px solid blue;
            border-collapse: collapse;
          }
      
          #item td,
          #item th {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
          }
          .center{
            text-align: center;
          }
        </style>
      </head>

<body>
  <div class="center">
    <h1 >Tool Request</h1>
  </div>

  <div>
      <table id="item">
        <thead>
          <tr>
            <th>Requested Item No</th>
            <th>Item Name </th>
            <th> Item Quantity</th>
            <th>Project</th>
            <th>User</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>101</td>
            <td>Screw Driver</td>
            <td>30</td>
            <td>Qasimabaad</td>
            <td>Guest User</td>
            <td><button>Accept</button><br><br><button>Reject</button></td>
          </tr>
        </tbody>
      </table>
    </div>

</body>

</html>