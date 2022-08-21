<?php $total_subtotal=0; $total_vat_amount=0; $total_total_amount=0;?>
<a class="btn btn-success mb-2" href="<?=base_url('product/addproduct')?>">Add New</a>
<table id="invoicetable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Invoice Number</th>
            <th>Supplier Name</th>
            <th>NIR No</th>
            <th>NIR Date</th>
            <th>Invoice Date</th>
            <th id="upsubtotal">Sub Total</th>
            <th id="upvat">VAT Amount</th>
            <th id="uptotal">Total Amount</th>
            <th>Invoice status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $index=0;?>
        <?php foreach ($products as $product):?>
        <?php if(!$product['isremoved']):?>
        <?php $index++;?>
        <tr>
            <td><?=($index)?></td>
            <td><?=$product['invoice_number']?></td>
            <td>
            <?php 
                $lines=json_decode($product['lines'], true);
                $result;
                foreach ($suppliers as $supplier){
                    if ($supplier['id'] == $product['supplierid']) {
                        $result = $supplier;
                    }
                }
                $subtotal=0; $vat_amount=0; $total_amount=0;
                foreach ($lines as $key => $line) {
                    $subtotal+=$line['amount_without_vat'];
                    $vat_amount+=$line['amount_vat_value'];
                    $total_amount+=$line['total_amount'];
                }
                $total_subtotal+=$subtotal;
                $total_vat_amount+=$vat_amount;
                $total_total_amount+=$total_amount;
                echo str_replace("_"," ", $result['name']);
                echo $result['isremoved']?"(<span id='boot-icon' class='bi bi-circle-fill' style='font-size: 12px; color: rgb(255, 0, 0);''></span>)":"";
            ?>
            </td>
            <td><?=$product['id']?></td>
            <td><?=$product['date_of_reception']?></td>
            <td><?=$product['invoice_date']?></td>
            <td><?=$subtotal?></td>
            <td><?=$vat_amount?></td>
            <td><?=$total_amount?></td>
            <td><?=$product['ispaid']?"<label class='status success'>Paid</label>":"<label class='status danger'>Not Paid</label>"?></td>
            <td class="form-inline flex justify-around">
                <a class="btn btn-primary" href="<?=base_url('product/editproduct/'.$product['id'])?>"><i class="bi bi-terminal-dash"></i></a>
                <button class="btn btn-danger " onclick="delProduct('<?=$product['id']?>')" <?=$product['isremoved']?"disabled":""?>><i class="bi bi-trash3-fill"></i></button>
            </td>
        </tr>
        <?php endif;?>
        <?php endforeach;?>
    </tbody>
</table>
<table id="total-table" class="table table-bordered table-striped absolute" style="width: 50%;">
    <thead>
        <tr>
            <th></th>
            <th>Sub Total</th>
            <th>VAT Amount</th>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td id="downtotalmark">Total:</td>
            <td id="subtotal"><?=$total_subtotal?></td>
            <td id="vat"><?=$total_vat_amount?></td>
            <td id="total"><?=$total_total_amount?></td>
        </tr>
    </tbody>
</table>
<script type="text/javascript">
    function getOffset(el) {
      const rect = el.getBoundingClientRect();
      return {
        left: rect.left,
        top: rect.top,
        width: rect.width
      };
    }

    function refreshbrowser() {
      const first_row_1 =  getOffset(upsubtotal);
      const first_row_2 = getOffset(upvat);
      const first_row_3 = getOffset(uptotal);

      console.log(first_row_1.left);

      document.getElementById("total-table").style.left = parseFloat(first_row_1.left - 100)+"px";

      console.log(document.getElementById("total-table").style.left);
      document.getElementById("total-table").style.width = parseFloat(100+first_row_1.width+first_row_2.width+first_row_3.width) + "px";
      document.getElementById("downtotalmark").style.width = 100+"px";
      document.getElementById("subtotal").style.width  = first_row_1.width + "px";
      document.getElementById("vat").style.width  = first_row_2.width + "px";
      document.getElementById("total").style.width  = first_row_3.width + "px";
    }

    refreshbrowser();
    
    onresize = (event) => {
      refreshbrowser();
    };
</script>