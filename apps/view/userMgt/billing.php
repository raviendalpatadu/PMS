<?php
require_once '../../control/config.php';
$template = new template();
?>
<!DOCTYPE html>
<html lang="en">

<!--<head>-->
<?php $template->getHead(); ?>
<!--</head>-->

<body>
    <div class="loader"></div>

    <!--<header>-->
    <?php $template->getHeader(); ?>
    <!--</header>-->

    <!--<Sidebar menu>-->
    <?php $template->getSidebar(); ?>
    <!--</Sidebar>-->



    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"></div>
        </div>

        <!--</Sidebar>-->

        <div class="container-fluid">
            <hr>
            <h3>BILLING</h3>
            <div class="row-fluid">
                <div class="span12">
                    <!-- add product -->
                    <div class="span6">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"><i class="icon-plus"></i></span>
                                <h5>Add Product</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <form class="form-horizontal" method="post" action="#" name="bill_validate" id="bill_validate" novalidate="novalidate">
                                    <div class="control-group">
                                        <label class="control-label">Drug Name</label>
                                        <div class="controls">

                                            <input type="text" id="product_name" name="product_name">
                                            <input type="hidden" id="product_id" name="product_id">
                                            <input type="hidden" id="product_stock" name="product_stock">
                                            <div id="searchResultName"></div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Quantity</label>
                                        <div class="controls">
                                            <input type="number" name="product_quantity" id="product_quantity">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Price</label>
                                        <div class="controls">
                                            <input type="number" name="product_price" id="product_price">
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <input type="submit" value="Add" id="Add" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- billpart -->
                    <div class="span6">
                        <span id="msg_err">
                            <?php $template->showMessage(); ?>
                        </span>
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon">
                                    <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                                </span>
                                <h5><i class="icon-shopping-cart"></i>&nbsp Print</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered table-striped with-check">
                                    <thead>
                                        <tr>
                                            <th><i class="icon-resize-vertical"></i></th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Price</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TOTAL PART -->
                        <div class="span12">
                            <span class="span6">
                                <h4>Total:Rs.<span id="total">0.00</span> </h4>
                            </span>

                            <button id="print" class="btn btn-success span3">Print</button>

                            <span class="span3">
                                <button id="delete" class="btn btn-danger"> <i class="icon-trash"></i> Delete</button>
                            </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Footer-part-->
    <?php $template->getFooter(); ?>
    <!--Script-part-->
    <?php $template->getScript(); ?>
    <?php $template->getDataTables(); ?>
    <?php $template->alertDate($_SESSION['login_type']); ?>


</body>

</html>

