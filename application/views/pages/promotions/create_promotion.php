<div class="middle-content">
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row" style="margin-bottom: 0px!important;">
                <div class="col s12 m11 l11">
                    <div class="page-title">Create promotion</div>
                </div>
                <div class="col s12 m1 l1">
  <a href="<?php echo PROYECT_ROOT . "promotions" ?>" class="btn-floating btn-large waves-effect waves-light blue"><i class="large material-icons">arrow_back</i></a>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <form class="col s12">

                            <div class="row" style="margin-bottom: 0px!important;">
                                <div class="col s4">

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="promotion_title" type="text" class="  validate-form">
                                            <label for="cleaning_user_name">* Promotion title</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="promotion_code" maxlength="6" type="text" class=" uppercase validate-form">
                                            <label for="promotion_code">* Promotion code</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix"><p style="    font-size: 19px;
                                                                                text-align: center;
                                                                                margin-top: 7px;
                                                                                font-weight: bold;">%</p></i>
                                            <input id="promotion_discount"  maxlength="2" type="number" class="  validate-form">
                                            <label for="promotion_discount">* Promotion discount</label>
                                        </div>
                                    </div>

                                </div>


                                <div class="col s8">

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="promotion_date"   class="validate-form" value="">
                                            <label for="promotion_date" class="active">* Date range</label>
                                        </div>
                                    </div>


                                </div>   
                            </div>   
                            <div class="col s12 "> 
                                <a id="promotion_create_button" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">Create</a> 
                            </div>

                            <div id="promotion_modal" class="modal">
                                <div class="modal-content">
                                    <h4 id="promotion_modal_title"></h4>
                                    <p  id="promotion_modal_desc"></p>
                                </div>
                                <div class="modal-footer">
                                    <a  id="promotion_modal_button" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
