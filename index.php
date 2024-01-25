
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Product Pricing Module</title>
    <style>
        .scrollable-table {
            max-height: 400px;
            overflow-y: auto;
        }

        .fixed-header {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
        }

        .cell {
            width: 160px;
            height: 40px;
            text-align: center;
        }

        .function-box {
            
            margin-top: 20px;
            margin-bottom: 30px;
        }

        #cellValue{

            width: 250px;
        }


th{
    font-size: 12px;
}
            .currency-box {
            border: 2px solid grey;
            border-radius: 34px;
            padding: 12px;
            width_: 200px; /* Adjust the width as needed */
            margin: auto; /* Center the box */
        }

    </style>
</head>
<body>

    <div class="container mt-4">
    <div class="row currency-box">

        <div class="col-md-2 mb-3">
            <label for="currency1" class="form-label">Today's Date</label>
         <input class="form-control" type="text" value="<?= date('Y-m-d'); ?>" readonly>

        </div>

        <div class="col-md-2 mb-3">
            <label for="currency1" class="form-label">Home Currency:</label>
            <select class="form-select" id="currency1" onchange="updateText()">
                <!-- Add major currencies as options -->
                <option value="NGN" selected>NGN</option>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <!-- Add more currencies as needed -->
            </select>
        </div>

        <div class="col-md-2 mb-3">
            <label for="currency2" class="form-label">Alt Currency:</label>
            <select class="form-select" id="currency2" onchange="updateText()">
                <!-- Add major currencies as options -->
                <option value="NGN">NGN</option>
                <option value="USD" selected>USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <!-- Add more currencies as needed -->
            </select>
        </div>

         <div class="col-md-2 mb-3">
            <label for="currency1" class="form-label">Alt Currency Rate</label>
         <input id="rate" class="form-control" type="number" value="1" min="1">

        </div>

          <div class="col-md-2 mb-3">
            <label for="currency2" class="form-label">Retail Margin %:</label>
            <select class="form-select" id="rt_margin" oninput="calcProfit()">
                 <?php for ($num = 0; $num < 101; $num++) : ?>

                        <option value="<?= $num ?>"><?= $num ?></option>

                <?php endfor; ?>
            </select>
        </div>


  <div class="col-md-2 mb-3">
            <label for="currency2" class="form-label">Wholesale Margin %:</label>
            <select class="form-select" id="wh_margin" oninput="calcProfit()">
                  <?php for ($num = 0; $num < 101; $num++) : ?>

                        <option value="<?= $num ?>"><?= $num ?></option>

                <?php endfor; ?>
            </select>
        </div>


    </div>
</div>