<script>
    $(document).ready(function() {

        $('#product_id, #product_stock').hide();
        $('#product_price').prop('disabled', true);

        // autocomplete for drug name
        $('#product_name').keyup(function() {
            var alreadyInList = [];
            $('tr[class="odd gradeX"]').each(function() {
                alreadyInList.push($(this).attr('id'));
                console.log(alreadyInList);
            });
            $.ajax({
                type: "POST",
                url: "../../model/userMgt/_drugListAutoComplete.php",
                data: {
                    name: $('#product_name').val(),
                    alreadyInList: alreadyInList
                },
                success: function(data) {
                    $('#searchResultName').fadeIn();
                    // console.log(data);
                    $('#searchResultName').html(data);
                    // when a result is clicked
                    $("li[id^='drug_ida']").click(function() {
                        $('#product_id').val($(this).data('drugid'));
                        $('#product_name').val($(this).text());
                        $('#product_price').val($(this).data('drugprice'));
                        $('#product_stock').val($(this).data('drugstock'));
                        $('#searchResultName').fadeOut();
                        $('#product_quantity').focus();

                    });
                    // when cursor is hovered over the content
                    $("ul > li[id='drug_ida']").hover(function() {
                        // alert($(this).text());
                        $(this).css({
                            'background-color': '#00ffff',
                            'color': 'white'
                        });
                    }, function() {
                        $(this).css({
                            'background-color': 'transparent',
                            'color': 'black'
                        });

                    });


                }
            });
        });

        // when clicked out of the autocomplete box
        $('#product_name').focusout(function() {
            $('#searchResultName').fadeOut();
        });

        // validation of the form
        var validator = $("#bill_validate").validate({
            debug: true,
            rules: {
                product_name: {
                    required: true
                },
                product_quantity: {
                    required: true,
                    digits: true,
                    max: function() {
                        return parseInt($('#product_stock').val());
                    }
                },
                product_price: {
                    required: true,
                    number: true
                },
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
                $(element).parents('.control-group').removeClass('success');

            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            },

            submitHandler: function(form, e) {

                var name = $("#product_name").val();
                var id = $("#product_id").val();
                var quantity = $("#product_quantity").val();
                var price = $("#product_price").val();
                var stockk = $('#product_stock').val();
                var tot = parseFloat(price) * parseFloat(quantity);
                var gtot = parseFloat($('#total').text());


                // checks whether the drug is in the stock
                if (id != "") {
                    $('tbody').append('<tr class="odd gradeX" id="' + id + '"><td><input type="checkbox" /></td><td id="name"><i id="remove" class="icon-remove-sign"></i>&nbsp  ' + name + '</td><td id="qty">' + quantity + '</td><td id="price">' + price + '</td><td id="tot">Rs.' + tot.toFixed(2) + '</td></tr>');
                    $("#bill_validate input[id^='product'] ").val("");
                    sum();
                } else {
                    alert("Drug Not Valid");
                }

                // resets the form after submission
                $('.control-group').each(function() {
                    if ($(this).hasClass('success') || $(this).hasClass('error')) {
                        $(this).attr({
                            "class": "control-group"
                        });
                        $(this).children(".controls").find('span[class="help-inline"]').remove();
                    }
                });


                $(function() {
                    $("tr[class='odd gradeX'] > td[id='qty']").dblclick(function(event) {
                        event.stopImmediatePropagation() //<-------stop the bubbling of the event here
                        var currentEle = $(this);
                        var value = $(this).text();
                        updateVal(currentEle, value);
                    });
                });


                // updation part when dbl clicked on the item
                // it changes the <td> to <input> and when Enter is pressed or clicked out the value updates
                // along with the total colunm
                function updateVal(currentEle, value) {
                    var inputTag = '<div class="control-group"> <div class="controls"><input type="number" class="thVal" name="product_quantity" id="product_quantity" value="' + value + '"></div></div>';
                    $(currentEle).html(inputTag);
                    $(".thVal").focus();
                    $(".thVal").keyup(function(event) {
                        event.stopImmediatePropagation();
                        if (event.keyCode == 13) {
                            dblclickCheck();
                        }
                        
                    });

                    // checks whether the entered quantity is in the stock
                    function dblclickCheck() {
                        var newVal = $(".thVal").val();
                        if (parseInt(newVal) > parseInt(stockk)) {
                            $(currentEle).attr({'value': newVal});
                            $(".thVal").focus();
                            $(".thVal").parents('.control-group').addClass('error');
                            // console.log('focus out')
                            if ($('.controls > span').html() != 'Only '+ stockk + ' remains.') {
                                $(".thVal").parents('.controls').append('<span class="help-inline" generated="true">Only '+ stockk + ' remains.</span>');  
                            }
                            
                        } else {
                            $(currentEle).html($(".thVal").val());
                        }
                    }

                    $(currentEle).focusout(function(event) { // you can use $('html')
                        dblclickCheck();


                        // sets the price total
                        $('tr[class="odd gradeX"]').each(function() {
                            var qty = $(this).find("td[id='qty']").text();
                            var price = $(this).find("td[id='price']").text();
                            tot = parseFloat(qty * price);
                            $(this).find("td[id='tot']").text('Rs.' + tot.toFixed(2));
                        });


                        // sets the grand total 
                        var sum = 0;
                        $('td[id="tot"]').each(function() {
                            var splitRowTotal = $(this).text().split("Rs.");
                            sum += parseFloat(splitRowTotal[1]);
                            $('#total').html(sum.toFixed(2));
                        })
                    });
                }

                // addition part of the 
                function sum() {
                    var sum = 0;
                    $('td[id="tot"]').each(function() {
                        var splitRowTotal = $(this).text().split("Rs.");
                        sum += parseFloat(splitRowTotal[1]);
                        $('#total').html(sum.toFixed(2));
                    });
                    if ($('tbody').children().html() == null) {
                        $('#total').html('0.00');
                    }
                }

                // when remove icon is clicked
                $('td[id="name"] > i[id="remove"]').click(function() {
                    if (confirm('Are you sure you want to remove this item?')) {
                        $(this).closest('tr').remove();
                        sum();
                    }
                });

                $('#delete').click(function() {
                    $(':checked').closest("tr").remove();
                    sum();
                });

            },
            messages: {
                product_quantity: {
                    max: jQuery.validator.format("Only {0} left.")
                }
            }
        });



        // when print button is clicked
        $('#print').click(function() {
            $('tr[class="odd gradeX"]').each(function() {
                // console.log("id:"+$(this).attr('id'))
                // console.log("qty:"+$(this).find('td[id="qty"]').text())
                var drugId = $(this).attr('id');
                var drugQty = $(this).find('td[id="qty"]').text();
                var drugTot = $(this).find('td[id="tot"]').text();
                if (drugTot != 'Nan' ) {
                    $.ajax({
                        type: "POST",
                        url: "../../model/userMgt/_billGeneration.php",
    
                        data: {
                            drug_id: drugId,
                            drug_qty: drugQty,
                            drug_tot: drugTot
                        },
                        success: function(status, data) {
    
                            if (data == 'success') {
                                $('tbody').html('');
                                $('#total').text('0.00');
                            } else {
                                alert('falied');
                            }
                            validator.resetForm();
    
                        }
                    });
                }
                else{
                    alert("ERROR IN TOTAL AMOUNT")
                }
            })

        });




        // repeat the given process eveery 2 seconds
        // shows update and other messages
        setInterval(function() {
            $.ajax({
                type: "POST",
                url: "../../model/changes/showMsg.php",

                success: function(data) {
                    $('#msg_err').html(data);
                }
            });
        }, 2000);




    });
</script>