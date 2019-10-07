<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>STORES</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <h1>STORES</h1>
    <form onsubmit='return save_data()'>
      <div id='stores'>

      </div>
    </form>

    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
    <script type="text/javascript">
    var tbl = "";

    $(document).ready(function () {
      $.getJSON('http://localhost/storeschedule/public/api/stores', function(data) {

            tbl = data;

            var stores = data.stores;
            var text = "";

            var text = "<table>";
            text += "<tr><th>Store</th><th>Mo</th></tr>";

            for (var i = 0; i < stores.length; i++) {
              console.log(stores[i].name + "</td>");
              text += "<tr><td>" + stores[i].name + "</td>";
              for (var day = 0; day < 7; day++) {
                var checked = stores[i].days[day] == 1 ? "checked" : "";
                text += "<td><input type='checkbox' onclick='status_changed(" + i + "," + day + ", this)' " + checked + "></td>";
              }
              text += "</tr>";
            }
            text += "</table><br><input type='submit'>";
            $("#stores").html(text);

      });
    });


    function status_changed(i, day, cb) {
      tbl.stores[i].days[day] = cb.checked ? 1 : 0;
    }



    function save_data() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {tbl:tbl}
      });
      $.post('http://localhost/storeschedule/public/api/save/stores', function(data, status) {
        if (data.result == "OK") {
          alert("Data saved");
        }
        else {
          alert("Something wrong happened");
        }
      });

      return false;
    }
    </script>
  </body>
</html>
