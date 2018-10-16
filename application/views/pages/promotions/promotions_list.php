<div class="middle-content">
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row" style="margin-bottom: 0px!important;">
                <div class="col s12 m11 l11">
                    <div class="page-title">Promotions</div>
                </div>
                <div class="col s12 m1 l1">
                    <a href="promotions/create" class="btn-floating btn-large waves-effect waves-light blue"><i class="large material-icons">add</i></a>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-content"> 
                    <table class="responsive-table" id="promotions_table">
                        <thead>
                            <tr>
                                <th data-field="id">Promotion</th>
                                <th data-field="name">Discount</th>
                                <th data-field="price">Finish</th>
                                <th data-field="price">Acquisitions</th>
                                <th data-field="price">Status</th>
                                <th data-field="price">Enable/Disabled</th> 
                                <th data-field="price">Edit</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($promotions_list != null) {
                                foreach ($promotions_list as $promotion) {

                                    $assign_button = "";
                                    $active = intval($promotion["active"]);
                                    $edit_button = "<a data-id='" . $promotion["id_promotion"] . "' class='btn_edit_promotion btn-floating btn-mini waves-effect waves-light blue'>"
                                            . "<i class='material-icons'class>mode_edit</i></a>";

                                    $enable_button = "<a data-status='" . $promotion["active"] . "' data-id='" . $promotion["id_promotion"] . "' class='btn_enable_promotion btn-floating btn-mini waves-effect waves-light blue'>"
                                            . "<i class='material-icons'class>mode_edit</i></a>";

                                    $status_label = "<p>Active</p>";


                                    switch ($active) {
                                        case 1:
                                            $status_label = "<p style='color:green;'> Active </p>";
                                            $enable_button = "<a data-status='" . $promotion["active"] . "' data-id='" . $promotion["id_promotion"] . "' class='btn_enable_promotion btn-floating btn-mini waves-effect waves-light red'>"
                                                    . "<i class='material-icons'class>not_interested</i></a>";
                                            break;
                                        case 0:
                                            $status_label = "<p style='color:red;'>Unactive</p>";

                                            $enable_button = "<a data-status='" . $promotion["active"] . "' data-id='" . $promotion["id_promotion"] . "' class='btn_enable_promotion btn-floating btn-mini waves-effect waves-light green'>"
                                                    . "<i class='material-icons'class>done</i></a>";
                                            break;
                                    }


                                    echo "<tr>"
                                    . "<td> " . $promotion["title"] . " </td>"
                                    . "<td> " . $promotion["discount"] . "% </td>"
                                    . "<td> " . $promotion["finish_date"] . " </td>"
                                    . "<td> " . $promotion["users"] . " </td>"
                                    . "<td> " . $status_label . " </td>"
                                    . "<td> "
                                    . $enable_button
                                    . "</td>"
                                    . "<td> "
                                    . $edit_button
                                    . "</td>"
                                    . "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="promotion_edit_profile_modal" class="modal" style="
     top:2%!important; 
     width: 70%!important;
     ">
    <div class="modal-content">


        <div class="row" style="margin-bottom: 0px!important;">
            <div class="col s4">



                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Promotion title" id="edit_promotion_title" type="text" class="validate-form">

                        <label for="edit_promotion_title" class="active">* Promotion title</label>
                    </div>

                </div>

                <input  id="edit_promotion_code_old" type="text" style="display: none;">
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Promotion code" maxlength="6" id="edit_promotion_code" type="text" class="uppercase validate-form">

                        <label for="edit_promotion_code" class="active">* Promotion code</label>
                    </div>

                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix"><p style="    font-size: 19px;
                                                            text-align: center;
                                                            margin-top: 7px;
                                                            font-weight: bold;">%</p></i>
                        <input placeholder="Promotion discount" id="edit_promotion_discount" type="text" class="validate-form">
                        <label for="edit_promotion_discount" class="active">* Promotion discount</label>
                    </div>

                </div>




            </div>


            <div class="col s8">

                <div class="row">
                    <div class="input-field col s12">
                        <input id="edit_promotion_date"   class="validate-form" value="">
                        <label for="edit_promotion_date" class="active">* Date range</label>
                    </div>
                </div>


            </div>   
        </div>

        <div class="col s12 "> 
            <a id="promotion_edit_button" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">Edit</a> 
        </div>




    </div> 
</div>


<div id="promotion_error_modal" class="modal">
    <div class="modal-content">
        <h4 id="promotion_error_modal_title"></h4>
        <p  id="promotion_error_modal_desc"></p>
    </div>
    <div class="modal-footer">
        <a  id="promotion_error_modal_modal_button" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
    </div>
</div>