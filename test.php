<form name="form1">
  <input type="radio" name="group1" value="t1">Yes
  <input type="radio" name="group1" value="t2">No<br />
  <input type="radio" name="group2" value="t1">Yes
  <input type="radio" name="group2" value="t2">No<br />
  <input type="radio" name="group3" value="t1">Yes
  <input type="radio" name="group3" value="t2">No<br />
  <br />
  <br />
  <input type="radio" name="group4" value="t1" onclick="selectAll(form1)">All Yes<br />
  <input type="radio" name="group4" value="t2" onClick="selectAll(form1)" >All No
</form>
<script type="text/javascript">
    function selectAll(form1) {

      var check = document.getElementsByName("group4"),
            radios = document.form1.elements;

        if (check[0].checked) {

            for( i = 0; i < radios.length; i++ ) {

                if( radios[i].type == "radio" ) {

                    if (radios[i].value == "t1" ) {

                        radios[i].checked = true;
                    }

                }

            }

        } else {

            for( i = 0; i < radios.length; i++ ) {

                if( radios[i].type == "radio" ) {

                    if (radios[i].value == "t2" ) {

                        radios[i].checked = true;

                    }

                }

            }

        };
      return null;
    }
    </script>
