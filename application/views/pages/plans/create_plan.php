<div class="middle-content">
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row" style="margin-bottom: 0px!important;">
                <div class="col s12 m11 l11">
                    <div class="page-title">Create plan</div>
                </div>
                <div class="col s12 m1 l1">
      <a href="<?php echo PROYECT_ROOT . "plans" ?>" class="btn-floating btn-large waves-effect waves-light blue"><i class="large material-icons">arrow_back</i></a>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <form class="col s12">

                            <div class="row" style="margin-bottom: 0px!important;">
                                <div class="col s12">

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="create_plan_name" type="text" class="validate validate-form">
                                            <label for="create_plan_name">* Name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select id="create_plan_select">
                                                <option value="" disabled selected  id="create_plan_select_item">Choose category plan</option>
                                                <?php
                                                if ($category_plans) {
                                                    while ($category = $category_plans->fetch_assoc()) {
                                                        echo "<option value='" . $category["id_category"] . "'>" . $category["name"] . "</option>";
                                                    }
                                                }
                                                ?>   
                                            </select>
                                            <label>* Category</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input  id="create_plan_price" class="validate-form" type="text">
                                            <label for="create_plan_price">* Price</label>
                                        </div>
                                    </div>
                                    <div class="row"  id="url_payment_container" >
                                        <div class="input-field col s12">
                                            <input  id="create_plan_payment_url"  type="text">
                                            <label for="create_plan_payment_url">* Recurring payment URL</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea id="create_plan_desc" class="materialize-textarea  validate-form" length="120"></textarea>
                                            <label for="create_plan_desc">* Description</label>
                                        </div>
                                    </div>

                                </div>   

                            </div>   
                            <div class="col s12 "> 
                                <a id="create_plan_btn" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">Create</a> 
                            </div>


                            <div id="plan_error_modal" class="modal">
                                <div class="modal-content">
                                    <h4 id="plan_error_modal_title"></h4>
                                    <p  id="plan_error_modal_desc"></p>
                                </div>
                                <div class="modal-footer">
                                    <a  id="trigger_plan_error_modal_modal_button" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