<div class="container mt-4">
    <div class="function-box">
       <!--  <label for="cellValue">Selected Cell Value:</label>
        <input type="text" id="cellValue" class="form-control_" readonly>
 -->
          <label for="cellValue" style="margin-left: 34px;">Total cost price <span class="cur_1 text">NGN</span>:</label>
          <input type="text" id="tcp" class="form-control_" readonly>

          <label for="cellValue" style="margin-left: 34px;">Total selling price <span class="cur_1 text">NGN</span>:</label>
          <input type="text" id="tsp" class="form-control_" readonly>

          <label for="cellValue" style="margin-left: 34px;">Profit in %:</label>
          <input type="text" id="profit" class="form-control_" readonly>

    </div>


    <div class="scrollable-table">
        <table class="table table-bordered">
            <thead class="fixed-header">
            <tr>
                <th class="cell">SN</th>
                <th class="cell">Product title</th>
                <th class="cell">Description</th>
                <th class="cell">Quantity</th>
                <th class="cell"><span class="cur_1 text">NGN</span> Cost Price</th>
                <th class="cell"><span class="cur_1 text">NGN</span> Unit Cost Price</th>
                <th class="cell"><span class="cur_1 text">NGN</span> Freight cost</th>
                <th class="cell"><span class="cur_2 text">USD</span> Freight cost</th>
                <th class="cell"><span class="cur_1 text">NGN</span> Total Cost Price</th>
                <th class="cell"><span class="cur_1 text">NGN</span> Total Selling Price</th>
                <th class="cell"><span class="cur_1 text">NGN</span> Unit Selling Price</th>
                
            </tr>
            </thead>
            <tbody>
            <!-- Rows with cells -->
            <!-- Add more rows as needed -->
            <?php for ($row = 1; $row <= 50; $row++) : ?>
                <tr>
                 <?php for ($col = 1; $col <= 11; $col++) : ?>

                    <td class="cell" id="<?= $row ?>_<?= chr(96 + $col) ?>">

                        <div class="input-group input-group-sm">
                            <input id="<?= $row ?>_<?= $col ?>" type="text" class="form-control border-0" placeholder_="Cell <?= $row ?><?= chr(96 + $col) ?>" oninput="updatePrice(<?= $row ?>, <?= $col ?>)" <?= ($col == 6 || $col > 8) ? 'readonly' : '' ?>>
                        </div>

                    </td>
                <?php endfor; ?>

                </tr>
            <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function showCellValue(cell) {

        var cellId = cell.id;
        var cellValue = $(cell).val();
        $('#cellValue').val(cellValue);
        console.log("Selected Cell: " + cellId + " - Value: " + cellValue);
    }
</script>



<script>
    function updateText() {
        var currency1 = $('#currency1').val();
        var currency2 = $('#currency2').val();

        $('.cur_1').text(currency1);
        $('.cur_2').text(currency2);
    }


    function updatePrice(row, id) {

        var purchase_price = parseFloat($('#'+row+'_5').val());
        var freight_price_1 = parseFloat($('#'+row+'_7').val());
        var freight_price_2 = parseFloat($('#'+row+'_8').val());

        var quantity= parseFloat($('#'+row+'_4').val());

        const wholesale_margin = parseInt( $('#wh_margin').val());

        var rate = parseInt( $('#rate').val());

        rate = rate > 0 ? rate : 1;

        if( purchase_price > 0 && quantity > 0 ){

            var unit_cost_price = Math.ceil((purchase_price/quantity)) //toFixed(2);
   
            $('#'+row+'_6').val(unit_cost_price);

        }

        if( purchase_price > 0 && freight_price_1 > 0 && freight_price_2 > 0 && quantity > 0 ){

            var total_cost_price = Math.ceil(( purchase_price + freight_price_1 + ( freight_price_2 * rate ) ));
            var total_selling_price = Math.ceil ( ((100 + wholesale_margin) /100) * total_cost_price);
            var selling_price_unit = Math.ceil( total_selling_price  / quantity);

            $('#'+row+'_9').val(total_cost_price);
            $('#'+row+'_10').val(total_selling_price);
            $('#'+row+'_11').val(selling_price_unit);

            calcProfit()
        }



    }


    function calcProfit() {

        var totalCostPrice = 0;
        var totalSellingPrice = 0;

        for (var row = 1; row <= 50; row++) {

            var costPrice = parseFloat(document.getElementById(row + '_9').value) || 0;
  
            var sellingPrice = parseFloat(document.getElementById(row + '_10').value) || 0;

            totalCostPrice += costPrice;
            totalSellingPrice += sellingPrice;
        }

        var percentageDifference = 0;

        if (totalCostPrice !== 0) {

            percentageDifference = ((totalSellingPrice - totalCostPrice) / totalCostPrice) * 100;
        }

        $('#profit').val(percentageDifference.toFixed(2) + "%");
        $('#tcp').val(totalCostPrice.toFixed(2));
        $('#tsp').val(totalSellingPrice.toFixed(2));

        console.log("Total Cost Price: " + totalCostPrice);
        console.log("Total Selling Price: " + totalSellingPrice);
        console.log("Percentage Difference: " + percentageDifference.toFixed(2) + "%");
    }


</script>

</body>
</html>


